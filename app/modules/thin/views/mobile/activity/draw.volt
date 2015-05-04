<link rel="stylesheet" type="text/css" href="{{ static_url('css/mobile/game.css') }}">

<div class="main">
	<div class="table_bord"><img src="{{ static_url('img/table_bord.png') }}" /></div>
	<div class="lottery_table">
		<div class="l lottery_item"></div>
		<div class="l lottery_item"></div>
		<div class="r lottery_item"></div>
		<div class="l lottery_item"></div>
	</div>
	<div class="award_list">
		<div class="award"><img src="{{ static_url('img/award1.png') }}"  /></div>
		<div class="award"><img src="{{ static_url('img/award2.png') }}"  /></div>
		<div class="award"><img src="{{ static_url('img/award3.png') }}"  /></div>
		<div class="award">再接再厉</div>
	</div>
	<div class="lotterystart" id="draw-start" data-url="{{ url('/thin/activity/draw.json') }}">
		<div class="cover">抽奖</div>
	</div>
</div>

<div class="lottery_bottom">
	<a href="{{ url('/thin/activity/', ['redo': 1]) }}" class="btn remake">返回制作</a>
</div>


<script type="text/javascript">
	var SHARE_URL = "{{ url('/thin/activity/share/') }}",
    SHARE_DATA_URL = "{{ url('/thin/activity/share.json') }}",
    requesting = false;

function submitShare() {
    if (!requesting) {
        $.ajax({
            url: SHARE_DATA_URL,
            type: 'post',
            dataType: 'json',
            beforeSend: function(){
                requesting = true;
            },
            error: function(){
                requesting = false;
                $.alert('与服务器通讯失败，请重试！');
            },
            success: function(data){
                requesting = false;
                $.alert(data.errmsg);
            }
        });
    }
}

function showShare() {
    if (!requesting) {
        $.ajax({
            url: SHARE_URL,
            type: 'get',
            dataType: 'html',
            beforeSend: function(){
                requesting = true;
            },
            error: function(){
                requesting = false;
                $.alert('与服务器通讯失败，请重试！');
            },
            success: function(html){
                requesting = false;
                var d = dialog({
                    title: '邀请好机油',
                    content: html,
                    okValue: '发布微博',
                    ok: function(){
                        submitShare();
                    },
                    cancelValue: '取消',
                    cancel: function(){}
                });
                //d.showModal();
            }
        });
    }
}


$(document).ready(function() {
	$('#draw-start').click(function(e){
        e.preventDefault();
        var self = $(this),
            myData = self.data();

        if (!self.data('running')) {
            $.ajax({
                url: myData['url'],
                type: 'post',
                dataType: 'json',
                beforeSend: function(){
                    self.data('running', true);
                },
                error: function(){
                    self.removeData('running');
                    $.alert('与服务器通讯失败，请重试！');
                },
                success: function(data){
                    if (data.errcode) {
                        self.removeData('running');
                        var button = [];
                        if (data.noShare && data.drawLeft == 0) {
                            var btn = {
                                value: '邀请好机油',
                                callback: function (){
                                    showShare();
                                }
                            };
                            button.push(btn);
                        }
                        $.alert(data.errmsg, button);
                    } else {
                        $('.lottery_table').draw(data.result, function(){
                            self.removeData('running');
                            $.alert(data.errmsg);
                        });
                    }
                }
            });
        }
    });
    
})

Draw = (function() {
  function Draw(el) {
    this.el = el;
    this.current = 0;
    this.width = this.el.width();
    this.height = this.el.height();
    this.timer = null;
    this.slideTime = 400;
    this.size = 4;
  }

  Draw.prototype.run = function(stop, callback, step) {
    if (step == null) {
      step = 0;
    }
    if (stop > this.size) {
      stop = stop % this.size;
    }
    this.current += 1;
    if (this.current > this.size) {
      this.current = 1;
    }
    this.el.children().removeClass("active").eq(this.current-1).addClass("active");
    if (step < 3.3 || this.current !== stop) {
      return setTimeout((function(_this) {
        return function() {
          step += 0.08;
          return _this.run(stop, callback, step);
        };
      })(this), this.slideTime - (this.slideTime - 50) * Math.sin(step));
    } else {
      if (typeof callback === 'function') {
        return callback.call(this);
      }
    }
  };

  return Draw;

})();

$.fn.draw = function(stop, callback) {
  return this.each(function() {
    var draw;
    draw = $(this).data('draw');
    if (!draw) {
      draw = new Draw($(this));
      $(this).data('draw', draw);
    }
    return draw.run(stop, callback);
  });
};
	
	
</script >
	
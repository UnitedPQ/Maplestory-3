<div class="game-draw clearfix">
    <a href="{{ url('/thin/activity/', ['redo': 1]) }}" class="btn back-btn" data-pjax><span>返回制作</span></a>

    <div id="draw" class="draw">
        <img src="{{ static_url('img/prize.png') }}" class="prize-img">

        <a href="#" id="draw-start" class="draw-start" data-url="{{ url('/thin/activity/draw.json') }}">
            <img src="{{ static_url('img/draw.png') }}">
        </a>
    </div>
</div>

<div class="global-nav absolute">
    <a href="{{ url('/thin/') }}" class="first" data-pjax>活动首页</a>
    <a href="{{ url('/thin/intro/') }}" data-pjax>活动规则</a>
    <a href="{{ url('/prize/my/', ['module': 'thin']) }}" data-pjax>我要兑奖</a>
    <a href="{{ url('/prize/', ['module': 'thin']) }}" class="last" data-pjax>中奖名单</a>
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
                d.showModal();
            }
        });
    }
}

$(document).ready(function(){
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
                        $('#draw').draw(data.result, function(){
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
                        });
                    }
                }
            });
        }
    });
});
</script>
var preload = null;
var winwidth = winheight = process = has_load_num = 0;
var rem = 10;
var load_timer ;
var complete_load = false;
var img_list = [
                docUrl + "img/page7.jpg",
                docUrl + "img/rotate.png",
                docUrl + "img/turntable.png",
                docUrl + "img/sharepoint.png",
                docUrl + "img/sprite.png",
                docUrl + "img/rules.png",
                docUrl + "img/page-left-arrowb.png"
                ];
var lyricsNum = 26; //歌词总数
var isShowShare = false;

var Draw = (function() {
  function Draw(el) {
    this.el = el;
    this.current = 0;
    this.width = this.el.width();
    this.height = this.el.height();
    this.timer = null;
    this.slideTime = 40;
    this.running = false;
    this.config = [
      0,              //再接再厉
      90,             //x5max
      180,            //耳机
      270             //电源
    ]
    this.size = this.config.length;
    this.step = 0;
  }
  Draw.prototype.init = function(stop, callback){
    if(this.running){return};
    this.running = true;
    this.step = 0;
    this.run(stop, callback);
  }

  Draw.prototype.run = function(stop, callback) {
    if (stop > this.size) {
      stop = stop % this.size;
    }

    if(this.step < 3){
      this.step += 0.02;
    }
    this.current += Math.ceil((Math.sin(this.step)*50));
    if (this.current > 360) {
      this.current = this.current%360;
    }
    //console.log(Math.ceil((Math.sin(this.step)*50)));
    this.el.css({
      '-webkit-transform': "rotate("+this.current+"deg)",
      'transform': "rotate("+this.current+"deg)"
    });
    if (this.step < 3 || !(this.isArrive(stop))) {
      return setTimeout((function(_this) {
        return function() {
          return _this.run(stop, callback);
        };
      })(this), this.slideTime);
    } else {
      this.running = false;
      if (typeof callback === 'function') {
        return callback.call(this);
      }
    }
  };
  Draw.prototype.isArrive = function(stop){
    var stopdeg = this.config[stop]?this.config[stop]:0;
    //console.log(stopdeg);
    var close1 = 60;
    var step1 = 3.04;
    var close2 = 30;
    var step2 = 3.08;
    var diff = 10;
    console.log(this.step);

    if(stopdeg == 0){
      if((this.current > 360-diff || this.current < diff)){
        return true;
      }
    }else{
    
      if(this.current > stopdeg - diff && this.current < stopdeg + diff){
        return true;
      }
    }
    return false;
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
    return draw.init(stop, callback);
  });
};

var Slide = (function() {
function Slide(el, o,startIndex,isLoop) {
    this.el = el;
    this.o = $.extend({
      slideTime: 400
    }, o || {});
    this.listObj = this.el.children();
    this.totalPage = this.listObj.size();
    this.nowIndex = this.nowIndex>0?this.nowIndex:1;
    //this.listObj.eq(this.nowIndex-1).addClass("active").siblings().children().addClass("none");
    this.listObj.eq(this.nowIndex-1).addClass("active");

    this.animateTimer = null ;
    this.animateObj = [];
    this.el.css({
      "width": (winwidth) + "px",
      "height": winheight + "px"
    });
    for(var i=0;i<this.totalPage;i++){
      this.listObj.eq(i).css({"z-index": i+1 });
      if(i!=0){
        this.listObj.eq(i).css({
          '-webkit-transform': "translateX("+winwidth+"px)",
          'transform': "translateX("+winwidth+"px)",
        });
      }
    }
    this.listObj.css({
      "width": winwidth + "px",
      "height": winheight + "px"
    });
    this.onSlide = false;
    $(".winner_list").on("tap",(function(_this){
      return function(){
        return _this.slideTo(2);
      }
    })(this));
    $(".getprize").on("tap",(function(_this){
      return function(){
        $.ajax({
          url: '/newyear/win/exchange.json',
          type: 'get',
          dataType: 'json',
          success: function(data) {
            if (data.errcode == 0) {
              $('#award-title').html(data.errmsg);
              _this.slideTo(3);
            } else {
              showmsg(data.errmsg);
            }
          }
        });
      }
    })(this));
    $(".page02 .goback").on("tap",(function(_this){
      return function(){
        return _this.slideTo(1);
      }
    })(this));
  }

  Slide.prototype.slideIt = function(idx , obj) {
    var nextIndex;
    if(typeof obj == "object"){
      self = obj;
    }else{
      self = this;
    }
    var nextIndex = 0;
    var totalPage = 0;
    if (idx === 'prev' || idx === 'prevTo') {
      nextIndex = self.nowIndex - 1;
    }else if(idx === 'next' || idx === 'nextTo'){
      nextIndex = self.nowIndex + 1;
    }else{
      nextIndex = self.nowIndex;
    }

    //滑动的时候不能达到最后1页
    //disable 的页面不能通过滑动操作
    if(idx === 'prev' || idx === 'next'){
      if(self.listObj.eq(self.nowIndex-1).hasClass("disable")){ return; }
      if( idx === 'next' && self.listObj.eq(self.nowIndex-1).hasClass("nextdisable")){ return; }
      if( idx === 'prev' && self.listObj.eq(self.nowIndex-1).hasClass("prevdisable")){ return; }
    }
    totalPage = self.totalPage;

    //下一页
    if (nextIndex > 0 && nextIndex < totalPage+1 ) {
      self.listObj.css({
        "-webkit-transition": "all 0.2s linear",
        "transition": "all 0.2s linear"
      });

      if(idx == "next" || idx === 'nextTo'){
        self.listObj.eq(self.nowIndex-1).css({
          '-webkit-transform': "translateX("+(-winwidth)+"px)",
          'transform': "translateX("+(-winwidth)+"px)",
        });
        self.listObj.eq(nextIndex-1).css({
            '-webkit-transform': "translateX(0px)",
            'transform': "translateX(0px)",
        });
        
        self.onSlide = false;
        self.nowIndex = nextIndex;
        self.listObj.eq(self.nowIndex-1).addClass("active").siblings().removeClass("active");
        if(self.nowIndex >= 2 && self.nowIndex <= 7){
          $(".skip").css({"opacity":"0.8"});
        }else{
          $(".skip").css({"opacity":"0"});
        }
        if(self.nowIndex >= 7){
          $(".page-left-arrow").addClass("none");
        }
      }else{
        self.listObj.eq(self.nowIndex-1).css({
          '-webkit-transform': "translateX("+(winwidth)+"px)",
          'transform': "translateX("+(winwidth)+"px)",
        });
        self.listObj.eq(nextIndex-1).css({
          '-webkit-transform': "translateX(0px)",
          'transform': "translateX(0px)",
        });
        self.onSlide = false;
        self.nowIndex = nextIndex;
        self.listObj.eq(self.nowIndex-1).addClass("active").siblings().removeClass("active");
      }

      return;
    } else if(nextIndex >= totalPage+1){//翻到底页
      
      return self.onSlide = false;
    } else{
      return self.onSlide = false;
    }
  };

  Slide.prototype.slideTo = function(pageno,obj) {
    if(typeof obj == "object"){
      self = obj;
    }else{
      self = this;
    }
    if(pageno < 1 || pageno > self.totalPage){ return; }
    if(pageno > self.nowIndex){
      self.slideIt("nextTo");
    }else if(pageno < self.nowIndex){
      self.slideIt("prevTo");
    }

    if(pageno != self.nowIndex){

      self.slideTo(pageno,self);
    }
  };

  return Slide;
})();

$.fn.slide = function(o) {
  return this.each(function() {
    var slideObj;
    slideObj = new Slide($(this), o,1);
    sobj = slideObj;
    return $(this).data('slideobj', slideObj);
  });
};

$(document).ready(function() {
  orientationchange();
	pageinit();
  //preLoadQ();     //跳过预加载
  preLoadComplete();

	window.addEventListener("touchmove",function(e){
    e.preventDefault();
  })

  //分享浮层
  $(".toshare").on("tap",function(){
    $(".shareview").show();
  })
  $(".shareview").on("tap",function(){
    $(".shareview").hide();
  })

  //切换中奖名单
  $(".page02 .tag_list .award_tag").on("tap",function(){
    $(this).addClass("on").siblings().removeClass("on");
    var index = $(this).index();
    console.log(index);
    $(".page02 .name_list").children().eq(index).show().siblings().hide();
  })

  $(".page01 .machine .start").on("tap",function(){
    var me = $(this);
    if (!me.data('requesting')) {
      me.data('requesting', true);
      $.ajax({
        url: '/newyear/win/do.json',
        dataType: 'json',
        type: 'post',
        beforeSend: function() {
          me.data('requesting', true);
        },
        error: function() {
          me.removeData('requesting');
          showmsg('与服务器通讯失败');
        },
        success: function(data) {
          $('#draw-left').html(data.drawLeft);
          if (data.errcode == 0) {
            $(".page01 .turntable").draw(data.itemId,function(){
              showmsg(data.errmsg);
              me.removeData('requesting');
            });
          } else {
            showmsg(data.errmsg);
            me.removeData('requesting');
          }
        }
      })
    }
  });

  $('#exchange-submit').on('click', function(e){
    e.preventDefault();
    var form = $('#exchange-form');
    if (!form.data('submiting')) {
      form.data('submiting', true);
      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        data: form.serialize(),
        beforeSend: function(){
          form.data('submiting', true);
        },
        error: function(){
          form.removeData('submiting');
          showmsg('兑奖失败，请重试');
        },
        success: function(data) {
          form.removeData('submiting');
          if (data.errcode == 0) {
            $('.swiper-wrapper').data('slideobj').slideTo(1);
            showmsg(data.errmsg);
          } else {
            showmsg(data.errmsg);
          }
        }
      });
    }
  });
})

function pageinit(){
  var winsize = getWinSize();
  if(IsPC()){
    $("body").css({"width":"480px","height":"100%"});
    winwidth = 480;
    winheight = winsize.height;
  }else{
    if(winsize.width < winsize.height){
      winwidth = winsize.width;
      winheight = winsize.height;
    }else{
      winwidth = winsize.height;
      winheight = winsize.width;
    }
  }

  rem = winwidth / 32;
  rem = rem.toFixed(1);
  $("html").css("font-size",rem+"px");
  $("body,.shareview ,.main").width(winwidth).height(winheight);

  $(".pageloading .loadimg").removeClass("none");;

}

function preLoadQ(){
  var itemsParam = [];
  for(var i = 0; i< img_list.length; i++){
    itemsParam.push({ type : "img" , src:img_list[i]});
  }
  console.log(itemsParam);
  var queue=new ProcessQ({
      items : itemsParam,
      onProgressing : function(deltaTime,queue){
          //console.log( "progressing" , queue.finishedWeight," of ",queue.totalWeight);
      },
      onFinish : function(queue){
          preLoadComplete();
          console.log("finished : " , queue.finishedCount );
      }
  });
  queue.init();
  queue.start();
}

function preLoadComplete() {
  console.log("complete");
  $('.swiper-wrapper').slide();
  pageLoading("hide");
}


function IsPC()  
{  
   var userAgentInfo = navigator.userAgent;  
   var Agents = new Array("Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod");  
   var flag = true;  
   for (var v = 0; v < Agents.length; v++) {  
       if (userAgentInfo.indexOf(Agents[v]) > 0) { flag = false; break; }  
   }  
   return flag;  
}

//---页面等待---//
function pageLoading(sw){
	if (sw == "show"){
		$(".fullmask,.pageloading").show();
	}
	if (sw == "hide"){
		$(".fullmask,.pageloading").hide();
	}
}

var preload = null;
var winwidth = winheight = process = has_load_num = 0;
var rem = 10;
var load_timer ;
var complete_load = false;
var img_list = [
                docUrl + "img/page2.jpg",
                docUrl + "img/page3.jpg",
                docUrl + "img/page4.jpg",
                docUrl + "img/page5.jpg",
                docUrl + "img/page6.jpg",
                docUrl + "img/page7.jpg",
                docUrl + "img/page1.png",
                docUrl + "img/page2.png",
                docUrl + "img/page3.png",
                docUrl + "img/page4.png",
                docUrl + "img/page5.png",
                docUrl + "img/page6.png",
                docUrl + "img/page7.png",
                docUrl + "img/sharepoint.png",
                docUrl + "img/page-left-arrow.png",
                docUrl + "img/page-left-arrowb.png"
                ];
var lyricsNum = 26; //歌词总数
var pageMark = 8;
var pageView = 9;
var isShowShare = false;
var sobj = null;
var forceToIndex = false;

var Slide = (function() {
function Slide(el, startIndex) {
    this.el = el;
    this.listObj = this.el.children();
    this.totalPage = this.listObj.size();
    this.nowIndex = startIndex>0?startIndex:1;

    //this.listObj.eq(this.nowIndex-1).addClass("active").siblings().children().addClass("none");
    this.listObj.eq(this.nowIndex-1).addClass("active");

    this.animateTimer = null ;
    this.animateObj = [];
    this.el.css({
      "width": (winwidth) + "px",
      "height": winheight + "px"
    });

    this.listObj.css({
      "width": winwidth + "px",
      "height": winheight + "px"
    });

    for(var i=0;i<this.totalPage;i++){
      this.listObj.eq(i).css({"z-index": i+1 });
      if( i+1 > this.nowIndex){
        this.listObj.eq(i).css({
          '-webkit-transform': "translateX("+winwidth+"px)",
          'transform': "translateX("+winwidth+"px)",
        });
      }else{
        this.listObj.eq(i).css({
          '-webkit-transform': "translateX(0)",
          'transform': "translateX(0)",
        });
      }
    }
    this.listObj.css({
      "-webkit-transition": "all 0.2s linear",
      "transition": "all 0.2s linear"
    });

    if(this.nowIndex == pageView){
      setTimeout(function(){
        musicFlyControl.start();
      },400);
    }
    this.showArrow();
    this.onSlide = false;
    $(el).on("swipeLeft",(function(_this) {
      return function() {
        return _this.slideIt('next');
      };
    })(this)).on("swipeRight",(function(_this) {
      return function() {
        return _this.slideIt('prev');
      };
    })(this));
    
    $(window).on("swipeUp",function(e) {
      return e.preventDefault();
    }).on("swipeDown",function(e) {
      return e.preventDefault();
    }).on("keydown",(function(_this) {
      return function(e) {
        if (e.keyCode === 37) {
          return _this.slideIt('prev');
        } else if (e.keyCode === 39) {
          return _this.slideIt('next');
        }
      };
    })(this));

    $(".page-left-arrow").on("tap",(function(_this) {
      return function() {
        return _this.slideIt('next');
      };
    })(this)).on("swipeLeft",(function(_this) {
      return function() {
        return _this.slideIt('next');
      };
    })(this));
    $(".page08 .tryagain").on("tap",(function(_this){
      return function(){
        if (forceToIndex) {
          forceToIndex = false;
          return _this.slideTo(1);
        } else {
          return _this.slideTo(pageMark);
        }
      }
    })(this));
    $(".page08 .metoo").on("tap",(function(_this){
      return function(){
        if (typeof sobj == "object"){
          return _this.slideTo(1);
        }
      }
    })(this));
    $(".skip").on("tap",(function(_this){
      return function(){
        if (typeof sobj == "object"){
          return _this.slideTo(pageMark);
        }
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
      //self.listObj.eq(nextIndex-1).children().removeClass("none");


      if(idx == "next" || idx === 'nextTo'){
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
        
      }else{
        self.listObj.eq(self.nowIndex-1).css({
          '-webkit-transform': "translateX("+(winwidth)+"px)",
          'transform': "translateX("+(winwidth)+"px)",
        });
        self.onSlide = false;
        self.nowIndex = nextIndex;
        self.listObj.eq(self.nowIndex-1).addClass("active").siblings().removeClass("active");
        if(self.nowIndex >= 2 && self.nowIndex <= 7){
          $(".skip").css({"opacity":"0.8"});
        }else{
          $(".skip").css({"opacity":"0"});
        }
      }

      //第9页为有音符飘的页面
      if(self.nowIndex == pageView){
        musicFlyControl.start();
      }else{
        musicFlyControl.stop();
      }
      self.showArrow();
      return;
    } else if(nextIndex >= totalPage+1){//翻到底页
      //$(".shareview").removeClass("none");
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
      if(pageno > self.nowIndex+1){
        this.listObj.css({"-webkit-transition": "none","transition": "none"});
      }
      self.slideIt("nextTo");
    }else if(pageno < self.nowIndex){
      if(pageno < self.nowIndex-1){
        this.listObj.css({"-webkit-transition": "none","transition": "none"});
      }
      self.slideIt("prevTo");
    }
    this.listObj.css({"-webkit-transition": "all 0.2s linear","transition": "all 0.2s linear"});
    if(pageno != self.nowIndex){
      self.slideTo(pageno,self);
    }
  };

  Slide.prototype.showArrow = function() {
    if(this.nowIndex < pageMark){
      $(".page-left-arrow").show();
      if(this.nowIndex != 1){
        $(".page-left-arrow img").attr("src",docUrl+"img/page-left-arrow.png");
      }else{
        $(".page-left-arrow img").attr("src",docUrl+"img/page-left-arrowb.png");
      }
    }
    else{
      $(".page-left-arrow").hide();
    }
  }

  return Slide;
})();

$.fn.slide = function(startIndex) {
  return this.each(function() {
    var slideObj;
    slideObj = new Slide($(this),startIndex);
    sobj = slideObj;
    return $(this).data('slideobj', slideObj);
  });
};

var Disk = {
  create : function(name,lyrics_no){
    $(".page08 .tle .title").html("我的音乐运势");
    $(".page08 .operate .tryagain,.page08 .operate .towin").removeClass("none");
    $(".page08 .operate .metoo").addClass("none");
    $(".page08 .mydisk .myname").html(name);
    $(".page08 .mydisk .lyrics").removeClass().addClass("lyrics lyrics"+lyrics_no);
    sobj.slideTo(pageView);
  },
  friend : function(name,lyrics_no){
    $(".page08 .tle .title").html("好友的音乐运势");
    $(".page08 .operate .tryagain,.page08 .operate .towin").addClass("none");
    $(".page08 .operate .metoo").removeClass("none");
    $(".page08 .mydisk .myname").html(name);
    $(".page08 .mydisk .lyrics").removeClass().addClass("lyrics lyrics"+lyrics_no);
    sobj.slideTo(pageView);
  },
  submit : function(name,lyrics_no){
    //提交成功
    this.create(name,lyrics_no);
  }
}

$(document).ready(function() {
  orientationchange();
  pageinit();

  preLoadQ();

  window.addEventListener("touchmove",function(e){
    e.preventDefault();
  })

  $(".shareview").on("tap",function(){
    $(".shareview").hdie();
  })
  //活动规则
  $(".home .rule").on("tap",function(){
    $(".rules").show();
  })
  $(".rules .btn").on("tap",function(){
    $(".rules").hide();
  })
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
  $("body,.shareview ,.rules").width(winwidth).height(winheight);
  $(".page-left-arrow").css("top", ((winheight-2.2*rem)/2) + "px").removeClass("none");
  $(".page08 .mydisk").css("top", ((winheight-25*rem)/2) + "px");

  $(".fullmask").hide();
  

  //判断是哪种情况进入页面
  if(friend.name != ""){
    $(".swiper-wrapper").slide(pageView);
    Disk.friend(friend.name,friend.lyrics_no);
  }else if(myinfo.name != ""){
    $(".swiper-wrapper").slide(pageView);
    Disk.create(myinfo.name,myinfo.lyrics_no);
    forceToIndex = true;
  }else{
    $(".swiper-wrapper").slide();
  }
  
  $(".pageloading .loadimg").removeClass("none");
}

function preLoadQ(){
  var itemsParam = [];
  for(var i = 0; i< img_list.length; i++){
    itemsParam.push({ type : "img" , src:img_list[i]});
  }
  //console.log(img_list);
  var queue=new ProcessQ({
      items : itemsParam,
      onProgressing : function(deltaTime,queue){
          //console.log( "progressing" , queue.finishedWeight," of ",queue.totalWeight);
      },
      onFinish : function(queue){
          preLoadComplete();
          //console.log("finished : " , queue.finishedCount );
      }
  });
  queue.init();
  queue.start();
}

function preLoadComplete() {
  pageLoading("hide");


/*  if (typeof sobj == "object"){
    sobj.slideTo(pageView);
  }
*/
  //指纹扫描

  //zepto longTap 750ms
  //自定义 onlongtap 1800ms
  var sending = false;
  $(".taparea").on("longTap",function(){
    var name = $("#yourname").val();
    if(name == ""){
      showmsg("请先输入您的名字");
      console.log("longTap");
    }
  }).onlongtap(function(){
    var name = $("#yourname").val();
    if(name == ""){
      showmsg("请先输入您的名字");
      console.log("onlongtap");
    }else{
      if (!sending) {
        sending = true;
        $.ajax({
          url: '/newyear/index/save.json',
          type: 'post',
          dataType: 'json',
          data: {name: name},
          beforeSend: function() {
            sending = true;
          },
          error: function() {
            sending = false;
            showmsg('与服务器通讯失败');
            $(".taparea").siblings(".scan").removeClass("ontap");
          },
          success: function(data) {
            sending = false;
            if (data.errcode == 0) {
              window.shareData.title = data.shareTitle;
              window.shareData.url = data.shareUrl;
              if (typeof refreshShareData == 'function') {
                refreshShareData();
              }
              Disk.submit(name, data.lyricNo)
            } else {
              showmsg(data.errmsg);
            }
            $(".taparea").siblings(".scan").removeClass("ontap");
          }
        });
      }
    }
  }).on("touchstart",function(){
    var name = $("#yourname").val();
    if(name == ""){
      //showmsg("请先输入您的名字");
    }else{
      $(this).siblings(".scan").addClass("ontap");
    }
  }).on("touchend touchmove",function(){
    $(this).siblings(".scan").removeClass("ontap");
  })

}


$.fn.onlongtap = function(callback){
  return this.each(function() {
    var touch = {},
    longTapTimeout,
    longTapDelay = 1800,
    now;

    function longTap() {
      longTapTimeout = null
      if (touch.last) {
        callback();
        touch = {}
      }
    }
    $(this).on('touchstart MSPointerDown pointerdown', function(e){
      now = Date.now()
      touch.last = now
      longTapTimeout = setTimeout(longTap, longTapDelay);
    })
    .on('touchmove MSPointerMove pointermove', function(e){
      touch.last = null;
      if (longTapTimeout) clearTimeout(longTapTimeout);
      longTapTimeout = null;
    })
    .on('touchend MSPointerUp pointerup', function(e){
      touch.last = null;
      if (longTapTimeout) clearTimeout(longTapTimeout);
      longTapTimeout = null;
    });
    

  });
};


//---页面等待---//
function pageLoading(sw){
  if (sw == "show"){
    $(".fullmask,.pageloading").show();
  }
  if (sw == "hide"){
    $(".fullmask,.pageloading").hide();
  }
}


$(document).ready(function(){
  $(".btn").on("touchstart mousedown",function(){
    $(this).addClass("on");
  }).on("touchend mouseup",function(){
    $(this).removeClass("on");
  })
})

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
function getWinSize(){
  var winWidth = 0 , winHeight = 0;
  // 获取窗口宽度
  if (window.innerWidth)
  winWidth = window.innerWidth;
  else if ((document.body) && (document.body.clientWidth))
  winWidth = document.body.clientWidth;
  // 获取窗口高度
  if (window.innerHeight)
  winHeight = window.innerHeight;
  else if ((document.body) && (document.body.clientHeight))
  winHeight = document.body.clientHeight;
  // 通过深入 Document 内部对 body 进行检测，获取窗口大小
  if (document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth)
  {
  winHeight = document.documentElement.clientHeight;
  winWidth = document.documentElement.clientWidth;
  }
  
  return {width:winWidth,height:winHeight};
}

//自定义提示框
function showmsg(msg){
  if($("#msgbox").length > 0){
    $("#msgbox #msgbox").html(msg);
  }else{
    var box = $("<div />",
              {
              id:"msgbox",
              css:{
                "position": "absolute","left": "4rem","top": "25%","width": "24rem","height": "10rem", 
                "background-color": "rgba(166, 100, 73, 0.9)","border-radius": "1rem","z-index": "10000",
                "-webkit-transform": "scale(0)","transform": "scale(0)",
                "-webkit-transition": "all 0.2s linear", "transition": "all 0.2s linear"
              }
              });
    var close = $("<div />",
              {
              text:"×",
              id:"closebox",
              css:{
                "position": "absolute","right": "0","top": "-1.5rem","width": "3rem","height": "3rem", 
                "background-color": "#ffffff","border-radius": "50%","z-index": "10001", "line-height":"3rem",
                "border":"0.2rem solid #af735a", "font-size":"3rem", "color":"#af735a",
                "text-align": "center"
              }
              });
    var msg = $("<div />",
              {
              text:msg,
              id:"msgbox",
              css:{
                "width": "20rem","height": "3rem", "line-height":"3rem","text-align": "center",
                "font-size": "1.6rem", "color":"#ffffff",
                "padding": "3.5rem 2rem"
              }
              });

    box.append(close);
    box.append(msg);
    $("body").append(box);

    setTimeout("$('#msgbox').css({'-webkit-transform': 'scale(1)','transform': 'scale(1)'});",100);
    $("#msgbox #closebox").off().on("tap",function(){
      box.css({"-webkit-transform": "scale(0)","transform": "scale(0)"});
      setTimeout("$('#msgbox').remove();",300);
    })
  }
}

function orientationchange() {
    var size = "";
    if (window.orientation == 90 || window.orientation == -90) {
        var $tips = $('<div class="orientation"><div class="cni"><img src="./img/henping.png" alt=""></div><div class="cnt">竖屏环境下，体验会更好哦！</div></div>');
        $tips.appendTo($('body'));
        return;
        $cnt = $tips.find('.cnt');
        var tw = $cnt.width();
        var th = $cnt.height();
        $cnt.css({
            'margin-top': $(window).height() / 4 + 'px',
            'margin-left': $(window).width() * 0.15 + 'px',
            'line-height': th + 'px' 
        });
        $tips.find('.close-btn').on('touchstart', function(e){
            e.preventDefault();
            $tips.remove();
        });
    } else {
        $('.orientation').remove();
    }
}

window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", orientationchange, false); 

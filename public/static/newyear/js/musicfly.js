var lastTime = 0;
var endTime = 0;
var animateObj = [];
var animateTimer = null;
//var raf = function (callback) { var timer = window.setTimeout(callback, 1000 / 30); return timer;};
var raf = function () {
  var currTime = new Date().getTime();
  var timeToCall = Math.max(30, (endTime - lastTime));
  var id = window.setTimeout(function() {
      animateUpdate(animateObj);
  }, timeToCall);
  lastTime = currTime + timeToCall;
  return id;
}
/*var raf = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function (callback) { 
  var currTime = new Date().getTime();
  var timeToCall = Math.max(0, 16 - (currTime - lastTime));
  var id = window.setTimeout(function() {
      callback(currTime + timeToCall);
  }, timeToCall);
  lastTime = currTime + timeToCall;
  return id;
};*/

var cancleRaf = function(id){
  if (!window.cancelAnimationFrame){
    clearTimeout(id);
  }else{
    window.cancelAnimationFrame(id);
  }
}

function animateUpdate(){
  animateObj.foreach(function(){
    this.animate();
  });
  endTime = new Date().getTime();
  animateTimer = raf();
}

musicFly = (function(){
  function musicFly(canvas_id){
    this.canvas = document.getElementById(canvas_id);
    this.ctx = this.canvas.getContext("2d");
    this.rem = rem;
    this.canvas.width = winwidth;
    this.canvas.height = winheight;
    this.micons = [];
    this.initAnimate = function(){
      var miconnum = 3;//getRandom(3,5);
      for(var i = 0; i<miconnum ; i++){
        var aIcon = new musicIcon({canvas:this.canvas});
        this.micons.push(aIcon);
      }
    }

    this.animate = function (){
      this.ctx.clearRect(0,0,this.canvas.width,this.canvas.height); 


      this.micons.foreach((function(_this){
        return function(){
          if(this.alive === true){
            this._move();
            this._paint();
          }
        }
      })(this))  
    }
  }
  return musicFly;
}())


var musicIcon = function(config){
  this.canvas = config.canvas
  this.ctx = this.canvas.getContext("2d");
  this.width = this.canvas.width;
  this.height = this.canvas.height;
  this.rem = Number(rem);
  this.x = this.y = 0;
  this.y = this.height / 2;
  this.alive = this.rotate = this.scale = this.speedx = this.speedy = 0;
  this.w = this.h = 0;  //画到canvas中的图片宽高
  this.destination = {x:0,y:0};

  this.imgsrc = docUrl + "img/sprite.png";
  this.iconlist = [
                {w:30, h:50, x:686, y:62},
                {w:40, h:40, x:604, y:72},
                {w:50, h:50, x:718, y:62},
                {w:30, h:30, x:646, y:72}
                ];
  this.imgconfig = null;
  this.total = this.iconlist.length;
  this.img = null;
  this._init();
}

musicIcon.prototype = {
  _paint:function(){
    this.ctx.save();
    this.ctx.beginPath();
    this.ctx.translate(this.canvas.width/2, this.canvas.height/2);
    //this.ctx.rotate(this.rotate);
    this.ctx.drawImage(this.img , this.imgconfig.x ,this.imgconfig.y ,this.imgconfig.w,this.imgconfig.h,this.x-this.w/2 , this.y-this.h/2, this.w , this.h);
    this.ctx.restore();
    this.ctx.save();
  },
  _move:function(){
    //调速度的地方
    this.x = this.x + this.speedx/8;
    this.y = this.y + this.speedy/8;

    if(this.x < -this.width/2 || this.x > this.width/2 || this.y < -this.height/2 || this.y > this.height/2){
      this._init();
    }

  },
  _init:function(){
    this.alive = "init";
    this.scale = getRandom(0.8,1.2,2);
    this.rotate = getRandom(0,2*Math.PI,2);
    this.x = this.y = 0;
    var rand = getRandom(0,1);
    if(rand == 0){
      rand = getRandom(0,1);
      this.destination = {x:rand*this.width-this.width/2,y:getRandom(0,this.height) - this.height/2};
      this.speedx = getRandom(2*this.rem,3*this.rem) * (rand-0.5);
      this.speedy = (this.destination.y) / ( (this.width/2) / this.speedx );
    }else{
      rand = getRandom(0,1);
      this.destination = {x:getRandom(0,this.width)-this.width/2,y:rand*this.height - this.height/2};
      this.speedy = getRandom(2*this.rem,3*this.rem) * (rand-0.5);
      this.speedx = (this.destination.x) / ( (this.height/2) / this.speedy );
    }

    rand = getRandom(0,this.total*10);
    this.imgconfig = this.iconlist[rand%this.total];
    if(this.img == null){
      var img = new Image();
      img.src = this.imgsrc;
      var self = this;
      imgload(img,function(status){
        if(status == "success"){
          self.w = parseInt(self.imgconfig.w*self.scale);
          self.h = parseInt(self.imgconfig.h*self.scale);
          self.alive = true;
        }else{
          self.alive = false;
        }
      })
      this.img = img;
    }else{
      this.w = parseInt(this.imgconfig.w*this.scale);
      this.h = parseInt(this.imgconfig.h*this.scale);
      this.alive = true;
    }
  }
}

var musicFlyControl = {
  start:function(){
    if(animateObj.length == 0){
      var Music = new musicFly("canvas_music");
      Music.initAnimate();
      animateObj.push(Music);
      animateTimer = raf();
    }else{
      animateTimer = raf();
    }
  },
  stop:function(){
    if(animateTimer != null){
      clearTimeout(animateTimer);
      animateTimer == null;
      //console.log("animate stop");
    }
  }
}


function getRandom(a , b , toFixNum){
  if(!toFixNum){
    return Math.round(Math.random()*(b-a)+a);
  }else{
    var n = Math.random()*(b-a)+a;
    return Number(n.toFixed(toFixNum));
  }
}

Array.prototype.foreach = function(callback){
  for(var i=0;i<this.length;i++){
    if(this[i]!==null) callback.apply(this[i] , [i])
  }
}

function imgload(img , callback){
  if(img.complete){
    callback.call(img,"success");
  }
  else {
    img.onload = function(){
      callback.call(this,"success");
    }
    img.onerror = function(){
      callback.call(this,"fail");
    }
  }
}
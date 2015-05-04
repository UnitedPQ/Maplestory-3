<!doctype html>
<html lang="cn" style="font-size: 10px;">
<head>
    <meta charset="utf-8">
    <meta name="apple-touch-fullscreen" content="YES">
    <script type="text/javascript">
        var jsVer = 29;
        var phoneWidth = parseInt(window.screen.width);
        var phoneScale = phoneWidth/640;

        var ua = navigator.userAgent;
        if (/Android (\d+\.\d+)/.test(ua)){
            var version = parseFloat(RegExp.$1);
            // andriod 2.3
            if(version>2.3){
                document.write('<meta name="viewport" content="width=640, minimum-scale = '+phoneScale+', maximum-scale = '+phoneScale+', target-densitydpi=device-dpi">');
            // andriod 2.3以上
            }else{
                document.write('<meta name="viewport" content="width=640, target-densitydpi=device-dpi">');
            }
            // 其他系统
        } else {
            document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">');
        }
    </script>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi"> -->
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="pragram" content="no-cache">
    
    {% if page == 'win' %}
    <link rel="stylesheet" href="{{ static_url('css/win.css') }}"/>
    {% else %}
    <link rel="stylesheet" href="{{ static_url('css/main.css') }}"/>
    {% endif %}
    <title>音乐签·开年运</title>
</head>
<body>

{{ content() }}

{% if msg and self %}
{{ weixin_share([
    'title': msg.nickname~'的2015音乐运势是：'~lyrics[msg.lyricNo],
    'description': '2015和音乐在一起，一句歌词测试你的开年运势，赢取X5Max等大奖。',
    'picUrl': static_url('img/400.jpg'),
    'url': url('/newyear/', ['mid': msg.id])
]) }}
{% else %}
{{ weixin_share([
    'title': '音乐签·开年运，测运势赢X5Max',
    'description': '2015和音乐在一起，一句歌词测试你的开年运势，赢取X5Max等大奖。',
    'picUrl': static_url('img/400.jpg'),
    'url': url('/newyear/')
]) }}
{% endif %}

<script type="text/javascript">
//有配置时name不为空
{% if msg and not forceIndex %}
    {% if self %}
        var friend = { name: "", lyrics_no: 1 };     //点击好友链接时候配置，有配置时自动跳转到唱片页
        var myinfo = { name: "{{ msg.name }}", lyrics_no: {{ msg.lyricNo }} };     //点击自己链接时候配置，有配置时自动跳转到唱片页
    {% else %}
        var friend = { name: "{{ msg.name }}", lyrics_no: {{ msg.lyricNo }} };     //点击好友链接时候配置，有配置时自动跳转到唱片页
        var myinfo = { name: "", lyrics_no: 1 };     //点击自己链接时候配置，有配置时自动跳转到唱片页
    {% endif %}
{% else %}
    var friend = { name: "", lyrics_no: 1 };     //点击好友链接时候配置，有配置时自动跳转到唱片页
    var myinfo = { name: "", lyrics_no: 1 };     //点击自己链接时候配置，有配置时自动跳转到唱片页
{% endif %}
var docUrl = '{{ static_url("/newyear/#") }}';
</script>
<script type="text/javascript" src="{{ static_url('js/zepto.min.js') }}"></script>
<script type="text/javascript" src="{{ static_url('js/ProcessQ.min.js') }}"></script>
<script type="text/javascript" src="{{ static_url('js/common.js') }}"></script>
{% if page == 'win' %}
<script type="text/javascript" src="{{ static_url('js/win.js') }}"></script>
{% else %}
<script type="text/javascript" src="{{ static_url('js/musicfly.js') }}"></script>
<script type="text/javascript" src="{{ static_url('js/main.js') }}"></script>
{% endif %}
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?0d6b2bf4133b5b88603f643e27aae2ae";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</body>
</html>
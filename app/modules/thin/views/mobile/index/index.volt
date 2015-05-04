<link rel="stylesheet" type="text/css" href="{{ static_url('css/mobile/index.css') }}">
<script type="text/javascript" src="{{ static_url('js/mobile.js') }}"></script>
<div class="box clearfix">
    <img src="{{ static_url('img/mobile/circle.png') }}" class="box-bg">

    <img src="{{ static_url('img/mobile/icon1.png') }}" class="absolute icon1">
    <img src="{{ static_url('img/mobile/icon2.png') }}" class="absolute icon2">
    <img src="{{ static_url('img/mobile/icon3.png') }}" class="absolute icon3">
    <img src="{{ static_url('img/mobile/icon4.png') }}" class="absolute icon4">
    <img src="{{ static_url('img/mobile/icon5.png') }}" class="absolute icon5">
    <img src="{{ static_url('img/mobile/icon6.png') }}" class="absolute icon6">
    <img src="{{ static_url('img/mobile/icon7.png') }}" class="absolute icon7">

    <img src="{{ static_url('img/mobile/he.png') }}" class="absolute he">

    <img src="{{ static_url('img/mobile/title1.png') }}" class="absolute title1">
    <img src="{{ static_url('img/mobile/title2.png') }}" class="absolute title2">
    <img src="{{ static_url('img/mobile/title3.png') }}" class="absolute title3">

    <img src="{{ static_url('img/mobile/text.png') }}" class="absolute text">
</div>

<nav class="absolute">
	<a href="{{ url('/thin/') }}" class="on first" data-pjax>活动首页</a>
    <a href="{{ url('/thin/intro/') }}" data-pjax>活动规则</a>
    <a href="{{ url('/prize/my/', ['module': 'thin']) }}" data-pjax>我要兑奖</a>
    <a href="{{ url('/prize/', ['module': 'thin']) }}" class="last" data-pjax>中奖名单</a>
</nav>

<div class="absolute index-bottom">
    <a href="{{ url('/thin/activity/') }}" class="relative start">
        <img src="{{ static_url('img/mobile/startbg.png') }}" class="startbg">

        <img src="{{ static_url('img/mobile/starttxt.png') }}" class="absolute starttxt">
    </a>
</div>
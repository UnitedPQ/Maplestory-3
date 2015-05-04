<div class="relative clearfix">
    <div class="box clearfix">
        <img src="{{ static_url('img/circle.png') }}" class="box-bg">

        <img src="{{ static_url('img/icon1.png') }}" class="absolute icon1">
        <img src="{{ static_url('img/icon2.png') }}" class="absolute icon2">
        <img src="{{ static_url('img/icon3.png') }}" class="absolute icon3">
        <img src="{{ static_url('img/icon4.png') }}" class="absolute icon4">
        <img src="{{ static_url('img/icon5.png') }}" class="absolute icon5">
        <img src="{{ static_url('img/icon6.png') }}" class="absolute icon6">
        <img src="{{ static_url('img/icon7.png') }}" class="absolute icon7">

        <img src="{{ static_url('img/he.png') }}" class="absolute he">

        <img src="{{ static_url('img/title1.png') }}" class="absolute title1">
        <img src="{{ static_url('img/title2.png') }}" class="absolute title2">
        <img src="{{ static_url('img/title3.png') }}" class="absolute title3">

        <img src="{{ static_url('img/text.png') }}" class="absolute text">
    </div>

    <div class="nav absolute">
        <a href="{{ url('/thin/') }}" class="on first" data-pjax>活动首页</a>
        <a href="{{ url('/thin/intro/') }}" data-pjax>活动规则</a>
        <a href="{{ url('/prize/my/', ['module': 'thin']) }}" data-pjax>我要兑奖</a>
        <a href="{{ url('/prize/', ['module': 'thin']) }}" class="last" data-pjax>中奖名单</a>
    </div>

    <div class="absolute index-bottom">
        <a href="{{ url('/thin/activity/') }}" class="relative start" data-pjax>
            <img src="{{ static_url('img/startbg.png') }}" class="startbg">

            <img src="{{ static_url('img/starttxt.png') }}" class="absolute starttxt">
        </a>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    setTimeout(function(){
        $('body').addClass('show');
    }, 500);
});
</script>
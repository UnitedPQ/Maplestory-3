<div class="fullmask"></div>
<div class="shareview none" ></div>
<div class="pageloading">
    <div class="loadimg none">
        <img src="{{ static_url('img/loading.png') }}" alt="">
    </div>
</div>

<div class="page-left-arrow none">
    <img src="{{ static_url('img/page-left-arrowb.png') }}" alt="">
</div>
<div class="skip">跳过>></div>
<!--     -->
<div class="main swiper-container" id="swiper-container">
    <div class="swiper-wrapper" id="swiper-wrapper">
        <div class="page home swiper-slide">
            <div class="logo sprite"></div>
            <div class="child sprite tag rule">活动规则</div>
            <div class="line"></div>
            <div class="package">
                <div class="cover"></div>
                <div class="disk rotate"></div>
                <div class="back"></div>
                <div class="micon1 sprite bombLeftOut"></div>
                <div class="micon2 sprite bombRightOut"></div>
            </div>
            <div class="direct sprite child pulse"></div>
        </div>
        
        <div class="page page06 swiper-slide">
            <div class="child child1 fadeInUp"></div>
            <div class="child child2 pulse"></div>
        </div>
        <div class="page page05 swiper-slide">
            <div class="child child1 fadeInUp"></div>
            <div class="child child2 pulse"></div>
        </div>
        <div class="page page04 swiper-slide">
            <div class="child child1 fadeInUp"></div>
            <div class="child child2 pulse"></div>
        </div>
        <div class="page page03 swiper-slide">
            <div class="child child1 fadeInUp"></div>
            <div class="child child2 pulse"></div>
        </div>
        <div class="page page02 swiper-slide">
            <div class="child child1 fadeInUp"></div>
            <div class="child child2 pulse"></div>
        </div>
        <div class="page page01 swiper-slide">
            <div class="child child1 fadeInUp"></div>
            <div class="child child2 pulse"></div>
        </div>

        <div class="page page07 interact nextdisable">
            <div class="logo sprite"></div>
            <div class="child child1 tle"></div>
            <div class="child child2 ">
                <div class="yourname">
                    <input id="yourname" type="text" value="{{ self ? msg.name : '' }}" placeholder="请输入您的名字" />
                </div>
                <div class="scan"></div>
                <div class="taparea" id="taparea"></div>
            </div>
        </div>
        <div class="page page08 slide disable">
            <div class="logo sprite"></div>
            <div class="tle">
                <div class="mtle mtle1 sprite"></div>
                <div class="title">好友的音乐运势</div>
                <div class="mtle mtle2 sprite"></div>
            </div>
            <div class="mydisk">
                <div class="myname">我的好音乐运势</div>
                <div class="lyrics"></div>
                <s class="sprite icon1 iconrotate"></s>
                <s class="sprite icon2 iconrotate"></s>
                <s class="sprite icon3 iconrotate"></s>
            </div>
            <div class="operate">
                <div class="btn tryagain none">再测一次</div>
                <div class="btn towin none"><a href="{{ url('/newyear/win/') }}">赢取大奖</a></div>
                <div class="btn metoo">我也要测试</div>
            </div>
            <canvas width="640" id="canvas_music" height="100%"></canvas>
        </div>

        
    </div>
<div class="rules none"><div class="desc"></div><div class="btn">返回首页</div></div>
</div>
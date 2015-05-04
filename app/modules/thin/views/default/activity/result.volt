<div class="game-result">
    <h4>亲，你制作的手机厚度为<em>{{ works.thickness }}</em>mm</h4>

    <div class="result-img">
        {% set r = mt_rand(1,4) %}
        <img src="{{ static_url('img/components/b'~works.b~'d'~works.d~'r'~r~'.png') }}" style="width:{{ r % 2 == 1 ? 540 : 300 }}px;height:{{ works.thickness / 10 * 44 }}px">
    </div>

    <p>{{ works.text1 }}<br>{{ works.text2 }}</p>

    <div class="btns clearfix">
        <a href="{{ url('/thin/activity/', ['redo': 1]) }}" class="btn z" data-pjax><span>重新制作</span></a>
        <a href="{{ url('/thin/activity/draw/') }}" class="btn y" data-pjax><span>我要抽奖</span></a>
    </div>
</div>

<div class="global-nav absolute">
    <a href="{{ url('/thin/') }}" class="first" data-pjax>活动首页</a>
    <a href="{{ url('/thin/intro/') }}" data-pjax>活动规则</a>
    <a href="{{ url('/prize/my/', ['module': 'thin']) }}" data-pjax>我要兑奖</a>
    <a href="{{ url('/prize/', ['module': 'thin']) }}" class="last" data-pjax>中奖名单</a>
</div>
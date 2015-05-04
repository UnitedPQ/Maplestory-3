<div class="intro">
    <h3 class="title clearfix">
        <img src="{{ static_url('img/tbg.png') }}" class="z">
        <img src="{{ static_url('img/t1.png') }}" class="absolute">
    </h3>

    <div class="intro-c clearfix">
        <dl class="clearfix">
            <dt>【活动时间】</dt>
            <dd>11月27日 - 12月03日</dd>
        </dl>
        <dl class="clearfix">
            <dt>【活动规则】</dt>
            <dd>
                <ol>
                    <li>活动期间，每个ID可参与DIY创意手机，每天可获得3次抽奖机会，邀请小伙伴PK，可额外获得3次抽奖机会。抽奖机会每日清零。</li>
                    <li>获奖后点击“我要兑奖”填写中奖信息，请于12月5日前完成填写，逾期将视为放弃。</li>
                    <li>活动最终解释权归vivo官方所有。</li>
                </ol>
            </dd>
        </dl>
        <dl class="clearfix">
            <dt>【活动奖品】</dt>
            <dd>
                <ul class="clearfix">
                    <li>
                        <img src="{{ static_url('img/g1.png') }}">
                        <p>K歌之王X5手机<br>(4台)</p>
                    </li>
                    <li>
                        <img src="{{ static_url('img/g2.png') }}">
                        <p>vivo原装移动电源<br>(15个)</p>
                    </li>
                    <li>
                        <img src="{{ static_url('img/g3.png') }}">
                        <p>拜亚动力耳机<br>(30条)</p>
                    </li>
                </ul>
            </dd>
        </dl>
    </div>
</div>

<div class="global-nav absolute">
    <a href="{{ url('/thin/') }}" class="first" data-pjax>活动首页</a>
    <a href="{{ url('/thin/intro/') }}" class="on" data-pjax>活动规则</a>
    <a href="{{ url('/prize/my/', ['module': 'thin']) }}" data-pjax>我要兑奖</a>
    <a href="{{ url('/prize/', ['module': 'thin']) }}" class="last" data-pjax>中奖名单</a>
</div>

<!--
<div class="global-nav absolute">
    <a href="{{ url('/thin/') }}" class="first" data-pjax>活动首页</a>
    <a href="#">我要兑奖</a>
    <a href="#" class="last">中奖名单</a>
</div>
-->
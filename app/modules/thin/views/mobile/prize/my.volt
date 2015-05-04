<div class="prize">
    <h3 class="title clearfix">
        <img src="{{ static_url('img/tbg.png') }}" class="z">
        <img src="{{ static_url('img/t3.png') }}" class="tle absolute">
    </h3>
    <div class="prize-c clearfix">
        {% if list.count() > 0 %}
            <div class="prize-my">
                <h4>恭喜你获得如下奖品：</h4>
                <ul>
                    <li class="clearfix">
                        {% for result in list %}
                            <div class="prize-name">{{ result.prize.name }} 一{{ result.prize.unit }}</div>
                            {% if not result.exchange %}
                                <a href="{{ url('/prize/exchange/', ['module': 'thin', 'id': result.id]) }}">兑奖</a>
                            {% else %}
                                <span>已兑奖</span>
                            {% endif %}
                        {% endfor %}
                    </li>
                </ul>
            </div>
        {% else %}
            <div class="prize-tips">很遗憾，你没有中奖，继续努力吧！</div>
        {% endif %}
    </div>
</div>

<div class="global-nav absolute">
    <a href="{{ url('/thin/') }}" class="first" data-pjax>活动首页</a>
    <a href="{{ url('/thin/intro/') }}" data-pjax>活动规则</a>
    <a href="{{ url('/prize/my/', ['module': 'thin']) }}" class="on" data-pjax>我要兑奖</a>
    <a href="{{ url('/prize/', ['module': 'thin']) }}" class="last" data-pjax>中奖名单</a>
</div>
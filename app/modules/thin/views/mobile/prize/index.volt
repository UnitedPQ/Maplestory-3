<div class="prize">
    <h3 class="title clearfix">
        <img src="{{ static_url('img/tbg.png') }}" class="z">
        <img src="{{ static_url('img/t2.png') }}" class="tle absolute">
    </h3>

    <div class="prize-c clearfix">
        <dl class="prize-list">
            <dt>
                <ul>
                    {% for prize in prizeList %}
                        <li><a href="#" class="tab{% if loop.first %} tab-on{% endif %} tab-{{ prize.id }}" for="#tab-{{ prize.id }}"><span>{{ prize.name }}</span></a></li>
                    {% endfor %}
                </ul>
            </dt>
            {% for prize in prizeList %}
                <dd id="tab-{{ prize.id }}" class="tab-c clearfix" style="display:{% if loop.first %}block{% else %}none{% endif %};">
                    {% if list[prize.id] is defined %}
                        <ul>
                            {% for result in list[prize.id] %}
                                <li>
                                    <img src="{{ result.user.avatar }}">
                                    <strong>{{ result.user.nickname }}</strong>
                                </li>
                            {% endfor %}
                        </ul>
                    {% else %}
                        <div class="prize-nolist">暂无中奖信息.</div>
                    {% endif %}
                </dd>
            {% endfor %}
        </dl>
    </div>
</div>
<div class="global-nav absolute">
    <a href="{{ url('/thin/') }}" class="first" data-pjax>活动首页</a>
    <a href="{{ url('/thin/intro/') }}" data-pjax>活动规则</a>
    <a href="{{ url('/prize/my/', ['module': 'thin']) }}" data-pjax>我要兑奖</a>
    <a href="{{ url('/prize/', ['module': 'thin']) }}" class="on last" data-pjax>中奖名单</a>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('.tab').click(function(e){
        e.preventDefault();
        if (!$(this).hasClass('tab-on')) {
            $('.tab').removeClass('tab-on');
            $(this).addClass('tab-on');
            $('.tab-c').hide();
            $($(this).attr('for')).show();
        }
    });
});
</script>
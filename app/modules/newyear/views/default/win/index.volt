<div class="shareview none" ></div>
<div class="pageloading">
    <div class="loadimg none">
        <img src="{{ static_url('img/loading.png') }}" alt="">
    </div>
</div>

<div class="main swiper-container" id="swiper-container">
    <div class="swiper-wrapper" id="swiper-wrapper">
        <div class="page01 page lottery swiper-slide">
            <div class="logo sprite"></div>
            <div class="sprite tag winner_list">中奖名单</div>
            <div class="sprite tag getprize">我要兑奖</div>
            <div class="machine">
                <div class="needle sprite"></div>
                <div class="turntable"></div>
                <div class="start">点击抽奖</div>
                <div class="remaintimes sprite">还有<span id="draw-left">{{ stat.drawLeft }}</span>次抽奖机会</div>

            </div>
            <div class="operate">
                <div class="btn backhome"><a href="{{ url('/newyear/', ['to': 'index']) }}">首　页</a></div>
                <div class="btn toshare">分享好友</div>
            </div>
        </div>
        
        <div class="page02 page swiper-slide">
            <div class="logo sprite"></div>
            <div class="child child1">中奖名单</div>
            <div class="list child child2">
                <div class="tag_list">
                    {% for prize in prizeList %}
                        <div class="award_tag award_tag{{ loop.index }}{% if loop.first %} on{% endif %}">{{ prize.extra('title') }}</div>
                    {% endfor %}
                </div>
                <div class="contain">
                    <s class="vivo sprite"></s>
                    <s class="icon1 sprite"></s>
                    <s class="icon2 sprite"></s>
                    <s class="icon3 sprite"></s>
                    <s class="icon4 sprite"></s>
                    <div class="name_list">
                        {% for prize in prizeList %}
                            <ul class="name_list{{ loop.index }}"{% if not loop.first %} style="display:none;"{% endif %}>
                                {% for result in list[prize.id] %}
                                    <li>{{ result.nickname }}</li>
                                {% elsefor %}
                                    <li style="color:#800;font-style:italic;">暂无中奖名单</li>
                                {% endfor %}
                            </ul>
                        {% endfor %}
                    </div>
                </div>
            </div>
            <div class="operate">
                <div class="btn goback">返　回</div>
            </div>
        </div>
        <div class="page03 page swiper-slide">
            <div class="logo sprite"></div>
            <div class="sprite tag home"><a href="{{ url('/newyear/', ['to': 'index']) }}">首　页</a></div>
            <div class="sprite tag winner_list">中奖名单</div>
            <div class="sprite tag getprize">我要兑奖</div>
            <div class="child child1">我要兑奖</div>
            <div class="form">
                <s class="icon1 sprite"></s>
                <s class="icon2 sprite"></s>
                <s class="icon3 sprite"></s>
                <div class="user_info">
                    <div class="award_tle" id="award-title"></div>
                    <div class="desc_info">
                        <form action="{{ url('/newyear/win/exchange.json') }}" method="post" id="exchange-form">
                            <div class="item">
                                <div class="tle">姓　　名:</div>
                                <div class="val"><input id="name" name="name" type="text"></div>
                            </div>
                            <div class="item">
                                <div class="tle">电　　话:</div>
                                <div class="val"><input id="mobile" name="mobile" type="text"></div>
                            </div>
                            <div class="item">
                                <div class="tle">地　　址:</div>
                                <div class="val"><input id="address" name="address" type="text"></div>
                            </div>
                            <div class="item">
                                <div class="tle">身份证号:</div>
                                <div class="val"><input id="idcard" name="idcard" type="text"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="operate">
                    <div class="btn submit"><a href="#" id="exchange-submit">提交信息</a></div>
                </div>
            </div>

        </div>
    </div>
</div>
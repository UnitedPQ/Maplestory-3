<div class="game-index relative clearfix">
    <form id="complete" action="{{ url('/thin/activity.json') }}" method="post" target="{{ url('/thin/activity/result/') }}">
        <a href="#" id="complete-btn" class="btn complete-btn"><span>完成制作</span></a>
        <input type="hidden" name="weibo" value="0">
        <label class="update-weibo" for="weibo"><input type="checkbox" id="weibo" name="weibo" value="1" checked> 同时分享到新浪微博</label>

        <div class="item-list clearfix">
            <div class="item-list-c">
                {% for component in components %}
                    <div id="item-list-{{ component['id'] }}" class="item-list-list" data-name="value_{{ component['id'] }}"{% if not loop.first %} style="display:none;"{% endif %}>
                        <input type="hidden" name="value_{{ component['id'] }}" value="0">
                        <div class="slide-list">
                            <ul>
                                {% for key, item in component['items'] %}
                                    <li data-value="{{ key }}">
                                        <a href="#" class="item-link" data-group="items-{{ component['id'] }}" data-name="value_{{ component['id'] }}" data-value="{{ key }}">
                                            <img src="{{ static_url('img/components/'~item['id']~'.png') }}">
                                        </a>
                                    </li>
                                {% endfor %}
                            </ul>
                        </div>

                        <a href="#" class="slide-btn slide-left"><br></a>
                        <a href="#" class="slide-btn slide-right"><br></a>
                    </div>
                {% endfor %}
            </div>
        </div>

        <div class="item-nav">
            <ul class="clearfix">
                {% for component in components %}
                    <li{% if loop.first %} class="nav-on"{% endif %}>
                        <a href="#" class="nav-{{ component['id'] }}" data-id="#item-list-{{ component['id'] }}">{{ component['name'] }}</a>
                    </li>
                {% endfor %}
            </ul>
        </div>
    </form>
</div>

<div class="global-nav absolute">
    <a href="{{ url('/thin/') }}" class="first" data-pjax>活动首页</a>
    <a href="{{ url('/thin/intro/') }}" data-pjax>活动规则</a>
    <a href="{{ url('/prize/my/', ['module': 'thin']) }}" data-pjax>我要兑奖</a>
    <a href="{{ url('/prize/', ['module': 'thin']) }}" class="last" data-pjax>中奖名单</a>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('.item-link').click(function(e){
        e.preventDefault();
        var self = $(this);
        var data = self.data();
        $('[data-group='+data['group']+']').removeClass('on');
        self.addClass('on');
        $('input[name='+data['name']+']').val(data['value']);
    });

    $('.item-nav a').click(function(e){
        e.preventDefault();
        var self = $(this);
        if (!self.parent('li').hasClass('nav-on')) {
            $('.item-nav li').removeClass('nav-on');
            self.parent('li').addClass('nav-on');
            var data = self.data();
            $('.item-list-list').hide();
            $(data['id']).show();
        }
    });

    $('.item-list-list').slide();

    $('#complete-btn').click(function(e){
        e.preventDefault();
        $(this).parent('form').submit();
    });

    $('#complete').submit(function(e){
        e.preventDefault();
        var form = $(this);

        if (!form.data('requesting')) {
            form.data('requesting', true);

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                dataType: 'json',
                data: form.serialize(),
                beforeSend: function(){
                    form.data('requesting', true);
                },
                error: function(){
                    form.removeData('requesting');
                },
                success: function(data){
                    form.removeData('requesting');
                    if (data.errcode) {
                        $.alert(data.errmsg);
                    } else {
                        if ($.support.pjax) {
                            $.pjax({url: form.attr('target'), container: '#pjax-container'});
                        } else {
                            window.location.href = form.attr('target');
                        }
                    }
                }
            });
        }
    });
});
</script>
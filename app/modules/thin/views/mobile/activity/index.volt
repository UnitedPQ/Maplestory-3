<link rel="stylesheet" type="text/css" href="{{ static_url('css/mobile/game.css') }}">
<script type="text/javascript" src="{{ static_url('js/mobile/game.js') }}"></script>

<form id="complete" action="{{ url('/thin/activity.json') }}" method="post" target="{{ url('/thin/activity/result/') }}">
    <div class="main">
    	<div class="mainleft">
    		<ul>
    			{% for component in components %}
                    <li{% if loop.first %} class="on" {% endif %} data-id="#item-list-{{ component['id'] }}">
    	                <div class="desc l">
    						<div class="icon l"></div>
    						<div class="l txt">{{ component['name'] }}</div>
    					</div>
    					<div class="triangle l"></div>
    					<div class="pointer"></div>
                    </li>
                {% endfor %}
    			
    		</ul>
    	</div>
    	
    	<div class="mainright">
    		<div class="show">
    			{% for component in components %}
    			<div id="item-list-{{ component['id'] }}" class="slider" data-name="value_{{ component['id'] }}" >
                	<input type="hidden" name="value_{{ component['id'] }}" value="1">
                	<div class="slide_list">
                    {% for key, item in component['items'] %}
                    	<div data-value="{{ key }}" class="slide_item">
                    		<img src="{{ static_url('img/components/'~item['id']~'.png') }}" />
                    	</div>
                    {% endfor %}
                    </div>
    			</div>
    			{% endfor %}
    		</div>
			<div class="slide-btn slide-left"></div>
            <div class="slide-btn slide-right"></div>
    	</div>
    </div>
    <a id="complete-btn" href="#" class="complete btn">完成制作</a>
    <input type="hidden" name="weibo" value="0">
    <label class="update-weibo" for="weibo"><input type="checkbox" id="weibo" name="weibo" value="1" checked> 同时分享到新浪微博</label>
</form>

<script type="text/javascript">
$(document).ready(function(){

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
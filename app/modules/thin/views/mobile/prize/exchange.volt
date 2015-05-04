<div class="prize">
    <h3 class="title clearfix">
        <img src="{{ static_url('img/tbg.png') }}" class="z">
        <img src="{{ static_url('img/t3.png') }}" class="tle absolute">
    </h3>
    <div class="prize-c clearfix">
        <div class="prize-exchange">
            <h4>你正在兑换 {{ result.prize.name }}：</h4>

            <form id="exchange-form" method="post" action="{{ url('prize/exchange.json', ['id': result.id]) }}" target="{{ url('/prize/my/', ['module': 'thin']) }}" class="form">
                <input type="hidden" name="module" value="{{ result.module }}">
                <input type="hidden" name="activityId" value="{{ result.activityId }}">
                <dl class="prize-exchange-form clearfix">
                    <dd class="exchange-form-row clearfix">
                        <label for="name" class="z">姓名 <span class="required color-danger">*</span>：</label>
                        <div class="input clearfix"><input type="text" name="name"></div>
                    </dd>

                    <dd class="exchange-form-row clearfix">
                        <label for="name" class="z">联系电话 <span class="required color-danger">*</span>：</label>
                        <div class="input clearfix"><input type="text" name="mobile"></div>
                    </dd>

                    <dd class="exchange-form-row clearfix">
                        <label for="name" class="z">地址 <span class="required color-danger">*</span>：</label>
                        <div class="input clearfix"><input type="text" name="address"></div>
                    </dd>

                    <dd class="exchange-form-row clearfix">
                        <label for="name" class="z">身份证号 <span class="required color-danger">*</span>：</label>
                        <div class="input clearfix"><input type="text" name="idcard"></div>
                    </dd>
                </dl>
            </form>

            <div class="prize-result-btns clearfix">
                <a href="#" id="exchange" class="btn prize-result-button z"><span>提交信息</span></a>
            </div>
        </div>
    </div>
</div>

<div class="global-nav absolute">
    <a href="{{ url('/thin/') }}" class="first" data-pjax>活动首页</a>
    <a href="{{ url('/thin/intro/') }}" data-pjax>活动规则</a>
    <a href="{{ url('/prize/my/', ['module': 'thin']) }}" class="on" data-pjax>我要兑奖</a>
    <a href="{{ url('/prize/', ['module': 'thin']) }}" class="last" data-pjax>中奖名单</a>
</div>

<script type="text/javascript">
    $('#exchange').click(function(e){
        e.preventDefault();
        self = $(this);

        if (!self.data('requesting')) {
            self.data('requesting', true);
            var form = $('#exchange-form');
            var url = form.attr('action');
            var method = form.attr('method');
            $.ajax({
                url: url,
                type: method,
                dataType: 'json',
                data: form.serialize(),
                beforeSend: function() {
                    self.data('requesting', true);
                },
                error: function() {
                    self.removeData('requesting');
                },
                success: function(data) {
                    self.removeData('requesting');
                    if (data.errmsg) {
                        $.alert(data.errmsg);
                    }
                    if (data.errcode == 0) {
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
</script>
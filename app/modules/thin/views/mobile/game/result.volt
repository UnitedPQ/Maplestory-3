<link rel="stylesheet" type="text/css" href="{{ static_url('css/mobile/game.css') }}">
<script type="text/javascript" src="{{ static_url('js/mobile/result.js') }}"></script>

<div class="main">
	<div class="result">
		<div class="my_result">亲，你制作的手机厚度为<span>XX</span>mm</div>
		<div class="view">
			<img class="long active" src="{{ static_url('img/components/b1d4_1.png') }}"/>
			<img class="short" src="{{ static_url('img/components/b1d4_2.png') }}"/>
			<img class="long" src="{{ static_url('img/components/b1d4_3.png') }}"/>
			<img class="short" src="{{ static_url('img/components/b1d4_4.png') }}"/>
		</div>
		<p class="p1">打败了<span>XX</span>%的网友。可惜还是没有X5Max薄。</p>
		<p >X5Max多厚？</p>
		<p >现在不告诉你，关注下@vivo智能手机 官微信息呗！</p>
	</div>
</div>

<div class="result_bottom">
	<a href="{{ url('/thin/game/') }}" class="btn remake l">重新制作</a>
	<a href="{{ url('/thin/game/lottery/') }}" class="btn to_lottery l">我要抽奖</a>
</div>



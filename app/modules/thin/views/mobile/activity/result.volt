<link rel="stylesheet" type="text/css" href="{{ static_url('css/mobile/game.css') }}">
<script type="text/javascript" src="{{ static_url('js/mobile/result.js') }}"></script>

<div class="main">
	<div class="result">
		<div class="my_result">亲，你制作的手机厚度为<span>{{ works.thickness }}</span>mm</div>
		<div class="view"  style="height:{{ works.thickness / 4 }}rem">
			<img class="long active" src="{{ static_url('img/components/b'~works.b~'d'~works.d~'r1.png') }}">
			<img class="short" src="{{ static_url('img/components/b'~works.b~'d'~works.d~'r2.png') }}">
			<img class="long" src="{{ static_url('img/components/b'~works.b~'d'~works.d~'r3.png') }}">
			<img class="short" src="{{ static_url('img/components/b'~works.b~'d'~works.d~'r4.png') }}">
			
		</div>
		<p class="p1">{{ works.text1 }}</p>
		<p >{{ works.text2 }}</p>
	</div>
</div>

<div class="result_bottom">
	<a href="{{ url('/thin/activity/',['redo': 1]) }}" class="btn remake l">重新制作</a>
	<a href="{{ url('/thin/activity/draw/') }}" class="btn to_lottery l">我要抽奖</a>
</div>
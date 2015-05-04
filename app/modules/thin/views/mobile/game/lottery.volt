<link rel="stylesheet" type="text/css" href="{{ static_url('css/mobile/game.css') }}">
<script type="text/javascript" src="{{ static_url('js/mobile/lottery.js') }}"></script>

<div class="main">
	<div class="table_bord"><img src="{{ static_url('img/table_bord.png') }}" /></div>
	<div class="lottery_table">
		<div class="l lottery_item"></div>
		<div class="l lottery_item"></div>
		<div class="r lottery_item"></div>
		<div class="l lottery_item"></div>
	</div>
	<div class="award_list">
		<div class="award"><img src="{{ static_url('img/award1.png') }}"  /></div>
		<div class="award"><img src="{{ static_url('img/award2.png') }}"  /></div>
		<div class="award"><img src="{{ static_url('img/award3.png') }}"  /></div>
		<div class="award">再接再厉</div>
	</div>
	<div class="lotterystart" id="draw-start">
		<div class="cover">抽奖</div>
	</div>
</div>

<div class="lottery_bottom">
	<a href="{{ url('/thin/game/') }}" class="btn remake">返回制作</a>
</div>



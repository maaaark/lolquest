{{ HTML::style('css/style.css') }}
<style type="text/css">
<!--
	body {
		background: #00ff00 !important;
	}
-->
</style>
<link rel="stylesheet" href="/css/bootstrap.min.css">
<div style="padding: 40px; background: #00ff00;">
<div class="streamer_logo">
	<img src="http://images.lolquest.net/lolquest_transparent.png" width="200" alt="lolquest.net" />
</div>
@foreach($myquests as $quest)
<div class="streamer_quest">
	<div class="streamer_avatar"><a href="/champions/{{ $quest->champion->key }}"><img class="img-circle" alt="{{ $quest->champion->name }}" src="/img/champions/{{ $quest->champion->champion_id }}_92.png" width="50"></a></div>
	<div class="streamer_text">
	<strong>{{ $quest->questtype->name }}</strong>
	<p class="questtext">{{ trans("quests.".$quest->type_id) }}<br/>
	</div>
	<div class="clear"></div>
	
	
</div>
@endforeach
</div>
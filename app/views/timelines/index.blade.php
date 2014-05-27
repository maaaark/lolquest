@extends('templates.default')
@section('title', trans("timeline.index"))
@section('content')
	<br/>
	<table class="table table-striped timeline-table">
		@foreach($timelines as $post)
			<tr>
				<td style="width: 30px !important;"><a href="/users/{{ $post->user->region }}/{{ $post->user->summoner_name }}"><img src="/img/profileicons/profileIcon{{ $post->user->summoner->profileIconId }}.jpg" class="img-circle" width="30" /></a></td>
				@if($post->event_type == "quest_create")
				<td><a href="/champions/{{ $post->quest->champion->key }}"><img class="img-circle quest_avatar" alt="{{ $post->quest->champion->name }}" src="/img/champions_small/{{ $post->quest->champion->champion_id }}_92.png" width="30" title="{{ $post->quest->champion->name }}" /></a></td>
				
				<td>{{ $post->quest->questtype->name }}</td>
				@elseif($post->event_type == "quest_end")
				<td  style="width: 30px !important;"><a href="/champions/{{ $post->quest->champion->key }}"><img class="img-circle quest_avatar" alt="{{ $post->quest->champion->name }}" src="/img/champions_small/{{ $post->quest->champion->champion_id }}_92.png" width="30" title="{{ $post->quest->champion->name }}" /></a></td>
				<td class="timeline_quest"><a href="/users/{{ $post->user->region }}/{{ $post->user->summoner_name }}">{{ $post->user->summoner_name }}</a> has finished the Quest <a href="#" class="timeline_info" title="{{ trans('quests.'.$post->quest->type_id) }}">{{ $post->quest->questtype->name }}</a> and gained <strong>{{ $post->quest->questtype->qp }} QP</strong> + <strong>{{ $post->quest->questtype->exp }} EXP</strong></td>
				@elseif($post->event_type == "quest_start")
				<td  style="width: 30px !important;"><a href="/champions/{{ $post->quest->champion->key }}"><img class="img-circle quest_avatar" alt="{{ $post->quest->champion->name }}" src="/img/champions_small/{{ $post->quest->champion->champion_id }}_92.png" width="30" title="{{ $post->quest->champion->name }}" /></a></td>
				<td class="timeline_quest"><a href="/users/{{ $post->user->region }}/{{ $post->user->summoner_name }}">{{ $post->user->summoner_name }}</a> has started the Quest <a href="#" class="timeline_info" title="{{ trans('quests.'.$post->quest->type_id) }}">{{ $post->quest->questtype->name }}</a>  ({{ $post->quest->questtype->qp }} QP + {{ $post->quest->questtype->exp }} EXP)</td>
				@elseif($post->event_type == "challenge_start")
				<td class="timeline_quest" colspan="2"><a href="/users/{{ $post->user->region }}/{{ $post->user->summoner_name }}">{{ $post->user->summoner_name }}</a> has started the <strong>{{ trans("dashboard.challenge_mode_".$post->challenge_mode) }} Challenge</strong></td>
				@endif
				<td class="timeline_quest">{{ $post->created_at->diffForHumans() }}</td>
			</tr>
		@endforeach	
	</table>
@stop
<table class="table table-striped timeline-table">
	@foreach($timelines as $post)
		<tr>
			<td style="width: 30px !important;"><a href="/summoner/{{ $post->user->region }}/{{ $post->user->summoner_name }}"><img src="/img/profileicons/profileIcon{{ $post->user->summoner->profileIconId }}.jpg" class="img-circle" width="30" /></a></td>
			@if($post->event_type == "quest_create")
			<td><a href="/champions/{{ $post->quest->champion->key }}"><img class="img-circle quest_avatar" alt="{{ $post->quest->champion->name }}" src="/img/champions_small/{{ $post->quest->champion->champion_id }}_92.png" width="30" title="{{ $post->quest->champion->name }}" /></a></td>
			
			<td>{{ $post->quest->questtype->name }}</td>
			@elseif($post->event_type == "quest_end")
			<td  style="width: 30px !important;"><a href="/champions/{{ $post->quest->champion->key }}"><img class="img-circle quest_avatar" alt="{{ $post->quest->champion->name }}" src="/img/champions_small/{{ $post->quest->champion->champion_id }}_92.png" width="30" title="{{ $post->quest->champion->name }}" /></a></td>
			<td class="timeline_quest"><a href="/summoner/{{ $post->user->region }}/{{ $post->user->summoner_name }}">{{ $post->user->summoner->name }} <i>{{ $post->user->title() }}</i></a> has finished the Quest <a href="#" class="timeline_info" title="{{ trans('quests.'.$post->quest->type_id) }}">{{ $post->quest->questtype->name }}</a> and gained <strong>{{ $post->quest->questtype->qp }} QP</strong> + <strong>{{ $post->quest->questtype->exp }} EXP</strong></td>
			@elseif($post->event_type == "quest_start")
			<td  style="width: 30px !important;"><a href="/champions/{{ $post->quest->champion->key }}"><img class="img-circle quest_avatar" alt="{{ $post->quest->champion->name }}" src="/img/champions_small/{{ $post->quest->champion->champion_id }}_92.png" width="30" title="{{ $post->quest->champion->name }}" /></a></td>
			<td class="timeline_quest"><a href="/summoner/{{ $post->user->region }}/{{ $post->user->summoner_name }}">{{ $post->user->summoner->name }} <i>{{ $post->user->title() }}</i></a> has started the Quest <a href="#" class="timeline_info" title="{{ trans('quests.'.$post->quest->type_id) }}">{{ $post->quest->questtype->name }}</a>  ({{ $post->quest->questtype->qp }} QP + {{ $post->quest->questtype->exp }} EXP)</td>
			@elseif($post->event_type == "quest_complete")
			<td  style="width: 30px !important;"><a href="/champions/{{ $post->quest->champion->key }}"><img class="img-circle quest_avatar" alt="{{ $post->quest->champion->name }}" src="/img/champions_small/{{ $post->quest->champion->champion_id }}_92.png" width="30" title="{{ $post->quest->champion->name }}" /></a></td>
			<td class="timeline_quest"><a href="/summoner/{{ $post->user->region }}/{{ $post->user->summoner_name }}">{{ $post->user->summoner->name }} <i>{{ $post->user->title() }}</i></a> has completed the Quest <a href="#" class="timeline_info" title="{{ trans('quests.'.$post->quest->type_id) }}">{{ $post->quest->questtype->name }}</a>  ({{ $post->quest->questtype->qp }} QP + {{ $post->quest->questtype->exp }} EXP)</td>
			@elseif($post->event_type == "daily_start")
			<td  style="width: 30px !important;"><a href="/champions/{{ $post->quest->champion->key }}"><img class="img-circle quest_avatar" alt="{{ $post->quest->champion->name }}" src="/img/champions_small/{{ $post->quest->champion->champion_id }}_92.png" width="30" title="{{ $post->quest->champion->name }}" /></a></td>
			<td class="timeline_quest"><a href="/summoner/{{ $post->user->region }}/{{ $post->user->summoner_name }}">{{ $post->user->summoner->name }} <i>{{ $post->user->title() }}</i></a> has started the Daily Quest <a href="#" class="timeline_info" title="{{ trans('quests.'.$post->quest->type_id) }}">{{ $post->quest->questtype->name }}</a>  ({{ $post->quest->questtype->qp }} QP + {{ $post->quest->questtype->exp }} EXP)</td>
			@elseif($post->event_type == "challenge_start")
			<td class="timeline_quest" colspan="2"><a href="/summoner/{{ $post->user->region }}/{{ $post->user->summoner_name }}">{{ $post->user->summoner->name }} <i>{{ $post->user->title() }}</i></a> has started the <strong>{{ trans("dashboard.challenge_mode_".$post->challenge_mode) }} Challenge</strong></td>
			@elseif($post->event_type == "challenge_step")
			<td class="timeline_quest" colspan="2"><a href="/summoner/{{ $post->user->region }}/{{ $post->user->summoner_name }}">{{ $post->user->summoner->name }} <i>{{ $post->user->title() }}</i></a> finished Step {{ $post->challenge_step }} of the <strong>{{ trans("dashboard.challenge_mode_".$post->challenge_mode) }} Challenge</strong></td>
			@elseif($post->event_type == "new_friend")
			<td  style="width: 30px !important;"><a href="/summoner/{{ $post->friend->region }}/{{ $post->friend->summoner_name }}"><img src="/img/profileicons/profileIcon{{ $post->friend->summoner->profileIconId }}.jpg" class="img-circle" width="30" /></a></td>
			<td class="timeline_quest"><a href="/summoner/{{ $post->user->region }}/{{ $post->user->summoner_name }}">{{ $post->user->summoner->name }} <i>{{ $post->user->title() }}</i></a> is now friends with <a href="/summoner/{{ $post->friend->region }}/{{ $post->friend->summoner_name }}">{{ $post->friend->summoner_name }}</a></td>
			@elseif($post->event_type == "new_comment")
			<td class="timeline_quest" colspan="2"><a href="/summoner/{{ $post->user->region }}/{{ $post->user->summoner_name }}">{{ $post->user->summoner->name }} <i>{{ $post->user->title() }}</i></a> has written a comment to <a href="/blogs/{{ $post->comment->blog->id }}">{{ $post->comment->blog->title }}</a></td>
			@elseif($post->event_type == "level_up")
			<td class="timeline_quest" colspan="2"><a href="/summoner/{{ $post->user->region }}/{{ $post->user->summoner_name }}">{{ $post->user->summoner->name }} <i>{{ $post->user->title() }}</i></a> is now <strong>Level {{ $post->user->level_id }}</strong></td>
			@elseif($post->event_type == "new_achievement")
			<td class="timeline_quest" colspan="2"><a href="/summoner/{{ $post->user->region }}/{{ $post->user->summoner_name }}">{{ $post->user->summoner->name }} <i>{{ $post->user->title() }}</i></a> has receive the Achievement <a href="/achievements/{{$post->achievement->id}}">
			@if($post->achievement->description == 1)
				{{ trans("achievements.".$post->achievement->description) }} {{ $post->achievement->factor}}
			@elseif($post->achievement->description == 2)
				{{ trans("achievements.".$post->achievement->description) }} {{ $post->achievement->factor}} Quests
			@elseif($post->achievement->description == 3)
				{{ trans("achievements.".$post->achievement->description) }} {{ $post->achievement->factor}} 
				@if($post->achievement->factor==1)
					friend
				@else
					friends
				@endif
			@else
				{{ $post->achievement->name }}
			@endif</a></td>
			@endif
			<td><small>{{ $post->created_at->diffForHumans() }}</small></td>
		</tr>
	@endforeach	
</table>
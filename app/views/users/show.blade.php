@extends('templates.default')
@if($user->summoner)
@section('title', trans("users.profile")." ".$user->summoner->name." (".$user->region.")")
@else
@section('title', trans("users.profile")." ".$user->summoner_name." (".$user->region.")")
@endif
@section('content')
	<br/>
	@if($user->summoner)
	<table width="100%" class="profile">
		<tr>
			<td valign="top" width="130" style="text-align: center; padding-right: 15px;">
				<img src="/img/profileicons/profileIcon{{ $user->summoner->profileIconId }}.jpg" width="100" class="img-circle" /><br/>
				<br/>
				{{ trans("users.level_profile") }}: {{ $user->level_id }}<br/><br/>
				@if(Auth::user())
				@if($user->id != Auth::user()->id)
					@if ( Auth::user()->isFriend($user->id) == 'checked')
						{{ trans("friends.already") }}
					@elseif ( Auth::user()->isFriend( $user->id) == 'unchecked')
						{{ trans("friends.unconfirmed") }}
					@elseif (Auth::user()->isFriend( $user->id) == 'nofriends') 
						<a href="/user_friend/{{$user->id}}" class="btn btn-primary">{{ trans("friends.request") }}</a>
					@elseif (Auth::user()->isFriend( $user->id) == 'invited') 
						<a href="/accept_friend/{{$user->id}}" class="btn btn-primary">{{ trans("friends.accept") }}</a>
					@endif
				@else
					<a href="/settings" class="btn btn-primary">{{ trans("users.settings") }}</a>
				@endif
				@endif
			</td>
			<td width="400" valign="top">
				<table class="table table-striped" stlye="width: 100%;">
					<tr>
						<td width="130" class="attribute">{{ trans("users.summoner_name") }} </td>
						<td>{{ $user->summoner->name }}</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("users.region") }}</td>
						<td>{{ $user->region }}</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("users.level") }}</td>
						<td>{{ $user->summoner->summonerLevel }}</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("users.verified") }}</td>
						<td>
							@if( $user->summoner_status == 2)
								{{ trans("users.is_verified") }}
							@else
								{{ trans("users.profile_not_verified") }}
							@endif
						</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("users.quests_completed") }}</td>
						<td>{{ $user->quests->count() }}</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("users.registered") }}</td>
						<td>{{ date("d.m.Y",strtotime($user->created_at)) }}</td>
					</tr>
				</table>
			</td>
			<td valign="top">
				<div class="profile_season_stats">
					<table class="table table-striped">
						<tr>
							<td colspan="2"><strong>{{ trans("users.ranked_stats") }}</strong></td>
						</tr>
						<tr>
							<td>Stat</td>
							<td>Value</td>
						</tr>
						<tr>
							<td>Stat</td>
							<td>Value</td>
						</tr>
						<tr>
							<td>Stat</td>
							<td>Value</td>
						</tr>
						<tr>
							<td>Stat</td>
							<td>Value</td>
						</tr>
						<tr>
							<td>Stat</td>
							<td>Value</td>
						</tr>
						<tr>
							<td>Stat</td>
							<td>Value</td>
						</tr>
						<tr>
							<td>Stat</td>
							<td>Value</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
	
	<table width="100%">
		<tr>
			<td width="50%" valign="top" style="padding-right: 20px;">
				<h2>{{ trans("users.quests_done") }}</h2>
				<table class="table table-striped">
				@foreach($quests_done as $quest)
					<tr>
						<td width="50">
							<img src="/img/champions/{{ $quest->champion_id }}_92.png" class="img-circle" width="35" />
						</td>
						<td>
							{{ $quest->questtype->name }}
							@if($quest->daily == 1) 
								(Daily Quest)
							@endif
							<br/>
							<div class="quest_description">{{ trans("quests.".$quest->type_id) }}</div>
						</td>
					</tr>
				@endforeach
				</table>
			</td>
			<td width="50%" valign="top">
				<h2>{{ trans("achievements.achievements") }}</h2>
				
				@if($user->trophy_top == 0) 
					<div class="challenge_tropy_open"><img class="img-circle trophy" alt="" src="/img/trophy/top.jpg" title="Top Lane Trophy" width="70"></div>
				@else 
					<div class="challenge_tropy_finished"><img class="img-circle trophy" alt="" src="/img/trophy/top.jpg" title="Top Lane Trophy" width="70"></div>
				@endif
				
				@if($user->trophy_jungle == 0) 
					<div class="challenge_tropy_open"><img class="img-circle trophy" alt="" src="/img/trophy/jungle.jpg" title="Jungler Trophy" width="70"></div>
				@else 
					<div class="challenge_tropy_finished"><img class="img-circle trophy" alt="" src="/img/trophy/jungle.jpg" title="Jungler Trophy" width="70"></div>
				@endif
				
				@if($user->trophy_mid == 0) 
					<div class="challenge_tropy_open"><img class="img-circle trophy" alt="" src="/img/trophy/mid.jpg" title="Mid Lane Trophy" width="70"></div>
				@else 
					<div class="challenge_tropy_finished"><img class="img-circle trophy" alt="" src="/img/trophy/mid.jpg" title="Mid Lane Trophy" width="70"></div>
				@endif
				
				@if($user->trophy_marksman == 0) 
					<div class="challenge_tropy_open"><img class="img-circle trophy" alt="" src="/img/trophy/marksman.jpg" title="Marksman Trophy" width="70"></div>
				@else 
					<div class="challenge_tropy_finished"><img class="img-circle trophy" alt="" src="/img/trophy/marksman.jpg" title="Marksman Trophy" width="70"></div>
				@endif
				
				@if($user->trophy_support == 0) 
					<div class="challenge_tropy_open"><img class="img-circle trophy" alt="" src="/img/trophy/support.jpg" title="Support Trophy" width="70"></div>
				@else 
					<div class="challenge_tropy_finished"><img class="img-circle trophy" alt="" src="/img/trophy/support.jpg" title="Support Trophy" width="70"></div>
				@endif
				
				<div class="clear"></div>
				<hr/>
				
				@if($user->achievements->count() == 0)
					{{ trans("achievements.no_achievements") }}
				@else
					@foreach($user->achievements as $achievement)
						<div class="achievement"><img src="/img/trophy/gold.png" title="{{ $achievement->name }}" class="trophy"  /></div>
					@endforeach
				@endif
				<div class="clear"></div>
			</td>
		</tr>
	</table>
				
	<h2>Last Games</h2>
	<table class="table">
		@foreach($games as $game)
			<?php 
				if($game["win"]==true) {
					$class = "success";
				} else {
					$class = "danger";
				}
			?>
			<tr class="<?php echo $class; ?>">
				<td>
					<a href="/champions/{{ $game->champion->key }}"><img src="/img/champions/{{ $game->championId }}_92.png" class="img-circle" width="35" /></a>
				</td>
				<td class="game_kda">
				{{ $game->championsKilled }} / {{ $game->numDeaths }} / {{ $game->assists }}<br/>
				@if($game->numDeaths > 0)
				KDA: {{ round(($game->championsKilled+$game->assists)/$game->numDeaths,2) }}
				@else
				KDA: {{ ($game->championsKilled+$game->assists) }}
				@endif
				</td>
				<td class="game_kda">
					{{ $game->subType }}<br/>
					{{ $game->minionsKilled }} CS ( {{ $game->neutralMinionsKilled }} neutral )
				</td>
				<td>
					<img src="/img/spells/{{ $game->spell1 }}.png" width="35" class="img-circle" > 
					<img src="/img/spells/{{ $game->spell2 }}.png" width="35" class="img-circle" >
				</td>
				<td id="items">
					@foreach($game->items as $item)
						<a href="/items/{{ $item->id }}"><img src="/img/items/{{ $item->id }}_64.png" data-toggle="tooltip" data-placement="top" title="{{ $item->name }}" width="35" class="img-circle items" ></a>
					@endforeach	
				</td>
			</tr>
		@endforeach
	</table>
	<br/>
	<h2>{{ trans("dashboard.quest_status") }}</h2>
	<ul class="champions_finished">
	@foreach($champion_quests as $champion_quest)
		<li>
		@if($champion_quest->quests == 0)
			<a href="/champions/{{ $champion_quest->key }}"><img class="img-circle quest_avatar" alt="{{ $champion_quest->name }}" src="/img/champions_small/{{ $champion_quest->champion_id }}_92.png" width="30" style="opacity: 0.4;" title="{{ $champion_quest->name }}: {{ $champion_quest->quests }} Quests done" /></a>
		@else
			<a href="/champions/{{ $champion_quest->key }}"><img class="img-circle quest_avatar" alt="{{ $champion_quest->name }}" src="/img/champions_small/{{ $champion_quest->champion_id }}_92.png" width="30"  title="{{ $champion_quest->name }}: {{ $champion_quest->quests }} Quests done" /></a>
		@endif
		</li>
	@endforeach
	</ul>
	<div class="clear"></div>
	<br/><br/>
	@else
		{{ trans("users.no_summoner") }}
	@endif
	
@stop
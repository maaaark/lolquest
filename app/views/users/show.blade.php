@extends('templates.default')
@if($user->summoner)
@section('title', trans("users.profile")." ".$user->summoner->name)
@else
@section('title', trans("users.profile")." ".$user->summoner_name)
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
				<a href="#" class="btn btn-primary">{{ trans("users.friend_request") }}</a>
			</td>
			<td width="400" valign="top">
				<table class="table table-striped" stlye="width: 100%;">
					<tr>
						<td width="130" class="attribute">{{ trans("users.summoner_name") }}</td>
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
						<td>{{ $user->created_at }}</td>
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
				@if($user->achievements->count() == 0)
					{{ trans("achievements.no_achievements") }}
				@else
					@foreach($user->achievements as $achievement)
						{{ $achievement->name }}
					@endforeach
				@endif
				
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
					<img src="/img/champions/{{ $game->championId }}_92.png" class="img-circle" width="35" />
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
					{{ $game->gameMode }}<br/>
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

	@else
		{{ trans("users.no_summoner") }}
	@endif
	
@stop
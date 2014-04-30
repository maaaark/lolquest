@extends('templates.default')
@section('title', trans("users.profile")." ".$user->summoner->name)
@section('content')
	<br/>
	@if($user->summoner)
	<table width="100%" class="profile">
		<tr>
			<td valign="top" width="130">
				<img src="/img/profileicons/profileIcon{{ $user->summoner->profileIconId }}.jpg" width="100" class="img-circle" />
			</td>
			<td>
				<table class="table table-striped" stlye="width: 100%;">
					<tr>
						<td width="250" class="attribute">{{ trans("users.summoner_name") }}</td>
						<td>{{ $user->summoner->name }}</td>
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
				</table>
			</td>
		</tr>
	</table>
	@if(Auth::check())
		@if(Auth::user()->id==$user->id)
		<a href="/refresh_games" class="btn btn-primary">{{ trans("users.refresh") }}</a>
		@endif
	@endif
	<br/>
	
	
					
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
				KDA: {{ round(($game->championsKilled+$game->assists)/$game->numDeaths,2) }}
				</td>
				<td>
					<img src="/img/spells/{{ $game->spell1 }}.png" width="35" class="img-circle" > 
					<img src="/img/spells/{{ $game->spell2 }}.png" width="35" class="img-circle" >
				</td>
				<td id="items">
					@foreach($game->items as $item)
						{{ $item->item_id }}
					@endforeach
					<img src="/img/items/{{ $game->item0 }}_64.png" data-toggle="tooltip" data-placement="top" title="Tooltip on top" width="35" class="img-circle items" > 
					<img src="/img/items/{{ $game->item1 }}_64.png" data-toggle="tooltip" data-placement="top" title="Tooltip on top" width="35" class="img-circle items" >
					<img src="/img/items/{{ $game->item2 }}_64.png" data-toggle="tooltip" data-placement="top" title="Tooltip on top" width="35" class="img-circle items" >
					<img src="/img/items/{{ $game->item3 }}_64.png" data-toggle="tooltip" data-placement="top" title="Tooltip on top" width="35" class="img-circle items" >
					<img src="/img/items/{{ $game->item4 }}_64.png" data-toggle="tooltip" data-placement="top" title="Tooltip on top" width="35" class="img-circle items" >
					<img src="/img/items/{{ $game->item5 }}_64.png" data-toggle="tooltip" data-placement="top" title="Tooltip on top" width="35" class="img-circle items" >
					&nbsp;&nbsp;&nbsp;
					<img src="/img/items/{{ $game->item6 }}_64.png" width="35" class="img-circle" >	
				</td>
			</tr>
		@endforeach
	</table>

<h2>Friends test 22</h2>
	@foreach($user->friends as $friend)
		{{ $friend->summoner_name }}<br/>
	@endforeach
	
	@else
		{{ trans("users.no_summoner") }}
	@endif
	
@stop
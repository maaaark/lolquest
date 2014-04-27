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
					<img src="/img/champions/{{ $game->championId }}_92.png" class="img-circle" width="50" />
				</td>
				<td>
				{{ $game->championsKilled }} / {{ $game->numDeaths }} / {{ $game->assists }}
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
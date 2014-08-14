@extends('templates.default')
@section('title', trans("users.profile")." ".$team->name)
@section('content')	
	<br/>

	<table width="100%" class="profile">
		<tr>
			<td valign="top" width="130" style="text-align: center; padding-right: 15px;">
				<img src="/img/teams/{{ $team->logo }}.jpg" width="100" class="img-circle" /><br/>
				<br/>
				{{ trans("users.level_profile") }}: {{ $team->level_id }}<br/><br/>
				@if($team->public == 1)
					<a href="#" class="btn btn-primary">{{ trans("teams.join") }}</a>
				@endif
			</td>
			<td width="400" valign="top">
				<table class="table table-striped" stlye="width: 100%;">
					<tr>
						<td width="130" class="attribute">{{ trans("users.summoner_name") }} </td>
						<td>{{ $team->name }}</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("users.region") }}</td>
						<td>{{ $team->region }}</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("teams.website") }}</td>
						<td>{{ $team->website }}</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("teams.since") }}</td>
						<td>
							{{ date("d.m.Y",strtotime($team->created_at)) }}
						</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("teams.captain") }}</td>
						<td><a href="/summoner/{{ $team->user->region }}/{{ $team->user->summoner_name }}">{{ $team->user->summoner->name }}</a></td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("teams.member") }}</td>
						<td>{{ $team->members->count() }}</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("users.quests_completed") }}</td>
						<td>0</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("users.achievement_points") }}</td>
						<td><img src="/img/ap.png" width="20" /> 0</td>
					</tr>
				</table>
			</td>
			<td valign="top">
				
			</td>
		</tr>
	</table>
	<br/><br/>
	
	<table width="100%">
		<tr>
			<td width="50%" valign="top">
				<h3>{{ trans("teams.member") }}</h3>
				<table class="table table-striped">
					<tr>
						<td width="20"><a href="/summoner/{{ $team->user->region }}/{{ $team->user->summoner_name }}"><img src="/img/profileicons/profileIcon{{ $team->user->summoner->profileIconId }}.jpg" class="img-circle" width="20" /></a></td>
						<td><a href="/summoner/{{$team->user->region }}/{{ $team->user->summoner_name }}">{{ $team->user->summoner->name }}</a> <i>({{ trans("teams.captain") }})</i></td>
					</tr>
				@foreach($team->members as $member)
					@if($member->id != $team->user->id)
					<tr>
						<td width="20"><a href="/summoner/{{ $member->region }}/{{ $member->summoner_name }}"><img src="/img/profileicons/profileIcon{{ $member->summoner->profileIconId }}.jpg" class="img-circle" width="20" /></a></td>
						<td><a href="/summoner/{{ $member->region }}/{{ $member->summoner_name }}">{{ $member->summoner->name }}</a></td>
					</tr>
					@endif
				@endforeach
				</table>
			</td>
			<td valign="top">
				<h3>{{ trans("teams.last_quests") }}</h3>
			</td>
		</tr>
	</table>
@stop
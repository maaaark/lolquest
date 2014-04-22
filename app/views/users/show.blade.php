@extends('layouts.master')
@section('content')
	<h2> {{ trans("users.profile") }} {{ $user->name }}</h2>
	@if($user->summoner)
	<table>
		<tr>
			<td>
				<img src="/img/profileicons/profileIcon{{ $user->summoner->profileIconId }}.jpg" />
			</td>
			<td>
				<table class="table table-striped">
					<tr>
						<td width="250">{{ trans("users.summoner_name") }}</td>
						<td>{{ $user->summoner->name }}</td>
					</tr>
					<tr>
						<td>{{ trans("users.level") }}</td>
						<td>{{ $user->summoner->summonerLevel }}</td>
					</tr>
					<tr>
						<td>icon</td>
						<td>{{ $user->summoner->profileIconId }}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	@else
		{{ trans("users.no_summoner") }}
	@endif
	
@stop
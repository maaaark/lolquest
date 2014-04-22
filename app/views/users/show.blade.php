@extends('layouts.master')
@section('content')
	<h2> {{ trans("users.profile") }} {{ $user->summoner_name }}</h2>
	<br/>
	@if($user->summoner)
	<table width="100%">
		<tr>
			<td valign="top" width="150">
				<img src="/img/profileicons/profileIcon{{ $user->summoner->profileIconId }}.jpg" class="img-circle" />
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
	@else
		{{ trans("users.no_summoner") }}
	@endif
	
@stop
@extends('templates.default')
@section('title', 'Search Result')
@section('content')
	<br/>
	<table class="table table-striped">
	<tr>
		<th>{{ trans("users.summoner_name") }}</th>
		<th>{{ trans("users.region") }}</th>
		<th>{{ trans("users.verified") }}</th>
	</tr>
	@foreach($users as $user)
		<tr>
			<td><a href="/summoner/{{ $user->region }}/{{ $user->summoner_name }}">{{ $user->summoner_name }}</a></td>
			<td>{{ $user->region }}</td>
			<td>
			@if( $user->summoner_status == 2)
				{{ trans("users.is_verified") }}
			@else
				{{ trans("users.profile_not_verified") }}
			@endif
			</td>
		</tr>
	@endforeach
	</table>
@stop
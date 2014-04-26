@extends('templates.default')
@section('title', trans("users.index"))
@section('content')
	<table class="table table-striped">
		<thead>
			<tr>
				<th class="text-left">{{ trans("users.summoner_name") }}</th>
				<th class="text-left">{{ trans("users.friends") }}</th>
				<th class="text-left">{{ trans("users.region") }}</th>
				@if (Authority::can('edit', 'User'))
					<th></th>
				@endif
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td class="text-left"><a href="/summoner/{{ $user->region }}/{{ $user->summoner_name }}">{{ $user->summoner_name }}</a></td>
					<td class="text-left">
					@if (Auth::user()->id == $user->id)
					@else
					<a href="/user_friend/{{ $user->id}}">{{ trans("users.invite") }}</a>@endif</td>
					<td class="text-left">{{ $user->region }}</td>
					@if (Authority::can('edit', 'User'))
					  <td>{{ link_to_route('users.edit', trans("users.edit"), array($user->region,$user->summoner_name)) }}</td>
					@endif
				</tr>
			@endforeach
		</tbody>
	 </table>
@stop
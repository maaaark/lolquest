@extends('templates.default')
@section('title', trans("users.index"))
@section('content')
	<table class="table table-striped">
		<thead>
			<tr>
				<th class="text-left">{{ trans("users.summoner_name") }}</th>
				@if(Auth::check())
					<th class="text-left">{{ trans("users.friends") }}</th>
				@endif
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
					@if(Auth::check())
					<td class="text-left">
							<a href="/user_friend/{{ $user->id}}">{{ trans("users.invite") }}</a>
					</td>
					@endif
					<td class="text-left">{{ $user->region }}</td>
					@if (Authority::can('edit', 'User'))
						<td>{{ link_to_route('users.edit', trans("users.edit"), array($user->region,$user->summoner_name)) }}</td>
					@endif
				</tr>
			@endforeach
		</tbody>
	 </table>
@stop
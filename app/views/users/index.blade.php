@extends('layouts.master')
@section('content')
	<table class="table table-striped">
		<thead>
			<tr>
				<th class="text-left">Name</th>
				<th class="text-left">Summoner Name</th>
				<th class="text-left">Region</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td class="text-left">{{ link_to_route('users.show', $user->name, $user->id) }}</td>
					<td class="text-left">{{ $user->summoner_name }}</td>
					<td class="text-left">{{ $user->region }}</td>
					@if (Authority::can('edit', 'User'))
					  <td>{{ link_to_route('users.edit', trans("users.edit"), $user->id) }}</td>
					@endif
				</tr>
			@endforeach
		</tbody>
	 </table>
@stop
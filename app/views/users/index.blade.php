@extends('layouts.master')
@section('content')
	<table class="table table-bordered no-more-tables">
		<thead>
			<tr>
				<th class="text-left">Name</th>
				<th class="text-left">Summoner Name</th>
				<th class="text-left">Region</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td class="text-left">{{ $user->name }}</td>
					<td class="text-left">{{ $user->summoner_name }}</td>
					<td class="text-left">{{ $user->region }}</td>
				</tr>
			@endforeach
		</tbody>
	 </table>
@stop
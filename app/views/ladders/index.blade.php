@extends('templates.default')
@section('title', trans("ladders.monthly"))
@section('content')
	<br/>
	<table class="table table-striped">
		<tr>
			<th>Summoner</th>
			<th>Quests completed</th>
			<th>Total EXP this month</th>
		</tr>
	@foreach($partipicant as $row)
		<tr>
			<td>{{ $row->summoner_name }}</td>
			<td>{{ $row["total_quests"] }}</td>
			<td>{{ $row["exp"] }}</td>
		</tr>
	@endforeach
	</table>
@stop
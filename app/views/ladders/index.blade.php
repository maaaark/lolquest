@extends('templates.default')
@section('title', trans("ladders.monthly")." ".trans("month.".$month))
@section('content')
	<br/>
	
	<strong>{{ trans("ladders.archive") }}</strong>
	<select id="dynamic_select" width="200">
		<option value="/ladders/{{ $year }}/{{ $month }}" selected>{{ trans("month.".$month) }} {{ $year }}</option>
		<option value="/ladders/2014/04">{{ trans("month.04") }} 2014</option>
		<option value="/ladders/2014/03">{{ trans("month.03") }} 2014</option>
	</select> 
	
	<br/>
	<br/>
	<table class="table table-striped">
		<tr>
			<th>Place</th>
			<th>Summoner</th>
			<th>Quests completed</th>
			<th>Total EXP this month</th>
		</tr>
	@foreach($ladder as $row)
		<tr>
			<td>{{ $row->rang }}</td>
			<td><a href="/summoner/{{ $row->user->region }}/{{ $row->user->summoner_name }}">{{ $row->user->summoner_name }}</a></td>
			<td>{{ $row->total_quests }}</td>
			<td>{{ $row->month_exp }}</td>
		</tr>
	@endforeach
	</table>
	<a href="/ladders/refresh_ladder" class="btn btn-primary">Refresh Ladder (Admin only)</a>
@stop
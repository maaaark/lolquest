@extends('templates.default')
@section('title', trans("ladders.monthly")." ".trans("month.".$month))
@section('content')
	<br/>
	
	<strong>{{ trans("ladders.archive") }}</strong>
	<select id="dynamic_select" width="200">
		<option value="/ladders/{{ $year }}/{{ $month }}" selected>{{ trans("month.".$month) }} {{ $year }}</option>
		<option value="/ladders/2014/06">{{ trans("month.06") }} 2014</option>
		<option value="/ladders/2014/05">{{ trans("month.05") }} 2014</option>
		<option value="/ladders/2014/04">{{ trans("month.04") }} 2014</option>
		<option value="/ladders/2014/03">{{ trans("month.03") }} 2014</option>
	</select> 
	
	<br/>
	<br/>
	<table class="table table-striped">
		<tr>
			<th>{{ trans("ladders.rang") }}</th>
			<th colspan="2">{{ trans("ladders.summoner") }}</th>
			<th>{{ trans("ladders.quests") }}</th>
			<th>{{ trans("ladders.total_exp") }}</th>
		</tr>
	@foreach($ladder as $row)
		<tr>
			<td width="60">{{ $row->rang }}.</td>
			<td width="20"><a href="/summoner/{{ $row->user->region }}/{{ $row->user->summoner_name }}"><img src="/img/profileicons/profileIcon{{ $row->user->summoner->profileIconId }}.jpg" class="img-circle" width="20" /></a></td>
			<td><a href="/summoner/{{ $row->user->region }}/{{ $row->user->summoner_name }}">{{ $row->user->summoner_name }}</a></td>
			<td>{{ $row->total_quests }}</td>
			<td>{{ $row->month_exp }}</td>
		</tr>
	@endforeach
	</table> 
	<?php echo $ladder->links(); ?>
@stop
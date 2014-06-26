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
	
	<span class="league_info">{{ trans("ladders.update") }}</span>
	
	<br/>
	<br/>
	<table class="table table-striped">
		<tr>
			<th>{{ trans("ladders.rang") }}</th>
			<th colspan="3">{{ trans("ladders.summoner") }}</th>
			<th>{{ trans("ladders.quests") }}</th>
			<th>{{ trans("ladders.total_exp") }}</th>
		</tr>
	@foreach($ladder as $row)
		<tr>
			<td width="60">{{ $row->rang }}.</td>
			<td width="20">
				@if($row->rang <= 3)
					<img src="/img/leagues/challenger_5.png" height="20" />
				@elseif($row->rang <= 10)
					<img src="/img/leagues/diamond_5.png" height="20" />
				@elseif($row->rang <= 25)
					<img src="/img/leagues/platinum_5.png" height="20" />
				@elseif($row->rang <= 50)
					<img src="/img/leagues/gold_5.png" height="20" />	
				@elseif($row->rang <= 100)
					<img src="/img/leagues/silver_5.png" height="20" />
				@elseif($row->rang >= 101)
					<img src="/img/leagues/bronze_5.png" height="20" />
				@endif
			</td>
			<td width="20"><a href="/summoner/{{ $row->user->region }}/{{ $row->user->summoner_name }}"><img src="/img/profileicons/profileIcon{{ $row->user->summoner->profileIconId }}.jpg" class="img-circle" width="20" /></a></td>
			<td><a href="/summoner/{{ $row->user->region }}/{{ $row->user->summoner_name }}">{{ $row->user->summoner->name }}</a></td>
			<td>{{ $row->total_quests }}</td>
			<td>{{ $row->month_exp }}</td>
		</tr>
	@endforeach
	</table> 
	<?php echo $ladder->links(); ?>
@stop
@extends('templates.default')
@section('title', "Teams")
@section('content')	
	<br/>
	@if(Auth::check())
	@if(Auth::user()->team_id == 0)
	<a href="/teams/create" class="btn btn-primary">{{ trans("teams.create_new") }}</a><br/>
	<br/>
	@endif
	@endif
	<table class="table table-striped">
		<tr>
			<th>{{ trans("ladders.rang") }}</th>
			<th colspan="3">{{ trans("ladders.summoner") }}</th>
			<th>{{ trans("teams.member") }}</th>
			<th>{{ trans("teams.average_exp") }}</th>
			<th>{{ trans("ladders.quests") }}</th>
		</tr>
	@foreach($teams as $row)
		<tr>
			<td width="60">{{ $row->rank }}.</td>
			<td width="20">
				@if($row->rank <= 3)
					<img src="/img/leagues/challenger_5.png" height="20" />
				@elseif($row->rank <= 10)
					<img src="/img/leagues/diamond_5.png" height="20" />
				@elseif($row->rank <= 25)
					<img src="/img/leagues/platinum_5.png" height="20" />
				@elseif($row->rank <= 50)
					<img src="/img/leagues/gold_5.png" height="20" />	
				@elseif($row->rank <= 100)
					<img src="/img/leagues/silver_5.png" height="20" />
				@elseif($row->rank >= 101)
					<img src="/img/leagues/bronze_5.png" height="20" />
				@endif
			</td>
			<td width="20"><a href="/teams/{{ $row->region }}/{{ $row->clean_name }}"><img src="/img/teams/logo/{{ $row->logo }}" class="img-circle" width="20" /></a></td>
			<td><a href="/teams/{{ $row->region }}/{{ $row->clean_name }}">{{ $row->name }}</a></td>
			<td>{{ $row->members->count() }}</td>
			<td>{{ $row->average_exp }}</td>
			<td>{{ $row->quests }}</td>
			
		</tr>
	@endforeach
	</table> 
	<br/>
	@if(Auth::check())
	@if(Auth::user()->team_id == 0)
	<a href="/teams/create" class="btn btn-primary">{{ trans("teams.create_new") }}</a><br/>
	@endif
	@endif
	<br/>
@stop
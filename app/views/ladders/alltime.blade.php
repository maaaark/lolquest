@extends('templates.default')
@section('title', "Top 100 Summoner")
@section('content')
	<?php $i=1; ?>
	<br/>
	<table class="table table-striped">
		<tr>
			<th>{{ trans("ladders.rang") }}</th>
			<th colspan="3">{{ trans("ladders.summoner") }}</th>
			<th>{{ trans("ladders.total_exp") }}</th>
			<th>{{ trans("ladders.quests") }}</th>
			<th>{{ trans("ladders.lifetime_qp") }}</th>
			<th>{{ trans("ladders.registered") }}</th>
		</tr>
	@foreach($users as $row)
		<tr>
			<td width="60">{{ $i }}.</td>
			<td width="20">
				@if($i <= 3)
					<img src="/img/leagues/challenger_5.png" height="20" />
				@elseif($i <= 10)
					<img src="/img/leagues/diamond_5.png" height="20" />
				@elseif($i <= 25)
					<img src="/img/leagues/platinum_5.png" height="20" />
				@elseif($i <= 50)
					<img src="/img/leagues/gold_5.png" height="20" />	
				@elseif($i <= 100)
					<img src="/img/leagues/silver_5.png" height="20" />
				@elseif($i >= 101)
					<img src="/img/leagues/bronze_5.png" height="20" />
				@endif
			</td>
			<td width="20">
				@if($row->summoner) 
					<a href="/summoner/{{ $row->region }}/{{ $row->summoner_name }}">
						<img src="http://ddragon.leagueoflegends.com/cdn/4.21.5/img/profileicon/{{ $row->summoner->profileIconId }}.png" class="img-circle" width="20" />
					</a>
				@else
					-
				@endif
				</td>
			<td>
				@if($row->summoner)
				<a href="/summoner/{{ $row->region }}/{{ $row->summoner_name }}">{{ $row->summoner->name }}</a>
				@else
				-
				@endif
			</td>
			<td>{{ $row->exp }}</td>
			<td>{{ $row->quests->count() }}</td>
			<td>
				{{ $row->lifetime_qp }}
			</td>
			<td>
				{{ $row->created_at->diffForHumans() }}
			</td>
		</tr>
		<?php $i++; ?>
	@endforeach
	</table> 
@stop
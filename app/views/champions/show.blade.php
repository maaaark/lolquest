@extends('templates.default')
@section('title', $champion->name)
@section('content')
	<script src="/js/chart.min.js"></script>
	<script>
		$( document ).ready(function() {
			
			// WIN LOSS
			@if($champion_games > 1)
				var pieData = [
					{
						value : {{ $champion_wins }},
						color : "#6dba4d",
					},
					{
						value : {{ $champion_losses }},
						color : "#c13333",
						
					},
				];
				var myChart = new Chart(document.getElementById("winloss").getContext("2d"));
				var myPie = myChart.Pie(pieData, {
					animationSteps: 100,
					animationEasing: 'easeOutQuart',
					scaleLabel : "<%=value%> %"
				});
			@endif
			
			// QUESTS DONE
			
			var lineChartData = {
				labels : [{{ $dates }}],
						datasets : [
							{
								fillColor : "rgba(151,187,205,0.5)",
								strokeColor : "rgba(151,187,205,1)",
								pointColor : "rgba(151,187,205,1)",
								pointStrokeColor : "#fff",
								data : [{{ $counts }}]
							}
						]

					}
				var myLine = new Chart(document.getElementById("champion_quests").getContext("2d")).Line(lineChartData);
		});
	</script>
	<br/>
	<table width="100%">
		<tr>
			<td valign="top">
				<img class="img-circle" src="/img/champions/{{ $champion->champion_id }}_92.png" width="92">
			</td>
			<td valign="top">
				<table class="table table-striped champion_stats">
					<tr>
						<td width="120"><strong>{{ trans("champions.attack_damage") }}</strong></td>
						<td>{{ $champion->attackdamage }} (+ {{ $champion->attackdamageperlevel }} / Level)</td>
						<td width="120"><strong>{{ trans("champions.health") }}</strong></td>
						<td>{{ $champion->hp }} (+ {{ $champion->hpperlevel }} / Level)</td>
					</tr>
					<tr>
						<td><strong>{{ trans("champions.attack_range") }}</strong></td>
						<td>{{ $champion->attackrange }}</td>
						<td><strong>{{ trans("champions.mana_energy") }}</strong></td>
						<td>{{ $champion->mp }} (+ {{ $champion->mpperlevel }} / Level)</td>
					</tr>
					<tr>
						<td><strong>{{ trans("champions.armor") }}</strong></td>
						<td>{{ $champion->armor }} (+ {{ $champion->armorperlevel }} / Level)</td>
						<td><strong>{{ trans("champions.movespeed") }}</strong></td>
						<td>{{ $champion->movespeed }}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br/>
	<table  width="100%">
		<tr>
			<td valign="top" width="50%">
				<h3>{{ trans("champions.wl_ratio") }} {{ $champion->name }}</h3>
				@if($champion_games <= 1)
					{{ trans("champions.no_data") }}
				@else
					<canvas id="winloss" height="200" width="300"></canvas><br/><br/>
				@endif
			</td>
			<td valign="top" width="50%">
				<h3>{{ trans("champions.quests_with") }} {{ $champion->name }}</h3>
					<canvas id="champion_quests" height="200" width="500"></canvas><br/><br/>
			</td>
		</tr>
	</table>
	@if($champion_games >= 2)
		Based on {{ $champion_games }} Games with {{ $champion->name }}
	@endif
	<br/><br/>
	<br/>
	<table  width="100%">
		<tr>
			<td valign="top" width="50%">
				<h3>{{ trans("champions.last_quests") }}</h3>
				<table class="table table-striped" style="margin-right: 15px;">
				@foreach($last_quests as $last)
					<tr>
						<td style="width: 30px !important;">
						<a href="/users/{{ $last->user->region }}/{{ $last->user->summoner_name }}"><img src="/img/profileicons/profileIcon{{ $last->user->summoner->profileIconId }}.jpg" class="img-circle" width="30" /></a>
						</td>
						<td class="timeline_quest">
							<a href="/summoner/{{ $last->user->region }}/{{ $last->user->summoner_name }}">{{ $last->user->summoner_name }}</a> - <a href="#" class="timeline_info" title="{{ trans('quests.'.$last->type_id) }}">{{ $last->questtype->name }}</a>
						</td>
					</tr>
				@endforeach
				</table>
			</td>
			<td valign="top" width="50%">
				<h3>{{ trans("champions.last_achievements") }}</h3>
				
			</td>
		</tr>
	</table>
@stop
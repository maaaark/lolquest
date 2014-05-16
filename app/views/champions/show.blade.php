@extends('templates.default')
@section('title', $champion->name)
@section('content')
	<script src="/js/chart.min.js"></script>
	<script>
		$( document ).ready(function() {
		
			// WIN LOSS
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
				animationEasing: 'easeOutBounce',
				scaleLabel : "<%=value%> %"
			});
			
			// QUESTS DONE
			var data = {
			labels : ["January","February","March","April","May","June","July"],
			datasets : [
					{
						fillColor : "rgba(220,220,220,0.5)",
						strokeColor : "rgba(220,220,220,1)",
						pointColor : "rgba(220,220,220,1)",
						pointStrokeColor : "#fff",
						data : [65,59,90,81,56,55,40]
					},
				]
			}
			
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
						<td width="120"><strong>Attack Damage</strong></td>
						<td>{{ $champion->attackdamage }} (+ {{ $champion->attackdamageperlevel }} / Level)</td>
						<td width="120"><strong>Health</strong></td>
						<td>{{ $champion->hp }} (+ {{ $champion->hpperlevel }} / Level)</td>
					</tr>
					<tr>
						<td><strong>Attack Range</strong></td>
						<td>{{ $champion->attackrange }}</td>
						<td><strong>Mana / Energie</strong></td>
						<td>{{ $champion->mp }} (+ {{ $champion->mpperlevel }} / Level)</td>
					</tr>
					<tr>
						<td><strong>Armor</strong></td>
						<td>{{ $champion->armor }} (+ {{ $champion->armorperlevel }} / Level)</td>
						<td><strong>Movespeed</strong></td>
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
				<h3>Win/Loss Ratio for {{ $champion->name }}</h3>
				@if($champion_games <= 0)
					No data available for this Champion
				@else
					<canvas id="winloss" height="200" width="300"></canvas><br/>
					Based on {{ $champion_games }} Games with {{ $champion->name }}<br/>
				@endif
			</td>
			<td valign="top" width="50%">
				<h3>Picked</h3>
				@if($champion_games <= 0)
					No data available for this Champion
				@else
					<canvas id="quests" height="200" width="300"></canvas><br/>
					Based on {{ $champion_games }} Games with {{ $champion->name }}
				@endif
			</td>
		</tr>
	</table>
@stop
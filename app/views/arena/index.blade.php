@extends('templates.default')
@section('title', "Arena - ".trans("month.".$month))
@section('content')
	
	@if(Config::get('settings.active_ladder') == 0)
		<div class="bs-callout bs-callout-warning">
			{{ trans("ladders.ladder_prepare") }}
		</div>
	@endif
	@if(Config::get('settings.active_ladder') == 3)
		<div class="bs-callout bs-callout-warning">
			{{ trans("ladders.ladder_test") }}
		</div>
	@endif
	<br/>
	<strong>Previous Arenas</strong>
	<select id="dynamic_select" width="200">
		<option value="/ladders/{{ $year }}/{{ $month }}" selected>{{ trans("month.".$month) }} {{ $year }}</option>
		<option value="/ladders/2014/06">{{ trans("month.06") }} 2014</option>
		<option value="/ladders/2014/05">{{ trans("month.05") }} 2014</option>
		<option value="/ladders/2014/04">{{ trans("month.04") }} 2014</option>
		<option value="/ladders/2014/03">{{ trans("month.03") }} 2014</option>
	</select> 
	
	<br/>
	
	<br/>
	<table width="100%"> 
		<tr>
			<td valign="top" width="300" style="padding-right: 20px;">
					@if(Auth::check())
					<div class="challenge">
						@if(Auth::user()->active_arena == 1) 
							Currently Arena Quests done: {{ $my_arena->arena_quests }}<br/>
							Currently Arena Rang: {{ $my_arena->rang }}<br/>
							<br/>
							@if($my_arena->arena_quest_started == 1)
								<a href="#"><img class="img-circle" alt="" src="/img/champions/{{ $my_arena_quest->champion_id }}_92.png" width="100"></a>
								<h3>{{ $my_arena_quest->questtype->name }}</h3>
								Text
					
								<?php
									 $enddate_arena_quest = date("Y/m/d H:i:s",$my_arena->arena_quest_end_time);
								?>
								<script>
								$( document ).ready(function() {
									$('.arena_quest_timer').countdown("{{ $enddate_arena_quest }}", function(event) {
										var totalHours = event.offset.totalDays * 24 + event.offset.hours;
										$(this).html(event.strftime(totalHours + ':%M:%S'));
									});
								});
								</script>
								
								Arena Quest started<br/>
								Time left: <span class="arena_quest_timer"></span><br/>
								<br/>
								<a href="/arena/finish_quest" class="btn btn-success">Finish Arena Quest</a><br/>
								<br/>
								<a href="/arena/stop_arena" class="btn btn-danger">Stop Arena</a>
								<div class="clear"></div>
							@else
								{{ Form::model(null, array('action' => 'ArenasController@start_quest', 'name' => 'frm', 'id' => 'frm' )) }}
								<select name="champion_arena_id" class="quest_select_champion">
									<option value="0">{{ trans("dashboard.random_champion") }}</option>
									@foreach($champions as $champion)
									<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>	
									@endforeach
								 </select>
								{{ Form::submit("Start Arena Quest", array('class' => 'btn btn-primary', 'style' => '', 'name' => 'send', 'id' => 'send')) }}
								<br/><br/>
								<a href="/arena/stop_arena" class="btn btn-danger">Stop Arena</a>
								{{ Form::close() }}
							@endif
						@else
							<h3>Join the Arena</h3>
							@if(Auth::user()->qp > 500)
								<a href="/arena/start_arena" class="btn btn-primary">Join the Arena (500 QP)</a>
							@else 
								<button class="btn btn-inactive">Not enough QP for Arena</button>
						@endif
						@endif
					</div>
					
					@endif
			</td>
			<td valign="top">
				<table class="table table-striped">
					<tr>
						<th>Rank</th>
						<th>Summoner Name</th>
						<th>Finished Quests</th>
					</tr>
					<tr>
						<td>1.</td>
						<td>heyitsmark</td>
						<td>5</td>
					</tr>
					<tr>
						<td>2.</td>
						<td>test</td>
						<td>5</td>
					</tr>
					<tr>
						<td>3.</td>
						<td>test2</td>
						<td>5</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
@stop
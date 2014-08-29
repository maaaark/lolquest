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
							<div style="text-align: center">
							@if($my_arena->arena_quest_started == 1)
								<a href="/champions/"><img class="img-circle" alt="" src="/img/champions/{{ $my_arena_quest->champion_id }}_92.png" width="100"></a><br/>
								<br/>
								<h3>{{ $my_arena_quest->questtype->name }}</h3>
								{{ $my_arena_quest->questtype->name }}<br/>
					
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
								
								<br/>
								Time left: <span class="arena_quest_timer"></span><br/>
								<br/>
								<form id="frm" method="post" action="/arena/finish_quest">
									<input class="inactive_at_click btn btn-success" type="submit" value="{{ trans('arena.finish_quest') }}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</form>
								<br/>
								<a href="/arena/stop_arena" class="btn btn-danger">End this Arena run</a>
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
								<a href="/arena/stop_arena" class="stop_arena btn btn-danger">End this Arena run</a>
								{{ Form::close() }}
							@endif
							</div>
						@else
							<h3>Join the Arena</h3>
							@if(Auth::user()->qp > 500)
								<form id="frm" method="post" action="/arena/start_arena">
									<input class="inactive_at_click btn btn-success" type="submit" value="{{ trans('arena.join_button') }}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</form>
							@else 
								<button class="btn btn-inactive">Not enough QP for Arena</button>
							@endif
						@endif
					</div>
					@else
					<div class="challenge">
						<div style="text-align: center">
							<a href="/login" class="btn btn-primary">Login to participate in the Arena</a>
						</div>
					</div>
					@endif
			</td>
			<td valign="top">
				<table class="table table-striped">
					<tr>
						<th>Rank</th>
						<th colspan="2">Summoner Name</th>
						<th>Finished Quests</th>
						<th>Reward</th>
					</tr>
					@foreach($arena_ladder as $arena)
					<tr>
						<td width="60">{{ $arena->rang }}.</td>
						<td style="width: 30px;"><img src="/img/profileicons/profileIcon{{ $arena->user->summoner->profileIconId }}.jpg" width="30" class="img-circle" /></td>
						<td><a href="/summoner/{{ $arena->user->region }}/{{ $arena->user->summoner_name }}">{{ $arena->user->summoner->name }}</a></td>
						<td>{{ $arena->arena_quests }}</td>
						<td>
							@if($arena->rang == 1 )
								<img src="/img/leagues/rp.png" alt="Riot Points" /> 1780 RP + 500 QP
							@elseif($arena->rang == 2)
								<img src="/img/leagues/rp.png" alt="Riot Points" /> 840 RP + 250 QP
							@elseif($arena->rang == 3)
								500 QP
							@elseif($arena->rang <= 5)
								250 QP
							@else
								-
							@endif
						</td>
					</tr>
					@endforeach
				</table>
			</td>
		</tr>
	</table>
@stop
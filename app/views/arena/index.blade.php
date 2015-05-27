@extends('templates.default')
@section('title', "Arena - ".trans("month.".$month))
@section('content')
	@if(Auth::user()->summoner_status == 1)
	
	<div class="bs-callout bs-callout-warning">
		{{ trans("arena.not_verified") }}
	</div>

	@else
		
	@if(Session::has('modal'))
		<script type="text/javascript">
			$(window).load(function(){
				$('#myModal').modal('show');
			});
		</script>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Arena Rewards</h4>
				  </div>
				  <div class="modal-body">
					<h3>Your Arena run has ended!</h3>
					<div style="text-align: center">
						<img src="/img/arena/trophy.png" />
					</div>
					{{ Session::get('end_msg') }}<br/>
					<br/>
					<h4>Based on your result, you will get the following rewards:</h4>
					<h4>{{ Session::get('reward') }} QP</h4>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans("dashboard.close") }}</button>
				  </div>
				</div>
			</div>
		</div>
	@endif
	
	<br/>
	<table width="100%"> 
		<tr>
			<td valign="top" width="300" style="padding-right: 20px;">
					@if(Auth::check())
					<div class="challenge">
						@if(Auth::user()->active_arena == 1) 
							Currently Arena Quests done: {{ $my_arena->arena_quests }}<br/>
							<br/>
							<div style="text-align: center">
							@if($my_arena->arena_quest_started == 1)
								<a href="/champions/"><img class="img-circle" alt="" src="/img/champions/{{ $my_arena_quest->champion_id }}_92.png" width="100"></a><br/>
								<br/>
								<h3>{{ $my_arena_quest->questtype->name }}</h3>
								<ul style="text-align: left;">
									{{ $my_arena_quest->questtype->description }}
								</ul>
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
							@if(Auth::user()->qp >= 500)
								<form id="frm" method="post" action="/arena/start_arena">
									<input class="inactive_at_click btn btn-primary" type="submit" value="{{ trans('arena.join_button') }}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</form>
							@else 
								<button class="btn btn-inactive">Not enough QP for Arena</button>
							@endif
							<br/>
							@if(Auth::user()->lp >= 50)
								<form id="frm" method="post" action="/arena/start_arena">
									<input class="inactive_at_click btn btn-success" type="submit" value="{{ trans('arena.join_button_lp') }}">
									<input type="hidden" name="lp" value="1">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</form>
							@else 
								<button class="btn btn-inactive">Not enough Gold for Arena</button>
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
						<th>End of Season Reward</th>
					</tr>
					@foreach($arena_ladder as $arena)
					<tr>
						<td width="60">{{ $arena->rang }}.</td>
						<td style="width: 30px;"><img src="http://ddragon.leagueoflegends.com/cdn/5.8.1/img/profileicon/{{ $arena->user->summoner->profileIconId }}.png" width="30" class="img-circle" /></td>
						<td><a href="/summoner/{{ $arena->user->region }}/{{ $arena->user->summoner_name }}">{{ $arena->user->summoner->name }}</a></td>
						<td>{{ $arena->arena_quests }}</td>
						<td>
							@if($arena->rang == 1 )
								<img src="/img/leagues/rp.png" alt="Riot Points" /> 500 Gold + 1000 QP
							@elseif($arena->rang == 2)
								<img src="/img/leagues/rp.png" alt="Riot Points" /> 250 RP + 500 QP
							@elseif($arena->rang == 3)
								250 QP
							@elseif($arena->rang <= 5)
								100 QP
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
	
	@endif
@stop
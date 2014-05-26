@extends('templates.default')
@section('title', trans("users.dashboard"))
@section('content')
	<br/>
	<h3>My Quests</h3>
	 <div class="quest_amount">
		{{ $myquests->count() }} of {{ $user->quest_slots }} {{ trans("dashboard.questlog") }}
		@if($user->quest_slots<4)
			{{ trans("dashboard.quest_slot_add") }}
		@endif
	 </div>
	 <div class="row myquests">
	 
		@foreach($myquests as $quest)
			<div class="col-lg-3 col-sm-6 col-md-4 col-sm-4 col-xs-6">
				@if($quest->daily == 1)
				<div class="quest daily_ribbon">
				@else
				<div class="quest">
				@endif
					<a href="/champions/{{ $quest->champion->key }}"><img class="img-circle" alt="{{ $quest->champion->name }}" src="/img/champions/{{ $quest->champion->champion_id }}_92.png" width="100"></a>
					<h3>{{ $quest->questtype->name }}</h3>
					<p class="questtext">{{ trans("quests.".$quest->type_id) }}<br/> 
					<br/> 
					{{ trans("dashboard.with") }} <strong>{{ $quest->champion->name }}</strong></p>
					<br/>
					@if($quest->daily == 1)
						<p><strong>{{ $quest->questtype->qp*2 }} QP + {{ $quest->questtype->exp*2 }} EXP</strong></p>
					@else
						<p><strong>{{ $quest->questtype->qp }} QP + {{ $quest->questtype->exp }} EXP</strong></p>
					@endif
				
					@if($time_waited < Config::get('api.refresh_time'))
						<p><button class="btn btn-inactive">{{ trans("dashboard.wait", array('time'=>Config::get('api.refresh_time')-$time_waited)) }}</button></p>
					@else
						<p><a class="btn btn-success" href="/quests/check_quest/{{ $quest->id }}" role="button">{{ trans("dashboard.complete") }}</a></p>
					@endif
					@if($quest->daily == 1)
					<p><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $quest->id }}">{{ trans("dashboard.cancel") }}</a></p><span class="clock"></span>
					@else
					<p><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $quest->id }}">{{ trans("dashboard.cancel") }}</a></p>
					@endif
					<p><div class="refresh_cooldown"></div></p>
				</div>
			</div>
			
			<!-- Cancel Quest Popup -->
			<div class="modal fade" id="myModal-{{ $quest->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">{{ trans("dashboard.cancel") }} "{{ $quest->questtype->name }}"</h4>
					  </div>
					  <div class="modal-body">
						<table>
							<tr>
								<td valign="top" width="120"><img class="img-circle" alt="{{ $quest->champion->name }}" src="/img/champions/{{ $quest->champion->champion_id }}_92.png" width="100" style="margin-right: 15px;"></td>
								<td valign="top" width="100%">
									<h3>{{ $quest->questtype->name }}</h3>
									{{ trans("quests.".$quest->type_id) }}<br/>
									<br/>
									<table class="table table-striped payment-table">
										<tr>
											<td>{{ trans("dashboard.balance") }}</td>
											<td>{{ $user->qp; }}</td>
										</tr>
										<tr>
											<td>{{ trans("dashboard.cancel") }}</td>
											@if(($quest->createDate + 86400000) > ($time*1000) )
											<td>-{{ Config::get('costs.delete_daily') }} QP</td>
											@else
											<td>{{ trans("dashboard.delete_free") }}</td>
											@endif
										</tr>
										@if(($quest->createDate + 86400000) > ($time*1000) )
											<?php $free_in = ($quest->createDate + 86400000)-($time *1000); ?>
											<tr>
												<td width="200">{{ trans("dashboard.free_in") }}</td>
												<td>{{ date("H:i:s",$free_in/1000) }}</td>
											</tr>
										@endif
										<tr>
											<td><strong>{{ trans("dashboard.balance_after") }}</strong></td>
											@if(($quest->createDate + 86400000) > ($time*1000) )
											<td><strong>{{ $user->qp-Config::get('costs.delete_daily') }}</strong></td>
											@else
											<td><strong>{{ $user->qp-0 }}</strong></td>
											@endif
										</tr>
									</table>
								</td>
							</tr>
						</table>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans("dashboard.close") }}</button>
						@if(($quest->createDate + 86400000) > ($time*1000) )
							@if(Config::get('costs.delete_daily') > $user->qp)
								<button type="button" class="btn btn-inactive">{{ trans("dashboard.low_qp") }}</button>	
								<a href="/shop" class="btn btn-primary">{{ trans("dashboard.buy_qp") }}</a>
							@else
								<a href="/quests/cancel_quest/{{ $quest->id }}" class="btn btn-danger">{{ trans("dashboard.cancel") }}</a>
							@endif
							@else
								<!-- FREE TO DELETE -->
								<a href="/quests/cancel_quest/{{ $quest->id }}" class="btn btn-danger">{{ trans("dashboard.cancel") }}</a>
						@endif
						
						
					  </div>
					</div>
				</div>
			</div>
		@endforeach
		
		
		@if($myquests->count() < $user->quest_slots)
			<div class="col-lg-3 col-sm-6 col-md-4 col-sm-4 col-xs-6">
				<div class="quest">
				{{ Form::model($user, array('action' => 'QuestsController@create_choose_quest', 'name' => 'frm', 'id' => 'frm' )) }}
				  <img class="img-circle" alt="" src="/img/champions/0_92.png" width="100">
					  <h3>{{ trans("dashboard.choose_slot") }}</h3>
					  <p class="questtext">{{ trans("dashboard.choose") }}<br/> 
					  <br/>  <br/> 
					  <select name="choose_quest_champion" class="quest_select_champion">
						<option value="0">{{ trans("dashboard.random_champion") }}</option>
						@foreach($champions as $champion)
						<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>	
						@endforeach
					  </select>
					  <select name="choose_playerrole" class="quest_select_champion">
						<option value="0">{{ trans("dashboard.random_role") }}</option>
						@foreach($playerroles as $role)
						<option value="{{ $role->id }}">{{ $role->name }}</option>	
						@endforeach
					  </select>
					  </p>
					  <br/>
					  <br/><br/>
					  <br/>
					  @if($user->summoner_status == 2)
					  <p>{{ Form::submit(trans("dashboard.get"), array('class' => 'btn btn-primary', 'style' => 'margin-top: 22px;', 'name' => 'send', 'id' => 'send')) }}</p>
					  @else
						<a href="/verify" class="btn btn-primary">{{ trans("dashboard.verify_first") }}</a>
					  @endif
					{{ Form::close() }}
				</div>
			</div>
		@else
			
		@endif
		
		<?php $free_slots = $user->quest_slots - ($myquests->count()+1); ?>
		@for ($i = 1; $i <= $free_slots; $i++)
			<div class="col-lg-3 col-sm-6 col-md-4 col-sm-4 col-xs-6">
				<div class="quest empty_quest">
					{{ trans("dashboard.empty_quests") }}
				</div>
			</div>
		@endfor
		
		<?php $buyable_slots = 4 -$user->quest_slots; ?>
		@for ($i = 1; $i <= $buyable_slots; $i++)
			<div class="col-lg-3 col-sm-6 col-md-4 col-sm-4 col-xs-6">
				<div class="quest maxquests">
					{{ trans("dashboard.maximum_quests") }}<br/>
					<br/>
					<a href="/shop" class="btn btn-primary">{{ trans("dashboard.buy_quest_slots") }}</a>
				</div>
			</div>
		@endfor
		
	</div>
	
	<br/><br/>
	<!-- END OF QUESTSLOTS -->
	
	<h3>Challenges</h3>
	<div class="challenge">
		<div class="col-lg-3 col-sm-6 col-md-4 col-sm-4 col-xs-6">
			<div class="challenge_sidebar">
				@if($user->challenge_mode == 0)
				<img class="img-circle" alt="" src="/img/champions/0_92.png" width="100"><br/>
				<br/>
				{{ Form::model($user, array('action' => 'QuestsController@create_challenge')) }}
				<select name="challenge_mode" class="quest_select_champion">
					<option value="1">Top-Lane</option>
					<option value="2">Jungle</option>
					<option value="3">Mid-Lane</option>
					<option value="4">Marksman</option>
					<option value="5">Support</option>
				</select>
				<br/>
				{{ Form::submit(trans("dashboard.start_challenge"), array('class' => 'btn btn-primary', 'style' => 'margin-top: 22px;')) }}<br/><br/>
				<strong>{{ trans("dashboard.challenge_exp") }}</strong>
				{{ Form::close() }}
				@else
					<img class="img-circle" alt="" src="/img/champions/0_92.png" width="100"><br/>
					<br/>
					<h4>{{ trans("dashboard.challenge_mode") }}:</h4>
					{{ trans("dashboard.challenge_mode_".$user->challenge_mode) }}<br/>
					<br/>
					<a href="/cancel_challenge" class="btn btn-danger">{{ trans("dashboard.cancel_challenge") }}</a>
				@endif
			</div>
		</div>
		<div class="col-lg-9 col-sm-6 col-md-8 col-sm-8 col-xs-6">
			@if($user->challenge_mode == 0)
				{{ trans("dashboard.challenge_desc") }}
			@else
				<h4>{{ trans("dashboard.current_challenge") }}:</h4>
				{{ trans("challenges.".$user->challenge_mode."_".$user->challenge_step) }}<br/>
				<br/>
				<h4>{{ trans("dashboard.challenge_progress") }}:</h4>
				<div class="progress">
				  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
					0%
				  </div>
				</div>
			@endif
		</div>
		<div class="clear"></div>
	</div>
	<br/><br/>
@stop
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
					<img class="img-circle" alt="{{ $quest->champion->name }}" src="/img/champions/{{ $quest->champion->champion_id }}_92.png" width="100">
					<h2>{{ $quest->questtype->name }}</h2>
					<p class="questtext">{{ trans("quests.".$quest->type_id) }}<br/> 
					<br/> 
					{{ trans("dashboard.with") }} {{ $quest->champion->name }}</p>
					<br/>
					@if($quest->daily == 1)
						
						<p><span class="clock"></span>&nbsp;&nbsp;&nbsp;<a href="#" class="cancel" data-toggle="modal" data-target="#myModal-{{ $quest->id }}">{{ trans("dashboard.cancel") }}</a></p>
					@else
						<p><a href="#" data-toggle="modal" data-target="#myModal-{{ $quest->id }}">{{ trans("dashboard.reroll") }}</a></p>
					@endif
					@if($time_waited < Config::get('api.refresh_time'))
						<button class="btn btn-inactive">{{ trans("dashboard.wait", array('time'=>Config::get('api.refresh_time')-$time_waited)) }}</button>
					@else
						<p><a class="btn btn-success" href="/quests/check_quest/{{ $quest->id }}" role="button">{{ trans("dashboard.complete") }}</a></p>
					@endif
					@if($quest->daily == 1)
						<p><strong>{{ $quest->questtype->qp*2 }} QP + {{ $quest->questtype->exp*2 }} EXP</strong></p>
					@else
						<p><strong>{{ $quest->questtype->qp }} QP + {{ $quest->questtype->exp }} EXP</strong></p>
					@endif
					<p><div class="refresh_cooldown"></div></p>
				</div>
			</div>
			
			<!-- Modal for QP Warning / Buy -->
			<div class="modal fade" id="myModal-{{ $quest->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">{{ trans("dashboard.reroll_modal") }} "{{ $quest->questtype->name }}"</h4>
					  </div>
					  <div class="modal-body">
						<table>
							<tr>
								<td valign="top" width="120"><img class="img-circle" alt="{{ $quest->champion->name }}" src="/img/champions/{{ $quest->champion->champion_id }}_92.png" width="100" style="margin-right: 15px;"></td>
								<td valign="top" width="100%">
									<h3>{{ $quest->questtype->name }}</h3>
									{{ trans("quests.".$quest->type_id) }}<br/>
									<br/>
									<table class="table table-striped">
										<tr>
											<td>{{ trans("dashboard.balance") }}</td>
											<td>{{ $user->qp; }}</td>
										</tr>
										<tr>
											<td>{{ trans("dashboard.costs_reroll") }}</td>
											<td>{{ Config::get('costs.reroll') }}</td>
										</tr>
										<tr>
											<td><strong>{{ trans("dashboard.balance_after") }}</strong></td>
											<td><strong>{{ $user->qp-Config::get('costs.reroll') }}</strong></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans("dashboard.close") }}</button>
						@if(Config::get('costs.reroll') > $user->qp)
							<button type="button" class="btn btn-inactive">{{ trans("dashboard.low_qp") }}</button>	
						@else
							<a href="/quests/reroll_quest/{{ $quest->id }}" class="btn btn-primary">{{ trans("dashboard.reroll") }}</a>
						@endif
					  </div>
					</div>
				</div>
			</div>
		@endforeach
		
		
		@if($myquests->count() < $user->quest_slots)
			<div class="col-lg-3 col-sm-6 col-md-4 col-sm-4 col-xs-6">
				<div class="quest">
				{{ Form::model($user, array('action' => 'QuestsController@create_choose_quest')) }}
				  <img class="img-circle" alt="" src="/img/champions/0_92.png" width="100">
					  <h2>{{ trans("dashboard.choose_slot") }}</h2>
					  <p class="questtext">{{ trans("dashboard.choose") }}<br/> 
					  <br/> 
					  <select name="choose_quest_champion" class="quest_select_champion">
						<option value="0">{{ trans("dashboard.random_champion") }}</option>
						@foreach($champions as $champion)
						<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>	
						@endforeach
					  </select>
					  </p>
					  <br/>
					  <br/>
					  <p>{{ Form::submit(trans("dashboard.get"), array('class' => 'btn btn-primary')) }}</p>
					{{ Form::close() }}
				</div>
			</div>


		@else
			
		@endif
		
		@for ($i = $user->quest_slots; $i <= 3; $i++)
			<div class="col-lg-3 col-sm-6 col-md-4 col-sm-4 col-xs-6">
				<div class="quest maxquests">
					{{ trans("dashboard.maximum_quests") }}
				</div>
			</div>
		@endfor
		
	</div>
	<br/><br/>
@stop
@extends('templates.default')
@section('title', trans("users.dashboard"))
@section('content')
	<br/>
	<h3>My Quests</h3>
	 <div class="quest_amount">
		{{ $myquests->count() }} of 2 {{ trans("dashboard.questlog") }}
	 </div>
	 <div class="row myquests">
	 
		@foreach($myquests as $quest)
			<div class="col-sm-3">
				<div class="quest">
					<img class="img-circle" alt="{{ $quest->champion->name }}" src="/img/champions/{{ $quest->champion->champion_id }}_92.png" width="100">
					<h2>{{ $quest->questtype->name }}</h2>
					<p class="questtext">{{ trans("quests.".$quest->type_id) }}<br/> 
					<br/> 
					{{ trans("dashboard.with") }} {{ $quest->champion->name }}</p>
					<br/>
					<p><a href="#" data-toggle="modal" data-target="#myModal-{{ $quest->id }}">{{ trans("dashboard.reroll") }}</a></p>
					@if($time_waited < Config::get('api.refresh_time'))
						<button class="btn btn-inactive">{{ trans("dashboard.wait", array('time'=>Config::get('api.refresh_time')-$time_waited)) }}</button>
					@else
						<p><a class="btn btn-success" href="/quests/check_quest/{{ $quest->id }}" role="button">{{ trans("dashboard.complete") }}</a></p>
					@endif
					<p>{{ $quest->questtype->exp }} EXP + {{ $quest->questtype->qp }} QP</p>
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
								<td valign="top" width="120"><img class="img-circle" alt="{{ $quest->champion->name }}" src="/img/champions/{{ $quest->champion->champion_id }}_92.png" width="100"></td>
								<td valign="top">
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
		
		
		@if($myquests->count() < 2)
			<div class="col-sm-3">
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
			<div class="col-sm-3">
				<div class="quest maxquests">
					{{ trans("dashboard.maximum_quests") }}
				</div>
			</div>
		@endif
		
		@if($myquests->count() == 0)
		<div class="col-sm-3">
			<div class="quest maxquests inactive_quest_slot">
				{{ trans("dashboard.empty_slot") }}
			</div>
		</div>
		@endif
		
		@if($myquests->count() <= 1)
		<div class="col-sm-3">
			<div class="quest maxquests inactive_quest_slot">
				{{ trans("dashboard.empty_slot") }}
			</div>
		</div>
		@endif
		
	</div>
	<br/><br/>
	
@stop
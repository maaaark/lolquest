@extends('templates.full')
@section('title', trans("users.dashboard"))
@section('content')
	<br/>
	<h3>My Quests</h3>
	 <div class="quest_amount">
		{{ $myquests->count() }} of 2 {{ trans("dashboard.questlog") }}
	 </div>
	 <div class="row myquests">
	 
		@foreach($myquests as $quest)
			<div class="col-lg-2">
				<div class="quest">
					<img class="img-circle" alt="{{ $quest->champion->name }}" src="/img/champions/{{ $quest->champion->champion_id }}_92.png" width="100">
					<h2>{{ $quest->questtype->name }}</h2>
					<p class="questtext">{{ trans("quests.".$quest->type_id) }}<br/> 
					<br/> 
					{{ trans("dashboard.with") }} {{ $quest->champion->name }}</p>
					<br/>
					<p><a href="#">{{ trans("dashboard.reroll") }}</a></p>
					<p><a class="btn btn-default" href="/quests/check_quest/{{ $quest->id }}" role="button">{{ trans("dashboard.complete") }}</a></p>
					<p>{{ $quest->questtype->exp }} EXP + {{ $quest->questtype->qp }} QP</p>
				</div>
			</div>
		@endforeach
		
		
		@if($myquests->count() < 2)
			<div class="col-lg-2">
				<div class="quest">
				{{ Form::model($user, array('action' => 'QuestsController@create_choose_quest')) }}
				  <img class="img-circle" alt="" src="/img/champions/0_92.png" width="100">
					  <h2>{{ trans("dashboard.choose_slot") }}</h2>
					  <p class="questtext">{{ trans("dashboard.choose") }}<br/> 
					  <br/> 
					  <select name="choose_quest_champion" class="quest_select_champion">
						<option>{{ trans("dashboard.pick") }}</option>
						@foreach($champions as $champion)
						<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>	
						@endforeach
					  </select>
					  </p>
					  <br/>
					  <br/>
					  <p>{{ Form::submit(trans("dashboard.get"), array('class' => 'btn btn-primary')) }}</p>
					  <p>100 EXP + 10 QP</p>
					{{ Form::close() }}
				</div>
			</div>

			<div class="col-lg-2">
				<div class="quest">
					{{ Form::model($user, array('action' => 'QuestsController@create_random_quest')) }}
					<img class="img-circle" alt="" src="/img/champions/0_92.png" width="100">
					<h2>{{ trans("dashboard.open_slot") }}</h2>
					<p class="questtext">{{ trans("dashboard.random") }}</p>
					<br/>
					<br/>
					<p>{{ Form::submit(trans("dashboard.get"), array('class' => 'btn btn-primary')) }}</p>
					<p>150 EXP + 15 QP</p>
					{{ Form::close() }}
				</div>
			</div>
		@else
			<div class="col-lg-2">
				<div class="quest maxquests">
					{{ trans("dashboard.maximum_quests") }}
				</div>
			</div>
		@endif
		
		<div class="col-lg-2">
			<div class="quest maxquests inactive_quest_slot">
				{{ trans("dashboard.empty_slot") }}
			</div>
		</div>
	
		<div class="col-lg-2">
			<div class="quest maxquests inactive_quest_slot">
				{{ trans("dashboard.empty_slot") }}
			</div>
		</div>
		
	</div>
	<h2>Quests</h2>
	@foreach($myquests as $quest)
		<strong>{{ $quest->questtype->name }}</strong> with {{ $quest->champion->name }}<br/>
	@endforeach
	<br/>
	<h2>Notifications</h2>
	@foreach($user->notifications as $note)
		{{ $note->message }}<br/>
	@endforeach
	
@stop
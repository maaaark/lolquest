@extends('templates.default')
@section('title', trans("users.challenges"))
@section('content')
	<br/>	
	<div class="challenge">
		<div class="col-lg-3 col-sm-6 col-md-4 col-sm-4 col-xs-6">
			<div class="challenge_sidebar">
				@if($user->challenge_mode == 0)
				<img class="img-circle" alt="" src="/img/champions/0_92.png" width="100"><br/>
				<br/>
				{{ Form::model($user, array('action' => 'QuestsController@create_challenge')) }}
				<select name="challenge_mode" class="quest_select_champion">
					@if($user->trophy_top == 0)
					<option value="1">Top-Lane</option>
					@endif
					@if($user->trophy_jungle == 0)
					<option value="2">Jungle</option>
					@endif
					@if($user->trophy_mid == 0)
					<option value="3">Mid-Lane</option>
					@endif
					@if($user->trophy_marksman == 0)
					<option value="4">Marksman</option>
					@endif
					@if($user->trophy_support == 0)
					<option value="5">Support</option>
					@endif
				</select>
				<br/>
				{{ Form::submit(trans("dashboard.start_challenge"), array('class' => 'btn btn-primary', 'style' => 'margin-top: 22px;')) }}<br/><br/>
				<strong>{{ trans("dashboard.challenge_exp") }}</strong>
				{{ Form::close() }}
				@else
					<img class="img-circle" alt="" src="/img/trophy/{{ $user->challenge_mode }}.jpg" width="100"><br/>
					<br/>
					<h4>{{ trans("dashboard.challenge_mode") }}:</h4>
					{{ trans("dashboard.challenge_mode_".$user->challenge_mode) }}<br/>
					<br/>
					<form id="frm" action="/finish_challenge">
								<input class="inactive_at_click btn btn-success" type="submit" value="{{ trans('dashboard.finish_challenge') }}">
					</form><br/>
					<div class="cancel_challenge"><a href="/cancel_challenge" class="btn btn-danger" id="cancel_challenge"  style='width: 155px; margin-top: 12px;'>{{ trans("dashboard.cancel_challenge") }}</a></div>
				@endif
			</div>
		</div>
		<div class="col-lg-9 col-sm-6 col-md-8 col-sm-8 col-xs-6">
			<h4>{{ trans("dashboard.challenge_progress") }}:</h4>
			<div class="progress">
			<?php $challenge_percent = 0; ?>
			@if($user->challenge_step == 1)
				<?php $challenge_percent = 0; ?>
			@elseif($user->challenge_step == 2)
				<?php $challenge_percent = 20; ?>
			@elseif($user->challenge_step == 3)
				<?php $challenge_percent = 40; ?>
			@elseif($user->challenge_step == 4)
				<?php $challenge_percent = 60; ?>
			@elseif($user->challenge_step == 5)
				<?php $challenge_percent = 80; ?>
			@endif
			  <div class="progress-bar" role="progressbar" aria-valuenow="{{ $challenge_percent }}" aria-valuemin="{{ $challenge_percent }}" aria-valuemax="100" style="width: {{ $challenge_percent }}%;">
				{{ $challenge_percent }}%
			  </div>
			</div>
			<br/>
			@if($user->challenge_mode == 0)
				{{ trans("dashboard.challenge_desc") }}<br/>
				<br/>
				@if($user->trophy_top == 0) 
					<div class="challenge_tropy_open"><img class="img-circle trophy" alt="" src="/img/trophy/top.jpg" title="Top Lane Trophy" width="70"></div>
				@else 
					<div class="challenge_tropy_finished"><img class="img-circle trophy" alt="" src="/img/trophy/top.jpg" title="Top Lane Trophy" width="70"></div>
				@endif
				
				@if($user->trophy_jungle == 0) 
					<div class="challenge_tropy_open"><img class="img-circle trophy" alt="" src="/img/trophy/jungle.jpg" title="Jungler Trophy" width="70"></div>
				@else 
					<div class="challenge_tropy_finished"><img class="img-circle trophy" alt="" src="/img/trophy/jungle.jpg" title="Jungler Trophy" width="70"></div>
				@endif
				
				@if($user->trophy_mid == 0) 
					<div class="challenge_tropy_open"><img class="img-circle trophy" alt="" src="/img/trophy/mid.jpg" title="Mid Lane Trophy" width="70"></div>
				@else 
					<div class="challenge_tropy_finished"><img class="img-circle trophy" alt="" src="/img/trophy/mid.jpg" title="Mid Lane Trophy" width="70"></div>
				@endif
				
				@if($user->trophy_marksman == 0) 
					<div class="challenge_tropy_open"><img class="img-circle trophy" alt="" src="/img/trophy/marksman.jpg" title="Marksman Trophy" width="70"></div>
				@else 
					<div class="challenge_tropy_finished"><img class="img-circle trophy" alt="" src="/img/trophy/marksman.jpg" title="Marksman Trophy" width="70"></div>
				@endif
				
				@if($user->trophy_support == 0) 
					<div class="challenge_tropy_open"><img class="img-circle trophy" alt="" src="/img/trophy/support.jpg" title="Support Trophy" width="70"></div>
				@else 
					<div class="challenge_tropy_finished"><img class="img-circle trophy" alt="" src="/img/trophy/support.jpg" title="Support Trophy" width="70"></div>
				@endif
				<div class="clear"></div>
			@else
				<h4>{{ trans("dashboard.current_challenge") }}:</h4>
				{{ trans("challenges.".$user->challenge_mode."_".$user->challenge_step) }}<br/>
				<br/>
				<i>
				{{ trans("challenges.available_champions") }}<br/>
				{{ trans("challenges.".$user->challenge_mode."_champions") }}
				</i>
			@endif
		</div>
		<div class="clear"></div>
	</div>
	<br/><br/>
@stop
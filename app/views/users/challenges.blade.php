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
					<!--<option value="2">Jungle</option>-->
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
					<form id="frm" action="/finish_challenge" method="post">
						<input class="btn btn-success" type="submit" value="{{ trans('dashboard.finish_challenge') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                                @if($user->challenge_mode == 1)
                                @foreach($full_top_champions as $index => $row)
                                    @if ($index == 0)
                                        {{$row->name}}
                                    @else
                                        , {{$row->name}}
                                    @endif
                                 
                                @endforeach
                                @elseif($user->challenge_mode == 2)
                                @foreach($full_jungle_champions as $index => $row)
                                    @if ($index == 0)
                                        {{$row->name}}
                                    @else
                                        , {{$row->name}}
                                    @endif
                                 
                                @endforeach
                                @elseif($user->challenge_mode == 3)
                                @foreach($full_mid_champions as $index => $row)
                                    @if ($index == 0)
                                        {{$row->name}}
                                    @else
                                        , {{$row->name}}
                                    @endif
                                 
                                @endforeach
                                @elseif($user->challenge_mode == 4)
                                @foreach($full_marksman_champions as $index => $row)
                                    @if ($index == 0)
                                        {{$row->name}}
                                    @else
                                        , {{$row->name}}
                                    @endif
                                 
                                @endforeach
                                @elseif($user->challenge_mode == 5)
                                @foreach($full_support_champions as $index => $row)
                                    @if ($index == 0)
                                        {{$row->name}}
                                    @else
                                        , {{$row->name}}
                                    @endif
                                 
                                @endforeach
                                
                                @endif
				
				</i>
			@endif
		</div>
		<div class="clear"></div>
	</div>
	<div class="daily_quests"></br></br>
	<h3>Lifetime Challenges</h3>
	<br/>
	
	
	<div role="tabpanel">

  <!-- Nav tabs -->
  	<ul class="nav nav-tabs" role="tablist">
  	  	<li role="presentation" class="active"><a href="#current" aria-controls="current" role="tab" data-toggle="tab">Current Challenges</a></li>
    	<li role="presentation"><a href="#stats" aria-controls="stats" role="tab" data-toggle="tab">Stats</a></li>
    	<li role="presentation"><a href="#objectives" aria-controls="objectives" role="tab" data-toggle="tab">Objectives</a></li>
    	<li role="presentation"><a href="#others" aria-controls="others" role="tab" data-toggle="tab">Others</a></li>
    </ul>
  
  	<div class="tab-content">
  		<div role="tabpanel" class="tab-pane fade in active" id="current">
  			<!-- CURRENT CHALLENGES-->
  			<table width="100%" class="table table-striped daily_quests_table">
	@foreach($user->challenges as $challenge)
		<tr>
			<td valign="top" width="100"><img width="75" src="/img/leagues/{{$challenge->icon}}"><br/><br/></td>
			<td valign="top">
				<strong>{{$challenge->name}}</strong><br/>
				<div class="daily_description">{{$challenge->description}}</div>
				<div class="progress">
				  <div class="overlay_progress uppercase small" style="text-align: center;">
				  @if($challenge->type == 1)
						{{number_format($userstats->ingamegold,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->ingamegold!=0)
							{{round((($userstats->ingamegold/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 2)
						{{number_format($userstats->dmg,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->dmg!=0)
							{{round((($userstats->dmg/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 3)
						{{number_format($userstats->heal,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->heal!=0)
							{{round((($userstats->heal/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 4)
						{{number_format($userstats->kills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->kills!=0)
							{{round((($userstats->kills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 5)
						{{number_format($userstats->assists,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->assists!=0)
							{{round((($userstats->assists/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 6)
						{{number_format($userstats->wins,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->wins!=0)
							{{round((($userstats->wins/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 7)
						{{number_format($userstats->games,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->games!=0)
							{{round((($userstats->games/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 8)
						{{number_format($userstats->dmgtaken,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->dmgtaken!=0)
							{{round((($userstats->dmgtaken/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 9)
						{{number_format($userstats->wards,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->wards!=0)
							{{round((($userstats->wards/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 10)
						{{number_format($userstats->wardkills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->wardkills!=0)
							{{round((($userstats->wardkills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 11)
						{{number_format($userstats->towers,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->towers!=0)
							{{round((($userstats->towers/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 12)
						{{number_format($userstats->doublekills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->doublekills!=0)
							{{round((($userstats->doublekills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 13)
						{{number_format($userstats->tripplekills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->tripplekills!=0)
							{{round((($userstats->tripplekills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 14)
						{{number_format($userstats->quadrakills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->quadrakills!=0)
							{{round((($userstats->quadrakills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 15)
						{{number_format($userstats->pentakills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->pentakills!=0)
							{{round((($userstats->pentakills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 16)
						{{number_format($userstats->dragons,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->dragons!=0)
							{{round((($userstats->dragons/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 17)
						{{number_format($userstats->barons,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->barons!=0)
							{{round((($userstats->barons/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @endif
				</div>
			</td>
			<td valign="top" width="150" style="text-align: center;">
			<br/>
				@if(0 == 1)
					<br/>
					Already claimed
				@else
					20 Gold + 200 EXP<br/>
					@if(1==2)
						<form id="frm" method="post" action="/quests/dailyprogress/wins">
							<input class="inactive_at_click btn btn-success" type="submit" value="{{ trans('dashboard.claim_reward') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</form>
					@else
						<a href="#" class="btn btn-primary not_finished_daily">Claim reward</a>
					@endif
				@endif
			</td>
		</tr>
	@endforeach
	</table>
  			<!-- END CURRENT CHALLENGES-->
  		</div>
  		<div role="tabpanel" class="tab-pane fade" id="stats">
			<!-- STATS CHALLENGES-->
  			<table width="100%" class="table table-striped daily_quests_table">
	@foreach($statchallenges as $challenge)
		<tr>
			<td valign="top" width="100"><img width="75" src="/img/leagues/{{$challenge->icon}}"><br/><br/></td>
			<td valign="top">
				<strong>{{$challenge->name}}</strong><br/>
				<div class="daily_description">{{$challenge->description}}</div>
				<div class="progress">
				  <div class="overlay_progress uppercase small" style="text-align: center;">
				  @if($challenge->type == 1)
						{{number_format($userstats->ingamegold,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->ingamegold!=0)
							{{round((($userstats->ingamegold/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 2)
						{{number_format($userstats->dmg,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->dmg!=0)
							{{round((($userstats->dmg/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 3)
						{{number_format($userstats->heal,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->heal!=0)
							{{round((($userstats->heal/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 4)
						{{number_format($userstats->kills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->kills!=0)
							{{round((($userstats->kills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 5)
						{{number_format($userstats->assists,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->assists!=0)
							{{round((($userstats->assists/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 6)
						{{number_format($userstats->wins,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->wins!=0)
							{{round((($userstats->wins/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 7)
						{{number_format($userstats->games,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->games!=0)
							{{round((($userstats->games/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 8)
						{{number_format($userstats->dmgtaken,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->dmgtaken!=0)
							{{round((($userstats->dmgtaken/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 9)
						{{number_format($userstats->wards,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->wards!=0)
							{{round((($userstats->wards/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 10)
						{{number_format($userstats->wardkills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->wardkills!=0)
							{{round((($userstats->wardkills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 11)
						{{number_format($userstats->towers,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->towers!=0)
							{{round((($userstats->towers/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 12)
						{{number_format($userstats->doublekills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->doublekills!=0)
							{{round((($userstats->doublekills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 13)
						{{number_format($userstats->tripplekills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->tripplekills!=0)
							{{round((($userstats->tripplekills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 14)
						{{number_format($userstats->quadrakills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->quadrakills!=0)
							{{round((($userstats->quadrakills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 15)
						{{number_format($userstats->pentakills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->pentakills!=0)
							{{round((($userstats->pentakills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 16)
						{{number_format($userstats->dragons,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->dragons!=0)
							{{round((($userstats->dragons/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 17)
						{{number_format($userstats->barons,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->barons!=0)
							{{round((($userstats->barons/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @endif
				</div>
			</td>
			<td valign="top" width="150" style="text-align: center;">
			<br/>
				@if(0 == 1)
					<br/>
					Already claimed
				@else
					20 Gold + 200 EXP<br/>
					@if(1==2)
						<form id="frm" method="post" action="/quests/dailyprogress/wins">
							<input class="inactive_at_click btn btn-success" type="submit" value="{{ trans('dashboard.claim_reward') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</form>
					@else
						<a href="#" class="btn btn-primary not_finished_daily">Claim reward</a>
					@endif
				@endif
			</td>
		</tr>
	@endforeach
	</table>
  			<!-- END STATS CHALLENGES--></div>
  		<div role="tabpanel" class="tab-pane fade" id="objectives">
			<!-- Objekts CHALLENGES-->
  			<table width="100%" class="table table-striped daily_quests_table">
	@foreach($objectivechallenges as $challenge)
		<tr>
			<td valign="top" width="100"><img width="75" src="/img/leagues/{{$challenge->icon}}"><br/><br/></td>
			<td valign="top">
				<strong>{{$challenge->name}}</strong><br/>
				<div class="daily_description">{{$challenge->description}}</div>
				<div class="progress">
				  <div class="overlay_progress uppercase small" style="text-align: center;">
				  @if($challenge->type == 1)
						{{number_format($userstats->ingamegold,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->ingamegold!=0)
							{{round((($userstats->ingamegold/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 2)
						{{number_format($userstats->dmg,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->dmg!=0)
							{{round((($userstats->dmg/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 3)
						{{number_format($userstats->heal,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->heal!=0)
							{{round((($userstats->heal/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 4)
						{{number_format($userstats->kills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->kills!=0)
							{{round((($userstats->kills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 5)
						{{number_format($userstats->assists,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->assists!=0)
							{{round((($userstats->assists/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 6)
						{{number_format($userstats->wins,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->wins!=0)
							{{round((($userstats->wins/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 7)
						{{number_format($userstats->games,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->games!=0)
							{{round((($userstats->games/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 8)
						{{number_format($userstats->dmgtaken,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->dmgtaken!=0)
							{{round((($userstats->dmgtaken/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 9)
						{{number_format($userstats->wards,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->wards!=0)
							{{round((($userstats->wards/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 10)
						{{number_format($userstats->wardkills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->wardkills!=0)
							{{round((($userstats->wardkills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 11)
						{{number_format($userstats->towers,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->towers!=0)
							{{round((($userstats->towers/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 12)
						{{number_format($userstats->doublekills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->doublekills!=0)
							{{round((($userstats->doublekills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 13)
						{{number_format($userstats->tripplekills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->tripplekills!=0)
							{{round((($userstats->tripplekills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 14)
						{{number_format($userstats->quadrakills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->quadrakills!=0)
							{{round((($userstats->quadrakills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 15)
						{{number_format($userstats->pentakills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->pentakills!=0)
							{{round((($userstats->pentakills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 16)
						{{number_format($userstats->dragons,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->dragons!=0)
							{{round((($userstats->dragons/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 17)
						{{number_format($userstats->barons,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->barons!=0)
							{{round((($userstats->barons/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @endif
				</div>
			</td>
			<td valign="top" width="150" style="text-align: center;">
			<br/>
				@if(0 == 1)
					<br/>
					Already claimed
				@else
					20 Gold + 200 EXP<br/>
					@if(1==2)
						<form id="frm" method="post" action="/quests/dailyprogress/wins">
							<input class="inactive_at_click btn btn-success" type="submit" value="{{ trans('dashboard.claim_reward') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</form>
					@else
						<a href="#" class="btn btn-primary not_finished_daily">Claim reward</a>
					@endif
				@endif
			</td>
		</tr>
	@endforeach
	</table>
  			<!-- END Objekts CHALLENGES--></div>
  		<div role="tabpanel" class="tab-pane fade" id="others"><!-- OTHER CHALLENGES-->
  			<table width="100%" class="table table-striped daily_quests_table">
	@foreach($otherchallenges as $challenge)
		<tr>
			<td valign="top" width="100"><img width="75" src="/img/leagues/{{$challenge->icon}}"><br/><br/></td>
			<td valign="top">
				<strong>{{$challenge->name}}</strong><br/>
				<div class="daily_description">{{$challenge->description}}</div>
				<div class="progress">
				  <div class="overlay_progress uppercase small" style="text-align: center;">
				  @if($challenge->type == 1)
						{{number_format($userstats->ingamegold,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->ingamegold!=0)
							{{round((($userstats->ingamegold/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 2)
						{{number_format($userstats->dmg,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->dmg!=0)
							{{round((($userstats->dmg/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 3)
						{{number_format($userstats->heal,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->heal!=0)
							{{round((($userstats->heal/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 4)
						{{number_format($userstats->kills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->kills!=0)
							{{round((($userstats->kills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 5)
						{{number_format($userstats->assists,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->assists!=0)
							{{round((($userstats->assists/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 6)
						{{number_format($userstats->wins,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->wins!=0)
							{{round((($userstats->wins/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 7)
						{{number_format($userstats->games,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->games!=0)
							{{round((($userstats->games/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 8)
						{{number_format($userstats->dmgtaken,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->dmgtaken!=0)
							{{round((($userstats->dmgtaken/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 9)
						{{number_format($userstats->wards,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->wards!=0)
							{{round((($userstats->wards/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 10)
						{{number_format($userstats->wardkills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->wardkills!=0)
							{{round((($userstats->wardkills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 11)
						{{number_format($userstats->towers,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->towers!=0)
							{{round((($userstats->towers/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 12)
						{{number_format($userstats->doublekills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->doublekills!=0)
							{{round((($userstats->doublekills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 13)
						{{number_format($userstats->tripplekills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->tripplekills!=0)
							{{round((($userstats->tripplekills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 14)
						{{number_format($userstats->quadrakills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->quadrakills!=0)
							{{round((($userstats->quadrakills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 15)
						{{number_format($userstats->pentakills,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->pentakills!=0)
							{{round((($userstats->pentakills/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 16)
						{{number_format($userstats->dragons,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->dragons!=0)
							{{round((($userstats->dragons/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @elseif($challenge->type == 17)
						{{number_format($userstats->barons,0,'','.') }} / {{number_format($challenge->value,0,'','.')}}</div>
						<div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 
						@if($userstats->barons!=0)
							{{round((($userstats->barons/$challenge->value)*100),2)}}%
						@else 
							0%
						@endif ;"></div>
				  @endif
				</div>
			</td>
			<td valign="top" width="150" style="text-align: center;">
			<br/>
				@if(0 == 1)
					<br/>
					Already claimed
				@else
					20 Gold + 200 EXP<br/>
					@if(1==2)
						<form id="frm" method="post" action="/quests/dailyprogress/wins">
							<input class="inactive_at_click btn btn-success" type="submit" value="{{ trans('dashboard.claim_reward') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</form>
					@else
						<a href="#" class="btn btn-primary not_finished_daily">Claim reward</a>
					@endif
				@endif
			</td>
		</tr>
	@endforeach
	</table>
  			<!-- END OTHER CHALLENGES--></div>
	</div>


	
	
	</div>
	<br/><br/>
@stop
@extends('templates.default')
@section('title', trans("users.profile")." ".$team->name)
@section('content')	
	<br/>
	@if($team->members->count() < 3)
	<div class="bs-callout bs-callout-danger" style="margin-top: 0;">
		{{ trans("teams.min_member") }}
	</div>
	@endif
	<table width="100%" class="profile">
		<tr>
			<td valign="top" width="130" style="text-align: center; padding-right: 15px;">
				<img src="/img/teams/logo/{{ $team->logo }}" width="100" class="img-circle" /><br/>
				<br/>
				@if(Auth::check())
					@if($team->public == 1)
                        <a href="/teams/join_request" class="btn btn-primary">{{ trans("teams.join") }}</a><br/>
					@endif
				@endif
				<br/>
				@if(Auth::check())
					@if($team->user_id == Auth::user()->id)
                        <a href="/teams/edit" class="btn btn-primary">{{ trans("teams.edit") }}</a><br/><br/>
						<a href="/teams/delete_team" class="delete_team btn btn-danger">{{ trans("teams.delete") }}</a>
					@endif
				@endif
				@if(Auth::check())
					@if(Auth::user()->team_id == $team->id && Auth::user()->id != $team->user_id)
						<a href="/leave_team" class="btn btn-danger">{{ trans("teams.leave") }}</a>
					@endif
				@endif
			</td>
			<td width="400" valign="top">
				<table class="table table-striped" stlye="width: 100%;">
					<tr>
						<td width="130" class="attribute">{{ trans("teams.team_name") }} </td>
						<td>{{ $team->name }}</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("users.region") }}</td>
						<td>{{ $team->region }}</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("teams.website") }}</td>
						<td><a href="{{ $team->website }}" target="blank">{{ $team->website }}</a></td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("teams.since") }}</td>
						<td>
							{{ date("d.m.Y",strtotime($team->created_at)) }}
						</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("teams.captain") }}</td>
						<td><a href="/summoner/{{ $team->user->region }}/{{ $team->user->summoner_name }}">{{ $team->user->summoner->name }}</a></td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("teams.quests") }}</td>
						<td>{{ $team->quests }}</td>
					</tr>
				</table>
			</td>
            <td valign="top">
                <div class="profile_season_stats">
                    <table class="table table-striped" style="margin-bottom: 0;">
                        @if($team->rank > 0)
                        <tr>
                            <td colspan="2"><strong>{{ trans("teams.ranked_stats") }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">
                                @if($team->rang <= 3)
                                <img src="/img/leagues/challenger_5.png" height="55" />
                                @elseif($team->rank <= 10)
                                <img src="/img/leagues/diamond_5.png" height="55" />
                                @elseif($team->rank <= 25)
                                <img src="/img/leagues/platinum_5.png" height="55" />
                                @elseif($team->rank <= 50)
                                <img src="/img/leagues/gold_5.png" height="55" />
                                @elseif($team->rank <= 100)
                                <img src="/img/leagues/silver_5.png" height="55" />
                                @elseif($team->rank >= 101)
                                <img src="/img/leagues/bronze_5.png" height="55" />
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Current Rang</td>
                            <td>{{ $team->rank }}</td>
                        </tr>
                        <tr>
                            <td>Quest</td>
                            <td>{{ $team->quests }}</td>
                        </tr>
                        <tr>
                            <td>Average EXP / Summoner</td>
                            <td>{{ $team->average_exp }}</td>
                        </tr>
                        <tr>
                            <td>Total EXP</td>
                            <td>{{ $team->exp }}</td>
                        </tr>
                    </table>
                    @else
                    <tr>
                        <td colspan="2"><strong>{{ trans("teams.ranked_stats") }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <img src="/img/leagues/0_5.png" height="55" />
                        </td>
                    </tr>
                    </table>
                <div style="text-align: center; font-style: italic;">
                    <br/>
                    {{ trans("teams.not_ranked") }}
                </div>
                @endif


                </div>
                </td>
		</tr>
	</table>
	<h3>{{ trans("teams.description") }}</h3>
    <div class="team_description">
        {{ $team->description }}
    </div>
    <br/><br/>
	<table width="100%">
		<tr>
			<td width="50%" valign="top">
				<h3>{{ trans("teams.member") }} ({{$team->members->count()}})</h3>
				<table class="table table-striped">
					<tr>
						<td width="20"><a href="/summoner/{{ $team->user->region }}/{{ $team->user->summoner_name }}"><img src="/img/profileicons/profileIcon{{ $team->user->summoner->profileIconId }}.jpg" class="img-circle" width="20" /></a></td>
						<td><a href="/summoner/{{$team->user->region }}/{{ $team->user->summoner_name }}">{{ $team->user->summoner->name }}</a> <i>({{ trans("teams.captain") }})</i></td>
					</tr>
				@foreach($team->members as $member)
					@if($member->id != $team->user->id)
					<tr>
						<td width="20"><a href="/summoner/{{ $member->region }}/{{ $member->summoner_name }}"><img src="/img/profileicons/profileIcon{{ $member->summoner->profileIconId }}.jpg" class="img-circle" width="20" /></a></td>
						<td><a href="/summoner/{{ $member->region }}/{{ $member->summoner_name }}">{{ $member->summoner->name }}</a>
						@if(Auth::check())
							@if(Auth::user()->id == $team->user_id)
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="red remove_member" href="/teams/{{ $team->region }}/{{ $team->clean_name }}/remove/{{ $member->id }}"><i class="fa fa-ban"></i> Remove member</a>
							@endif
						@endif
						</td>
					</tr>
					@endif
				@endforeach
				</table>
                @if(Auth::check())
				@if($team->user_id == Auth::user()->id)
				<a href="/teams/{{ $team->region }}/{{ $team->clean_name }}/invite" class="btn btn-primary">{{ trans("teams.invite_new") }}</a>
				@endif
                @endif
			</td>
			<td valign="top">
				<h3>{{ trans("teams.challenges") }}</h3>
                <i>- comming soon -</i>
			</td>
		</tr>
	</table>
	@if(Auth::check())
		<br/>
		<h3>{{ trans("teams.achievements") }}</h3>
		<table class="table table-striped">
			@foreach($achievements as $achievement)
			<tr>
				<td width="50">
				@if($team->assists >= $achievement->factor)
					<img src="/img/leagues/challenger_5.png" style="margin-top: 10px;" width="50" />
				@else
					<img src="/img/leagues/grey_challenger.png" style="margin-top: 10px;" width="50" />
				@endif
				</td>
				<td width="50%">
					<h4>{{ $achievement->name }}</h4>
					<i>If you finish a quest, your Assists will be added to this achievement.</i><br/>
				</td>
				<td>
					<br/>
					<div class="progress">
					@if($team->assists >= $achievement->factor)
					  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
						earned
					  </div>
					@else
					  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($team->assists/$achievement->factor)*100 }}%;">
						{{ $team->assists }} / {{ $achievement->factor }}
					  </div>
					@endif
					</div>
				</td>
			</tr>
			@endforeach
		</table>
	@endif
@stop
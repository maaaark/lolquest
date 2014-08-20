@extends('templates.default')
@section('title', 'Search Result')
@section('content')
<?php // var_dump($users, $teams); ?>
	<br/>
	<table class="table table-striped">
	<tr>
                <th colspan="2">{{ trans("users.summoner_name") }}</th>
		<th>{{ trans("users.region") }}</th>
		<th>{{ trans("users.level_profile") }}</th>
                <th>{{ trans("search.current_rang") }}<br /><small>{{ trans("search.this_month") }}</small></th>
		<th>{{ trans("search.quests") }}<br /><small>{{ trans("search.this_month") }}</small></th>
		<th>{{ trans("search.total_exp") }}<br /><small>{{ trans("search.this_month") }}</small></th>
		<th>{{ trans("search.team") }}</th>
	</tr>
        
        @if (count($users) >= 1)
            @foreach($users as $user)
                <tr>
					@if($user->summoner)
                    <td style="width: 30px;"><img src="/img/profileicons/profileIcon{{ $user->summoner->profileIconId }}.jpg" width="30" class="img-circle" /></td>
					<td><a href="/summoner/{{ $user->region }}/{{ $user->summoner_name }}">{{ $user->summoner->name }}</a></td>
					@else
					<td style="width: 30px;">-</td>
					<td><a href="/summoner/{{ $user->region }}/{{ $user->summoner_name }}">{{ $user->summoner_name }}</a></td>
					@endif
                    
			<td>{{ $user->region }}</td>
			<td>{{ $user->level_id }}</td>
                        @if($user->ladder_rang($user->id))
			<td>{{ $user->ladder_rang($user->id)->rang }}</td>
			<td>{{ $user->ladder_rang($user->id)->total_quests }}</td>
			<td>{{ $user->ladder_rang($user->id)->month_exp }}</td>
                        @else
                        <td> - </td>
                        <td> - </td>
                        <td> - </td>
                        @endif
                        @if($user->team)
                            <td>{{ $user->team->name }}</td>
                        @else
                            <td>-</td>
                        @endif
                        
		</tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" style="text-align: center;"> {{ trans("search.no_result") }} </td>
            </tr>
        @endif
        
        
	
	</table>
        
        <br/>
	<table class="table table-striped">
	<tr>
                <th colspan="2">{{ trans("search.teamname") }}</th>
                <th>{{ trans("search.teamregion") }}</th>
		<th>{{ trans("search.teamlevel") }}</th>
		<th>{{ trans("search.teamexp") }}</th>
		
                <th>{{ trans("search.teamrank") }}</th>
                <th>{{ trans("search.teamavgexp") }}</th>
                <th>{{ trans("search.teamquests") }}</th>
	</tr>
        
        @if (count($teams) >= 1)
            @foreach($teams as $team)
                <tr>
                        @if($team->logo)
                        <td style="width: 30px;"><img src="/img/teams/logo/{{ $team->logo }}" width="30" class="img-circle" /></td>
                        <td><a href="/teams/{{ $team->region }}/{{ $team->name }}">{{ $team->name }}</a></td>
                        @else
                        <td style="width: 30px;"><img src="/img/teams/logo/default.jpg" width="30" class="img-circle" /></td>
                        <td><a href="/teams/{{ $team->region }}/{{ $team->name }}">{{ $team->name }}</a></td>
                        @endif
                        <td>{{ $team->region }}</td>
                        <td>{{ $team->exp }}</td>
                        <td>{{ $team->team_level_id }}</td>
			
			
                        @if($team->rank)
			<td>{{ $team->rank }}</td>
                        @else
                        <td> - </td>
                        @endif
                        <td>{{ $team->average_exp }}</td>
                        <td>{{ $team->quests }}</td>
		</tr>
            @endforeach
        @else
            <tr>
                <td colspan="8" style="text-align: center;"> {{ trans("search.no_result") }} </td>
            </tr>
        @endif
        
        
	
	</table>
@stop
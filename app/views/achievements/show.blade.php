@extends('templates.default')
@section('title', 'Achievements of '.$user->summoner->name)
@section('content')
	<br/>
	<a href="/summoner/{{ $user->region }}/{{ $user->summoner_name }}">Back to the Profile of {{ $user->summoner->name }}</a><br/>
	<br/>
	<table style="float:left" class="table_ach table-striped">
		<tbody>
				<tr>
					<th colspan="2">All Achievements</th>
				</tr>
			@foreach($achievements as $achievement)

				@if($user->hasAchievement($achievement->id))
					<?php $style = 1.0; ?>
				@else
					<?php $style = 0.5; ?>
				@endif

				<tr width="25%" height="45px" style="opacity: {{ $style }}; -moz-opacity: {{ $style }}; -khtml-opacity: {{ $style }};">			
					<td width="55px"><a href="/achievements/{{ $achievement->id }}"><img src="/img/trophy/{{$achievement->icon}}.png" title="{{ $achievement->name }}" class="trophy"  /></a></td>
					<td width="">
						@if($achievement->description == 1)
							<strong>{{$achievement->name}}</strong></br>
							<a href="/achievements/{{ $achievement->id }}">{{ trans("achievements.".$achievement->description) }} {{ $achievement->factor}}</a>
						@elseif($achievement->description == 2)
							<strong>{{$achievement->name}}</strong></br>
							<a href="/achievements/{{ $achievement->id }}">{{ trans("achievements.".$achievement->description) }} {{ $achievement->factor}} Quests</a>
						@elseif($achievement->description == 3)
							<strong>{{$achievement->name}}</strong></br>
							<a href="/achievements/{{ $achievement->id }}">{{ trans("achievements.".$achievement->description) }} {{ $achievement->factor}} 
							@if($achievement->factor==1)
								friend
							@else
								friends
								@endif</a>
						@else
							<a href="/achievements/{{ $achievement->id }}">{{ $achievement->name }}</a>
						@endif
					</td>		
			</tr>		
				@if($achievement->id == $achievements->count() /2)
			</tbody>
	 </table>				
					
	<table style="float:left" class="table_ach table-striped">
		<tbody>
				<tr>
					<th colspan="2">All Achievements</th>
				</tr>
				@endif
					
			@endforeach
		</tbody>
	 </table>
	 
@stop
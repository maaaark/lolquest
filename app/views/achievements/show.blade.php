@extends('templates.default')
@section('title', 'Achievements of '.$user->summoner->name)
@section('content')
	<br/>
	<a href="/summoner/{{ $user->region }}/{{ $user->summoner_name }}">Back to the Profile of {{ $user->summoner->name }}</a><br/>
	<br/>
	<table style="float:left" class="table_ach table-striped">
		<tbody>
				<tr>
					<th colspan="3">All Achievements</th>
				</tr>
			@foreach($achievements as $achievement)

				@if($user->hasAchievement($achievement->id))
					<?php $style = 1.0; ?>
				@else
					<?php $style = 0.5; ?>
				@endif

				<tr width="25%" height="45px" style="opacity:{{ $style }}; -moz-opacity: {{ $style }}; -khtml-opacity: {{ $style }};">			
					<td width="55px"><img src="/img/trophy/{{$achievement->icon}}.png" title="{{ $achievement->name }}" class="trophy"  /></td>
					<td  width="55px"><img src="/img/ap.png" width="20"/> {{ $achievement->points }}</td>
					<td width="">
						<strong>{{$achievement->name}}</strong></br>
						@if($achievement->description == 1)
							<a href="/summoner/{{ $user->region }}/{{ $user->summoner_name }}">{{ trans("achievements.".$achievement->description) }} {{ $achievement->factor}}</a>
						@elseif($achievement->description == 2)
							<a href="/summoner/{{ $user->region }}/{{ $user->summoner_name }}">{{ trans("achievements.".$achievement->description) }} {{ $achievement->factor}} Quests</a>
						@elseif($achievement->description == 3)
							<a href="/summoner/{{ $user->region }}/{{ $user->summoner_name }}">{{ trans("achievements.".$achievement->description) }} {{ $achievement->factor}} 
							@if($achievement->factor==1)
								friend
							@else
								friends
								@endif</a>
						@elseif($achievement->description == 'Ctop' or $achievement->description == 'Cmid' or $achievement->description == 'Csup' or $achievement->description == 'Cadc' or $achievement->description == 'Cjug'or $achievement->description == 'Call' or $achievement->description == 8)
							<a href="/summoner/{{ $user->region }}/{{ $user->summoner_name }}">{{ trans("achievements.".$achievement->description) }}</a>
						@elseif($achievement->description == 5)
								<a href="/summoner/{{ $user->region }}/{{ $user->summoner_name }}">{{ trans("achievements.".$achievement->description.$achievement->factor) }}</a>
						@elseif($achievement->description == 6)
							<a href="/summoner/{{ $user->region }}/{{ $user->summoner_name }}">{{ trans("achievements.".$achievement->description) }} {{ $achievement->factor}} QP</a>
						@elseif($achievement->description == 7)
							<a href="/summoner/{{ $user->region }}/{{ $user->summoner_name }}">{{ $achievement->factor}}{{ trans("achievements.".$achievement->description) }}</a>
						@else
							<a href="/summoner/{{ $user->region }}/{{ $user->summoner_name }}">{{ $achievement->name }}</a>
						@endif
						</br> @if($achievement->title)Title: {{$achievement->title->title}} @endif 
					</td>		
					
			</tr>		
				@if($achievement->id == $achievements->count() /2)
			</tbody>
	 </table>				
					
	<table style="float:left" class="table_ach table-striped">
		<tbody>
				<tr>
					<th colspan="3">&nbsp;</th>
				</tr>
				@endif
					
			@endforeach
		</tbody>
	 </table>
	 
@stop
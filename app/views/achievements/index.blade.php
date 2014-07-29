@extends('templates.default')
@section('title', 'Achievements')
@section('content')
	<br/>
	<table style="float:left" class="table_ach table-striped">
		<tbody>
				<tr>
					<th colspan="2">All Achievements</th>
				</tr>
			@foreach($achievements as $achievement)		
				<tr width="25%" height="45px">			
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
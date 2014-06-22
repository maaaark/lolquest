@extends('templates.default')
@section('title', 'Achievements')
@section('content')
	<br/>
	<table class="table table-striped">
		<tbody>
				<tr>
					<th colspan="3">All Achievements</th>
				</tr>
			@foreach($achievements as $achievement)
				<tr>
					<td width="50"><a href="/achievements/{{ $achievement->id }}"><img src="/img/trophy/{{$achievement->icon}}.png" title="{{ $achievement->name }}" class="trophy"  /></a></td>
					<td>
						@if($achievement->description == 1)
							<a href="/achievements/{{ $achievement->id }}">{{ trans("achievements.".$achievement->description) }} {{ $achievement->factor}}</a>
						@elseif($achievement->description == 2)
							<a href="/achievements/{{ $achievement->id }}">{{ trans("achievements.".$achievement->description) }} {{ $achievement->factor}} Quests</a>
						@elseif($achievement->description == 3)
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
			@endforeach
		</tbody>
	 </table>
@stop
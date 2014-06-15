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
						<a href="/achievements/{{ $achievement->id }}">{{ $achievement->name }}<br/>
						<small>{{ $achievement->description }}</small></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	 </table>
@stop
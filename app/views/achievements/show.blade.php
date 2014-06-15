@extends('templates.default')
@section('title', 'Achievements')
@section('content')
	<br/>
	<table class="table table-striped">
		<tbody>
				<tr>
					<th colspan="3">All Achievements</th>
				</tr>
				<tr>
					<td width="50"><img src="/img/trophy/{{$achievement->icon}}.png" title="{{ $achievement->name }}" class="trophy"  /></td>
					<td>
						{{ $achievement->name }}<br/>
						<small>{{ $achievement->description }}</small>
					</td>
				</tr>
		</tbody>
	 </table>
@stop
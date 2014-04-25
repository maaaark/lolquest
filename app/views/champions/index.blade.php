@extends('templates.default')
@section('title', trans("champions.index"))
@section('content')
	<table class="table table-striped">
		<thead>
			<tr>
				<th class="text-left">{{ trans("champions.avatar") }}</th>
				<th class="text-left">ID</th>
				<th class="text-left">Champion_ID</th>
				<th class="text-left">{{ trans("champions.name") }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach($champions as $champion)
				<tr>
					<td class="text-left"><img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="/img/champions/{{ $champion->champion_id }}_92.png" width="40"></td>
					<td class="text-left"><a href="/champions/{{ $champion->id }}">{{ $champion->id }}</a></td>
					<td class="text-left"><a href="/champions/{{ $champion->id }}">{{ $champion->champion_id }}</a></td>
					<td><a href="/champions/{{ $champion->id }}">{{ $champion->name }}</a></td>
				</tr>
			@endforeach
		</tbody>
	 </table>
@stop
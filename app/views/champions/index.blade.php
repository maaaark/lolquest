@extends('templates.default')
@section('title', trans("champions.index"))
@section('content')
	<table class="table table-striped">
		<tbody>
			@foreach($champions as $champion)
				<tr>
					<td class="text-left" style="width: 40px !important;"><a href="/champions/{{ Str::lower($champion->key) }}"><img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="/img/champions/{{ $champion->champion_id }}_92.png" width="40"></a></td>
					<td style="width: 200px;"><strong><a href="/champions/{{ Str::lower($champion->key) }}">{{ $champion->name }}</a></strong><br/><i>{{ $champion->title }}</i></td>
					<td><a href="/champions/{{ Str::lower($champion->key) }}" style="margin-top: 10px;">{{ $champion->quests->count() }} Quests</a></td>
					<td class="text-left"><a href="/champions/{{ $champion->id }}">{{ $champion->champion_id }}</a></td>
				</tr>
			@endforeach
		</tbody>
	 </table>
@stop
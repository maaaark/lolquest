@extends('templates.default')
@section('title', trans("champions.index"))
@section('content')
	<br/>
	<table class="table table-striped">
		<tbody>
			<tr>
				<th colspan="2" style="width: 200px;">Champion</th>
				<th>Amount Quests</th>
				<th>Pickrate</th>
				<th>Winrate</th>
			</tr>
			@foreach($champions as $champion)
				<tr>
					<td class="text-left" style="width: 40px !important;"><a href="/champions/{{ Str::lower($champion->key) }}"><img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="/img/champions/{{ $champion->champion_id }}_92.png" width="40"></a></td>
					<td style="width: 200px;"><strong><a href="/champions/{{ Str::lower($champion->key) }}">{{ $champion->name }}</a></strong><br/><i>{{ $champion->title }}</i></td>
					<td><a href="/champions/{{ Str::lower($champion->key) }}" style="margin-top: 10px;">{{ $champion->quests->count() }} Quests</a></td>
					<td>{{ $champion->pickrate($games_amount) }}%</td>
					<td>{{ $champion->winrate() }}%</td>
				</tr>
			@endforeach
		</tbody>
	 </table>
	 <?php echo $champions->links(); ?>
@stop
@extends('templates.default')
@section('title', trans("timeline.index"))
@section('content')
	<br/>
	<table class="table table-striped transactions">
		@foreach($timelines as $post)
			<tr>
				<td><strong>{{ $post->user->summoner_name }}</strong></td>
				<td>{{ $post->quest->questtype->name }}</td>
				<td>{{ date("d.m.Y - H:i:s",strtotime($post->created_at)) }}</td>
			</tr>
		@endforeach	
	</table>
@stop
@extends('templates.default')
@section('title', trans("forum.forum"))
@section('content')
<br/>
	<a href="/forum">Forum</a> > <a href="/forum/{{ $category->url_name }}">{{ $category->name }}</a><br/>
	<br/>
	<div class="forum_category">
		<div class="forum_headline">{{ $category->name }}</div>
		@if($topics->count() > 0)
		<table class="table table-striped" style="margin-bottom: 0;">
			@foreach($topics as $topic)
			<tr>
				<td><a href="/forum/{{ $category->url_name }}/{{ $topic->url_name }}">{{ $topic->topic }}</a></td>
				<td>
					by <strong>{{ $topic->user->summoner_name }}</strong><br/>
					{{ $topic->replies->count() }} Replies
				</td>
			</tr>
			@endforeach
		</table>
		@else
			No Topics yet. Go ahead and create one!
		@endif
	</div>
@stop
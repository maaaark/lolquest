@extends('templates.default')
@section('title', trans("forum.forum"))
@section('content')
<br/>
	<a href="/forum">{{ trans("forum.forum") }}</a> > <a href="/forum/{{ $category->url_name }}">{{ $category->name }}</a><br/>
	<br/>
	<div class="forum_category">
		<div class="forum_headline">{{ $category->name }}</div>
		@if($topics->count() > 0)
		<table class="table table-striped" style="margin-bottom: 0;">
			@foreach($topics as $topic)
			<tr>
				<td valign="center"><a href="/forum/{{ $category->url_name }}/{{ $topic->url_name }}">{{ $topic->topic }}</a></td>
				<td>
					{{ trans("forum.by") }} <strong>{{ $topic->user->summoner_name }}</strong><br/>
					{{ $topic->replies->count() }} {{ trans("forum.replies") }}
				</td>
			</tr>
			@endforeach
		</table>
		@else
			<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ trans("forum.no_topics") }}<br/>
			<br/>
		@endif
	</div>
	<table width="100%" style="margin-top: -20px;">
		<tr>
			<td width="50%" align="left">
				{{ $topics->links(); }}
			</td>
			<td width="50%" align="right">
				<a href="/forum/{{ $category->url_name }}/create_topic/new" class="btn btn-primary right">{{ trans("forum.create_topic") }}</a>
			</td>
		</tr>
	</table>
@stop
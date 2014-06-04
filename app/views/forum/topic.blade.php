@extends('templates.default')
@section('title', trans("forum.forum"))
@section('content')
<br/>
	<a href="/forum">Forum</a> > <a href="/forum/{{ $category->url_name }}">{{ $category->name }}</a> > <a href="/forum/{{ $category->url_name }}/{{ $topic->topic }}">{{ $topic->topic }}</a><br/>
	<br/>
	<div class="forum_category">
		<div class="forum_headline">{{ $topic->topic }}</div>
		<table class="table table-striped" style="margin-bottom: 0;">
			@foreach($replies as $reply)
			<tr>
				<td width="100" style="text-align: center;" valign="top">
					<a href="/summoner/{{ $reply->user->region }}/{{ $reply->user->summoner_name }}"><img src="/img/profileicons/profileIcon{{ $reply->user->summoner->profileIconId }}.jpg" class="img-circle" width="50" /></a>
					<br/>
					<strong>{{ $reply->user->summoner_name }}</strong><br/>
					Level {{ $reply->user->level_id }}<br/>
					{{ $reply->user->replies->count() }} Posts
				</td>
				<td valign="top">
					<div class="small">{{ $reply->created_at }}</div><br/>
					{{ $reply->content }}
				</td>
			</tr>
			@endforeach
		</table>
	</div>
@stop
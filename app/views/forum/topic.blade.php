@extends('templates.default')
@section('title', trans("forum.forum"))
@section('content')
<br/>
	<a href="/forum">{{ trans("forum.forum") }}</a> > <a href="/forum/{{ $category->url_name }}">{{ $category->name }}</a> > <a href="/forum/{{ $category->url_name }}/{{ $topic->topic }}">{{ $topic->topic }}</a><br/>
	<br/>
	<div class="forum_category">
		<div class="forum_headline">{{ $topic->topic }}</div>
		<table class="table table-striped" style="margin-bottom: 0;">
			<tr>
				<td width="100" style="text-align: center;" valign="top">
					<a href="/summoner/{{ $topic->user->region }}/{{ $topic->user->summoner_name }}"><img src="/img/profileicons/profileIcon{{ $topic->user->summoner->profileIconId }}.jpg" class="img-circle" width="50" /></a>
					<br/>
					<strong>{{ $topic->user->summoner_name }}</strong><br/>
					{{ trans("forum.level") }} {{ $topic->user->level_id }}<br/>
					{{ $topic->user->replies->count() }} {{ trans("forum.posts") }}
				</td>
				<td valign="top">
					<div class="small">{{ $topic->created_at->diffForHumans() }}</div><br/>
					{{ $topic->content }}
				</td>
			</tr>
			@foreach($replies as $reply)
			<tr>
				<td width="100" style="text-align: center;" valign="top">
					<a href="/summoner/{{ $reply->user->region }}/{{ $reply->user->summoner_name }}"><img src="/img/profileicons/profileIcon{{ $reply->user->summoner->profileIconId }}.jpg" class="img-circle" width="50" /></a>
					<br/>
					<strong>{{ $reply->user->summoner_name }}</strong><br/>
					{{ trans("forum.level") }} {{ $reply->user->level_id }}<br/>
					{{ $reply->user->replies->count() }} {{ trans("forum.posts") }}
				</td>
				<td valign="top">
					<div class="small">{{ $reply->created_at->diffForHumans() }}</div><br/>
					{{ $reply->content }}
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	<table width="100%" style="margin-top: -20px;">
		<tr>
			<td width="50%" align="left">
				{{ $replies->links(); }}
			</td>
			<td width="50%" align="right">
				@if(Auth::check())
					<a href="/forum/{{ $category->url_name }}/{{ $topic->topic }}/reply" class="btn btn-primary right">{{ trans("forum.reply") }}</a>
				@else
					<a href="/login" class="btn btn-primary right">{{ trans("sidebar.register_to_do") }}</a>
				@endif
			</td>
		</tr>
	</table>

	<br/>
	<br/>
@stop
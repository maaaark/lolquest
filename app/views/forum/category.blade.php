@extends('templates.default')
@section('title', trans("forum.forum"))
@section('content')
<br/>
	<a href="/forum">{{ trans("forum.forum") }}</a> > <a href="/forum/{{ $category->id }}/{{ $category->url_name }}">{{ $category->name }}</a><br/>
	<br/>
	<div class="forum_category">
		<div class="forum_headline">{{ $category->name }}</div>
		@if($topics->count() > 0)
		<table class="table table-striped" style="margin-bottom: 0;">
			@foreach($topics as $topic)
			@if($topic->deleted === "0")
			<tr>
				<td width="50" style="position: relative;">
						@if(array_key_exists($topic->id,$last_reads) && $last_reads[$topic->id]>= $topic->updated_at)
						 <img src="/img/forum/folder.png" height="35" style="opacity: 0.3" />
							@if($topic->status === "1")
						 <img src="/img/forum/lock.png" class="lock" height="35" />
							@endif
						@else
						 <img src="/img/forum/folder.png" height="35" />
							@if($topic->status === "1")
						 <img src="/img/forum/lock.png" class="lock" height="35" />
							@endif
						@endif
				</td>
				<td valign="center">
					<a href="/forum/{{ $category->id }}/{{ $topic->id }}/{{ $topic->url_name }}">{{ $topic->topic }}</a><br/>
					<small>{{ trans("forum.by") }} <strong>{{ $topic->user->summoner->name }}</strong></small>
				</td>
				<td>
					{{ $topic->updated_at->diffForHumans() }}<br/>
					{{ $topic->replies->count() }} {{ trans("forum.replies") }}
				</td>
			</tr>
			@elseif($topic->deleted === "1" && Auth::check() && Auth::user()->hasRole('admin'))
			<tr>
				<td width="50" style="position: relative;">
						@if(array_key_exists($topic->id,$last_reads) && $last_reads[$topic->id]>= $topic->updated_at)
						 <img src="/img/forum/folder.png" height="35" style="opacity: 0.3" />
							@if($topic->status === "1")
						 <img src="/img/forum/lock.png" class="lock" height="35" />
							@endif
						@else
						 <img src="/img/forum/folder.png" height="35" />
							@if($topic->status === "1")
						 <img src="/img/forum/lock.png" class="lock" height="35" />
							@endif
						@endif
				</td>
				<td valign="center">
					<span style="color: red;">!!!!DELETED!!!!</span> <a href="/forum/{{ $category->id }}/{{ $topic->id }}/{{ $topic->url_name }}">{{ $topic->topic }}</a><br/>
					<small>{{ trans("forum.by") }} <strong>{{ $topic->user->summoner->name }}</strong></small>
				</td>
				<td>
					{{ $topic->updated_at->diffForHumans() }}<br/>
					{{ $topic->replies->count() }} {{ trans("forum.replies") }}
				</td>
			</tr>
			@endif
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
				@if(Auth::check())
				<a href="/forum/create_topic/{{ $category->id }}/new" class="btn btn-primary right">{{ trans("forum.create_topic") }}</a>
				@endif
				
			</td>
		</tr>
	</table>
	<br/>
@stop
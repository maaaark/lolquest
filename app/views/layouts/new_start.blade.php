@extends('templates.blog')
@section('title', "")
@section('content')
	@foreach($blogs as $blog)
		<div class="blog">
			<div class="blog_inner">
				<a href="/blogs/{{ $blog->id }}"><h2>{{ $blog->title }}</h2></a>
				<div class="blog_date">
					<a href="/summoner/{{ $blog->user->region }}/{{ $blog->user->summoner_name }}">
					{{ $blog->user->summoner->name }}</a> - {{ $blog->created_at->diffForHumans() }} - <a href="/blogs/{{ $blog->id }}">{{ $blog->comments->count() }} {{ trans("blog.comments") }}</a>
				</div>
				<div class="excerpt blog_post">{{ $blog->excerpt }}</div>
				<a href="/blogs/{{ $blog->id }}"><div class="read_more btn btn-primary right">{{ trans("blog.readmore") }}</div></a>
			</div>
		</div>
	@endforeach
@stop
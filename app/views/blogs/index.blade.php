@extends('templates.blog')
@section('title', trans("blog.blog"))
@section('content')
	@foreach($blogs as $blog)
		<div class="blog_overview">
			<div class="blog_picture"><a href="/blogs/{{ $blog->id }}"><img src="/img/blog/{{ $blog->picture }}" /></a></div>
			<div class="blog_content">
				<h4><a href="/blogs/{{ $blog->id }}">{{ $blog->title }}</a></h4>
				<span class="comment_time">{{ $blog->created_at->diffForHumans() }} - {{ $blog->comments->count() }} {{ trans("blog.comments") }}</span><br/>
				{{ Str::limit($blog->body, 400) }} <a href="/blogs/{{ $blog->id }}">{{ trans("blog.more") }}</a>
			</div>
			<div class="clear"></div>
		</div>
	@endforeach
@stop
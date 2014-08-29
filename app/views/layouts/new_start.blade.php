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
				<br/>
			</div>
		</div>
		<br/>				
		
	@endforeach
	<div style="width: 100; text-align: center;">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- lolquest leaderboard -->
		<ins class="adsbygoogle"
			 style="display:inline-block;width:728px;height:90px"
			 data-ad-client="ca-pub-5331969279811198"
			 data-ad-slot="7231103062"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
		</div>
		<br/><br/>
@stop
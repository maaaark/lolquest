@extends('templates.default')
@section('title', trans("blog.blog").' - '.$blog->title)
@section('content')
	<h2>{{ $blog->title }}</h2>
	<div class="blog_date">
		<a href="/users/{{ $blog->user->region }}/{{ $blog->user->summoner_name }}"><img src="/img/profileicons/profileIcon{{ $blog->user->summoner->profileIconId }}.jpg" class="img-circle" width="30" />
		&nbsp;&nbsp;{{ $blog->user->summoner_name }}</a> - {{ $blog->created_at->diffForHumans() }} - {{ $blog->comments->count() }} {{ trans("blog.comments") }}
	</div>
	<div class="blog_post">
	{{ $blog->body }}
	</div>
	
	@if(Auth::check())
	<br/>
	<h3>{{ trans("blog.write_comment") }}</h3>
		{{ Form::model(Auth::user(),array('action' => 'BlogsController@create_comment', 'name' => 'frm', 'id' => 'frm' )) }}
		<input type="hidden" value="{{ $blog->id }}" name="blog_id">
		<textarea cols="100" rows="8" name="comment"></textarea><br/>
		{{ Form::submit(trans("blog.send_comment"), array('class' => 'btn btn-primary', 'style' => 'margin-top: 22px;', 'name' => 'send', 'id' => 'send')) }}
		{{ Form::close() }}
	@endif
	
	<br/>
	<h3>{{ trans("blog.comments") }}</h3>
	@foreach($comments as $comment)
		<div class="comment">
			<table>
				<tr>
					<td valign="top" style="width: 50px !important; text-align: center;">
						<a href="/users/{{ $comment->user->region }}/{{ $comment->user->summoner_name }}">
							<img src="/img/profileicons/profileIcon{{ $comment->user->summoner->profileIconId }}.jpg" class="img-circle" width="50" />
						</a>
					</td>
					<td valign="top" style="padding-left: 15px;">
						<a href="/users/{{ $comment->user->region }}/{{ $comment->user->summoner_name }}" class="comment_name">{{ $comment->user->summoner_name }}</a>&nbsp;&nbsp;
						<span class="comment_time">
							{{ $comment->created_at->diffForHumans() }}
						</span>
						<div class="comment_text">
						{{{ $comment->comment }}}
						</div>
					</td>
				</tr>
			</table>
		</div>
	@endforeach
@stop
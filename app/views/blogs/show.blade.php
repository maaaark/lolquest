@extends('templates.default')
@section('title', $blog->title)
@section('content')
	<br/>
	<script>
$( document ).ready(function() {	
	$('#wysiwyg').summernote({
	  height: 200,                 // set editor height

	  minHeight: null,             // set minimum height of editor
	  maxHeight: null,             // set maximum height of editor

	  focus: true,                 // set focus to editable area after initializing summernote
		  toolbar: [
		['style', ['bold', 'italic', 'underline', 'clear']],
		['font', ['strikethrough']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
	  ]
	});
});
</script>
	<div class="blog_date">
		<a href="/summoner/{{ $blog->user->region }}/{{ $blog->user->summoner_name }}"><img src="http://ddragon.leagueoflegends.com/cdn/5.8.1/img/profileicon/{{ $blog->user->summoner->profileIconId }}.png" class="img-circle" width="30" />
		&nbsp;&nbsp;{{ $blog->user->summoner->name }}</a> - {{ $blog->created_at->diffForHumans() }} - {{ $blog->comments->count() }} {{ trans("blog.comments") }}
	</div>
	<div class="blog_post">
	{{ $blog->body }}
	</div>
	
	@if(Auth::check())
	<br/>
	<h3>{{ trans("blog.write_comment") }}</h3>
		{{ Form::model(Auth::user(),array('action' => 'BlogsController@create_comment', 'name' => 'frm', 'id' => 'frm' )) }}
		<input type="hidden" value="{{ $blog->id }}" name="blog_id">
		<textarea cols="100" rows="8" id="wysiwyg" name="comment"></textarea><br/>
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
						<a href="/summoner/{{ $comment->user->region }}/{{ $comment->user->summoner_name }}">
							<img src="/img/profileicons/profileIcon{{ $comment->user->summoner->profileIconId }}.jpg" class="img-circle" width="50" />
						</a>
					</td>
					<td valign="top" style="padding-left: 15px;">
						<a href="/summoner/{{ $comment->user->region }}/{{ $comment->user->summoner_name }}" class="comment_name">{{ $comment->user->summoner->name }}</a>&nbsp;&nbsp;
						<span class="comment_time">
							{{ $comment->created_at->diffForHumans() }}
						</span>
						<div class="comment_text">
						{{ $comment->comment }}
						</div>
					</td>
				</tr>
			</table>
		</div>
	@endforeach
@stop
@extends('templates.default')
@section('title', trans("forum.forum"))
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
	<a href="/forum">Forum</a> > <a href="/forum/{{ $category->url_name }}">{{ $category->name }}</a> > <a href="/forum/{{ $category->url_name }}/{{ $topic->topic }}">{{ $topic->topic }}</a><br/>
	<br/>
	{{ Form::open(array('action' => 'ForumController@save_reply')) }}
		{{ Form::textarea('content', null, array('id' => 'wysiwyg')) }}<br/>
		<br/>
		{{ Form::hidden('topic_id', $topic->id) }}
		{{ Form::submit(trans("forum.save_reply"), array("class"=>"btn btn-primary")); }}
	{{ Form::close() }}
	<div class="right">
	</div>
	<br/>
	<br/>
@stop
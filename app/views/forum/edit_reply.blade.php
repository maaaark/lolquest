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
	{{ Form::open(array('action' => 'ForumController@editsave_reply')) }}
		{{ Form::textarea('content', $replies->content, array('id' => 'wysiwyg')) }}<br/>
		<br/>
		{{ Form::hidden('reply_id', $replies->id) }}
		{{ Form::hidden('forum_topic_id', $replies->forum_topic_id) }}
		{{ Form::hidden('user_id', Auth::id()) }}
		{{ Form::submit("Save", array("class"=>"btn btn-primary")); }}
	{{ Form::close() }}
	<div class="right">
	</div>
	<br/>
	<br/>
@stop
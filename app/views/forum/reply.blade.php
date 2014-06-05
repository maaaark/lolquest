@extends('templates.default')
@section('title', trans("forum.forum"))
@section('content')
<br/>
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
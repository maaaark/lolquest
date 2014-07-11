@extends('templates.default')
@section('title', trans("forum.forum"))
@section('content')
<br/>
	<a href="/forum">Forum</a> > <a href="/forum/{{ $category->id }}">{{ $category->name }}</a><br/>
	<br/>
	{{ Form::open(array('action' => 'ForumController@save_topic')) }}
		{{ Form::text('title', null, array("placeholder" => "Forum Topic", "class" => "forum_title")) }}<br/>
		{{ Form::textarea('content', null, array('id' => 'wysiwyg')) }}<br/>
		<br/>
		{{ Form::hidden('category_id', $category->id) }}
		{{ Form::submit(trans("forum.create_topic"), array("class"=>"btn btn-primary")) }}
	{{ Form::close() }}
	<div class="right">
	</div>
	<br/>
	<br/>
@stop
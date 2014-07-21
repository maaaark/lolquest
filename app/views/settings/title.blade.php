@extends('templates.default')
@section('title', trans("users.settings")." - Titles")
@section('content')
	<br/>
	@if(Auth::user()->active_title > 0)
	<strong>Current title:</strong> {{ $user->title() }}<br/>
	@endif
	<br/>
	{{ Form::open(array('action' => 'UsersController@update_title')) }}	
		<select name="title">
			@if(Auth::user()->active_title > 0)
				<option value="{{ $current_title->id }}">{{ $current_title->title }}</option>
			@else
				<option value="0">No title</option>
			@endif
			@foreach($user->titles as $title)
				<option value="{{ $title->title->id }}">{{ $title->title->title }}</option>
			@endforeach
				<option value="0">No title</option>
		</select>
	<br/><br/>
		{{ Form::submit(trans("sidebar.save"), array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop
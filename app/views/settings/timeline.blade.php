@extends('templates.default')
@section('title', trans("users.settings")." ".$user->summoner->summoner_name)
@section('content')
	<br/>
	{{ Form::open(array('action' => 'UsersController@update_timeline_settings')) }}
		{{ Form::checkbox('show_in_timeline', 1, $user->show_in_timeline) }} Show my Events in Timeline<br/>
		<br/>
		{{ Form::submit(trans("sidebar.save"), array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop
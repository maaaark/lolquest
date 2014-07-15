@extends('templates.default')
@section('title', trans("users.settings")." ".$user->summoner->summoner_name)
@section('content')
	<br/>
	{{ Form::open(array('action' => 'UsersController@update_timeline_settings')) }}
		{{ Form::checkbox('show_in_timeline', 1, $user->show_in_timeline) }} {{ trans("timeline.settings_1") }}<br/>
		<br/>
		{{ Form::checkbox('timeline_friends_only', 1, $user->timeline_friends_only) }} {{ trans("timeline.settings_2") }}<br/>
		<br/>
		{{ Form::submit(trans("sidebar.save"), array('class' => 'btn btn-primary')) }} <br/>
		<br/>
	{{ Form::close() }}
@stop
@extends('templates.default')
@section('title', trans("users.settings")." ".$user->summoner->summoner_name)
@section('content')
	<br/>
	{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}
		{{ Form::checkbox('show_in_timeline', 'value', true) }} Show my Events in Timeline<br/>
		<br/>
		{{ Form::submit(trans("sidebar.save"), array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop
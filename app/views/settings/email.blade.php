@extends('templates.default')
@section('title', trans("users.settings")." ".$user->summoner->summoner_name)
@section('content')
	<br/>
	{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}
		<div class="form-group">
			{{ Form::label('email', 'Email') }}
			{{ Form::email('email', null, array('class' => 'form-control')) }}
		</div>
		{{ Form::submit(trans("sidebar.save"), array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop



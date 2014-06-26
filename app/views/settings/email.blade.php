@extends('templates.default')
@section('title', trans("users.settings")." ".$user->summoner->summoner_name)
@section('content')
	<br/>
	{{ Form::open(array('action' => 'UsersController@update_email')) }}
		<div class="form-group">
			{{ Form::label('email', 'Email') }}
			{{ Form::email('email', $user->email, array('class' => 'form-control')) }}
		</div>
		{{ Form::submit(trans("sidebar.save"), array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop



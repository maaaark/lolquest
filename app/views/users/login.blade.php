@extends('templates.full')
@section('title', 'Login')
@section('content')
<div class="user_form">
{{ Form::open(array('url' => 'login')) }}
	<h1>Login</h1>

	<!-- if there are login errors, show them here -->
	<p>
		{{ $errors->first('email') }}
		{{ $errors->first('password') }}
	</p>

	<p>
		{{ Form::label('email', 'Email Address') }}
		{{ Form::text('email', Input::old('email'), array('placeholder' => 'example@lolquest.net')) }}
	</p>

	<p>
		{{ Form::label('password', 'Password') }}
		{{ Form::password('password') }}
	</p>

	<p>{{ Form::submit('Submit!') }}</p>
{{ Form::close() }}
</div>
@stop
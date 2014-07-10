@extends('templates.full')
@section('title', '')
@section('content')
<div class="login_form">
	<div class="inner_login">
	{{ Form::open(array('url' => 'login')) }}
		<h1>Login</h1>

		<!-- if there are login errors, show them here -->
		<p>
			{{ $errors->first('email') }}
			{{ $errors->first('password') }}
		</p>
		
		
		<div class="input-group">
		  <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
		  {{ Form::text('email', Input::old('email'), array('placeholder' => 'example@lolquest.net', 'class' => 'form-control')) }}
		</div>
		<br/>
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-key"></i></span>
		  {{ Form::password('password', array('class' => 'form-control')) }}
		</div>
		<br/>
		<p>{{ Form::submit('Submit!', array('class' => 'btn btn-primary btn-block')) }}</p>
		<p>
			No Account yet? <a href="/register">Register now!</a> | <a href="/forgot_password">Reset password</a>
		</p>
	{{ Form::close() }}
	</div>
</div>
@stop
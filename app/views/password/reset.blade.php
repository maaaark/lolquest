@extends('templates.full')
@section('title', 'Reset Password')
@section('content')
<div class="login_form">
	<div class="inner_login">
	<h2 style="margin-top: 0;">Reset Password</h2>
	<form action="{{ action('RemindersController@postReset') }}" method="POST">
		<input type="hidden" name="token" value="{{ $token }}">
		<input type="email" class="form-control" placeholder="E-Mail" name="email"><br/>
		<input type="password" class="form-control" placeholder="Password" name="password"><br/>
		<input type="password" class="form-control" placeholder="Password" name="password_confirmation"><br/>
		<input type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" class="btn btn-primary" value="Reset Password">
	</form>
	</div>
</div>
@stop
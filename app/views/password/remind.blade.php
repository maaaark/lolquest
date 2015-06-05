@extends('templates.full')
@section('title', 'Reset Password')
@section('content')
<div class="login_form">
	<div class="inner_login">
	<h2 style="margin-top: 0;">Forgot password</h2>
	<form action="{{ action('RemindersController@postRemind') }}" method="POST">
		<input type="email" class="form-control" placeholder="E-Mail" name="email"><br/>
		<input type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" class="btn btn-primary" value="Send Mail">
	</form>
	</div>
</div>
@stop
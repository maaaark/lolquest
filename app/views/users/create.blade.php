@extends('templates.full')
@section('title', 'Register')
@section('content')
<div class="login_form">
<div class="inner_login">
@if(Session::get('beta_user') == 1)
	{{ Form::open(array('url'=>'users/store', 'class'=>'')) }}
		<h2 class="form-signup-heading" style="margin-top: 0;">{{ trans('users.welcome') }}</h2>
	 
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
		  {{ Form::text('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>'E-Mail', 'class' => 'form-control')) }}
		</div>
		<br/>
		
		<div class="input-group">
		  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
		  {{ Form::text('summoner_name', null, array('class'=>'form-control', 'placeholder'=>'Summoner Name', 'class' => 'form-control')) }}
		</div>
		<br/>
		
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-globe"></i></span>
		  {{ Form::select('region', array('0' => 'Select a Region', 'euw' => 'euw', 'na' => 'na'), null, array('class' => 'form-control')) }}
		</div>
		<br/>
		
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-key"></i></span>
		  {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password', 'class' => 'form-control')) }}
		</div>
		<br/>
		
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-key"></i></span>
		  {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password', 'class' => 'form-control')) }}
		</div>
		<br/>
			
		{{ Form::submit('Register', array('class'=>'btn btn-large btn-success btn-block'))}}<br/>
		<p>
			Already have an account? <a href="/login">Go and Login!</a>
		</p>
	{{ Form::close() }}
@else
	You Beta Key is invalid.
@endif
</div>
</div>
@stop
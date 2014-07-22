@extends('templates.no_summoner')
@section('title', 'Register Summoner')
@section('content')
<div class="login_form">
	<div class="inner_login">
	{{ Form::open(array('action' => 'BaseController@save_summoner')) }}	
		<h2>Register Summoner</h2>
		<div class="bs-callout bs-callout-warning">
		There was an error while creating your summoner.<br/>
		Please re-enter your region and summoner name.<br/>
		</div>
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-user"></i></span>
		  {{ Form::text('summoner_name', null, array('class'=>'form-control', 'placeholder'=>'Summoner Name', 'class' => 'form-control')) }}
		</div>
		<br/>
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-globe"></i></span>
		  {{ Form::select('region', array('0' => 'Select a Region', 'euw' => 'euw', 'na' => 'na'), null, array('class' => 'form-control')) }}
		</div>
		<br/>
		<p>{{ Form::submit('Save Summoner', array('class' => 'btn btn-primary btn-block')) }}</p>
	{{ Form::close() }}
	</div>
</div>
@stop
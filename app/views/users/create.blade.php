@extends('layouts.master')
@section('content')
{{ Form::open(array('url'=>'users/store', 'class'=>'')) }}
    <h2 class="form-signup-heading"><?php echo trans('users.welcome'); ?></h2>
 
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
 
    {{ Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Name')) }}<br/>
    {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'E-Mail')) }}<br/>
	<br/>
	{{ Form::text('summoner_name', null, array('class'=>'form-control', 'placeholder'=>'Summoner Name')) }}<br/>
	{{ Form::select('region', array('0' => 'Select a Region', 'EUW' => 'euw', 'NA' => 'na'), null, array('class' => 'form-control')) }}<br/>
	<br/>
    {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}<br/>
    {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) }}<br/>
	<br/>
    {{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}
@stop
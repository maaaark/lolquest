@extends('layouts.master')
@section('content')
{{ Form::open(array('url'=>'users/store', 'class'=>'')) }}
    <h2 class="form-signup-heading"><?php echo trans('users.welcome'); ?></h2>
 
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
 
    {{ Form::text('name', null, array('class'=>'input-large', 'placeholder'=>'Name')) }}<br/>
    {{ Form::text('email', null, array('class'=>'input-large', 'placeholder'=>'E-Mail')) }}<br/>
	<br/>
	{{ Form::text('summoner_name', null, array('class'=>'input-large', 'placeholder'=>'Summoner Name')) }}<br/>
	{{ Form::select('region', array('0' => 'Select a Region', 'EUW' => 'euw', 'NA' => 'na'), null, array('class' => 'form-control')) }}<br/>
	<br/>
    {{ Form::password('password', array('class'=>'input-large', 'placeholder'=>'Password')) }}<br/>
    {{ Form::password('password_confirmation', array('class'=>'input-large', 'placeholder'=>'Confirm Password')) }}<br/>
	<br/>
    {{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}
@stop
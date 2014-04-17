@extends('layouts.master')
@section('content')
{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}

	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('email', 'Email') }}
		{{ Form::email('email', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('summoner_name', 'Summoner name') }}
		{{ Form::text('summoner_name', null, array('class' => 'form-control')) }}
	</div>
	
	<div class="form-group">
		{{ Form::label('region', 'Region') }}
		{{ Form::select('region', array('0' => 'Select a Region', 'Eu-West' => 'euw', 'Nordamerika' => 'na'), null, array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Speichern', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@stop



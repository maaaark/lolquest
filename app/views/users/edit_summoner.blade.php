@extends('templates.default')
@section('title', 'Edit summoner name')
{{ Form::model($user, array('action' => 'UsersController@update_summoner')) }}
@section('content')
	<div class="bs-callout bs-callout-danger">
		<h4>{{ trans("users.warning") }}</h4>
		{{ trans("users.quest_delete") }}
	</div>

	<ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
	<div class="form-group">
		{{ Form::label('summoner_name', 'Summoner name') }}
		{{ Form::text('summoner_name', null, array('class' => 'form-control')) }}
	</div>
	
	<div class="form-group">
		{{ Form::label('region', 'Region') }}
		{{ Form::select('region', array('' => 'Select a Region', 'euw' => 'EU-W', 'na' => 'NA'), null, array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Speichern', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@stop



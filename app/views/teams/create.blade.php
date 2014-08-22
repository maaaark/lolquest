@extends('templates.default')
@section('title', "Create a Team")
@section('content')	
	<br/>
	{{ Form::open(array('url'=>'teams/store', 'class'=>'', 'files' => true)) }}
	<table class="table table-striped">
		<tr>
			<td class="attribute">{{ trans("teams.team_name") }}</td>
			<td>{{ Form::text('teamname', null, array('class'=>'form-control', 'placeholder'=>'Team Name', 'class' => 'form-control')) }}</td>
		</tr>
		<tr>
			<td class="attribute">{{ trans("teams.region") }}</td>
			<td>{{ Form::select('region', array('0' => 'Select a Region', 'euw' => 'EUW', 'na' => 'NA' ), null, array('class' => 'form-control')) }}</td>
		</tr>
		<tr>
			<td class="attribute">{{ trans("teams.website") }}</td>
			<td>{{ Form::text('website', null, array('class'=>'form-control', 'placeholder'=>'http://lolquest.net', 'class' => 'form-control')) }}</td>
		</tr>
		<tr>
			<td class="attribute">{{ trans("teams.logo") }}</td>
			<td>{{ Form::file('logo', null, array('class'=>'form-control', 'placeholder'=>'Logo Upload 100x100 px', 'class' => 'form-control')) }}</td>
		</tr>
		<tr>
			<td class="attribute">{{ trans("teams.description") }}</td>
			<td>{{ Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=>'Team description', 'class' => 'form-control')) }}</td>
		</tr>
	</table> 
	{{ Form::submit('Create team for 100 QP', array('class'=>'create_team btn btn-success'))}}<br/>
	{{ Form::close() }}
@stop
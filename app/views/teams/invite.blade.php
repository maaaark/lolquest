@extends('templates.default')
@section('title', "Invite a member")
@section('content')	
	<br/>
	{{ Form::open(array('url'=>'/teams/send_invite', 'class'=>'', 'files' => true)) }}
	<table class="table table-striped">
		<tr>
			<td class="attribute">{{ trans("users.summoner_name") }}</td>
			<td>{{ Form::text('summoner_name', null, array('class'=>'form-control', 'placeholder'=>'Summoner name', 'class' => 'form-control')) }}</td>
		</tr>
		<tr>
			<td class="attribute">{{ trans("teams.region") }}</td>
			<td>{{ Form::select('region', array('0' => 'Select a Region', 'euw' => 'EUW', 'na' => 'NA' ), null, array('class' => 'form-control')) }}</td>
		</tr>
	</table> 
	{{ Form::submit('Invite Player', array('class'=>'btn btn-success'))}}<br/>
	{{ Form::close() }}
@stop
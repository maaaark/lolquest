@extends('templates.default')
@section('title', trans("users.settings")." ".$user->summoner_name)
@section('content')
<br/>
{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}
	<div class="form-group">
		{{ Form::label('email', 'Email') }}
		{{ Form::email('email', null, array('class' => 'form-control')) }}
	</div>
	
	<div class="form-group">
		{{ Form::label('edit', trans("sidebar.edit")) }}<br/>
		<a href="/edit_summoner" class="btn btn-primary">{{ trans("sidebar.edit") }}</a><br/>
	</div>
	<br/><br/>
	{{ Form::submit(trans("sidebar.save"), array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@stop



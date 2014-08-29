@extends('templates.default')
@section('title', trans("users.settings")." - Livestream")
@section('content')
	<br/>
	{{ Form::open(array('action' => 'UsersController@save_livestream')) }}	
	<table class="table table-striped">
		<tr>
			<th width="250">
				Platform
			</th>
			<th>
				Channel
			</th>
		</tr>
		<tr>
			<td width="250">
				<select class="form-control" name="livestream_platform">
					<option value="twitch">Twitch.tv</option>
				</select>
			</td>
			<td>
				<input type="text" class="form-control" name="livestream_channel" value="{{ Auth::user()->livestream_channel }}" />
			</td>
		</tr>
	</table>
	<br/>
		{{ Form::submit(trans("sidebar.save"), array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop
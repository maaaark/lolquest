@extends('templates.default')
@section('title', trans("users.settings")." - Skins")
@section('content')
	<br/>
	{{ Form::open(array('action' => 'UsersController@save_skin')) }}	
	<table>
		<tr>
			<td width="250">
				Left Skin
				<select name="left_skin">
						<option value="{{ Auth::user()->skin_left }}">{{ Auth::user()->skin_left }}</option>
					@foreach($skins as $skin)
						<option value="{{ $skin->champion_id }}.jpg">{{ $skin->champion->name }}</option>
					@endforeach
				</select>
			</td>
			<td>
				Right Skin
				<select name="right_skin">
						<option value="{{ Auth::user()->skin_right }}">{{ Auth::user()->skin_right }}</option>
					@foreach($skins as $skin)
						<option value="{{ $skin->champion_id }}.jpg">{{ $skin->champion->name }}</option>
					@endforeach
				</select>
			</td>
		</tr>
	</table>
	<br/>
		{{ Form::submit(trans("sidebar.save"), array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop
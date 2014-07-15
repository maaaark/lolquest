@extends('templates.default')
@section('title', trans("users.settings")." - Skins")
@section('content')
	<br/>
	{{ trans("shop.skin_info") }}<br/>
	<br/>
	{{ Form::open(array('action' => 'UsersController@save_skin')) }}	
	<table>
		<tr>
			<td width="250">
				Left Skin
				<select name="left_skin">
					@if(Auth::user()->skin_left == "default_left.png")
						<option value="{{ Auth::user()->skin_left }}">Default</option>
					@else
						<option value="{{ $skin_left->champion_id }}">{{ $skin_left->name }}</option>
					@endif
					
					@foreach($skins as $skin)
						<option value="{{ $skin->champion_id }}.jpg">{{ $skin->champion->name }}</option>
					@endforeach
				</select>
			</td>
			<td>
				Right Skin
				<select name="right_skin">
					
					@if(Auth::user()->skin_right == "default_right.png")
						<option value="{{ Auth::user()->skin_right }}">Default</option>
					@else
						<option value="{{ $skin_right->champion_id }}">{{ $skin_right->name }}</option>
					@endif
					
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
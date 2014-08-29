@extends('templates.default')
@section('title', trans("users.settings")." - Skins")
@section('content')
	<br/>
	{{ trans("shop.skin_info") }}<br/>
	<br/>
	{{ Form::open(array('action' => 'UsersController@save_skin')) }}	
	<table class="table table-striped">
		<tr>
			<th width="50%">Left Skin</th>
			<th>Right Skin</th>
		</tr>
		<tr>
			<td width="250">
				<select name="left_skin" class="form-control">
					@if(Auth::user()->skin_left == "default_left.png")
						<option value="{{ Auth::user()->skin_left }}">Default</option>
					@else
						<option value="{{ $skin_left->champion_id }}.jpg">{{ $skin_left->name }}</option>
					@endif
					
					@foreach($skins as $skin)
						<option value="{{ $skin->champion_id }}.jpg">{{ $skin->champion->name }}</option>
					@endforeach
				</select>
			</td>
			<td>
				<select name="right_skin" class="form-control">
					@if(Auth::user()->skin_right == "default_right.png")
						<option value="{{ Auth::user()->skin_right }}">Default</option>
					@else
						<option value="{{ $skin_right->champion_id }}.jpg">{{ $skin_right->name }}</option>
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
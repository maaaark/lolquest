@extends('templates.default')
@section('title', trans("users.settings")." ".$user->summoner_name)
@section('content')
<br/>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
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
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<h2>Friends</h2>
		<table class="table table-striped">
			<tr>
		@if($user->openFriends())
		@foreach($user->openFriends() as $openfriend)
				@if($user->getFriendUser($openfriend->user_id))
				<td width="50">
					<img src="/img/profileicons/profileIcon{{ $user->getFriendUser($openfriend->user_id)->summoner->profileIconId }}.jpg" width="40" class="img-circle" /><br/>
				</td>
				<td>
					<div class="quest_description">{{$user->getFriendUser($openfriend->user_id)->summoner_name}}</div>
				</td>
				<td>
				<a href="/accept_friend/{{$user->getFriendUser($openfriend->user_id)->id}}" class="btn btn-success">{{ trans("friends.accept") }}</a>
				</td>
				<td>
				<a href="/remove_friend/{{$openfriend->id}}" class="btn btn-danger">{{ trans("friends.remove") }}</a>
				</td>
			</tr>
				@endif
		@endforeach
		@endif
		
		@foreach($user->friends as $friend)
				<td width="50">
					<img src="/img/profileicons/profileIcon{{ $friend->summoner->profileIconId }}.jpg" width="40" class="img-circle" /><br/>
				</td>
				<td colspan="2">
					<div class="quest_description">{{$friend->summoner_name}}</div>
				</td>
			@if ( Auth::user()->isFriend($friend->id) == 'checked')
				<td>
				<a href="/remove_friend/{{$friend->id}}" class="btn btn-danger">{{ trans("friends.remove") }}</a>
				</td>
			@elseif ( Auth::user()->isFriend( $friend->id) == 'unchecked')
				<td>
					<div class="quest_description">{{ trans("friends.unconfirmed") }}</div>
				</td>
				<td>
				<a href="/remove_friend/{{$friend->id}}" class="btn btn-danger">{{ trans("friends.remove") }}</a>
				</td>
			@else
				<td></td>
			@endif
			</tr>
		@endforeach
		</table>
</div>

	

@stop



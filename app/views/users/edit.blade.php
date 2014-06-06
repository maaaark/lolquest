@extends('templates.default')
@section('title', trans("users.settings")." ".$user->summoner_name)
@section('content')
<br/>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

	<table class="table table-striped">
		<tr>
			<th>Settings</th>
		</tr>
		<tr>
			<td><i class="fa fa-refresh"></i>&nbsp;&nbsp;<a href="/verify" class="">{{ trans("sidebar.refresh_games") }}</a></td>
		</tr>
		<tr>
			<td><i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="/edit_mail" class="">{{ trans("sidebar.edit_mail") }}</a></td>
		</tr>
		<tr>
			<td><i class="fa fa-user"></i>&nbsp;&nbsp;<a href="/edit_summoner" class="">{{ trans("sidebar.edit") }}</a></td>
		</tr>
		<tr>
			<td><i class="fa fa-check"></i>&nbsp;&nbsp;<a href="/verify" class="">{{ trans("verify.title") }}</a></td>
		</tr>
		<tr>
			<td><i class="fa fa-dashboard"></i>&nbsp;&nbsp;<a href="/verify" class="">{{ trans("sidebar.timeline_settings") }}</a></td>
		</tr>
	</table>

{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}
	<div class="form-group">
		{{ Form::label('email', 'Email') }}
		{{ Form::email('email', null, array('class' => 'form-control')) }}
	</div>
	{{ Form::submit(trans("sidebar.save"), array('class' => 'btn btn-primary')) }}
{{ Form::close() }}

</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<table class="table table-striped friends_list">
			<tr>
				<th colspan="4">Friends</th>
			</tr>
			<tr>
		@if($user->openFriends())
		@foreach($user->openFriends() as $openfriend)
				@if($user->getFriendUser($openfriend->user_id))
				<td width="50">
					<a href="/summoner/{{$user->getFriendUser($openfriend->user_id)->region}}/{{$user->getFriendUser($openfriend->user_id)->summoner_name}}"><img src="/img/profileicons/profileIcon{{ $user->getFriendUser($openfriend->user_id)->summoner->profileIconId }}.jpg" width="30" class="img-circle" /></a>
				</td>
				<td width="210">
					<a href="/summoner/{{$user->getFriendUser($openfriend->user_id)->region}}/{{$user->getFriendUser($openfriend->user_id)->summoner_name}}">
						{{$user->getFriendUser($openfriend->user_id)->summoner_name}}
					</a>
				</td>
				<td>
				<a href="/accept_friend/{{$user->getFriendUser($openfriend->user_id)->id}}" class="btn btn-success">{{ trans("friends.accept") }}</a>
				</td>
				<td>
				<a href="/remove_friend/{{$openfriend->id}}" class="remove">{{ trans("friends.remove") }}</a>
				</td>
			</tr>
				@endif
		@endforeach
		@endif
		
		@foreach($user->friends as $friend)
				<td width="50">
					<a href="/summoner/{{$friend->region}}/{{$friend->summoner_name}}">
					<img src="/img/profileicons/profileIcon{{ $friend->summoner->profileIconId }}.jpg" width="30" class="img-circle" />
					</a>
				</td>
				<td colspan="2" width="210">
					<a href="/summoner/{{$friend->region}}/{{$friend->summoner_name}}">
					{{$friend->summoner_name}}
					</a>
				</td>
			@if ( Auth::user()->isFriend($friend->id) == 'checked')
				<td>
				<a href="/remove_friend/{{$friend->id}}" class="remove">{{ trans("friends.remove") }}</a>
				</td>
			@elseif ( Auth::user()->isFriend( $friend->id) == 'unchecked')
				<td>
					<div class="quest_description">{{ trans("friends.unconfirmed") }}</div>
				</td>
				<td>
				<a href="/remove_friend/{{$friend->id}}" class="remove">{{ trans("friends.remove") }}</a>
				</td>
			@else
				<td></td>
			@endif
			</tr>
		@endforeach
		</table>
</div>

	

@stop



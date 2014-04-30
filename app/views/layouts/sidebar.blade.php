@if(Auth::check())
	<br/>
	<h3>{{ trans("sidebar.logged_in_headline") }}</h3>
	<table class="logged_in">
		<tr>
			<td valign="top" width="100" style="text-align: center;">
				<a href="/summoner/{{ Auth::user()->region }}/{{ Auth::user()->summoner_name }}"><img src="/img/profileicons/profileIcon{{ Auth::user()->summoner->profileIconId }}.jpg" class="img-circle" width="70" /></a><br/>
			</td>
			<td valign="top">
				<a href="/dashboard">{{ trans("sidebar.myquest") }}</a><br/>
				<a href="/users/{{ Auth::user()->id }}/edit">{{ trans("sidebar.settings") }}</a><br/>
				<a href="/logout" class="logout">{{ trans("sidebar.logout") }}</a>
			</td>
		</tr>
	</table>
	<br/>
	<strong>{{ trans("sidebar.level") }} {{ Auth::user()->ulevel }}:</strong><br/>
	<div class="progress">
	  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
		60%
	  </div>
	</div>
	<br/>
	<h3>{{ trans("sidebar.active_quests") }}</h3>
	<table class="sidebar_questlist">
		@if(Session::has('my_open_quests'))
			@foreach(Session::get('my_open_quests') as $quest)
			<tr>
				<td valign="top" width="50"><a href="/dashboard"><img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="/img/champions/{{ $quest->champion_id }}_92.png" width="40"></a></td>
				<td valign="top">
					<a href="/dashboard"><strong>{{ $quest->questtype->name }}</strong></a><br/>
					<div class="sidebar_questtext">{{ trans("quests.".$quest->type_id) }}</div>
				</td>
			</tr>
			@endforeach
		@else
			Keine Quest vorhanden
		@endif
	</table>
	<br/><br/>
	<h3>{{ trans("sidebar.friends_ladder") }}</h3>
	<table class="table table-striped" style="margin-bottom: 5px;">
		@foreach(Auth::user()->friends as $friend)
			@if($friend->ladder)
				<tr>
					<td width="30">{{ $friend->ladder->rang }}.</td>
					<td width="40"><a href="/summoner/{{ $friend->region }}/{{ $friend->summoner_name }}"><img src="/img/profileicons/profileIcon{{ $friend->summoner->profileIconId }}.jpg" class="img-circle" width="25" /></a></td>
					<td><a href="/summoner/{{ $friend->region }}/{{ $friend->summoner_name }}">{{ $friend->summoner_name }}</a></td>
					<td>{{ $friend->ladder->month_exp }} EXP</td>			
				</tr>
			@endif
		@endforeach
	</tr>
	</table>
	<div class="view_ladder"><a href="/ladders">{{ trans("sidebar.view_ladder") }}</a></div>
@else
	<br/>
	<h3>{{ trans("sidebar.login_headline") }}</h3>
	{{ Form::open(array('url' => 'login')) }}
		{{ Form::text('email', Input::old('email'), array('placeholder' => 'example@lolquest.net', 'class' => 'sidebar_input')) }}
		{{ Form::password('password', array('class' => 'sidebar_input')) }}
		{{ Form::submit('Login', array('class' => 'sidebar_button')) }}
	{{ Form::close() }}
@endif
@if(Auth::check())
<br/>
<h3>{{ trans("sidebar.logged_in_headline") }}</h3>
<table class="logged_in">
	<tr>
		<td valign="top" width="120" style="text-align: center;">
			<img src="/img/profileicons/profileIcon{{ Auth::user()->summoner->profileIconId }}.jpg" class="img-circle" width="70" /><br/>
			<a href="#" class="change_avatar">change avatar</a>
		</td>
		<td valign="top">
			{{ trans("sidebar.logged_in_as") }} <a href="/summoner/{{ Auth::user()->region }}/{{ Auth::user()->summoner_name }}">{{ Auth::user()->summoner_name }}</a> (<a href="/edit_summoner">{{ trans("sidebar.edit") }}</a>)<br/>
			<a href="#">{{ trans("sidebar.myquest") }}</a><br/>
			<a href="/users/{{ Auth::user()->id }}/edit">{{ trans("sidebar.settings") }}</a><br/>
			<a href="/logout" class="logout">{{ trans("sidebar.logout") }}</a>
		</td>
	</tr>
</table>
<br/>
<h3>{{ trans("sidebar.active_quests") }}</h3>
<table class="sidebar_questlist">
	@if(Session::has('my_open_quests'))
		@foreach(Session::get('my_open_quests') as $quest)
		<tr>
			<td valign="top" width="50"><img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="/img/champions/{{ $quest->champion_id }}_92.png" width="40"></td>
			<td valign="top">
				<strong>{{ $quest->questtype->name }}</strong><br/>
				<div class="sidebar_questtext">{{ trans("quests.".$quest->type_id) }}</div>
			</td>
		</tr>
		@endforeach
	@else
		Keine Quest vorhanden
	@endif
</table>
@if(Session::has('my_open_quests'))
<br/>
@if(Auth::user()->id==$user->id)
<a href="/refresh_games" style="color: #ffffff;" class="btn btn-primary btn-block">{{ trans("users.refresh") }}</a>
@endif
@endif

@else
<br/>
<h3>{{ trans("sidebar.login_headline") }}</h3>
{{ Form::open(array('url' => 'login')) }}
	{{ Form::text('email', Input::old('email'), array('placeholder' => 'example@lolquest.net', 'class' => 'sidebar_input')) }}
	{{ Form::password('password', array('class' => 'sidebar_input')) }}
	{{ Form::submit('Login', array('class' => 'sidebar_button')) }}
{{ Form::close() }}
@endif
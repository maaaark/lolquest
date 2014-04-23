@if(Auth::check())
<h2>{{ trans("sidebar.logged_in_headline") }}</h2>
<table class="logged_in">
	<tr>
		<td valign="top" width="90">
			<img src="/img/profileicons/profileIcon{{ Auth::user()->summoner->profileIconId }}.jpg" class="img-circle" width="70" />
		</td>
		<td valign="top">
			{{ trans("sidebar.logged_in_as") }} <a href="/summoner/{{ Auth::user()->region }}/{{ Auth::user()->summoner_name }}">{{ Auth::user()->summoner_name }}</a> (<a href="/edit_summoner">{{ trans("sidebar.edit") }}</a>)<br/>
			<a href="#">{{ trans("sidebar.myquest") }}</a><br/>
			<a href="#">{{ trans("sidebar.settings") }}</a><br/>
			<a href="/logout">{{ trans("sidebar.logout") }}</a>
		</td>
	</tr>
</table>
@else
<h2>{{ trans("sidebar.login_headline") }}</h2>
{{ Form::open(array('url' => 'login')) }}
	{{ Form::text('email', Input::old('email'), array('placeholder' => 'example@lolquest.net', 'class' => 'sidebar_input')) }}
	{{ Form::password('password', array('class' => 'sidebar_input')) }}
	{{ Form::submit('Login', array('class' => 'sidebar_button')) }}
{{ Form::close() }}
@endif
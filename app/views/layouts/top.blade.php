<!-- Fixed navbar -->
<div class="navigation">
  <div class="container">
	<div class="logo"><a href="/"><img src="/img/logo.jpg"></a></div>
	<div class="list">
		<ul class="">
		<li><a href="/users">Users</a></li>
		@if(Auth::check())
			<li><a href="/summoner/{{ Auth::user()->region }}/{{ Auth::user()->summoner_name }}">{{ Auth::user()->summoner_name }}</a></li>
			<li><a href="/logout">Logout</a></li>
		@else
			<li><a href="/login">Login</a></li>
			<li><a href="/users/create">Register</a></li>
		@endif
	</ul>
	</div>
	<div class="clear"></div>
  </div>
</div>
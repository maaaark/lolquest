<!-- Fixed navbar -->
<div class="navigation">
  <div class="container">
	<div class="logo"><a href="/"><img src="/img/logo.jpg"></a></div>
	<div class="list">
		<ul class="">
		
		@if(Auth::check())
			<li><a href="/logout">Logout</a></li>
			<li>
				<a href="/summoner/{{ Auth::user()->region }}/{{ Auth::user()->summoner_name }}">
					<div class="avatar"><img src="/img/profileicons/profileIcon{{ Auth::user()->summoner->profileIconId }}.jpg" class="img-circle" width="20" style="display: inline;" /></div>
					<div class="name">{{ Auth::user()->summoner_name }}</div>
					<div class="clear"></div>
				</a>
			</li>
			
		@else
			<li><a href="/login">Login</a></li>
			<li><a href="/users/create">Register</a></li>
		@endif
		<li class="quests"><a href="#">My Quests</a></li>
		<li><a href="#">Ladders</a></li>
		<li><a href="/users">Summoners</a></li>
	</ul>
	</div>
	<div class="clear"></div>
  </div>
</div>
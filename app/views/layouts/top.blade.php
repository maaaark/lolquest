<!-- Fixed navbar -->
<div class="navbar-wrapper">
  <div class="container">

	<div class="navbar navbar-inverse navbar-static-top" role="navigation">
	  <div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="/">LoL Quest</a>
		</div>
		<div class="navbar-collapse collapse">
		  <ul class="nav navbar-nav">
			<li><a href="/users">Users</a></li>
			@if(Auth::check())
				<li><a href="/users/{{ Auth::user()->id }}">{{ Auth::user()->summoner_name }}</a></li>
				<li><a href="/logout">Logout</a></li>
			@else
				<li><a href="/login">Login</a></li>
				<li><a href="/users/create">Register</a></li>
			@endif
		  </ul>
		</div>
	  </div>
	</div>

  </div>
</div>
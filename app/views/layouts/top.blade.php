<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
	<div class="navbar-collapse collapse">
	  <ul class="nav navbar-nav">
		<li class="active"><a href="{{ URL::to('/') }}">LoL Quest</a></li>
		<li><a href="{{ URL::to('users') }}">User</a></li>
		@if(Auth::check())
			<li>{{ link_to_route('users.show', Auth::user()->name, Auth::user()->id) }}</li>
		@else
			<li><a href="{{ URL::to('login') }}">{{ trans('users.login') }}</a></li>
			<li><a href="{{ URL::to('register') }}">{{ trans('users.register') }}</a></li>
		@endif
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
		  <ul class="dropdown-menu">
			<li><a href="#">Action</a></li>
			<li><a href="#">Another action</a></li>
		  </ul>
		</li>
		@if(Auth::check())
		<li><a href="{{ URL::to('logout') }}">Logout {{ Auth::user()->name }}</a></li>
		@endif
	  </ul>
	</div><!--/.nav-collapse -->
  </div>
</div>
<div id="top">
	<div class="content">
	@if(Auth::check())
		<a href="{{ URL::to('logout') }}">Logout {{ Auth::user()->name }}</a> | {{ link_to_route('users.edit', trans('users.edit'), Auth::user()->id) }}
		@if(Auth::user()->hasRole('admin'))
			| Administrator
		@endif
	@else
		<a href="{{ URL::to('login') }}">{{ trans('users.login') }}</a> | <a href="{{ URL::to('register') }}">{{ trans('users.register') }}</a>
	@endif
	</div>
</div>
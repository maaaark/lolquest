<html>
	<head>
		<title>LolQuest</title>
		{{ HTML::style('css/style.css') }}
	</head>
    <body>
	
	<div id="page">
		@if(Auth::check())
			<a href="{{ URL::to('logout') }}">Logout {{ Auth::user()->name }}</a>
		@else
			<a href="{{ URL::to('login') }}">Login</a>
		@endif
		<br/><br/>
		@if(Session::has('message'))
			<p class="alert">{{ Session::get('message') }}</p>
		@endif
		@yield('content')
	</div>
    
	{{ HTML::script('js/custom.js') }}	
    </body>
</html>
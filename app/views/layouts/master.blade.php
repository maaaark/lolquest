<html>
	<head>
		<title>LolQuest</title>
		{{ HTML::style('css/style.css') }}
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		{{ HTML::script('js/custom.js') }}
	</head>
    <body>
	
	@include('layouts.top')
	
	<div id="page">
		@if(Session::has('message'))
			<p class="alert">{{ Session::get('message') }}</p>
		@endif
		
		@if(Auth::check())
			@if(Auth::user()->summoner_status == 0)
			<div class="bs-callout bs-callout-warning">
				<h4>Warning!</h4>
				{{ trans("users.empty_summoner") }}
			</div>
			@elseif(Auth::user()->summoner_status == 1)
			<div class="bs-callout bs-callout-warning">
				{{ trans("users.not_verified") }}
			</div>
			@endif
			
		@endif
		
		@yield('content')
	</div>
    
    </body>
</html>
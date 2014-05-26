<html>
	<head>
		<title>lolquest.net - @yield('title')</title>
		{{ HTML::style('css/style.css') }}
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		{{ HTML::script('js/custom.js') }}
	</head>
    <body>
	
	@include('layouts.top')
	
	<div class="background">
		<div class="container">
			<div class="title"><h1>@yield('title')</h1></div>
		</div>
		<div class="container content-wrapper">	
			<div class="row">
				<div class="col-md-12">
				@if(Session::has('message'))
					<div class="bs-callout bs-callout-warning">
						{{ Session::get('message') }}
					</div>
				@endif
				@if(Session::has('error'))
					<div class="bs-callout bs-callout-danger">
						{{ Session::get('error') }}
					</div>
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
			</div>
		</div>
	</div>
    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-51337940-1', 'lolquest.net');
	  ga('send', 'pageview');

	</script>
    </body>
</html>
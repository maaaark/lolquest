<html>
	<head>
		<title>lolquest.net - @yield('title')</title>
		{{ HTML::style('css/style.css') }}
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
		<link href='http://fonts.googleapis.com/css?family=Cabin+Condensed:400,700' rel='stylesheet' type='text/css'>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<script src="/js/jquery.countdown.js"></script>
		{{ HTML::script('js/custom.js') }}
	</head>
    <body>
	
	
	@include('layouts.top')
	
	<img src="/img/blur.jpg" class="bg" />

	<div id="wrapper">
		<div class="container title-wrapper">
			<div class="title"><h1>@yield('title')</h1></div>
		</div>
		<div class="container content-wrapper">	
			<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
				@include('layouts.errors')

				@yield('content')
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 sidebar">
				@include('layouts.sidebar')
				</div>
			</div>
		</div>
	</div>
    
    </body>
</html>
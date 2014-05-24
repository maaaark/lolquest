<html>
	<head>
		<title>lolquest.net - @yield('title')</title>
		{{ HTML::style('css/style.css') }}
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
		<!--<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		-->
		<script src="/js/jquery.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/jquery.countdown.min.js"></script>
		@include('layouts.countdown')
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
			
				<table>
					<tr>
						<td valign="top" class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
							@include('layouts.errors')

							@yield('content')
						</td>
						<td valign="top" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 sidebar">
							@include('layouts.sidebar')
						</td>
					</tr>
				</table>

			</div>
		</div>
		<div class="container">
			@include('layouts.footer')
		</div>
	</div>
    
    </body>
</html>
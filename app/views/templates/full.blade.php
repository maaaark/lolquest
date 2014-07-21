<!DOCTYPE html>
<html>
	<head>
		<title>lolquest.net - @yield('title')</title>
		<link rel="icon" type="image/x-icon" href="/img/favicon.ico">
		<link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
		<link type="image/x-icon" href="/img/favicon.ico">
		<meta name="description" content="{{ trans('meta.description') }}" />
		<meta name="keywords" content="league of legends, quest, daily, skins, reward, lol, euw, na, rp, ep-boost, qp"/>
		{{ HTML::style('css/style.css') }}
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="/css/font-awesome.min.css">
		<script src="/js/jquery.min.js"></script>
	</head>
    <body>
	
	
	@include('layouts.top')
	

	
	<div id="wrapper">
		<div class="container title-wrapper">
			
		</div>
		
		<div class="container content-wrapper">	
			
			<div class="row">
				<div id="navigation">
					@include('layouts.navigation')
				</div>
				@include('layouts.errors')

				@yield('content')

			</div>
		</div>
		<div class="container">
			@include('layouts.footer')
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
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-51337940-2', 'auto');
  ga('send', 'pageview');

</script>
    </body>
</html>
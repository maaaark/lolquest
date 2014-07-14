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
		<link rel="stylesheet" href="/css/summernote.css">
		<script src="/js/jquery.min.js"></script>
	</head>
    <body>
	
	@include('layouts.top')
	
	<!-- <img src="/img/blur.jpg" class="bg" /> -->

	
	<div id="wrapper">
	
		@if(Auth::check())
			<div class="skin_left" style="background: url('http://images.lolquest.net/skins/{{ Auth::user()->skin_left }}')"></div>
			<div class="skin_right" style="background: url('http://images.lolquest.net/skins/{{ Auth::user()->skin_right }}')"></div>
		@else
			<div class="skin_left"></div>
			<div class="skin_right"></div>
		@endif
	
		
		<div class="container title-wrapper">
			@if(Config::get('settings.ads_enabled') == 1)
			<div id="banner_1">728x90</div>
			<div id="banner_2">160x600</div>
			@endif
			
		</div>
		
		<div class="container content-wrapper">	
			
			<div class="row">
				<div id="navigation">
					@include('layouts.navigation')
				</div>
				<table>
					<tr>
						<td valign="top" class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
							<div class="title"><h1>@yield('title')</h1></div>
							@include('layouts.errors')

							@yield('content')
							
							<br/>
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
    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-51337940-1', 'lolquest.net');
	  ga('send', 'pageview');

	</script>
	
	<script type="text/javascript" src="http://www.sponsorads.de/script.php?s=251949"></script>
	
	<script type="text/javascript" src="http://www.sponsorads.de/script.php?s=251948"></script>
    </body>
</html>
<html>
	<head>
		<title>lolquest.net - @yield('title')</title>
		
		
	</head>
    <body>
	
	@include('layouts.top')
	
	<div class="background">
		<div class="container">
		<div class="row ">
			<div class="col-md-7 col-lg-7">
			<div class="hexa_logo">
				<img src="/img/hexa_logo.png" alt="Welcome to lolquest" />
			</div>
			<div class="hexa_text">
				<div class="title"><img src="/img/welcome.png" alt="Welcome to lolquest" /></div>
			</div>
			<div class="clear"></div>
			<br/>
			<div class="landingpage_teaser">
				<br/>
				Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.<br/>
				<br/>	
			</div>
			</div>
		
			<div class="col-md-5  col-lg-5">
				<div class="register_form">
						<h2>{{ trans("start.register_now") }}</h2>
						{{ Form::open(array('url'=>'users/store', 'class'=>'')) }}
							<ul>
								@foreach($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						 
							{{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'E-Mail')) }}
							{{ Form::text('summoner_name', null, array('class'=>'form-control', 'placeholder'=>'Summoner Name')) }}
							{{ Form::select('region', array('0' => 'Select a Region', 'euw' => 'euw', 'na' => 'na'), null, array('class' => 'form-control')) }}
							{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
							{{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) }}
							{{ Form::submit('Register', array('class'=>'btn btn-large btn-success btn-block'))}}
						{{ Form::close() }}
						<hr/>
						{{ trans("start.have_account") }}<br/><br/>
						<a href="/login" class="btn btn-primary btn-large btn-block">{{ trans("start.login") }}</a><br/>
						<br/>
				</div>
			</div>
		</div>
		</div>
		<div class="navigation_wrapper">
			<div class="container">
				<div id="navigation">
					@include('layouts.navigation')
				</div>
			</div>
		</div>
					
		<div class="fullwidth_box_grey">
			<div class="container ">	
				<div class="row">
					
					<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
						<div class="lolquest_description">
						<h2>{{ trans("start.what_can_i_do_headline") }}</h2>
						{{ trans("start.what_can_i_do") }}<br/>
						<br/>
						{{ trans("start.free") }}<br/>
						<br/>
						<a href="#" class="btn btn-success">Register a new Account</a> or <a class="btn btn-primary" href="#">Login</a>
						</div>
					</div>
					<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
						<div class="lolquest_video">
							<img src="/img/lolquest_video.jpg" width="100%" alt="lolquest Video" />
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="fullwidth_box">
			<div class="container ">	
				<div class="col-lg-7">
					@yield('content')
				</div>
				<div class="col-lg-5">
					<br/><br/>
					<h2>{{ trans("start.recent") }}</h2>
					<div class="recent_activity">
						@include('timelines.clean_timeline', array('timelines' => $timelines))
					</div>
				</div>
			</div>
		</div>
		<div class="fullwidth_box">
			<div class="container ">	
				
			</div>
		</div>
	</div>
	{{ HTML::style('css/style.css') }}
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
	<link href='http://fonts.googleapis.com/css?family=Cabin+Condensed:400,700' rel='stylesheet' type='text/css'>
    <script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	{{ HTML::script('js/custom.js') }}
    </body>
</html>
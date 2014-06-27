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
				{{ trans("start.teaser") }} 
				<br/>
				<br/>	
			</div>
			</div>
		
			<div class="col-md-5  col-lg-5">
				<div class="register_form">
				
						@if(Config::get('settings.register') == "key")
						{{ Form::open(array('action' => 'UsersController@check_betakey')) }}
							<h2>{{ trans("start.join_beta") }}</h2>
							<ul>
								@foreach($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
							{{ Form::text('key', null, array('class'=>'form-control', 'placeholder'=>'Your Beta Key', 'class' => 'form-control')) }}
							{{ Form::submit('Register', array('class'=>'btn btn-large btn-success btn-block'))}}
							<a href="/login" class="btn btn-large btn-primary btn-block">Login</a>
						{{ Form::close() }}
						
						@else
						
						<h2>{{ trans("start.register_now") }}</h2>
						{{ Form::open(array('url'=>'users/store', 'class'=>'')) }}
							<ul>
								@foreach($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						 
							<div class="input-group">
								  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								  {{ Form::text('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>'E-Mail', 'class' => 'form-control')) }}
								</div>
								<br/>
								
								<div class="input-group">
								  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
								  {{ Form::text('summoner_name', null, array('class'=>'form-control', 'placeholder'=>'Summoner Name', 'class' => 'form-control')) }}
								</div>
								<br/>
								
								<div class="input-group">
								  <span class="input-group-addon"><i class="fa fa-globe"></i></span>
								  {{ Form::select('region', array('0' => 'Select a Region', 'euw' => 'euw', 'na' => 'na'), null, array('class' => 'form-control')) }}
								</div>
								<br/>
								
								<div class="input-group">
								  <span class="input-group-addon"><i class="fa fa-key"></i></span>
								  {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password', 'class' => 'form-control')) }}
								</div>
								<br/>
								
								<div class="input-group">
								  <span class="input-group-addon"><i class="fa fa-key"></i></span>
								  {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password', 'class' => 'form-control')) }}
								</div>
								<br/>
							{{ Form::submit('Register', array('class'=>'btn btn-large btn-success btn-block'))}}
						{{ Form::close() }}
						<hr/>
						<a href="/login" class="btn btn-primary btn-large btn-block">{{ trans("start.login") }}</a><br/>
						<br/>
						
						@endif
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
						<a href="/register" class="btn btn-success">{{ trans("start.register_now") }}</a>&nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;<a class="btn btn-primary" href="/login">Login</a>
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
					<a href="/timeline">See the full timeline</a>
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
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Cabin+Condensed:400,700' rel='stylesheet' type='text/css'>
    <script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	{{ HTML::script('js/custom.js') }}
    </body>
</html>
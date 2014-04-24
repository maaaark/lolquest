<html>
	<head>
		<title>lolquest.net - @yield('title')</title>
		{{ HTML::style('css/style.css') }}
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
		<link href='http://fonts.googleapis.com/css?family=Cabin+Condensed:400,700' rel='stylesheet' type='text/css'>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		{{ HTML::script('js/custom.js') }}
	</head>
    <body>
	
	@include('layouts.top')
	
	<div class="background">
		<div class="container ">
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
		<div class="fullwidth_box_grey">
			<div class="container ">	
				<div class="row">
					<div class="col-lg-8">
						<h2>What can i do on lolquest.net?</h2>
						Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.<br/>
						<br/>
						Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
					</div>
					<div class="col-md-4 register_form">
						<h2>Register now!</h2>
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
							{{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
						{{ Form::close() }}
						<hr/>
						Already have an lolquest.net account?<br/><br/>
						<a href="/login" class="btn btn-primary btn-large btn-block">Login</a><br/>
						<br/>
					</div>
				</div>
			</div>
		</div>
		<div class="fullwidth_box">
			<div class="container ">	
				@yield('content')
			</div>
		</div>
	</div>
    
    </body>
</html>
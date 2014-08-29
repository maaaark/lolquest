<html>
<head>
    <title>lolquest.net - League of Legends questing</title>
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <link type="image/x-icon" href="/img/favicon.ico">
    <meta name="language" content="en">
    <meta name="description" content="{{ trans('meta.description') }}" />
    <meta name="keywords" content="lolquest, league of legends, quest, daily, skins, reward, lol, euw, na, rp, ep-boost, qp"/>
    {{ HTML::style('css/style.css') }}
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

                    <hr/>

                    <h3>No Beta Key yet?</h3>
                    <a href="/supporter" class="btn btn-large btn-primary btn-block">Support us and get a Beta Key</a><br/>
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
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- lolquest start_rectangle -->
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:336px;height:280px"
                             data-ad-client="ca-pub-5331969279811198"
                             data-ad-slot="1611228261"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                        <!--<img src="/img/lolquest_video.jpg" width="100%" alt="lolquest Video" />-->
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
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- lolquest leaderboard -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="ca-pub-5331969279811198"
                 data-ad-slot="7231103062"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
</div>
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Cabin+Condensed:400,700' rel='stylesheet' type='text/css'>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
{{ HTML::script('js/custom.js') }}
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-51337940-1', 'lolquest.de');
    ga('send', 'pageview');

</script>
</body>
</html>
@if(Session::get('livestream'))
<div class="sidebar_box">
		<div class="sidebar_headline"><i class="fa fa-video-camera"></i>&nbsp;&nbsp;{{ trans("sidebar.livestream") }}</div>
		<div class="livestream">
			<object type="application/x-shockwave-flash" height="180" width="290" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=lolquest_net" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=www.twitch.tv&channel=lolquest_net&auto_play=false&start_volume=25" /></object>
		</div>
</div>
@endif

	
<div class="sidebar_box">
	<div class="sidebar_headline" style="margin-bottom: 0;"><i class="fa fa-key"></i>&nbsp;&nbsp;{{ trans("start.join_beta") }}</div>
	<div style="margin-left: -10px; padding: 10px;">
	{{ Form::open(array('action' => 'UsersController@check_betakey')) }}
	@if($errors)
	<ul>
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
	@endif
	{{ Form::text('key', null, array('class'=>'form-control', 'placeholder'=>'Your Beta Key', 'class' => 'form-control')) }}<br/>
	{{ Form::submit('Register', array('class'=>'btn btn-large btn-success btn-block'))}}
	<a href="/login" class="btn btn-large btn-primary btn-block">Login</a>
	{{ Form::close() }}
	<br/><br/>

	<h3>No Beta Key yet?</h3>
	<a href="/supporter" class="btn btn-large btn-primary btn-block">Support us and get a Beta Key</a><br/>
	</div>
</div>

<br/>

<div style="margin-left: -10px;">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- lolquest rectangle -->
<ins class="adsbygoogle"
	 style="display:inline-block;width:300px;height:250px"
	 data-ad-client="ca-pub-5331969279811198"
	 data-ad-slot="3719233468"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
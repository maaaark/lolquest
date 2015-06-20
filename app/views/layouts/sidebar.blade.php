@if(Session::get('livestream'))
<div class="sidebar_box">
		<div class="sidebar_headline"><i class="fa fa-video-camera"></i>&nbsp;&nbsp;{{ trans("sidebar.livestream") }}</div>
		<div class="livestream">
			<object type="application/x-shockwave-flash" height="180" width="290" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=lolquest_net" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=www.twitch.tv&channel=lolquest_net&auto_play=false&start_volume=25" /></object>
		</div>
</div>
@endif

<div class="sidebar_box">
		<div class="sidebar_headline"><i class="fa fa-facebook-square"></i>&nbsp;&nbsp;{{ trans("sidebar.social_media") }}</div>
		<div class="sidebar_social">
			<div class="fb-like" data-width="295" data-href="https://www.facebook.com/lolquest.net" data-layout="standard" data-colorscheme="dark" data-action="like" data-show-faces="true" data-share="true"></div>
			<br/><br/>
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://lolquest.net" data-text="A League of Legends Questing Platform" data-via="lolquest_net" data-hashtags="lolquest">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		
		<a href="https://twitter.com/lolquest_net" class="twitter-follow-button" data-show-count="false">Follow @lolquest_net</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

		</div>
</div>	

<!-- 
@if(Auth::check())
	@if(Session::get('notifications_amount') > 0)

	<div class="sidebar_box">
		<div class="sidebar_headline"><span class="new_notifications"><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;{{ Session::get('notifications_amount') }}</span> &nbsp;&nbsp;{{ trans("sidebar.new_note") }}</div>
		<div class="delete_all_notes"><a href="/delete_notifications"><span class="glyphicon glyphicon-trash"></span> {{ trans("sidebar.remove_notes") }}</a></div>
		<ul class="notifications_list">
			@foreach(Session::get('notifications') as $note)
			<li id="note_{{ $note->id }}">
				<div class="note_icon">
					@if($note->type == 1)
						<span class="glyphicon glyphicon-asterisk"></span>
					@elseif($note->type == 2)
						<span class="glyphicon glyphicon-comment"></span>
					@elseif($note->type == 3)
						<span class="glyphicon glyphicon-user"></span>
                    @elseif($note->type == 4)
                    <span class="fa fa-group"></span>
					@endif
				</div>
				<div class="note_message">
					@if($note->type == 1)
						<a href="/summoner/{{ Auth::user()->region }}/{{ Auth::user()->summoner_name }}/achievements">{{ $note->message }}</a>
					@elseif($note->type == 2)
						<a href="#">{{ $note->message }}</a>
					@elseif($note->type == 3)
						<a href="/settings">{{ $note->message }}</a>
					@elseif($note->type == 4)
						{{ $note->message }}
					@endif
				</div>
				<div class="delete_note"><a href="/notifications/delete_note/{{ $note->id }}">x</a></div>
				<div class="clear"></div>
			</li>
			@endforeach
		</ul>
		<div class="clear"></div>
	</div>
	@endif

-->
	@if(Auth::check())
		@if(Auth::user()->team_id < 0)
			<div class="sidebar_box">
					<div class="sidebar_headline"><i class="fa fa-group"></i>&nbsp;&nbsp;{{ trans("sidebar.my_team") }}</div>
					<table>
						<tr>
							<td width="60"><a href="/teams/{{ Auth::user()->team->region }}/{{ Auth::user()->team->clean_name }}"><img src="/img/teams/logo/{{ Auth::user()->team->logo }}" width="40" class="img-circle" /></a></td>
							<td valign="top">
								<a href="/teams/{{ Auth::user()->team->region }}/{{ Auth::user()->team->clean_name }}"><strong>{{ Auth::user()->team->name }}</strong></a><br/>
								Rang: {{ Auth::user()->team->rank }}&nbsp;&nbsp;&nbsp;({{ Auth::user()->team->exp }} EXP)<br/>
								Member: {{ Auth::user()->team->members->count() }}
							</td>
						</tr>
					</table>
			</div>
		@endif
	@endif
	
	@if(Session::has('daily_quest'))
	<div class="sidebar_box">
		<div class="sidebar_headline"><span class="glyphicon glyphicon-star"></span>&nbsp;&nbsp;Daily Quest</div>
		<div class="daily_quest">
			<table>
				<tr>
					<td valign="top" width="100%" style="padding-left: 10px;">
						<div class="daily_headline">{{ Session::get('daily_quest')->questtype->name }}&nbsp;&nbsp;&nbsp;(<span class="clock"></span>)</div>
						<div class="sidebar_questtext">{{ trans("quests.".Session::get('daily_quest')->questtype->id) }}</div>
						<div class="daily_reward">{{ Session::get('daily_quest')->questtype->qp * 2 }} QP + {{ Session::get('daily_quest')->questtype->exp * 2 }} EXP</div>
						<div class="accept_daily"><a href="/accept_daily" class="">{{ trans("sidebar.accept_quest") }}</a></div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	@endif



	
	<div class="sidebar_box">
	<div class="sidebar_headline"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;{{ trans("sidebar.active_quests") }}</div>
		<table class="sidebar_questlist">
		@if(Session::has('my_open_quests'))
			@foreach(Session::get('my_open_quests') as $quest)
			<tr>
				<td valign="top">
					<a href="/dashboard">{{ $quest->questtype->name }}</a><br/>
					<div class="sidebar_questtext">{{ trans("quests.".$quest->type_id) }}</div>
				</td>
			</tr>
			@endforeach
		@else
			{{ trans("sidebar.no_quest") }}
		@endif
	</table>
	</div>
	
	@if(Session::has('friend_ladder'))
	<div class="sidebar_box">
	<div class="sidebar_headline"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;{{ trans("sidebar.friends_ladder") }} ({{ date("F") }})</div>
		<table class="sidebar_questlist" style="border-bottom: 1px solid #ddd;">
			@if(Session::get('my_ladder_rang'))
				<tr style="background: #2d2d2d;">
					<td width="30">{{ Session::get('my_ladder_rang')->rang }}.</td>
					<td width="40" class="hidden-xs"><strong><a href="/summoner/{{ Session::get('my_ladder_rang')->user->region }}/{{ Session::get('my_ladder_rang')->user->summoner_name }}">
					<img src="http://ddragon.leagueoflegends.com/cdn/5.8.1/img/profileicon/{{ Session::get('my_ladder_rang')->user->summoner->profileIconId }}.png" class="img-circle" width="25" />
					</a></strong></td>
					<td width="140"><strong><a href="/summoner/{{ Session::get('my_ladder_rang')->user->region }}/{{ Session::get('my_ladder_rang')->user->summoner_name }}">{{ Session::get('my_ladder_rang')->user->summoner_name }}</a></strong></td>
					<td class="hidden-sm hidden-xs"><strong>{{ Session::get('my_ladder_rang')->month_exp }} EXP</strong></td>			
				</tr>
			@endif
		</table>
		<table class="sidebar_questlist" style="margin-bottom: 5px;">
			@foreach(Session::get('friend_ladder') as $friend_ladder)
				<tr>
					<td width="30">{{ $friend_ladder->rang }}.</td>
					<td width="40" class="hidden-xs"><a href="/summoner/{{ $friend_ladder->region }}/{{ $friend_ladder->summoner_name }}">
					<img src="http://ddragon.leagueoflegends.com/cdn/5.8.1/img/profileicon/{{ $friend_ladder->profileIconId }}.png" class="img-circle" width="25" />
					</a></td>
					<td width="140"><a href="/summoner/{{ $friend_ladder->region }}/{{ $friend_ladder->summoner_name }}">{{ $friend_ladder->summoner_name }}</a></td>
					<td class="hidden-sm hidden-xs">{{ $friend_ladder->month_exp }} EXP</td>			
				</tr>
			@endforeach
		</table>
		<div class="view_ladder"><a href="/ladders">{{ trans("sidebar.view_ladder") }}</a>&nbsp;&nbsp;&nbsp;</div><br/>
	</div>
	@endif
@else
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
@endif
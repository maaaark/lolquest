@if(Auth::check())
	
	@if(Session::get('notifications_amount') > 0)

	<div class="sidebar_box">
		<div class="sidebar_headline"><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;{{ Session::get('notifications_amount') }} new Notifications</div>
		<ul class="notifications_list">
			@foreach(Session::get('notifications') as $note)
			
			<li id="note_{{ $note->id }}">
				<div class="note_icon">
					@if($note->type == 1)
						<span class="glyphicon glyphicon-asterisk"></span>
					@elseif($note->type == 2)
						<span class="glyphicon glyphicon-comment"></span>
					@endif
				</div>
				<div class="note_message">
					<a href="#">{{ $note->message }}</a>
				</div>
				<div class="delete_note"><a href="/notifications/delete_note/{{ $note->id }}">x</a></div>
				<div class="clear"></div>
			</li>
			@endforeach
		</ul>
		<div class="clear"></div>
	</div>
	@endif
			
	
	<div class="sidebar_box">
	<div class="sidebar_headline"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;{{ trans("sidebar.logged_in_headline") }}</div>
	<div class="uppercase">{{ trans("sidebar.level") }} {{Auth::user()->level_id}} ({{ Session::get('user_exp') }}  / {{Auth::user()->level->exp_level}}):</div>
	<div class="progress">
	  <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{ Session::get('user_percent') }}% ;">
		{{ Session::get('user_percent') }} %
	  </div>
	</div>
	<table class="logged_in">
		<tr>
			<td valign="top" style="text-align: center; padding-right: 10px;" class="hidden-sm hidden-xs">
				<a class="summoner_avatar" href="/summoner/{{ Auth::user()->region }}/{{ Auth::user()->summoner_name }}">
					<img src="/img/profileicons/profileIcon{{ Auth::user()->summoner->profileIconId }}.jpg" width="70" class="profile_avatar" />
					<span class="border"><img src="/img/border/silver_border.png" width="70" /></span>
				</a><br/>
			</td>
			<td valign="top">
				<a href="/dashboard">{{ trans("sidebar.myquest") }}</a><br/>
				<a href="/users/{{ Auth::user()->id }}/edit">{{ trans("sidebar.settings") }}</a><br/>
				<a href="/logout" class="logout">{{ trans("sidebar.logout") }}</a>
			</td>
		</tr>
	</table>
	</div>

	<!-- SEARCH -->
	<div class="sidebar_box">
	<div class="sidebar_headline"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;{{ trans("sidebar.search") }}</div>
	{{ Form::open(array('url'=>'/search','action' => 'BaseController@search_summoner', 'style'=>'margin-bottom: 0;')) }}
		<div class="search_field">{{ Form::text('summoner_name', null, array('class' => 'form-control search_summoner_name', 'placeholder' => 'Search Summoner')) }}</div>
		<div class="search_field">{{ Form::submit('Search', array('class' => 'btn btn-primary')) }}</div>
		<div class="clear"></div>
	{{ Form::close() }}
	</div>
	
	
	@if(Session::has('daily_quest'))
	<div class="sidebar_box">
		<div class="sidebar_headline"><span class="glyphicon glyphicon-star"></span>&nbsp;&nbsp;Daily Quest</div>
		<div class="daily_quest">
			<table>
				<tr>
					<td valign="top" class="hidden-sm hidden-xs" width="50"><a href="/champions/{{ Session::get('daily_quest')->champion->key }}"><img class="img-circle" src="/img/champions/{{ Session::get('daily_quest')->champion_id }}_92.png" width="40"></a></td>
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
				<td valign="top" class="hidden-sm hidden-xs" width="50"><a href="/dashboard"><img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="/img/champions/{{ $quest->champion_id }}_92.png" width="40"></a></td>
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
					<td width="40" class="hidden-sm hidden-xs"><strong><a href="/summoner/{{ Session::get('my_ladder_rang')->user->region }}/{{ Session::get('my_ladder_rang')->user->summoner_name }}">
					<img src="/img/profileicons/profileIcon{{ Session::get('my_ladder_rang')->user->summoner->profileIconId }}.jpg" class="img-circle" width="25" />
					</a></strong></td>
					<td width="140"><strong><a href="/summoner/{{ Session::get('my_ladder_rang')->user->region }}/{{ Session::get('my_ladder_rang')->user->summoner_name }}">{{ Session::get('my_ladder_rang')->user->summoner_name }}</a></strong></td>
					<td class="hidden-sm hidden-xs"><strong>{{ Session::get('my_ladder_rang')->month_exp }} EXP</strong></td>			
				</tr>
			@endif
		</table>
		<table class="sidebar_questlist" style="margin-bottom: 5px;">
			@foreach(Session::get('friend_ladder') as $friend_ladder)
				@if ( Auth::user()->isFriend( $friend_ladder->id) == 'checked')
				<tr>
					<td width="30">{{ $friend_ladder->rang }}.</td>
					<td width="40" class="hidden-sm hidden-xs"><a href="/summoner/{{ $friend_ladder->region }}/{{ $friend_ladder->summoner_name }}">
					<img src="/img/profileicons/profileIcon{{ $friend_ladder->profileIconId }}.jpg" class="img-circle" width="25" />
					</a></td>
					<td width="140"><a href="/summoner/{{ $friend_ladder->region }}/{{ $friend_ladder->summoner_name }}">{{ $friend_ladder->summoner_name }}</a></td>
					<td class="hidden-sm hidden-xs">{{ $friend_ladder->month_exp }} EXP</td>			
				</tr>
				@endif
			@endforeach
		</table>
		<div class="view_ladder"><a href="/ladders">{{ trans("sidebar.view_ladder") }}</a>&nbsp;&nbsp;&nbsp;</div><br/>
	</div>
	@endif
	
@else
	<br/>
	<h3>{{ trans("sidebar.login_headline") }}</h3>
	{{ Form::open(array('url' => 'login')) }}
		{{ Form::text('email', Input::old('email'), array('placeholder' => 'example@lolquest.net', 'class' => 'form-control')) }}
		{{ Form::password('password', array('class' => 'form-control')) }}
		{{ Form::submit('Login', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@endif
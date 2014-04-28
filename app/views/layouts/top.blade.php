<!-- Fixed navbar -->
<div class="navigation">
  <div class="container">
	<div class="logo"><a href="/"><img src="/img/logo.jpg"></a></div>
	<div class="list">
		<ul class="">
		
		@if(Auth::check())
			<li><a href="/logout"><span class="glyphicon glyphicon-remove"></span> <span class="hidden-xs">Logout</span></a></li>
			<li><a href="#">LVL {{Auth::user()->ulevel}} | {{Auth::user()->exp}} / {{Level::find(Auth::user()->ulevel)->exp}} EXP | {{ Auth::user()->qp }} QP</a></li>
			<li>
				<a href="/summoner/{{ Auth::user()->region }}/{{ Auth::user()->summoner_name }}">
					<div class="avatar"><img src="/img/profileicons/profileIcon{{ Auth::user()->summoner->profileIconId }}.jpg" class="img-circle" width="20" style="display: inline;" /></div>
					<div class="name hidden-xs">{{ Auth::user()->summoner_name }} </div>
					<div class="clear"></div>
				</a>
			</li>
			<li class="navigation_natifications">
				
				<a href="/users"><span class="glyphicon glyphicon-comment"></span> <span class="hidden-xs">Notifications</span> </a> 
			@if(Session::get('notifications_amount') > 0)
				<span class="unread_notifications img-circle">{{ Session::get('notifications_amount') }}</span>
			@endif
			@if(Session::get('notifications_amount') > 0)	
				<ul class="notifications_list">
					@foreach(Session::get('notifications') as $note)
						<li><a href="#">{{ $note->message }}</a></li>
					@endforeach
				</ul>
				<div class="clear"></div>
			@endif
			</li>
			
			<li><a href="/ladders"><span class="glyphicon glyphicon-list"> </span> <span class="hidden-xs">Ladders</span></a></li>
			<li><a href="/users"><span class="glyphicon glyphicon-user"></span> <span class="hidden-xs">Summoners</span></a></li>
			
		@else
			<li><a href="/login"><span class="glyphicon glyphicon-user"> </span> <span class="hidden-xs">Login</span></a></li>
			<li><a href="/users/create"><span class="glyphicon glyphicon-ok"></span> <span class="hidden-xs">Register</span></a></li>
		@endif
		
	</ul>
	</div>
	<div class="clear"></div>
  </div>
</div>
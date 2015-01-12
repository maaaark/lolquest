<!-- Fixed navbar -->
<div class="navigation">
  <div class="container">
	<div class="logo"><a href="/"><img src="/img/logo.jpg"></a></div>
	<div class="list">
		<ul class="">
		
		@if(Auth::check())
			<li><a href="/logout"><span class="glyphicon glyphicon-remove"></span> <span class="hidden-xs hidden-sm">Logout</span></a></li>
			<li><a href="/settings"><span class="glyphicon glyphicon-cog"></span> <span class="hidden-xs hidden-sm">Settings</span></a></li>
			<li class=""><strong><a href="/shop">{{ Auth::user()->qp }} QP</a></strong></li>
			@if(Auth::user()->hasRole('admin'))
			<li class=""><strong><a href="/shop/gold">{{ Auth::user()->lp }} Gold</a></strong></li>
			@endif
			<li>
				<a href="/summoner/{{ Auth::user()->region }}/{{ Auth::user()->summoner_name }}">
					<div class="avatar"><img src="http://ddragon.leagueoflegends.com/cdn/4.21.5/img/profileicon/{{ Auth::user()->summoner->profileIconId }}.png" class="img-circle" width="20" style="display: inline;" /></div>
					<div class="name hidden-xs hidden-sm">{{ Auth::user()->summoner->name }} </div>
					<div class="clear"></div>
				</a>
			</li>
			
			<li style="width: 230px !important; padding-left: 10px; padding-right: 10px; padding-top: 7px; line-height: 20px !important;">
				<div class="uppercase small">{{ trans("sidebar.level") }} {{Auth::user()->level_id}} ({{ Session::get('user_exp') }}  / {{Auth::user()->level->exp_level - Auth::user()->level->exp}}):</div>
				<div class="progress">
				  <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{ Session::get('user_percent') }}% ;"></div>
				</div>
			</li>
			<li></li>
		@else
			<li><a href="/login"><span class="glyphicon glyphicon-ok"> </span> <span class="hidden-xs">Login</span></a></li>
			<li><a href="/users/create"><span class="glyphicon glyphicon-user"></span> <span class="hidden-xs">Register</span></a></li>
		@endif
		
	</ul>
	</div>
	<div class="clear"></div>
  </div>
</div>
<ul>
	<li><a href="/logout"><span class="glyphicon glyphicon-remove"></span> <span class="hidden-xs hidden-sm">Logout</span></a></li>
	<li class=""><a href="/shop"><span class="glyphicon glyphicon-shopping-cart"></span> <span class="hidden-xs hidden-sm">Shop</span></a></li>
	<li class=""><a href="#">{{ Auth::user()->qp }} QP</a></li>
	<li>
		<a href="/summoner/{{ Auth::user()->region }}/{{ Auth::user()->summoner_name }}">
			<div class="avatar"><img src="/img/profileicons/profileIcon{{ Auth::user()->summoner->profileIconId }}.jpg" class="img-circle" width="20" style="display: inline;" /></div>
			<div class="name hidden-xs hidden-sm">{{ Auth::user()->summoner_name }} </div>
			<div class="clear"></div>
		</a>
	</li>			
	<li><a href="/ladders"><span class="glyphicon glyphicon-list"> </span> <span class="hidden-xs hidden-sm">Ladders</span></a></li>
	<li><a href="/dashboard"><span class="glyphicon glyphicon-dashboard"></span> <span class="hidden-xs hidden-sm">My Quests</span></a></li>
</ul>
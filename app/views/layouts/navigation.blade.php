<ul>
	<li><a href="/dashboard"><span class="glyphicon glyphicon-dashboard"></span> <span class="hidden-xs hidden-sm">Quests</span></a></li>
	<li><a href="/challenges"><span class="glyphicon glyphicon-certificate"></span> <span class="hidden-xs hidden-sm">Challenges</span></a></li>
    <li><a href="/timeline"><span class="glyphicon glyphicon-dashboard"></span> <span class="hidden-xs hidden-sm">Timeline</span></a></li>
	<li><a href="/shop"><span class="glyphicon glyphicon-shopping-cart"></span> <span class="hidden-xs hidden-sm">Shop</span></a></li>
	<li><a href="/ladders"><i class="fa fa-trophy"></i> <span class="hidden-xs hidden-sm">Ladders</span></a></li>
    <li><a href="/ladders/top100"><i class="fa fa-trophy"></i> <span class="hidden-xs hidden-sm">Top 100</span></a></li>
    <!--<li><a href="/lottery"><i class="fa fa-group"></i> <span class="hidden-xs hidden-sm">Lottery</span></a></li>
    <li><a href="/champions"><span class="glyphicon glyphicon-list"> </span> <span class="hidden-xs hidden-sm">Champions</span></a></li>-->
	<li><a href="/forum"><i class="fa fa-folder-open"></i> <span class="hidden-xs hidden-sm">Forum</span></a></li>
</ul>
<div class="search">
	{{ Form::open(array('url'=>'/search','action' => 'BaseController@search_summoner', 'style'=>'margin-bottom: 0;')) }}
		<div class="search_field search_icon"><span class="glyphicon glyphicon-search"> </span></div>
		<div class="search_field">{{ Form::text('summoner_name', null, array('class' => 'form-control search_summoner_name', 'placeholder' => 'Search Summoner or Team')) }}</div>
		<div class="search_field">{{ Form::submit('Search', array('class' => 'btn btn-dark')) }}</div>
		<div class="clear"></div>
	{{ Form::close() }}
</div>
<div class="clear"></div>
@extends('templates.default')
@if($user->summoner)
	@section('title', trans("users.profile")." ".$user->summoner->name." <i>".$user->title()."</i>")
@else
	@section('title', trans("users.profile")." ".$user->summoner->name." <i>".$user->title()."</i>")
@endif

@section('content')	
	<br/>
	@if($user->summoner)
	<table width="100%" class="profile">
		<tr>
			<td valign="top" width="130" style="text-align: center; padding-right: 15px;">
				<img src="/img/profileicons/profileIcon{{ $user->summoner->profileIconId }}.jpg" width="100" class="img-circle" /><br/>
				<br/>
				{{ trans("users.level_profile") }}: {{ $user->level_id }}<br/><br/>
				@if(Auth::user())
					@if($user->id != Auth::user()->id)
						@if ( Auth::user()->isFriend($user->id) == 'checked')
							{{ trans("friends.already") }}
						@elseif ( Auth::user()->isFriend( $user->id) == 'unchecked')
							{{ trans("friends.unconfirmed") }}
						@elseif (Auth::user()->isFriend( $user->id) == 'nofriends') 
							<a href="/user_friend/{{$user->id}}" class="btn btn-primary">{{ trans("friends.request") }}</a>
						@elseif (Auth::user()->isFriend( $user->id) == 'invited') 
							<a href="/accept_friend/{{$user->id}}" class="btn btn-primary">{{ trans("friends.accept") }}</a>
						@endif
					@else
						<a href="/settings" class="btn btn-primary">{{ trans("users.settings") }}</a>
					@endif
				@endif
				@if(Auth::check())
					@if(Auth::user()->hasRole('admin'))
						<br/><a href="/admin/login_as/{{ $user->id }}">Login as {{ $user->summoner->name }}</a>
					@endif
				@endif
			</td>
			<td width="400" valign="top">
				<table class="table table-striped" stlye="width: 100%;">
					<tr>
						<td width="130" class="attribute">{{ trans("users.summoner_name") }} </td>
						<td>{{ $user->summoner->name }}</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("users.region") }}</td>
						<td>{{ $user->region }}</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("users.level") }}</td>
						<td>{{ $user->summoner->summonerLevel }}</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("users.verified") }}</td>
						<td>
							@if( $user->summoner_status == 2)
								{{ trans("users.is_verified") }}
							@else
								{{ trans("users.profile_not_verified") }}
							@endif
						</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("users.quests_completed") }}</td>
						<td>{{ $user->completed_quests() }}</td>
					</tr>
					<tr>
						<td class="attribute">{{ trans("users.achievement_points") }}</td>
						<td><img src="/img/ap.png" width="20" /> {{ $user->achievement_points}} <!--{{ date("d.m.Y",strtotime($user->created_at)) }} --></td>
					</tr>
				</table>
			</td>
			<td valign="top">
				<div class="profile_season_stats">
					<table class="table table-striped" style="margin-bottom: 0;">
					@if($ladder)
						<tr>
							<td colspan="2"><strong>{{ trans("users.ranked_stats") }}</strong></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align: center;">
									@if($ladder->rang <= 3)
										<img src="/img/leagues/challenger_5.png" height="55" />
									@elseif($ladder->rang <= 10)
										<img src="/img/leagues/diamond_5.png" height="55" />
									@elseif($ladder->rang <= 25)
										<img src="/img/leagues/platinum_5.png" height="55" />
									@elseif($ladder->rang <= 50)
										<img src="/img/leagues/gold_5.png" height="55" />	
									@elseif($ladder->rang <= 100)
										<img src="/img/leagues/silver_5.png" height="55" />
									@elseif($ladder->rang >= 101)
										<img src="/img/leagues/bronze_5.png" height="55" />
									@endif
							</td>
						</tr>
						<tr>
							<td>Current Rang</td>
							<td>{{ $ladder->rang }}</td>
						</tr>
						<tr>
							<td>Quests</td>
							<td>{{ $ladder->total_quests }}</td>
						</tr>
						<tr>
							<td>Total EXP</td>
							<td>{{ $ladder->month_exp }}</td>
						</tr>
						</table>
						@else
						<tr>
							<td colspan="2"><strong>{{ trans("users.ranked_stats") }}</strong></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align: center;">
								<img src="/img/leagues/0_5.png" height="55" />
							</td>
						</tr>
						</table>
						<div style="text-align: center; font-style: italic;">
							<br/>
							{{ trans("users.not_ranked") }}
						</div>
						@endif
					
					
				</div>
			</td>
		</tr>
	</table>
	

	
	<ul id="myTab" class="nav nav-tabs">
      <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
	  <li><a href="#last_games" data-toggle="tab">Last Games</a></li>
	  <li><a href="#quest_progress" data-toggle="tab">Quest Progress</a></li>
    </ul>
	
	<div id="myTabContent" class="tab-content">
      <div class="tab-pane active" id="profile">
		<!-- PROFILE -->
			<table width="100%">
				<tr>
					<td width="50%" valign="top" style="padding-right: 20px;">
						<h3>{{ trans("users.quests_done") }}</h3>
						<table class="table table-striped">
						@foreach($quests_done as $quest)
							<tr>
								<td width="50">
									<img src="/img/champions/{{ $quest->champion_id }}_92.png" class="img-circle" width="35" />
								</td>
								<td>
									{{ $quest->questtype->name }}
									@if($quest->daily == 1) 
										(Daily Quest)
									@endif
									<br/>
									<div class="quest_description">{{ trans("quests.".$quest->type_id) }}</div>
								</td>
							</tr>
						@endforeach
						</table>
					</td>
					<td width="50%" valign="top">
						<h3>{{ trans("achievements.achievements") }}</h3>
						
						@if($user->trophy_top == 0) 
							<div class="challenge_tropy_open"><img class="img-circle trophy" alt="" src="/img/trophy/top.jpg" title="Top Lane Trophy" width="70"></div>
						@else 
							<div class="challenge_tropy_finished"><img class="img-circle trophy" alt="" src="/img/trophy/top.jpg" title="Top Lane Trophy" width="70"></div>
						@endif
						
						@if($user->trophy_jungle == 0) 
							<div class="challenge_tropy_open"><img class="img-circle trophy" alt="" src="/img/trophy/jungle.jpg" title="Jungler Trophy" width="70"></div>
						@else 
							<div class="challenge_tropy_finished"><img class="img-circle trophy" alt="" src="/img/trophy/jungle.jpg" title="Jungler Trophy" width="70"></div>
						@endif
						
						@if($user->trophy_mid == 0) 
							<div class="challenge_tropy_open"><img class="img-circle trophy" alt="" src="/img/trophy/mid.jpg" title="Mid Lane Trophy" width="70"></div>
						@else 
							<div class="challenge_tropy_finished"><img class="img-circle trophy" alt="" src="/img/trophy/mid.jpg" title="Mid Lane Trophy" width="70"></div>
						@endif
						
						@if($user->trophy_marksman == 0) 
							<div class="challenge_tropy_open"><img class="img-circle trophy" alt="" src="/img/trophy/marksman.jpg" title="Marksman Trophy" width="70"></div>
						@else 
							<div class="challenge_tropy_finished"><img class="img-circle trophy" alt="" src="/img/trophy/marksman.jpg" title="Marksman Trophy" width="70"></div>
						@endif
						
						@if($user->trophy_support == 0) 
							<div class="challenge_tropy_open"><img class="img-circle trophy" alt="" src="/img/trophy/support.jpg" title="Support Trophy" width="70"></div>
						@else 
							<div class="challenge_tropy_finished"><img class="img-circle trophy" alt="" src="/img/trophy/support.jpg" title="Support Trophy" width="70"></div>
						@endif
						
						<div class="clear"></div>
						<hr/>
						@if($user->achievements->count() == 0)
							{{ trans("achievements.no_achievements") }}
						@else
							@foreach($user->achievements as $achievement)
								<div class="achievement"><img src="/img/trophy/{{$achievement->icon}}.png" title="
						@if($achievement->description == 1)
							{{ trans("achievements.".$achievement->description) }} {{ $achievement->factor}}
						@elseif($achievement->description == 2)
							{{ trans("achievements.".$achievement->description) }} {{ $achievement->factor}} Quests
						@elseif($achievement->description == 3)
							{{ trans("achievements.".$achievement->description) }} {{ $achievement->factor}} 
							@if($achievement->factor==1)
								friend
							@else
								friends
							@endif
						@else
							{{ $achievement->name }}
						@endif								
								" class="trophy"  /></div>
							@endforeach
						@endif
						<div class="clear"></div><br/>
						<a href="/summoner/{{ $user->region }}/{{ $user->summoner_name }}/achievements">{{ trans("achievements.all_achievements") }}</a>
					</td>
				</tr>
			</table>
      </div>
      <div class="tab-pane" id="last_games">
		<!-- LAST GAMES -->
        
		<h3>Last Games</h3>
		<table class="table">
			@foreach($games as $game)
				<?php 
					if($game["win"]==true) {
						$class = "success";
					} else {
						$class = "danger";
					}
				?>
				<tr class="<?php echo $class; ?>">
					<td>
						<a href="/champions/{{ $game->champion->key }}"><img src="/img/champions/{{ $game->championId }}_92.png" class="img-circle" width="35" /></a>
					</td>
					<td class="game_kda">
					{{ $game->championsKilled }} / {{ $game->numDeaths }} / {{ $game->assists }}<br/>
					@if($game->numDeaths > 0)
					KDA: {{ round(($game->championsKilled+$game->assists)/$game->numDeaths,2) }}
					@else
					KDA: {{ ($game->championsKilled+$game->assists) }}
					@endif
					</td>
					<td class="game_kda">
						{{ $game->subType }}<br/>
						{{ $game->minionsKilled }} CS ( {{ $game->neutralMinionsKilled }} neutral )
					</td>
					<td>
						<img src="/img/spells/{{ $game->spell1 }}.png" width="35" class="img-circle" > 
						<img src="/img/spells/{{ $game->spell2 }}.png" width="35" class="img-circle" >
					</td>
					<td id="items">
						@foreach($game->items as $item)
							<a href="/items/{{ $item->id }}"><img src="/img/items/{{ $item->id }}_64.png" data-toggle="tooltip" data-placement="top" title="{{ $item->name }}" width="35" class="img-circle items" ></a>
						@endforeach	
					</td>
					<td style="text-align: center;">
						<a href="#" class="toggle_game_details" id="{{ $game->id }}">
							<i class="fa fa-plus"></i>
							Details
						</a>
					</td>
				</tr>
				<tr class="game_detail_toggle game_details-{{ $game->id }}" >
					<td colspan="6" class="game_details">
						<table class="table">
							<tr>
								<td><strong>Gold earned</strong></td>
								<td>{{ $game->goldEarned }}</td>
								<td><strong>Wards placed</strong></td>
								<td>{{ $game->wardPlaced }}</td>
								<td><strong>Wards destroyed</strong></td>
								<td>{{ $game->wardKilled }}</td>
							</tr>
							<tr>
								<td><strong>Total damage Taken</strong></td>
								<td>{{ $game->totalDamageTaken }}</td>
								<td><strong>Total damage Dealt</strong></td>
								<td>{{ $game->totalDamageDealt }}</td>
								<td><strong>Total Heal</strong></td>
								<td>{{ $game->totalHeal }}</td>
							</tr>
							<tr>
								<td><strong>Game lenght</strong></td>
								<td>{{ gmdate("i", $game->timePlayed) }} min</td>
								<td><strong>Team</strong></td>
								<td>
									@if($game->teamId == 100)
										Blue
									@else
										Purple
									@endif
								</td>
								<td><strong>Turrets destroyed</strong></td>
								<td>{{ $game->turretsKilled }}</td>
							</tr>
							<tr>
								<td><strong>Killingsprees</strong></td>
								<td>{{ $game->killingSprees }}</td>
								<td><strong>Game Date</strong></td>
								<td>{{ date("d.m.Y H:i", $game->createDate/1000) }}</td>
								<td><strong>Enemy Jungle Minions</strong></td>
								<td>{{ $game->neutralMinionsKilledEnemyJungle }}</td>
							</tr>
							<tr>
								<td><strong>Time dead</strong></td>
								<td>{{ $game->time_dead }}</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						</table>
					</td>
				</tr>
			@endforeach
		</table>
		
      </div>
      <div class="tab-pane" id="quest_progress">
		<!-- QUEST PROGRESS -->
        
		<h3>{{ trans("dashboard.quest_status") }}</h3>
		<ul class="champions_finished">
		@foreach($champion_quests as $champion_quest)
			<li>
			@if($champion_quest->quests == 0)
				<a href="/champions/{{ $champion_quest->key }}"><img class="img-circle quest_avatar" alt="{{ $champion_quest->name }}" src="/img/champions_small/{{ $champion_quest->champion_id }}_92.png" width="30" style="opacity: 0.4;" title="{{ $champion_quest->name }}: {{ $champion_quest->quests }} Quests done" /></a>
			@else
				<a href="/champions/{{ $champion_quest->key }}"><img class="img-circle quest_avatar" alt="{{ $champion_quest->name }}" src="/img/champions_small/{{ $champion_quest->champion_id }}_92.png" width="30"  title="{{ $champion_quest->name }}: {{ $champion_quest->quests }} Quests done" /></a>
			@endif
			</li>
		@endforeach
		</ul>
		<div class="clear"></div>
		
      </div>
    </div>


				

	
	<br/><br/>
	@else
		{{ trans("users.no_summoner") }}
	@endif
	
@stop
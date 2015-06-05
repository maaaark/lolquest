<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	
	//use RemindableTrait;

	protected $guarded = array("password_confirmation");
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	
	public static $rules = array(
		'summoner_name'=>'required|min:3',
		'region'=>'required|alpha|min:2',
		'email'=>'required|email|unique:users',
		'password'=>'required|between:6,12|confirmed',
		'password_confirmation'=>'required|between:6,12'
	);
	
	public function level()
    {
        return $this->belongsTo('Level');
    }

	public function summoner()
    {
        return $this->hasOne('Summoner')->where("region", "=", $this->region);
    }
	
	public function ladder()
    {
        return $this->hasOne('Ladder');
    }
	
	public function team()
    {
        return $this->belongsTo('Team');
    }
	
	public function arena()
    {
        return $this->hasOne('Arena');
    }
	
	public function dailyprogress()
    {
        return $this->hasOne('Dailyprogess');
    }
	
	public function notifications()
    {
        return $this->hasMany('Notification');
    }
	
	public function skins()
    {
        return $this->hasMany('Skin');
    }
	
	public function titles()
    {
        return $this->hasMany('UserTitle');
    }
	
	public function challenges()
    {
        return $this->belongsToMany('Challenge')->orderby('type','asc')->orderby('value','asc')->withPivot('active');
    }
	
	
	public function title()
    {
		if($this->active_title > 0) {
			$title = Title::find($this->active_title);
			return $title->title;
		} else {
			return false;
		}
    }
	
	public function timelines()
    {
        return $this->hasMany('Timeline');
    }
	
	public function topics()
    {
        return $this->hasMany('ForumTopic');
    }
	
	public function last_reads()
    {
        return $this->hasMany('ForumLastRead');
    }
	
	public function replies()
    {
        return $this->hasMany('ForumReply');
    }
	
	public function blogs()
    {
        return $this->hasMany('Blog');
    }
	
	public function comments()
    {
        return $this->hasMany('Comment');
    }
	
	public function quests()
    {
        return $this->hasMany('Quest');
    }
	
	public function transactions()
    {
        return $this->hasMany('Transaction');
    }
	
	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
	
	public function roles()
    {
        return $this->belongsToMany('Role');
    }

    public function permissions()
    {
        return $this->hasMany('Permission');
    }

    public function hasRole($key)
    {
        foreach($this->roles as $role){
            if($role->name === $key)
            {
                return true;
            }
        }
        return false;
    }
	
	public function hasOpenQuestType($type_id) {
		$quest_type_count = Quest::where("user_id","=",$this->id)->where("type_id", "=", $type_id)->where("finished", "=", 0)->count();
		if($quest_type_count != 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function hasAchievement($id)
    {
        foreach($this->achievements as $achievement){
            if($achievement->id == $id)
            {
                return true;
            }
        }
        return false;
    }
	
	public function checkchallenge($user_id, $challenge_id)
	{
		$checkchallenges = ChallengeUser::where('user_id','=', $user_id)->where('challenge_id','=', $challenge_id)->first();
		if($checkchallenges){
			if($checkchallenges->active == 0){
				return true;
			}
		}
	}
	
	public function openFriends()
    {
        $isfriend_check = DB::table('friend_users')->where('friend_id', '=', Auth::user()->id)->where('validate', '=', 0)->get();
		return $isfriend_check;
    }
	
	public function finishedQuestsCount()
    {
        $quests = DB::table('quests')->where('user_id', '=', Auth::user()->id)->where('finished', '=', 1)->count();
		return $quests;
    }
	
	
	public function notify($type, $message)
    {
        $note = new Notification;
		$note->user_id = $this->id;
		$note->message = $message;
		$note->type = $type;
		$note->save();
    }
	
	public function getFriendUser($fid)
    {
		if(Auth::user()) {
		$frienduser = User::where('id', '=', $fid)->first();
		  return $frienduser;
		} else {
		return View::make('login');
		}
    }
	
	public function isFriend($friend_id)
    {
        $isfriend = DB::table('friend_users')->where('user_id', '=', Auth::user()->id)->where('friend_id', '=', $friend_id)->first();
        $isfriend_check = DB::table('friend_users')->where('user_id', '=', $friend_id )->where('friend_id', '=', Auth::user()->id)->first();
		if($isfriend)
		{
			if( $isfriend_check){
				return 'checked';
			} else {
				return 'unchecked';
			}
		} elseif ($isfriend_check){
			return 'invited';
		} else {
			return 'nofriends';
		}
    }
	
	public function reward($qp, $exp, $daily, $chid) {
		$user = User::find(Auth::user()->id);
		
		if($daily == true) {
			$user->qp = $user->qp + ($qp * 2);
			$user->exp = $user->exp + ($exp * 2);
			$user->daily_done = 1;
			$user->lifetime_qp = $user->lifetime_qp + ($qp * 2);
			
			if($user->team_id != 0) {
				$team = Team::find($user->team_id);
				$team->exp = $team->exp + ($exp * 2);
				$team->quests = $team->quests + 1;
				$team->average_exp = $team->exp / $team->members->count();
				$team->save();
			}
			
		} else {
			$user->qp = $user->qp + $qp;
			$user->exp = $user->exp + $exp;
			$user->lifetime_qp = $user->lifetime_qp + $qp;
			
			if($user->team_id != 0) {
				$team = Team::find($user->team_id);
				$team->exp = $team->exp + $exp;
				$team->quests = $team->quests + 1;
				$team->average_exp = $team->exp / $team->members->count();
				$team->save();
			}
			
			
		}
		if($user->exp > ($user->level->exp_level-1)) {
			$user->level_id +=1;
			$user->checkAchievement(1, $user->level_id);
		}						
		$user->checkAchievement(6, $user->lifetime_qp);		
		$user->checkAchievement(2, $user->finishedQuestsCount());
		$champions = 0;
		if($chid && $chid != 0){
			$champion_quest = Quest::where('user_id', '=', $user->id)->where('champion_id', '=', $chid)->count();
			$user->checkAchievement(7, $champion_quest);	
		}
		
		$champion_quests = DB::select(DB::raw('
			SELECT * , (
				SELECT COUNT( * ) 
				FROM quests
				WHERE user_id = '.$user->id.'
				AND finished = 1
				AND champion_id = champions.champion_id
				) AS quests
			FROM champions
			ORDER BY name ASC
		'));
		foreach($champion_quests as $champion_quest) {
			if($champion_quest->quests == 1) {
				$champions += 1;
			}
		}
		if($champions == Champion::count() && $user->hasachievement(69) == false){
			$user->checkAchievement(8, 0);
		}
		$user->save();
	}
	
	public function timeline($event_type,$quest_id, $achievement_id, $challenge_mode, $challenge_step, $comment_id, $friend_id, $title_id = 0) {
		$user = User::find($this->id);
		if($user->show_in_timeline == 1) {
			$timeline = new Timeline;
			$timeline->user_id = $user->id;
			$timeline->event_type = $event_type;
			$timeline->quest_id = $quest_id;
			$timeline->achievement_id = $achievement_id;
			$timeline->challenge_mode = $challenge_mode;
			$timeline->challenge_step = $challenge_step;
			$timeline->comment_id = $comment_id;
			$timeline->friend_id = $friend_id;
			$timeline->title_id = $title_id;
			$timeline->save();
			return true;
		}
		return false;
	}

	
	
	public function refresh_games()
	{
		if (Auth::check())
		{
			$user = User::find($this->id);
			if(Config::get('api.use_riot_api') == 1) {
				// USE RIOT API
				$api_key = Config::get('api.key');
				$summoner_data = "https://".$user->region.".api.pvp.net/api/lol/".$user->region."/v1.3/game/by-summoner/".$user->summoner->summonerid."/recent?api_key=".$api_key;
				$json = @file_get_contents($summoner_data);
				if($json === FALSE) {
					return Redirect::to("/dashboard")->with("error", "There was an error with the Riot API, please try again later!");
				} else {
					$obj = json_decode($json, true);
					
					foreach($obj["games"] as $game) {
						
						$recent_game = Game::where('gameId', '=', $game["gameId"])->where('summoner_id', '=', $user->summoner->summonerid)->first();
						if(!isset($recent_game)) {
							
							$newGame = new Game;
							$summoner_stats = SummonerStat::where('summoner_id', '=',$user->summoner->summonerid)->first();
							if(!isset($summoner_stats)){
								$summoner_stats = new SummonerStat;
								$summoner_stats->summoner_id = $user->summoner->summonerid;
								$summoner_stats->save();
								$summoner_stats = SummonerStat::where('summoner_id', '=',$user->summoner->summonerid)->first();
							}
							$summoner_stats->games += 1;
							
							$more_details = "https://".$user->region.".api.pvp.net/api/lol/".$user->region."/v2.2/match/".$game["gameId"]."?api_key=".$api_key;
							$json2 = @file_get_contents($more_details);
							if($json2 === FALSE) {
								//return Redirect::to("/dashboard")->with("error", "There was an error with the Riot API, please try again later!");
								$newGame->incomplete = true;
								$newGame->towerKills = 0;
								$newGame->firstTower = 0;
								$newGame->inhibitorKills = 0;
								$newGame->firstBaron = 0;
								$newGame->firstBlood = 0;
								$newGame->firstInhibitor = 0;
								$newGame->baronKills = 0;
								$newGame->dragonKills = 0;
								$newGame->firstDragon = 0;
								$newGame->doubleKills = 0;
								$newGame->tripleKills = 0;
								$newGame->quadraKills = 0;
								$newGame->pentaKills = 0;
								$newGame->firstBloodKill = 0;
								$newGame->exp_pm_zeroToTen = 0;
								$newGame->exp_pm_tenToTwenty = 0;
								$newGame->exp_pm_twentyToThirty = 0;
								$newGame->exp_pm_thirtyToEnd = 0;
								$newGame->gold_pm_zeroToTen = 0;
								$newGame->gold_pm_tenToTwenty = 0;
								$newGame->gold_pm_twentyToThirty = 0;
								$newGame->gold_pm_thirtyToEnd = 0;
								$newGame->cs_pm_zeroToTen = 0;
								$newGame->cs_pm_tenToTwenty = 0;
								$newGame->cs_pm_twentyToThirty = 0;
								$newGame->cs_pm_thirtyToEnd = 0;
								
							} else {
								$details = json_decode($json2, true);
							
								if(!isset($details["teams"])) {
									return Redirect::to("/dashboard")->with("error", "There was an error with the Riot API, please try again later!");
								}
								
								foreach($details["teams"] as $game_details) {
									if($game["teamId"] == $game_details["teamId"]) {
										$summoner_stats->towers += $game_details["towerKills"];
										$newGame->towerKills = $game_details["towerKills"];
										$newGame->firstTower = $game_details["firstTower"];
										$newGame->inhibitorKills = $game_details["inhibitorKills"];
										$newGame->firstBaron = $game_details["firstBaron"];
										$newGame->firstBlood = $game_details["firstBlood"];
										$newGame->firstInhibitor = $game_details["firstInhibitor"];
										$newGame->baronKills = $game_details["baronKills"];
										$summoner_stats->barons += $game_details["baronKills"];
										$newGame->dragonKills = $game_details["dragonKills"];
										$summoner_stats->dragons += $game_details["dragonKills"];
										$newGame->firstDragon = $game_details["firstDragon"];
									}
								}
								
								foreach($details["participants"] as $my_game_details) {
									if($my_game_details["championId"] == $game["championId"]) {
										
										$summoner_stats->doublekills += $my_game_details["stats"]["doubleKills"];
										$newGame->doubleKills = $my_game_details["stats"]["doubleKills"];
										$summoner_stats->tripplekills += $my_game_details["stats"]["tripleKills"];
										$newGame->tripleKills = $my_game_details["stats"]["tripleKills"];
										$summoner_stats->quadrakills += $my_game_details["stats"]["quadraKills"];
										$newGame->quadraKills = $my_game_details["stats"]["quadraKills"];
										$summoner_stats->pentakills += $my_game_details["stats"]["pentaKills"];
										$newGame->pentaKills = $my_game_details["stats"]["pentaKills"];
										
										
										if(isset($my_game_details["stats"]["firstBloodKill"])) {
											$newGame->firstBloodKill = $my_game_details["stats"]["firstBloodKill"];
										} else {
											$newGame->firstBloodKill = 0;
										}
										if(isset($my_game_details["stats"]["firstBloodAssist"])) {
											$newGame->firstBloodAssist = $my_game_details["stats"]["firstBloodAssist"];
										} else {
											$newGame->firstBloodAssist = 0;
										}
										
										
										$newGame->role = $my_game_details["timeline"]["role"];
										$newGame->lane = $my_game_details["timeline"]["lane"];
										
										if($game["createDate"] > 1423785600000) {
											if($newGame->lane == "TOP") {
												$user->dailyprogress->addTopGame($user);
											} elseif($newGame->lane == "JUNGLE") {
												$user->dailyprogress->addJungleGame($user);
											} elseif($newGame->lane == "MIDDLE") {
												$user->dailyprogress->addMidGame($user);
											} elseif($newGame->lane == "BOTTOM") {
												$user->dailyprogress->addBotGame($user);
											}
										}
										
										if(isset($my_game_details["timeline"]["xpPerMinDeltas"]["zeroToTen"])) {
											$newGame->exp_pm_zeroToTen = $my_game_details["timeline"]["xpPerMinDeltas"]["zeroToTen"];
										} else {
											$newGame->exp_pm_zeroToTen = 0;
										}
										
										if(isset($my_game_details["timeline"]["xpPerMinDeltas"]["tenToTwenty"])) {
											$newGame->exp_pm_tenToTwenty = $my_game_details["timeline"]["xpPerMinDeltas"]["tenToTwenty"];
										} else {
											$newGame->exp_pm_tenToTwenty = 0;
										}
										
										if(isset($my_game_details["timeline"]["xpPerMinDeltas"]["twentyToThirty"])) {
											$newGame->exp_pm_twentyToThirty = $my_game_details["timeline"]["xpPerMinDeltas"]["twentyToThirty"];
										} else {
											$newGame->exp_pm_twentyToThirty = 0;
										}
										
										if(isset($my_game_details["timeline"]["xpPerMinDeltas"]["thirtyToEnd"])) {
											$newGame->exp_pm_thirtyToEnd = $my_game_details["timeline"]["xpPerMinDeltas"]["thirtyToEnd"];
										} else {
											$newGame->exp_pm_thirtyToEnd = 0;
										}
										
										
										
										if(isset($my_game_details["timeline"]["goldPerMinDeltas"]["zeroToTen"])) {
											$newGame->gold_pm_zeroToTen = $my_game_details["timeline"]["goldPerMinDeltas"]["zeroToTen"];
										} else {
											$newGame->gold_pm_zeroToTen = 0;
										}
										
										if(isset($my_game_details["timeline"]["goldPerMinDeltas"]["tenToTwenty"])) {
											$newGame->gold_pm_tenToTwenty = $my_game_details["timeline"]["goldPerMinDeltas"]["tenToTwenty"];
										} else {
											$newGame->gold_pm_tenToTwenty = 0;
										}
										
										if(isset($my_game_details["timeline"]["goldPerMinDeltas"]["twentyToThirty"])) {
											$newGame->gold_pm_twentyToThirty = $my_game_details["timeline"]["goldPerMinDeltas"]["twentyToThirty"];
										} else {
											$newGame->gold_pm_twentyToThirty = 0;
										}
										
										if(isset($my_game_details["timeline"]["goldPerMinDeltas"]["thirtyToEnd"])) {
											$newGame->gold_pm_thirtyToEnd = $my_game_details["timeline"]["goldPerMinDeltas"]["thirtyToEnd"];
										} else {
											$newGame->gold_pm_thirtyToEnd = 0;
										}
										
										
										
										if(isset($my_game_details["timeline"]["creepsPerMinDeltas"]["zeroToTen"])) {
											$newGame->cs_pm_zeroToTen = $my_game_details["timeline"]["creepsPerMinDeltas"]["zeroToTen"];
										} else {
											$newGame->cs_pm_zeroToTen = 0;
										}
										
										if(isset($my_game_details["timeline"]["creepsPerMinDeltas"]["tenToTwenty"])) {
											$newGame->cs_pm_tenToTwenty = $my_game_details["timeline"]["creepsPerMinDeltas"]["tenToTwenty"];
										} else {
											$newGame->cs_pm_tenToTwenty = 0;
										}
										
										if(isset($my_game_details["timeline"]["creepsPerMinDeltas"]["twentyToThirty"])) {
											$newGame->cs_pm_twentyToThirty = $my_game_details["timeline"]["creepsPerMinDeltas"]["twentyToThirty"];
										} else {
											$newGame->cs_pm_twentyToThirty = 0;
										}
										
										if(isset($my_game_details["timeline"]["creepsPerMinDeltas"]["thirtyToEnd"])) {
											$newGame->cs_pm_thirtyToEnd = $my_game_details["timeline"]["creepsPerMinDeltas"]["thirtyToEnd"];
										} else {
											$newGame->cs_pm_thirtyToEnd = 0;
										}
										
										
									}
								}
							
							
							}
							
							
							
							if(!isset($game["stats"]["item0"])) { $item0 = 0; }	else { $item0 = $game["stats"]["item0"]; }
							if(!isset($game["stats"]["item1"])) { $item1 = 0; }	else { $item1 = $game["stats"]["item1"]; }
							if(!isset($game["stats"]["item2"])) { $item2 = 0; }	else { $item2 = $game["stats"]["item2"]; }
							if(!isset($game["stats"]["item3"])) { $item3 = 0; }	else { $item3 = $game["stats"]["item3"]; }
							if(!isset($game["stats"]["item4"])) { $item4 = 0; }	else { $item4 = $game["stats"]["item4"]; }
							if(!isset($game["stats"]["item5"])) { $item5 = 0; }	else { $item5 = $game["stats"]["item5"]; }
							if(!isset($game["stats"]["item6"])) { $item6 = 0; }	else { $item6 = $game["stats"]["item6"]; }
							if(!isset($game["stats"]["totalHeal"])) { $totalHeal = 0; }	else { $totalHeal = $game["stats"]["totalHeal"]; }
							if(!isset($game["stats"]["killingSprees"])) { $killingSprees = 0; }	else { $killingSprees = $game["stats"]["killingSprees"]; }
							if(!isset($game["stats"]["wardKilled"])) { $wardKilled = 0; }	else { $wardKilled = $game["stats"]["wardKilled"]; }
							if(!isset($game["stats"]["turretsKilled"])) { $turretsKilled = 0; }	else { $turretsKilled = $game["stats"]["turretsKilled"]; }
							if(!isset($game["stats"]["minionsKilled"])) { $minionsKilled = 0; }	else { $minionsKilled = $game["stats"]["minionsKilled"]; }
							if(!isset($game["stats"]["neutralMinionsKilled"])) { $neutralMinionsKilled = 0; }	else { $neutralMinionsKilled = $game["stats"]["neutralMinionsKilled"]; }
							if(!isset($game["stats"]["neutralMinionsKilledEnemyJungle"])) { $neutralMinionsKilledEnemyJungle = 0; }	else { $neutralMinionsKilledEnemyJungle = $game["stats"]["neutralMinionsKilledEnemyJungle"]; }
							if(!isset($game["stats"]["wardPlaced"])) { $wardPlaced = 0; } else { $wardPlaced = $game["stats"]["wardPlaced"]; }
							if(!isset($game["stats"]["assists"])) { $assists = 0; }	else { $assists = $game["stats"]["assists"]; }
							if(!isset($game["stats"]["numDeaths"])) { $numDeaths = 0; }	else { $numDeaths = $game["stats"]["numDeaths"]; }
							if(!isset($game["stats"]["championsKilled"])) { $championsKilled = 0; }	else { $championsKilled = $game["stats"]["championsKilled"]; }
							if(!isset($game["stats"]["totalDamageTaken"])) { $totalDamageTaken = 0; } else { $totalDamageTaken = $game["stats"]["totalDamageTaken"]; }
							if(!isset($game["stats"]["totalDamageDealt"])) { $totalDamageDealt = 0; } else { $totalDamageDealt = $game["stats"]["totalDamageDealt"]; }
						
							
							$newGame->summoner_id = $user->summoner->summonerid;
							$newGame->championId = $game["championId"];
							$newGame->gameId = $game["gameId"];
							$newGame->assists = $assists;
							$summoner_stats->assists +=$assists;
							$newGame->numDeaths = $numDeaths;
							$newGame->championsKilled = $championsKilled;
							$summoner_stats->kills +=$championsKilled;
							$newGame->goldEarned = $game["stats"]["goldEarned"];
							$summoner_stats->ingamegold +=$game["stats"]["goldEarned"];
							$newGame->wardPlaced = $wardPlaced;
							$summoner_stats->wards +=$wardPlaced;
							$newGame->item0 = $item0;
							$newGame->item1 = $item1;
							$newGame->item2 = $item2;
							$newGame->item3 = $item3;
							$newGame->item4 = $item4;
							$newGame->item5 = $item5;
							$newGame->item6 = $item6;
							$newGame->spell1 = $game["spell1"];
							$newGame->spell2 = $game["spell2"];
							$newGame->gameMode = $game["gameMode"];
							$newGame->wardKilled = $wardKilled;
							$summoner_stats->wardkills +=$wardKilled;
							$newGame->totalHeal = $totalHeal;
							$summoner_stats->heal +=$totalHeal;
							$newGame->totalDamageTaken = $totalDamageTaken;
							$summoner_stats->dmgtaken +=$totalDamageTaken;
							$newGame->totalDamageDealt = $totalDamageDealt;
							$summoner_stats->dmg +=$totalDamageDealt;
							$newGame->killingSprees = $killingSprees;
							$newGame->timePlayed = $game["stats"]["timePlayed"];
							$newGame->turretsKilled = $turretsKilled;
							$newGame->subType = $game["subType"];
							if($game["subType"] == "BOT") {
								$newGame->gameType = "BOT";
							} else {
								$newGame->gameType = $game["gameType"];
							}
							$newGame->minionsKilled = $minionsKilled;
							$newGame->neutralMinionsKilled = $neutralMinionsKilled;
							$newGame->neutralMinionsKilledEnemyJungle = $neutralMinionsKilledEnemyJungle;
							$newGame->mapId = $game["mapId"];
							$newGame->teamId = $game["teamId"];
							$newGame->level = $game["stats"]["level"];
							$mil = $game["createDate"];
							$newGame->createDate = $mil;
							$newGame->win = $game["stats"]["win"];
							if($newGame->win == true) {
								$summoner_stats->wins +=1;
								if($mil > 1423785600000) {
									$user->dailyprogress->addWin($user);
								}
							} else{
								$summoner_stats->losses +=1;
							}
							$newGame->save();
							if($game["subType"] != 'BOT_3x3' && $game["subType"] != 'NONE' && $game["subType"] != 'BOT' && $newGame->createDate >= 1423785600000){
								$summoner_stats->save();
							}
							$newGame->items()->attach($newGame->id, array("item_id"=>$item0));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item1));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item2));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item3));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item4));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item5));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item6));
							
							
							if($user->team_id != 0) {
								$team = Team::find($user->team_id);
								$team->assists += $newGame->assists;
								$team->save();
								$user->checkTeamAchievement(9, $team->assists);	
							}

                            if($newGame->gameType == "MATCHED_GAME") {
                                $champion = Champion::where("champion_id", "=", $newGame->championId)->first();
                                if($champion->fighter == 1) {
                                    $user->dailyprogress->addFighterGame($user);
                                } elseif($champion->tank == 1) {
                                    $user->dailyprogress->addTankGame($user);
                                } elseif($champion->marksman == 1) {
                                    $user->dailyprogress->addMarksmanGame($user);
                                } elseif($champion->support == 1) {
                                    $user->dailyprogress->addSupportGame($user);
                                } elseif($champion->mage == 1) {
                                    $user->dailyprogress->addMageGame($user);
                                } elseif($champion->assassin == 1) {
                                    $user->dailyprogress->addAssassinGame($user);
                                }
                                $user->save();
                            }
							
							
						}
						unset($recent_game);
					}
					$user->last_checked = date("U");
					$user->save();
					
				}
			} else {
				// NOT RIOT API
				return Redirect::to("/dashboard")->with("error", "No Valid API detected");	
			}
			
			
		} else {
			return View::make('login');
		}
	}
	
	public function update_details($gameid) {
	if (Auth::check())
		{	
			$api_key = Config::get('api.key');
			$user = User::find($this->id);
			$newGame = Game::where("gameId", "=", $gameid)->where("summoner_id", "=", $user->summoner->summonerid)->first();
			if($newGame) {
				$more_details = "https://".$user->region.".api.pvp.net/api/lol/".$user->region."/v2.2/match/".$gameid."?api_key=".$api_key;
				$json2 = @file_get_contents($more_details);
				if($json2 === FALSE) {
					return Redirect::to("/summoner/".$user->region."/".$user->summoner_name)->with("error", "No advanced data for this game available in the Riot API! Please try again later.");
				} else {
					$details = json_decode($json2, true);
				
					if(!isset($details["teams"])) {
						return Redirect::to("/summoner/".$user->region."/".$user->summoner_name)->with("error", "There was an error with the Riot API, please try again later!");
					}
							$summoner_stats = SummonerStat::where('summoner_id', '=',$user->summoner->summonerid)->first();
							if(!isset($summoner_stats)){
								$summoner_stats = new SummonerStat;
								$summoner_stats->summoner_id = $user->summoner->summonerid;
							}
							$summoner_stats->games += 1;
					
					foreach($details["teams"] as $game_details) {
						if($game_details["teamId"] == $newGame["teamId"]) {
							$summoner_stats->towers += $game_details["towerKills"];
							$newGame->towerKills = $game_details["towerKills"];
							$newGame->firstTower = $game_details["firstTower"];
							$newGame->inhibitorKills = $game_details["inhibitorKills"];
							$newGame->firstBaron = $game_details["firstBaron"];
							$newGame->firstBlood = $game_details["firstBlood"];
							$newGame->firstInhibitor = $game_details["firstInhibitor"];
							$newGame->baronKills = $game_details["baronKills"];
							$summoner_stats->barons += $game_details["baronKills"];
							$newGame->dragonKills = $game_details["dragonKills"];
							$summoner_stats->dragons += $game_details["dragonKills"];
							$newGame->firstDragon = $game_details["firstDragon"];
						}
					}
					
					foreach($details["participants"] as $my_game_details) {
						if($my_game_details["championId"] == $newGame["championId"]) {
							
							$summoner_stats->doublekills += $my_game_details["stats"]["doubleKills"];
							$newGame->doubleKills = $my_game_details["stats"]["doubleKills"];
							$summoner_stats->triplekills += $my_game_details["stats"]["tripleKills"];
							$newGame->tripleKills = $my_game_details["stats"]["tripleKills"];
							$summoner_stats->quadrakills += $my_game_details["stats"]["quadraKills"];
							$newGame->quadraKills = $my_game_details["stats"]["quadraKills"];
							$summoner_stats->pentakills += $my_game_details["stats"]["pentaKills"];
							$newGame->pentaKills = $my_game_details["stats"]["pentaKills"];
							
							
							if(isset($my_game_details["stats"]["firstBloodKill"])) {
								$newGame->firstBloodKill = $my_game_details["stats"]["firstBloodKill"];
							} else {
								$newGame->firstBloodKill = 0;
							}
							if(isset($my_game_details["stats"]["firstBloodAssist"])) {
								$newGame->firstBloodAssist = $my_game_details["stats"]["firstBloodAssist"];
							} else {
								$newGame->firstBloodAssist = 0;
							}
							
							
							$newGame->role = $my_game_details["timeline"]["role"];
							$newGame->lane = $my_game_details["timeline"]["lane"];
							
							if($newGame->lane == "BOTTOM") {
								$user->dailyprogress->addBotGame($user);
							} elseif($newGame->lane == "JUNGLE") {
								$user->dailyprogress->addJungleGame($user);
							} elseif($newGame->lane == "TOP") {
								$user->dailyprogress->addTopGame($user);
							} elseif($newGame->lane == "MIDDLE") {
								$user->dailyprogress->addMidGame($user);
							}
							
							
							if(isset($my_game_details["timeline"]["xpPerMinDeltas"]["zeroToTen"])) {
								$newGame->exp_pm_zeroToTen = $my_game_details["timeline"]["xpPerMinDeltas"]["zeroToTen"];
							} else {
								$newGame->exp_pm_zeroToTen = 0;
							}
							
							if(isset($my_game_details["timeline"]["xpPerMinDeltas"]["tenToTwenty"])) {
								$newGame->exp_pm_tenToTwenty = $my_game_details["timeline"]["xpPerMinDeltas"]["tenToTwenty"];
							} else {
								$newGame->exp_pm_tenToTwenty = 0;
							}
							
							if(isset($my_game_details["timeline"]["xpPerMinDeltas"]["twentyToThirty"])) {
								$newGame->exp_pm_twentyToThirty = $my_game_details["timeline"]["xpPerMinDeltas"]["twentyToThirty"];
							} else {
								$newGame->exp_pm_twentyToThirty = 0;
							}
							
							if(isset($my_game_details["timeline"]["xpPerMinDeltas"]["thirtyToEnd"])) {
								$newGame->exp_pm_thirtyToEnd = $my_game_details["timeline"]["xpPerMinDeltas"]["thirtyToEnd"];
							} else {
								$newGame->exp_pm_thirtyToEnd = 0;
							}
							
							
							
							if(isset($my_game_details["timeline"]["goldPerMinDeltas"]["zeroToTen"])) {
								$newGame->gold_pm_zeroToTen = $my_game_details["timeline"]["goldPerMinDeltas"]["zeroToTen"];
							} else {
								$newGame->gold_pm_zeroToTen = 0;
							}
							
							if(isset($my_game_details["timeline"]["goldPerMinDeltas"]["tenToTwenty"])) {
								$newGame->gold_pm_tenToTwenty = $my_game_details["timeline"]["goldPerMinDeltas"]["tenToTwenty"];
							} else {
								$newGame->gold_pm_tenToTwenty = 0;
							}
							
							if(isset($my_game_details["timeline"]["goldPerMinDeltas"]["twentyToThirty"])) {
								$newGame->gold_pm_twentyToThirty = $my_game_details["timeline"]["goldPerMinDeltas"]["twentyToThirty"];
							} else {
								$newGame->gold_pm_twentyToThirty = 0;
							}
							
							if(isset($my_game_details["timeline"]["goldPerMinDeltas"]["thirtyToEnd"])) {
								$newGame->gold_pm_thirtyToEnd = $my_game_details["timeline"]["goldPerMinDeltas"]["thirtyToEnd"];
							} else {
								$newGame->gold_pm_thirtyToEnd = 0;
							}
							
							
							
							if(isset($my_game_details["timeline"]["creepsPerMinDeltas"]["zeroToTen"])) {
								$newGame->cs_pm_zeroToTen = $my_game_details["timeline"]["creepsPerMinDeltas"]["zeroToTen"];
							} else {
								$newGame->cs_pm_zeroToTen = 0;
							}
							
							if(isset($my_game_details["timeline"]["creepsPerMinDeltas"]["tenToTwenty"])) {
								$newGame->cs_pm_tenToTwenty = $my_game_details["timeline"]["creepsPerMinDeltas"]["tenToTwenty"];
							} else {
								$newGame->cs_pm_tenToTwenty = 0;
							}
							
							if(isset($my_game_details["timeline"]["creepsPerMinDeltas"]["twentyToThirty"])) {
								$newGame->cs_pm_twentyToThirty = $my_game_details["timeline"]["creepsPerMinDeltas"]["twentyToThirty"];
							} else {
								$newGame->cs_pm_twentyToThirty = 0;
							}
							
							if(isset($my_game_details["timeline"]["creepsPerMinDeltas"]["thirtyToEnd"])) {
								$newGame->cs_pm_thirtyToEnd = $my_game_details["timeline"]["creepsPerMinDeltas"]["thirtyToEnd"];
							} else {
								$newGame->cs_pm_thirtyToEnd = 0;
							}
							
							$newGame->incomplete = 0;
							$newGame->save();
							$summoner_stats->save();
						}
					}
				}
			} else {
				return Redirect::to("/summoner/".$user->region."/".$user->summoner_name)->with("error", "Cannot access game details!");
			}

		} else {
			return Redirect::to('/login');
		}				
	}
	
	
	public function get_account_id() {
		$region = strtoupper($this->region);
		$summoner_data = "https://acs.leagueoflegends.com/v1/players?name=$this->summoner_name&region=$region";
		$json = @file_get_contents($summoner_data);
		if($json === FALSE) {
			return false;
		} else {
			$obj = json_decode($json, true);
			$this->summoner->accountId = $obj["accountId"];
			$this->summoner->platformId = $obj["platformId"];
			$this->summoner->save();
			return true;
		}
	}
	public function achievements()
    {
		return $this->belongsToMany('Achievement')->withTimestamps();
    }
	
	
	public function checkAchievement($type, $factor)
	{
		if(Auth::user()) {
				$achiv_id = 0;
				foreach(Auth::user()->achievements as $achievement) {
					if($achievement->type == $type){
						if($achiv_id < $achievement->id){
							$achiv_id = $achievement->id;
						}
					}
				}
				$user_achievement = Achievement::where('type', "=", $type)->where('id','>',$achiv_id)->first(); 
				if($user_achievement){
					if($user_achievement->factor <= $factor) {
						Auth::user()->achievements()->attach($user_achievement->id);
						Auth::user()->achievement_points += $user_achievement->points;
						Auth::user()->save();
						if($user_achievement->description == 1) {
							$achiv = trans('achievements.'.$user_achievement->description).' '.$user_achievement->factor;
						}
						elseif($user_achievement->description == 2){
							$achiv = trans('achievements.'.$user_achievement->description).' '.$user_achievement->factor.' Quests';
						}
						elseif($user_achievement->description == 3){
							if($user_achievement->factor==1){
								$achiv = trans('achievements.'.$user_achievement->description).' '.$user_achievement->factor.' friend';
							}
							else{
								$achiv = trans('achievements.'.$user_achievement->description).' '.$user_achievement->factor.' friends';
							}
						}	
						else{
							$achiv  = $user_achievement->name;
						}												
						Auth::user()->notify(1, trans("achievements.receive").'</br><a href="/summoner/'.Auth::user()->region.'/'.Auth::user()->summoner_name.'/achievements"> '.$achiv.'</a>');
						Auth::user()->timeline("new_achievement",0, $user_achievement->id, 0, 0, 0, 0);
						if($user_achievement->title){
							$new_title = new UserTitle;
							$new_title->user_id = Auth::user()->id;
							$new_title->title_id = $user_achievement->title->id;
							Auth::user()->notify(2, trans("achievements.receive_title").'</br><a href="/settings/title> '.$user_achievement->title->title.'</a>');
							$new_title->save();
						}
					}
				} 
		} else {
		return Redirect::to('login');
		}
	}
	
	public function checkAchievement_friend($friend, $type, $factor)
	{
		if($friend) {
				$achiv_id = 0;
				$user = User::find($friend);
				$friend = User::find(Auth::user()->id);
				foreach($user->achievements as $achievement) {
					if($achievement->type == $type){
						if($achiv_id < $achievement->id){
							$achiv_id = $achievement->id;
						}
					}
				}
				$user_achievement = Achievement::where('type', $type)->where('id','>',$achiv_id)->firstOrFail(); 
				if($user_achievement){
					if($user_achievement->factor <= $factor) {
						$user->achievements()->attach($user_achievement->id);
						$user->achievement_points += $user_achievement->points;
						$user->save();
						if($user_achievement->description == 1) {
							$achiv = trans('achievements.'.$user_achievement->description).' '.$user_achievement->factor;
						}
						elseif($user_achievement->description == 2){
							$achiv = trans('achievements.'.$user_achievement->description).' '.$user_achievement->factor.' Quests';
						}
						elseif($user_achievement->description == 3){
							if($user_achievement->factor==1){
								$achiv = trans('achievements.'.$user_achievement->description).' '.$user_achievement->factor.' friend';
							}
							else{
								$achiv = trans('achievements.'.$user_achievement->description).' '.$user_achievement->factor.' friends';
							}
						}	
						else{
							$achiv  = $user_achievement->name;
						}												
						$user->notify(1, trans("achievements.receive").'</br><a href="/summoner/'.$user->region.'/'.$user->summoner_name.'/achievements"> '.$achiv.'</a>');
						$user->timeline("new_achievement",0, $user_achievement->id, 0, 0, 0, 0);
						if($user_achievement->title){
							$new_title = new UserTitle;
							$new_title->user_id = $user->id;
							$new_title->title_id = $user_achievement->title->id;
							$user->notify(2, trans("achievements.receive_title").'</br><a href="/settings/title> '.$user_achievement->title->title.'</a>');
							$new_title->save();
						}
					}
				} 
		} else {
		return Redirect::to('login');
		}
	}
	
	public function checkTeamAchievement($type, $factor)
	{
		if(Auth::user()) {
				$user = User::find(Auth::user()->id);
				$team = Team::find($user->team_id);
				$achiv_id = 0;
				foreach($team->achievements as $achievement) {
					if($achievement->type == $type){
						if($achiv_id < $achievement->id){
							$achiv_id = $achievement->id;
						}
					}
				}
				$team_achievement = Achievement::where('type', "=", $type)->where('id','>',$achiv_id)->first(); 
				if($team_achievement){
					if($team_achievement->factor <= $factor) {
						$team->achievements()->attach($team_achievement->id);
						$team->save();
					}
				} 
		} else {
		return Redirect::to('login');
		}
	}
	
	public function ladder_rang($user_id)
    {
			$user = User::find($user_id);
			$year = date("Y");
			$month = date("m");
			$ladder = Ladder::where("user_id", "=", $user->id)->where("month", "=", $month)->where("year", "=", $year)->first();
			return $ladder;
    }
	
	public function completed_quests() {
		$user = User::find($this->id);
		$completed_quests = Quest::where("user_id", "=", $user->id)->where("finished", "=", 1)->count();
		return $completed_quests;
	}
	
	public function friends()
    {
        return $this->belongsToMany('User', 'friend_users', 'user_id', 'friend_id');
    }

}

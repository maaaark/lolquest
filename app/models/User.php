<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

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
        return $this->hasOne('Summoner');
    }
	
	public function ladder()
    {
        return $this->hasOne('Ladder');
    }
	
	public function notifications()
    {
        return $this->hasMany('Notification');
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
	
	public function reward($qp, $exp, $daily) {
		$user = User::find(Auth::user()->id);
		
		if($daily == true) {
			$user->qp = $user->qp + ($qp * 2);
			$user->exp = $user->exp + ($exp * 2);
			$user->lifetime_qp = $user->lifetime_qp + ($qp * 2);
		} else {
			$user->qp = $user->qp + $qp;
			$user->exp = $user->exp + $exp;
			$user->lifetime_qp = $user->lifetime_qp + $qp;
		}
		if($user->exp > ($user->level->exp_level-1)) {
			$user->level_id +=1;
			$user->checkAchievement(1, $user->level_id);
		}						
		$user->save();
	}
	
	public function timeline($event_type,$quest_id, $achievement_id, $challenge_mode, $challenge_step, $comment_id, $friend_id) {
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
			if(Config::get('api.use_riot_api')  == 1) {
				// USE RIOT API
				$api_key = Config::get('api.key');
				$summoner_data = "https://".$user->region.".api.pvp.net/api/lol/".$user->region."/v1.3/game/by-summoner/".$user->summoner->summonerid."/recent?api_key=".$api_key;
				$json = @file_get_contents($summoner_data);
				if($json === FALSE) {
					return Redirect::to('/api_problems');
				} else {
					$obj = json_decode($json, true);
					
					foreach($obj["games"] as $game) {
						
						$recent_game = Game::where('gameId', '=', $game["gameId"])->where('summoner_id', '=', $user->summoner->summonerid)->first();
						if(!isset($recent_game)) {
						
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
							if(!isset($game["stats"]["wardPlaced"])) { $wardPlaced = 0; } else { $wardPlaced = $game["stats"]["wardPlaced"]; }
							if(!isset($game["stats"]["assists"])) { $assists = 0; }	else { $assists = $game["stats"]["assists"]; }
							if(!isset($game["stats"]["numDeaths"])) { $numDeaths = 0; }	else { $numDeaths = $game["stats"]["numDeaths"]; }
							if(!isset($game["stats"]["championsKilled"])) { $championsKilled = 0; }	else { $championsKilled = $game["stats"]["championsKilled"]; }
						
							$newGame = new Game;
							$newGame->summoner_id = $user->summoner->summonerid;
							$newGame->championId = $game["championId"];
							$newGame->gameId = $game["gameId"];
							$newGame->assists = $assists;
							$newGame->numDeaths = $numDeaths;
							$newGame->championsKilled = $championsKilled;
							$newGame->goldEarned = $game["stats"]["goldEarned"];
							$newGame->wardPlaced = $wardPlaced;
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
							$newGame->gameType = $game["gameType"];
							$newGame->wardKilled = $wardKilled;
							$newGame->totalHeal = $totalHeal;
							$newGame->totalDamageTaken = $game["stats"]["totalDamageTaken"];
							$newGame->totalDamageDealt = $game["stats"]["totalDamageDealt"];
							$newGame->killingSprees = $killingSprees;
							$newGame->timePlayed = $game["stats"]["timePlayed"];
							$newGame->turretsKilled = $turretsKilled;
							$newGame->subType = $game["subType"];
							$newGame->minionsKilled = $minionsKilled;
							$newGame->neutralMinionsKilled = $neutralMinionsKilled;
							$newGame->mapId = $game["mapId"];
							$newGame->teamId = $game["teamId"];
							$newGame->level = $game["level"];
							$mil = $game["createDate"];
							$newGame->createDate = $mil;
							$newGame->win = $game["stats"]["win"];
							$newGame->save();
							
							$newGame->items()->attach($newGame->id, array("item_id"=>$item0));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item1));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item2));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item3));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item4));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item5));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item6));
						}
						unset($recent_game);
					}
					$user->last_checked = date("U");
					$user->save();
					
				}
			} else {
				// NOT RIOT API
				$summoner_name = urlencode($user->summoner_name);
				$region = $user->region;
				$url = "http://api.captainteemo.com/player/$region/$summoner_name/recent_games";
				$summoner_name = urlencode($summoner_name);
				$test = @file_get_contents($url);
				$data = json_decode($test, true);
				
			if($data["success"] == false ) {
				return Redirect::to('/api_problems');
				
			} else {
			
				foreach($data["data"]["gameStatistics"] as $games) {
					foreach($games as $game) {
						$kills = 0;
						$item_1 = 0;
						$item_2 = 0;
						$item_3 = 0;
						$item_4 = 0;
						$item_5 = 0;
						$item_6 = 0;
						$item_7 = 0;
						$multikill = 0;
						$killingSprees = 0;
						$crit = 0;
						$dead = 0;
						$deaths = 0;
						$neutral_cs = 0;
						$wards = 0;
						$totalHeal = 0;
						$wardKilled = 0;
						$turretsKilled = 0;
						$neutralMinionsKilled = 0;
						$teamId = 0;
						$level = 1;
						$wards_placed = 0;
						
						foreach($game['statistics'] as $stats) {
							foreach($stats as $stat) {
							  
								  if ($stat['statType'] == "WIN") {
									$game_result=1;
								  }
								  if ($stat['statType'] == "LOSE") {
									$game_result=0;
								  }
								  if ($stat['statType'] == "CHAMPIONS_KILLED") {
									$kills=$stat['value'];
								  }
								  if ($stat['statType'] == "ASSISTS") {
									$assists=$stat['value'];
								  }
								  if ($stat['statType'] == "NUM_DEATHS") {
									$deaths=$stat['value'];
								  }
								  if ($stat['statType'] == "ITEM0") {
									$item_0=$stat['value'];
								  }
								  if ($stat['statType'] == "ITEM1") {
									$item_1=$stat['value'];
								  }
								  if ($stat['statType'] == "ITEM2") {
									$item_2=$stat['value'];
								  }
								  if ($stat['statType'] == "ITEM3") {
									$item_3=$stat['value'];
								  }
								  if ($stat['statType'] == "ITEM4") {
									$item_4=$stat['value'];
								  }
								  if ($stat['statType'] == "ITEM5") {
									$item_5=$stat['value'];
								  }
								  if ($stat['statType'] == "ITEM6") {
									$item_6=$stat['value'];
								  }
								  if ($stat['statType'] == "MINIONS_KILLED") {
									$cs=$stat['value'];
								  }
								  if ($stat['statType'] == "NEUTRAL_MINIONS_KILLED") {
									$neutral_cs =$stat['value'];
								  }
								  if ($stat['statType'] == "SIGHT_WARDS_BOUGHT_IN_GAME") {
									$wards+=$stat['value'];
								  }
								  if ($stat['statType'] == "VISION_WARDS_BOUGHT_IN_GAME") {
									$wards+=$stat['value'];
								  }
								  if ($stat['statType'] == "WARD_PLACED") {
									$wards_placed=$stat['value'];
								  }
								  if ($stat['statType'] == "LARGEST_MULTI_KILL") {
									$multikill=$stat['value'];
								  }
								  if ($stat['statType'] == "LARGEST_KILLING_SPREE") {
									$killingspree=$stat['value'];
								  }
								  if ($stat['statType'] == "GOLD_EARNED") {
									$gold=$stat['value'];
								  }
								  if ($stat['statType'] == "LARGEST_CRITICAL_STRIKE") {
									$crit=$stat['value'];
								  }
								  if ($stat['statType'] == "TOTAL_DAMAGE_DEALT") {
									$total_dmg=$stat['value'];
								  }
								  if ($stat['statType'] == "LEVEL") {
									$level=$stat['value'];
								  }
								  if ($stat['statType'] == "TOTAL_TIME_SPENT_DEAD") {
									$dead=$stat['value'];
								  }
								  if ($stat['statType'] == "TOTAL_DAMAGE_TAKEN") {
									$total_dmg_taken=$stat['value'];
								  }
								  if ($stat['statType'] == "WARD_KILLED") {
									$wardKilled=$stat['value'];
								  }
								  if ($stat['statType'] == "TOTAL_HEAL") {
									$totalHeal=$stat['value'];
								  }
								  if ($stat['statType'] == "LARGEST_KILLING_SPREE") {
									$killingSprees=$stat['value'];
								  }
								  if ($stat['statType'] == "TURRETS_KILLED") {
									$turretsKilled=$stat['value'];
								  }
								  if ($stat['statType'] == "NEUTRAL_MINIONS_KILLED") {
									$neutralMinionsKilled=$stat['value'];
								  }
								  if ($stat['statType'] == "TOTAL_DAMAGE_TAKEN") {
									$totalDamageTaken=$stat['value'];
								  }
								  if ($stat['statType'] == "TOTAL_DAMAGE_DEALT") {
									$totalDamageDealt=$stat['value'];
								  }
								  
								  
								  
								  
							}
						}
						
						$gameid=$game['gameId'];
						$champion=$game['championId'];
						$game_date=date("Y-m-d H:i:s", strtotime($game['createDate']));
						$summoner_1 =$game['spell1'];
						$summoner_2 =$game['spell2'];
						$gameMapId =$game['gameMapId'];
						$teamId =$game['teamId'];
						
						$gametype =$game['gameType'];
						$gamemode =$game['gameMode'];
						$skin_id = $game['skinIndex'];
						$premade = $game['premadeSize'];
						$kda = 0;
						$account_id = 0;
					
					
						$recent_game = Game::where('gameId', '=', $game["gameId"])->where('summoner_id', '=', $user->summoner->summonerid)->first();
						if(!isset($recent_game)) {
							$newGame = new Game;
							$newGame->summoner_id = $user->summoner->summonerid;
							$newGame->championId = $champion;
							$newGame->gameId = $gameid;
							$newGame->assists = $assists;
							$newGame->numDeaths = $deaths;
							$newGame->championsKilled = $kills;
							$newGame->goldEarned = $gold;
							$newGame->wardPlaced = $wards_placed;
							$newGame->item0 = $item_0;
							$newGame->item1 = $item_1;
							$newGame->item2 = $item_2;
							$newGame->item3 = $item_3;
							$newGame->item4 = $item_4;
							$newGame->item5 = $item_5;
							$newGame->item6 = $item_6;
							$newGame->level = $level;
							$newGame->spell1 = $summoner_1;
							$newGame->spell2 = $summoner_2;
							$newGame->gameMode = $gamemode;
							$newGame->gameType = $gametype;
							$newGame->wardKilled = $wardKilled;
							$newGame->totalHeal = $totalHeal;
							$newGame->killingSprees = $killingSprees;
							$newGame->timePlayed = 0;
							$newGame->turretsKilled = $turretsKilled;
							$newGame->subType = $game["subType"];
							$newGame->minionsKilled = $cs;
							$newGame->mapId = $gameMapId;
							$newGame->teamId = $teamId;
							$newGame->neutralMinionsKilled = $neutralMinionsKilled;
							$newGame->totalDamageTaken = $totalDamageTaken;
							$newGame->totalDamageDealt = $totalDamageDealt;
							$mil = $game["createDate"];
							$time = strtotime($mil);
							$newformat = date('U',$time);
							$newGame->createDate = $newformat*1000;
							$newGame->win = $game_result;
							$newGame->save();
							
							$newGame->items()->attach($newGame->id, array("item_id"=>$item_0));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item_1));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item_2));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item_3));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item_4));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item_5));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item_6));
						}
						unset($recent_game);
						
					} // END FOR EACH GAME
				} // END OF STATS	
				
			} // END API CHECK
				
				
			}
			
			
		} else {
			return View::make('login');
		}
	}
	
	
	public function achievements()
    {
		return $this->belongsToMany('Achievement');
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
				$user_achievement = Achievement::where('type', $type)->where('id','>',$achiv_id)->firstOrFail(); 
				if($user_achievement){
					if($user_achievement->factor <= $factor) {
						Auth::user()->achievements()->attach($user_achievement->id);
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
						Auth::user()->notify(1, trans("achievements.receive").'<a href="/achievements/'.$user_achievement->id.'"> '.$achiv.'</a>');
						Auth::user()->timeline("new_achievement",0, $user_achievement->id, 0, 0, 0, 0);
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
						$user->notify(1, trans("achievements.receive").'<a href="/achievements/'.$user_achievement->id.'"> '.$achiv.'</a>');
						$user->timeline("new_achievement",0, $user_achievement->id, 0, 0, 0, 0);
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
	
	public function friends()
    {
        return $this->belongsToMany('User', 'friend_users', 'user_id', 'friend_id');
    }

}

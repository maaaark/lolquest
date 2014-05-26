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
		'summoner_name'=>'required|alpha|min:3',
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
	
	public function isFriend($friend_id)
    {
        $isfriend = DB::table('friend_user')->where('user_id', '=', Auth::user()->id)->where('friend_id', '=', $friend_id)->first();
        $isfriend_check = DB::table('friend_user')->where('user_id', '=', $friend_id )->where('friend_id', '=', Auth::user()->id)->first();
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

	
	
	public function refresh_games()
	{
		if (Auth::check())
		{
			$user = User::find(Auth::user()->id);
			$api_key = Config::get('api.key');
			$summoner_data = "https://prod.api.pvp.net/api/lol/".$user->region."/v1.3/game/by-summoner/".$user->summoner->summonerid."/recent?api_key=".$api_key;
			$json = @file_get_contents($summoner_data);
			if($json === FALSE) {
				return View::make('login');
			} else {
				$obj = json_decode($json, true);
				
				foreach($obj["games"] as $game) {
					if(!isset($game["stats"]["item0"])) { $item0 = 0; }	else { $item0 = $game["stats"]["item0"]; }
					if(!isset($game["stats"]["item1"])) { $item1 = 0; }	else { $item1 = $game["stats"]["item1"]; }
					if(!isset($game["stats"]["item2"])) { $item2 = 0; }	else { $item2 = $game["stats"]["item2"]; }
					if(!isset($game["stats"]["item3"])) { $item3 = 0; }	else { $item3 = $game["stats"]["item3"]; }
					if(!isset($game["stats"]["item4"])) { $item4 = 0; }	else { $item4 = $game["stats"]["item4"]; }
					if(!isset($game["stats"]["item5"])) { $item5 = 0; }	else { $item5 = $game["stats"]["item5"]; }
					if(!isset($game["stats"]["item6"])) { $item6 = 0; }	else { $item6 = $game["stats"]["item6"]; }
					if(!isset($game["stats"]["minionsKilled"])) { $minionsKilled = 0; }	else { $minionsKilled = $game["stats"]["minionsKilled"]; }
					if(!isset($game["stats"]["neutralMinionsKilled"])) { $neutralMinionsKilled = 0; }	else { $neutralMinionsKilled = $game["stats"]["neutralMinionsKilled"]; }
                    if(!isset($game["stats"]["wardPlaced"])) { $wardPlaced = 0; } else { $wardPlaced = $game["stats"]["wardPlaced"]; }
					if(!isset($game["stats"]["assists"])) { $assists = 0; }	else { $assists = $game["stats"]["assists"]; }
					if(!isset($game["stats"]["numDeaths"])) { $numDeaths = 0; }	else { $numDeaths = $game["stats"]["numDeaths"]; }
					if(!isset($game["stats"]["championsKilled"])) { $championsKilled = 0; }	else { $championsKilled = $game["stats"]["championsKilled"]; }
						
					$recent_game = Game::where('gameId', '=', $game["gameId"])->where('summoner_id', '=', $user->summoner->summonerid)->first();
					if(!isset($recent_game)) {
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
						$newGame->subType = $game["subType"];
						$newGame->minionsKilled = $minionsKilled;
						$newGame->neutralMinionsKilled = $neutralMinionsKilled;
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
						echo Auth::user()->name."hat ein achiement bekommen";
					}
				} else {
					echo Auth::user()->name."hat eindsfsdf achiement bekommen";
				}
		} else {
		return Redirect::to('login');
		}
	}
	
	
	public function friends()
    {
        return $this->belongsToMany('User', 'friend_user', 'user_id', 'friend_id');
    }

}

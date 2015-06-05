<?php

class QuestsController extends \BaseController {

	
	public function cancel_quest($quest_id) {
		if (Auth::check()) { 
				$user = User::find(Auth::user()->id);
				$quest = Quest::where("user_id", "=", $user->id)->where("id", "=", $quest_id)->first();
				if($quest) {
					$timeline = Timeline::where("user_id", "=", $user->id)->where('quest_id', '=', $quest_id)->first();
					if($timeline) {
						$timeline->delete();
					}
					$quest->delete();
					$time = date("U");
					if(($quest->createDate + 86400000) > ($time*1000)) {
						$user->qp = $user->qp - Config::get('costs.delete_daily');
					}
					$user->save();
					return Redirect::to('dashboard')->with('message', trans("dashboard.deleted"));
				} else {
					return Redirect::to('dashboard')->with('error', trans("dashboard.no_quest_found"));
				}
		} else {
			return Redirect::to('login');
		}
	}
	
	public function dailyprogress($progress) {
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			if($progress == "wins") {
				$daily = Dailyprogess::where("user_id", "=", $user->id)->first();
				if($daily->wins >= 3) {
					$daily->claimed_wins = true;
					$daily->save();
					$user->reward(100, 500, false, 0);
					$user->save();
					return Redirect::to('dashboard')->with('success', trans("dashboard.dailyquest_completed"));
				}
			} elseif($progress == "quests") {
				$daily = Dailyprogess::where("user_id", "=", $user->id)->first();
				if($daily->quests_completed >= 5) {
					$daily->claimed_quests = true;
					$daily->save();
					$user->reward(75, 400, false, 0);
					$user->save();
					return Redirect::to('dashboard')->with('success', trans("dashboard.dailyquest_completed"));
				}
			} elseif($progress == "top") {
				$daily = Dailyprogess::where("user_id", "=", $user->id)->first();
				if($daily->top_games >= 2) {
					$daily->claimed_top = true;
					$daily->save();
					$user->reward(50, 250, false, 0);
					$user->save();
					return Redirect::to('dashboard')->with('success', trans("dashboard.dailyquest_completed"));
				}
			} elseif($progress == "jungle") {
				$daily = Dailyprogess::where("user_id", "=", $user->id)->first();
				if($daily->jungle_games >= 2) {
					$daily->claimed_jungle = true;
					$daily->save();
					$user->reward(50, 250, false, 0);
					$user->save();
					return Redirect::to('dashboard')->with('success', trans("dashboard.dailyquest_completed"));
				}
			} elseif($progress == "mid") {
				$daily = Dailyprogess::where("user_id", "=", $user->id)->first();
				if($daily->mid_games >= 2) {
					$daily->claimed_mid = true;
					$daily->save();
					$user->reward(50, 250, false, 0);
					$user->save();
					return Redirect::to('dashboard')->with('success', trans("dashboard.dailyquest_completed"));
				}
			} elseif($progress == "bot") {
				$daily = Dailyprogess::where("user_id", "=", $user->id)->first();
				if($daily->bot_games >= 2) {
					$daily->claimed_bot = true;
					$daily->save();
					$user->reward(50, 250, false, 0);
					$user->save();
					return Redirect::to('dashboard')->with('success', trans("dashboard.dailyquest_completed"));
				}
			} elseif($progress == "fighter") {
                $daily = Dailyprogess::where("user_id", "=", $user->id)->first();
                if($daily->fighter_games >= 2) {
                    $daily->claimed_fighter = true;
                    $daily->save();
                    $user->reward(50, 250, false, 0);
                    $user->save();
                    return Redirect::to('dashboard')->with('success', trans("dashboard.dailyquest_completed"));
                }
            } elseif($progress == "mage") {
                $daily = Dailyprogess::where("user_id", "=", $user->id)->first();
                if($daily->mage_games >= 2) {
                    $daily->claimed_mage = true;
                    $daily->save();
                    $user->reward(50, 250, false, 0);
                    $user->save();
                    return Redirect::to('dashboard')->with('success', trans("dashboard.dailyquest_completed"));
                }
            } elseif($progress == "assassin") {
                $daily = Dailyprogess::where("user_id", "=", $user->id)->first();
                if($daily->assassin_games >= 2) {
                    $daily->claimed_assassin = true;
                    $daily->save();
                    $user->reward(50, 250, false, 0);
                    $user->save();
                    return Redirect::to('dashboard')->with('success', trans("dashboard.dailyquest_completed"));
                }
            } elseif($progress == "tank") {
                $daily = Dailyprogess::where("user_id", "=", $user->id)->first();
                if($daily->tank_games >= 2) {
                    $daily->claimed_tank = true;
                    $daily->save();
                    $user->reward(50, 250, false, 0);
                    $user->save();
                    return Redirect::to('dashboard')->with('success', trans("dashboard.dailyquest_completed"));
                }
            } elseif($progress == "marksman") {
                $daily = Dailyprogess::where("user_id", "=", $user->id)->first();
                if($daily->marksman_games >= 2) {
                    $daily->claimed_marksman = true;
                    $daily->save();
                    $user->reward(50, 250, false, 0);
                    $user->save();
                    return Redirect::to('dashboard')->with('success', trans("dashboard.dailyquest_completed"));
                }
            } elseif($progress == "support") {
                $daily = Dailyprogess::where("user_id", "=", $user->id)->first();
                if($daily->support_games >= 2) {
                    $daily->claimed_support = true;
                    $daily->save();
                    $user->reward(50, 250, false, 0);
                    $user->save();
                    return Redirect::to('dashboard')->with('success', trans("dashboard.dailyquest_completed"));
                }
            }
		}
		return Redirect::to('dashboard')->with('error', trans("dashboard.no_quest_found"));
	}
	
	
	public function create_challenge() {
		$input = Input::all();
		$validation = Validator::make($input, Quest::$rules);
		if (Auth::check())
		{
			$mode = Input::get('challenge_mode');
			$user = User::find(Auth::user()->id);
			$user->challenge_mode = $mode;
			$user->challenge_step = 1;
			$user->challenge_time = date("U")*1000;
			$user->timeline("challenge_start", 0, 0, $mode, $user->challenge_step, 0, 0);
			$user->save();
			
			return Redirect::to('challenges');
			
		} else {
			return Redirect::to('login');
		}
	}
	
	public function cancel_challenge() {
		if (Auth::check())
		{
			$user = User::find(Auth::user()->id);
			if($user->qp < 20) {
				return Redirect::to('/challenges')->with('error', trans("dashboard.low_qp"));
			}
			$user->qp = $user->qp - 20;
			$user->challenge_mode = 0;
			$user->challenge_step = 0;
			$user->save();
			
			return Redirect::to('/challenges');
			
		} else {
			return Redirect::to('login');
		}
	}
	

	public function create_choose_quest()
	{
		Session::put('_token', sha1(microtime()));
		$input = Input::all();
		$validation = Validator::make($input, Quest::$rules);
		if (Auth::check())
		{
			if ($validation->passes())
			{
				$user = User::find(Auth::user()->id);
				$open_quests = Quest::where("user_id", "=", $user->id)->where("finished", "=", "0")->count();
				$free_slots = $user->quest_slots - $open_quests;
				if($free_slots>0) {
				
					$champion = Input::get('choose_quest_champion');
					$role = Input::get('choose_playerrole');
					
					$api_type = Config::get('api.use_riot_api');
					
					
					// GENERATE QUESTTYPE
					if($role == 0) {
						$questtype = Questtype::orderBy(DB::raw('RAND()'))->first();
					} else {
						$questtype = Questtype::orderBy(DB::raw('RAND()'))->where("playerrole_id", "=", $role)->orWhere("playerrole_id", "=", 0)->first();
					}
						
					
					while($user->hasOpenQuestType($questtype->id) == true) {
						if($role == 0) {
							$questtype = Questtype::orderBy(DB::raw('RAND()'))->first();
						} else {
							$questtype = Questtype::orderBy(DB::raw('RAND()'))->where("playerrole_id", "=", $role)->orWhere("playerrole_id", "=", 0)->first();
						}
					}	
					
					if($api_type == 0) { // IF USING CUSTOM API
						while($questtype->id == 12){
							if($role == 0) {
								$questtype = Questtype::orderBy(DB::raw('RAND()'))->first();
							} else {
								$questtype = Questtype::orderBy(DB::raw('RAND()'))->where("playerrole_id", "=", $role)->orWhere("playerrole_id", "=", 0)->first();
							}
						}
					}
					
					
					$quest = new Quest;
					if($champion == 0) {
						$champion = Champion::orderBy(DB::raw('RAND()'))->first();
						$quest->champion_id = $champion->champion_id;
					} else {
						$quest->champion_id = Input::get('choose_quest_champion');
					}
					$quest->user_id = $user->id;
					$quest->type_id = $questtype->id;
					$quest->exp = $questtype->exp;
					$quest->quest_slot = "choose";
					$quest->createDate = date("U")*1000;
					$quest->save();
					
					$quest_count = ChampionQuest::where("champion_id", "=", $quest->champion_id)->where("quest_date", "=", date("y.m.d"))->first();
					if(!isset($quest_count)) {
						$quest_count = new ChampionQuest;
						$quest_count->quest_date = date("y.m.d");
						$quest_count->champion_id = $quest->champion_id;
						$quest_count->quest_count = 1;
					} else {
						$quest_count->quest_count = $quest_count->quest_count + 1;
					}
					$quest_count->save();
					$user->timeline("quest_start", $quest->id, 0, 0, 0,0,0);
					
					return Redirect::to('dashboard')->with('success', trans("dashboard.accepted"));
				
				} else {
					return Redirect::to('dashboard')->with('error', trans("dashboard.no_free_slot"));
				}
				
			} else {
				// Back
				return Redirect::to('dashboard')
				->withInput()
				->withErrors($validation)
				->with('error', trans("warnings.validation_errors"));
			}
		} else {
			return Redirect::to('login');
		}
		
	}
	
	public function accept_daily() {

		if (Auth::check())
		{
			$user = User::find(Auth::user()->id);
			
			if($user->summoner_status == 2) {
				$amount_dailies = Quest::where("user_id", "=", $user->id)->where("finished", "=", "0")->where("daily", "=", "1")->count();
				if($amount_dailies>0 || $user->daily_done == 1) {
					return Redirect::to('dashboard')->with('error', trans("dashboard.has_daily"));
				} else {
					$open_quests = Quest::where("user_id", "=", $user->id)->where("finished", "=", "0")->count();
					$free_slots = $user->quest_slots - $open_quests;
					if($free_slots>0) {
						$daily = Daily::where('active', '=', 1)->first();
						$quest = new Quest;
						$quest->champion_id = $daily->champion_id;
						$quest->user_id = $user->id;
						$quest->type_id = $daily->type_id;
						$quest->exp = $daily->questtype->exp * 2;
						$quest->daily = 1;
						$quest->quest_slot = "choose";
						$quest->createDate = date("U")*1000;
						$quest->save();
						
						$user->timeline("daily_start", $quest->id, 0, 0, 0, 0, 0);
						
						return Redirect::to('dashboard')->with('success', trans("dashboard.accepted"));
					} else {
						return Redirect::to('dashboard')->with('error', trans("dashboard.no_free_slot"));
					}
				}
			} else {
				return Redirect::to('/verify')->with('error', trans("dashboard.verify_first"));
			}
	
		} else {
			return Redirect::to('login');
		}
	}
	
	public static function check_quest($quest_id) {
	
		$input = Input::all();
		$validation = Validator::make($input, Quest::$rules);
		if (Auth::check()) { 
			if ($validation->passes()) {
				$user = User::find(Auth::user()->id);
				
				//$quest = Quest::find($quest_id);
				$quest = Quest::where('id', '=', $quest_id)->where('user_id', '=', Auth::user()->id)->where("finished", "=", 0)->first();
				if(isset($quest) && $quest->count() > 0) {
					
					$user->refresh_games();

				
				// START OF DIFFERENT QUESTS
				
					// Quest Type 1 - Play a game
					if($quest->questtype->id == 1) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						if($games_since_queststart->count() > 0) {
							$quest->finished = 1;
							$quest->save();
							if($quest->daily == 1) {
								$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
							} else {
								$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
							}
							$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
							$user->dailyprogress->addQuestCompleted($user);
							return Redirect::to('/quest_finished/'.$quest->id);
						}
					}
					
					// Quest Type 2 - Win a game
					if($quest->questtype->id == 2) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('win', '=', 1)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						if($games_since_queststart->count() > 0) {
							$quest->finished = 1;
							$quest->save();
							if($quest->daily == 1) {
								$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
							} else {
								$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
							}
							$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
							$user->dailyprogress->addQuestCompleted($user);
							return Redirect::to('/quest_finished/'.$quest->id);
						}
					}
					
					
					// Quest Type 3 - KDA >= 3.0
					if($quest->questtype->id == 3) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
							
							if($game->numDeaths == 0) {
								$kda = round(($game->championsKilled+$game->assists),1);
							} else {
								$kda = round(($game->championsKilled+$game->assists)/$game->numDeaths,1);
							}
								
							if($kda >= 3) {
								$quest->finished = 1;
								$quest->save();
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					
					
					// Quest Type 4 - Place at least 15 wards
					if($quest->questtype->id == 4) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->wardPlaced >= 15) {
								$quest->finished = 1;
								$quest->save();
							if($quest->daily == 1) {
								$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
							} else {
								$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
							}
							
							$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					
					// Quest Type 5 - Min. 6 kills on Summoners Rift
					if($quest->questtype->id == 5 || $quest->questtype->id == 18 || $quest->questtype->id == 19 || $quest->questtype->id == 20) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->gameMode == "CLASSIC" && $game->championsKilled >= 6) {
								$quest->finished = 1;
								$quest->save();
							if($quest->daily == 1) {
								$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
							} else {
								$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
							}
							$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					// Quest Type 6 - Min. 200 CS on SR
					if($quest->questtype->id == 6 || $quest->questtype->id == 21 || $quest->questtype->id == 22 || $quest->questtype->id == 23) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							$total_minions = $game->minionsKilled+$game->neutralMinionsKilled;
							if(($game->gameMode == "CLASSIC") && ($total_minions >= 200)) {
								$quest->finished = 1;
								$quest->save();	
							if($quest->daily == 1) {
								$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
							} else {
								$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
							}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					
					// Quest Type 7 - Take Smite + mind. 50 neutral Minons
					if($quest->questtype->id == 7) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->spell1 == 11 || $game->spell2 == 11) {
								if($game->neutralMinionsKilled >= 50) {
									$quest->finished = 1;
									$quest->save();
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
									$user->dailyprogress->addQuestCompleted($user);
									return Redirect::to('/quest_finished/'.$quest->id);
								}
							}
						}
					}
					
					
					// Quest Type 8 - Dont die!
					if($quest->questtype->id == 8) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('win', '=', 1)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->numDeaths == 0 && $game->goldEarned >= 11000) {
								$quest->finished = 1;
								$quest->save();
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					
					// Quest Type 9 - At least 11k Gold
					if($quest->questtype->id == 9) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						
						foreach($games_since_queststart as $game) {
								
							if($game->goldEarned >= 11000) {
								$quest->finished = 1;
								$quest->save();
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
									$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
									$user->dailyprogress->addQuestCompleted($user);
									return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					
					// Quest Type 10 - 15 assists (Support only)
					if($quest->questtype->id == 10) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->assists >= 15) {
								$quest->finished = 1;
								$quest->save();
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
									$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
									$user->dailyprogress->addQuestCompleted($user);
									return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					// Quest Type 11 - Kill at least 5 Wards
					if($quest->questtype->id == 11) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->wardKilled >= 5) {
								$quest->finished = 1;
								$quest->save();
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
									$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
									$user->dailyprogress->addQuestCompleted($user);
									return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					// Quest Type 12 - Finish under 30 minutes
					if($quest->questtype->id == 12) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->timePlayed <= 1800) {
								$quest->finished = 1;
								$quest->save();
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
									$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
									$user->dailyprogress->addQuestCompleted($user);
									return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					
					// Quest Type 13 - Mind 2 Turrets
					if($quest->questtype->id == 13 || $quest->questtype->id == 24 || $quest->questtype->id == 25) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->turretsKilled >= 2) {
								$quest->finished = 1;
								$quest->save();
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
									$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
									$user->dailyprogress->addQuestCompleted($user);
									return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					
					// Quest Type 14 - Get on a Killing Spree
					if($quest->questtype->id == 14 || $quest->questtype->id == 26 || $quest->questtype->id == 27 || $quest->questtype->id == 28) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->killingSprees >= 1) {
								$quest->finished = 1;
								$quest->save();
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
									$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
									$user->dailyprogress->addQuestCompleted($user);
									return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}

					
					
					// Quest Type 15 - At least 5000 Heal (Support Only)
					if($quest->questtype->id == 15) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->totalHeal >= 5000) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
									$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
									$user->dailyprogress->addQuestCompleted($user);
									return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					

					// Quest Type 16 - Deal at least 120000 Dmg
					if($quest->questtype->id == 16 || $quest->questtype->id == 29 || $quest->questtype->id == 30 || $quest->questtype->id == 31) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->totalDamageDealt >= 120000) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
									$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
									$user->dailyprogress->addQuestCompleted($user);
									return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					
					// Quest Type 17 - Tank 20.000 Dmg
					if($quest->questtype->id == 17 || $quest->questtype->id == 33 || $quest->questtype->id == 34) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->totalDamageTaken >= 20000) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true, $quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false, $quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								$user->checkAchievement(6, $user->lifetime_qp);
								$user->checkAchievement(2, $user->finishedQuestsCount());
								$user->save();
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					
					// Quest Type 35 - Late game
					if($quest->questtype->id == 35) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->level == 18) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true, $quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false, $quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								$user->checkAchievement(6, $user->lifetime_qp);
								$user->checkAchievement(2, $user->finishedQuestsCount());
								$user->save();
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					
					// Quest Type 36 - Early bird
					if($quest->questtype->id == 36) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->level <= 15) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true, $quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false, $quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								$user->checkAchievement(6, $user->lifetime_qp);
								$user->checkAchievement(2, $user->finishedQuestsCount());
								$user->save();
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					
					// Quest Type 37 - Death timer
					if($quest->questtype->id == 37) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->numDeaths <= 3) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true, $quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false, $quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								$user->checkAchievement(6, $user->lifetime_qp);
								$user->checkAchievement(2, $user->finishedQuestsCount());
								$user->save();
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					
					// Quest Type 38 - Kill at least 15 enemy jungle minions
					if($quest->questtype->id == 38) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->neutralMinionsKilledEnemyJungle >= 15) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true, $quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false, $quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								$user->checkAchievement(6, $user->lifetime_qp);
								$user->checkAchievement(2, $user->finishedQuestsCount());
								$user->save();
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					// Quest Type 39 - Get at least 3 Kills and 5 assists
					if($quest->questtype->id == 39) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->assists >= 5 && $game->championsKilled >= 3) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					
					// Quest Type 40 - Get first blood
					if($quest->questtype->id == 40 || $quest->questtype->id == 41 || $quest->questtype->id == 42 || $quest->questtype->id == 43) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->firstBloodKill == 1) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					
					// Quest Type 44 - Team get first blood
					if($quest->questtype->id == 44) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->firstBlood == 1) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					// Quest Type 45 - Get the first DRAGON
					if($quest->questtype->id == 45) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->firstDragon == 1) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					
					// Quest Type 46 - Get the first BARON
					if($quest->questtype->id == 46) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->firstBaron == 1) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					// Quest Type 47 - Destroy at least 8 towers
					if($quest->questtype->id == 47) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->towerKills >= 8) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					// Quest Type 48 - First inhib
					if($quest->questtype->id == 48) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->firstInhibitor == 1) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					// Quest Type 49 - At least 2 Inhibs
					if($quest->questtype->id == 49) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->inhibitorKills >= 2) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					
					// Quest Type 50 - Get the first tower of the game
					if($quest->questtype->id == 50) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->firstTower == 1) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					// Quest Type 51 - At least 3 dragons
					if($quest->questtype->id == 51) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->dragonKills >= 3) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					// Quest Type 52 - Get at least 2 baron buffs
					if($quest->questtype->id == 52) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->baronKills >= 2) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}
					
					
					// Quest Type 53 - 3 double, 2 triple or 1 quadra
					if($quest->questtype->id == 55 || $quest->questtype->id == 56 || $quest->questtype->id == 57 || $quest->questtype->id == 58) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('gameType', '=', "MATCHED_GAME")->where('mapId', '=', 11)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->doubleKills >= 3 || $game->tripleKills >= 2 || $game->quadraKills >= 1) {
								$quest->finished = 1;
								$quest->save();					
								if($quest->daily == 1) {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,true,$quest->champion_id);
								} else {
									$user->reward($quest->questtype->qp,$quest->questtype->exp,false,$quest->champion_id);
								}
								$user->timeline("quest_complete", $quest->id, 0, 0, 0, 0, 0);
								$user->dailyprogress->addQuestCompleted($user);
								return Redirect::to('/quest_finished/'.$quest->id);
							}
						}
					}

					
					
				} else {
					return Redirect::to('dashboard')->with('error', trans("dashboard.no_active_quest"));
				}
				return Redirect::to('dashboard')->with('error', trans("dashboard.quest_not_done"));
				
				
			} else {
				return Redirect::to('dashboard')
					->withInput()
					->withErrors($validation)
					->with('error', trans("warnings.validation_errors"));
			}
		} else {
			return Redirect::to('login');
		}
	}


}
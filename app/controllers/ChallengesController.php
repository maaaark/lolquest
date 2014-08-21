<?php

class ChallengesController extends \BaseController {

	public function finish_challenge()
	{
		if (Auth::check()) { 
				$user = User::find(Auth::user()->id);
				$user->refresh_games();
				
				$challenge_done = 0;
				$item_count = 0;
				
				if($user->challenge_mode == 1) { // TOP CHALLENGES
					
					
//					$top_champions = array(58, 48, 24, 39, 126, 62, 80, 64, 92, 68, 98, 8, 83, 122, 10, 41);
					$top_champions = Config::get('settings.top_champions');
					
					// STEP 1
					if($user->challenge_step == 1) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $top_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							$user->challenge_step = 2;
							$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false,0);
							$user->challenge_time = date("U")*1000;
							$user->save();
							
							$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
							
							return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
						}
					}
					
					
					// STEP 2
					if($user->challenge_step == 2) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $top_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								if($game->spell1 == 12) {
									$challenge_done = 1;
								}
								if($game->spell2 == 12) {
									$challenge_done = 1;
								}
							}
							
							if($challenge_done == 1) {
								$user->challenge_step = 3;
								$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false,0);
								$user->challenge_time = date("U")*1000;
								$user->save();
								$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
								return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
							}
							
						}
					}
					
					
					// STEP 3
					if($user->challenge_step == 3) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $top_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								$item_count = 0;
								if($game->item0 == 3068 || $game->item1 == 3068 || $game->item2 == 3068 || $game->item3 == 3068 || $game->item4 == 3068 || $game->item5 == 3068) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 3143 || $game->item1 == 3143 || $game->item2 == 3143 || $game->item3 == 3143 || $game->item4 == 3143 || $game->item5 == 3143) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 3065 || $game->item1 == 3065 || $game->item2 == 3065 || $game->item3 == 3065 || $game->item4 == 3065 || $game->item5 == 3065) {
									$item_count = $item_count +1;
								}
								
								if($item_count >= 3) {
									$user->challenge_step = 4;
									$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
									$user->challenge_time = date("U")*1000;
									$user->save();
									$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
									return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
								}
							}
						}
					}

					
					// STEP 4
					if($user->challenge_step == 4) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $top_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								if($game->totalDamageTaken >= 30000) {
									$challenge_done = 1;
								}
							}
							
							if($challenge_done == 1) {
								$user->challenge_step = 5;
								$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
								$user->challenge_time = date("U")*1000;
								$user->save();
								$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
								return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
							}
							
						}
					}
					
					
					// STEP 5
					if($user->challenge_step == 5) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $top_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								if($game->totalDamageDealt >= 80000 && $game->championsKilled >= 5 && $game->goldEarned >= 16000 && $game->wardPlaced >= 5 && $game->turretsKilled >= 1) {
									$challenge_done = 1;
								}
								
								if($challenge_done == 1) {
									$user->achievements()->attach(35);
									$a = Achievement::where('id', '=', 35)->first();
									$user->notify(1, trans("achievements.receive").$a->name);
									$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
									$user->challenge_time = date("U")*1000;
									$user->trophy_top = 1;
									$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step,0,0);
									$user->challenge_mode = 0;
									$user->challenge_step = 0;
									$user->save();
									return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
								}
							
							}
							
							
							
						}
					}
					
					
					// Not completed
					return Redirect::to('challenges')->with('error', trans("dashboard.quest_not_done"));
					
					
				} elseif($user->challenge_mode == 2) { // JUNGLE CHALLENGES
//					$jungle_champions = array(64, 77, 5, 80, 121, 32, 120, 11, 111, 56, 33, 107, 35, 19, 254, 60, 28);
					$jungle_champions = Config::get('settings.jungle_champions');
					
					// STEP 1
					if($user->challenge_step == 1) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $jungle_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							$user->challenge_step = 2;
							$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
							$user->challenge_time = date("U")*1000;
							$user->save();
							
							$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
							
							return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
						}
					}
					
					
					// STEP 2
					if($user->challenge_step == 2) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $jungle_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								if($game->spell1 == 11) {
									$challenge_done = 1;
								}
								if($game->spell2 == 11) {
									$challenge_done = 1;
								}
							}
							
							if($challenge_done == 1) {
								$user->challenge_step = 3;
								$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
								$user->challenge_time = date("U")*1000;
								$user->save();
								$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
								return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
							}
							
						}
					}
					
					// STEP 3
					if($user->challenge_step == 3) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $jungle_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							foreach($games_since_queststart as $game) {
								$item_count = 0;
								if($game->item0 == 2049 || $game->item1 == 2049 || $game->item2 == 2049 || $game->item3 == 2049 || $game->item4 == 2049 || $game->item5 == 2049) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 2045 || $game->item1 == 2045 || $game->item2 == 2045 || $game->item3 == 2045 || $game->item4 == 2045 || $game->item5 == 2045) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 3341 || $game->item1 == 3341 || $game->item2 == 3341 || $game->item3 == 3341 || $game->item4 == 3341 || $game->item5 == 3341 || $game->item6 == 3341) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 3364 || $game->item1 == 3364 || $game->item2 == 3364 || $game->item3 == 3364 || $game->item4 == 3364 || $game->item5 == 3364 || $game->item6 == 3364) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 3160 || $game->item1 == 3160 || $game->item2 == 3160 || $game->item3 == 3160 || $game->item4 == 3160 || $game->item5 == 3160) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 3206 || $game->item1 == 3206 || $game->item2 == 3206 || $game->item3 == 3206 || $game->item4 == 3206 || $game->item5 == 3206) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 3209 || $game->item1 == 3209 || $game->item2 == 3209 || $game->item3 == 3209 || $game->item4 == 3209 || $game->item5 == 3209) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 3207 || $game->item1 == 3207 || $game->item2 == 3207 || $game->item3 == 3207 || $game->item4 == 3207 || $game->item5 == 3207) {
									$item_count = $item_count +1;
								}
								
								
								if($item_count >= 3) {
									$user->challenge_step = 4;
									$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
									$user->challenge_time = date("U")*1000;
									$user->save();
									$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
									return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
								}
							
							}
							
						}
					}
					
					
					// STEP 4
					if($user->challenge_step == 4) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $jungle_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								if($game->totalDamageTaken >= 25000) {
									$challenge_done = 1;
								}
							}
							
							if($challenge_done == 1) {
								$user->challenge_step = 5;
								$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
								$user->challenge_time = date("U")*1000;
								$user->save();
								$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
								return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
							}
							
						}
					}
					
					
					// STEP 5
					if($user->challenge_step == 5) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $jungle_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								if($game->totalDamageDealt >= 75000 && $game->championsKilled >= 5 && $game->goldEarned >= 16000 && $game->wardPlaced >= 5 && $game->neutralMinionsKilled >= 60) {
									$challenge_done = 1;
								}
								
								if($challenge_done == 1) {
									$user->achievements()->attach(39);
									$a = Achievement::where('id', '=', 39)->first();
									$user->notify(1, trans("achievements.receive").$a->name);
									$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
									$user->challenge_time = date("U")*1000;
									$user->trophy_jungle = 1;
									$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step,0,0);
									$user->challenge_mode = 0;
									$user->challenge_step = 0;
									$user->save();
									return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
								}
							
							}
						}
					}
					
					// Not completed
					return Redirect::to('challenges')->with('error', trans("dashboard.quest_not_done"));
					
				
				} elseif($user->challenge_mode == 3) { // MID CHALLENGES
//					$mid_champions = array(103, 61, 79, 55, 63, 38, 157, 7, 127, 117, 4, 74, 90, 101, 115);
					$mid_champions = Config::get('settings.mid_champions');
					
					// STEP 1
					if($user->challenge_step == 1) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $mid_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							$user->challenge_step = 2;
							$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
							$user->challenge_time = date("U")*1000;
							$user->save();
							
							$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
							
							return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
						}
					}
					
					
					// STEP 2
					if($user->challenge_step == 2) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $mid_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								if($game->spell1 == 14) {
									$challenge_done = 1;
								}
								if($game->spell2 == 14) {
									$challenge_done = 1;
								}
							}
							
							if($challenge_done == 1) {
								$user->challenge_step = 3;
								$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
								$user->challenge_time = date("U")*1000;
								$user->save();
								$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
								return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
							}
							
						}
					}
					
					// STEP 3
					if($user->challenge_step == 3) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $mid_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								$item_count = 0;
								if($game->item0 == 3089 || $game->item1 == 3089 || $game->item2 == 3089 || $game->item3 == 3089 || $game->item4 == 3089 || $game->item5 == 3089) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 3157 || $game->item1 == 3157 || $game->item2 == 3157 || $game->item3 == 3157 || $game->item4 == 3157 || $game->item5 == 3157) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 3135 || $game->item1 == 3135 || $game->item2 == 3135 || $game->item3 == 3135 || $game->item4 == 3135 || $game->item5 == 3135) {
									$item_count = $item_count +1;
								}
								
								if($item_count >= 3) {
									$user->challenge_step = 4;
									$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
									$user->challenge_time = date("U")*1000;
									$user->save();
									$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
									return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
								}
								
							}
						}
					}
					
					
					// STEP 4
					if($user->challenge_step == 4) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $mid_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								if($game->totalDamageDealt >= 70000) {
									$challenge_done = 1;
								}
							}
							
							if($challenge_done == 1) {
								$user->challenge_step = 5;
								$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
								$user->challenge_time = date("U")*1000;
								$user->save();
								$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
								return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
							}
							
						}
					}
					
					// STEP 5
					if($user->challenge_step == 5) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $mid_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								if($game->totalDamageDealt >= 120000 && $game->championsKilled >= 5 && $game->goldEarned >= 16000 && $game->wardPlaced >= 1 && $game->turretsKilled >= 1) {
									$challenge_done = 1;
								}
								
								if($challenge_done == 1) {
									$user->achievements()->attach(36);
									$a = Achievement::where('id', '=', 36)->first();
									$user->notify(1, trans("achievements.receive").$a->name);
									$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
									$user->challenge_time = date("U")*1000;
									$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step,0,0);
									$user->trophy_mid = 1;
									$user->challenge_mode = 0;
									$user->challenge_step = 0;
									$user->save();
									return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
								}
							
							}
							
							
							
						}
					}
					
					// Not completed
					return Redirect::to('challenges')->with('error', trans("dashboard.quest_not_done"));
					
				
				} elseif($user->challenge_mode == 4) { // MARKSMAN CHALLENGES
//					$marksman_champions = array(222, 51, 236, 81, 15, 104, 67, 42, 29, 18, 21, 110, 96, 119, 22);
					$marksman_champions = Config::get('settings.marksman_champions');
					
					// STEP 1
					if($user->challenge_step == 1) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $marksman_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							$user->challenge_step = 2;
							$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
							$user->challenge_time = date("U")*1000;
							$user->save();
							
							$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
							
							return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
						}
					}
					
					// STEP 2
					if($user->challenge_step == 2) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $marksman_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								if($game->spell1 == 7) {
									$challenge_done = 1;
								}
								if($game->spell2 == 7) {
									$challenge_done = 1;
								}
							}
							
							if($challenge_done == 1) {
								$user->challenge_step = 3;
								$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
								$user->challenge_time = date("U")*1000;
								$user->save();
								$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
								return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
							}
							
						}
					}
					
					// STEP 3
					if($user->challenge_step == 3) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $marksman_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								$item_count = 0;
								if($game->item0 == 3072 || $game->item1 == 3072 || $game->item2 == 3072 || $game->item3 == 3072 || $game->item4 == 3072 || $game->item5 == 3072) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 3031 || $game->item1 == 3031 || $game->item2 == 3031 || $game->item3 == 3031 || $game->item4 == 3031 || $game->item5 == 3031) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 3035 || $game->item1 == 3035 || $game->item2 == 3035 || $game->item3 == 3035 || $game->item4 == 3035 || $game->item5 == 3035) {
									$item_count = $item_count +1;
								}
								
								if($item_count >= 3) {
									$user->challenge_step = 4;
									$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
									$user->challenge_time = date("U")*1000;
									$user->save();
									$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
									return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
								}
							}
							
						}
					}
					
					
					// STEP 4
					if($user->challenge_step == 4) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $marksman_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								if($game->totalDamageDealt >= 70000) {
									$challenge_done = 1;
								}
							}
							
							if($challenge_done == 1) {
								$user->challenge_step = 5;
								$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
								$user->challenge_time = date("U")*1000;
								$user->save();
								$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
								return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
							}
							
						}
					}
					
					
					// STEP 5
					if($user->challenge_step == 5) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $marksman_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								if($game->totalDamageDealt >= 120000 && $game->championsKilled >= 5 && $game->goldEarned >= 16000 && $game->wardPlaced >= 1 && $game->turretsKilled >= 1) {
									$challenge_done = 1;
								}
								
								if($challenge_done == 1) {
									$user->achievements()->attach(38);
									$a = Achievement::where('id', '=', 38)->first();
									$user->notify(1, trans("achievements.receive").$a->name);
									$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
									$user->challenge_time = date("U")*1000;
									$user->trophy_marksman = 1;
									$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step,0,0);
									$user->challenge_mode = 0;
									$user->challenge_step = 0;
									$user->save();
									return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
								}
							}
						}
					}
					
					// Not completed
					return Redirect::to('challenges')->with('error', trans("dashboard.quest_not_done"));
					
				
				} elseif($user->challenge_mode == 5) { // SUPPORT CHALLENGES
//					$support_champions = array(1, 89, 412, 37, 25, 43, 20, 44, 201, 12, 16, 40, 267, 143, 53, 117);
					$support_champions = Config::get('settings.support_champions');
					
					// STEP 1
					if($user->challenge_step == 1) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $support_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							$user->challenge_step = 2;
							$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
							$user->challenge_time = date("U")*1000;
							$user->save();
							
							$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
							
							return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
						}
					}
					
					
					
					// STEP 2
					if($user->challenge_step == 2) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $support_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								if($game->spell1 == 3) {
									$challenge_done = 1;
								}
								if($game->spell2 == 3) {
									$challenge_done = 1;
								}
							}
							
							if($challenge_done == 1) {
								$user->challenge_step = 3;
								$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
								$user->challenge_time = date("U")*1000;
								$user->save();
								$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
								return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
							}
							
						}
					}
					
					// STEP 3
					if($user->challenge_step == 3) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $support_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								$item_count = 0;
								if($game->item0 == 3069 || $game->item1 == 3069 || $game->item2 == 3069 || $game->item3 == 3069 || $game->item4 == 3069 || $game->item5 == 3069) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 2049 || $game->item1 == 2049 || $game->item2 == 2049 || $game->item3 == 2049 || $game->item4 == 2049 || $game->item5 == 2049) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 2045 || $game->item1 == 2045 || $game->item2 == 2045 || $game->item3 == 2045 || $game->item4 == 2045 || $game->item5 == 2045) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 3222 || $game->item1 == 3222 || $game->item2 == 3222 || $game->item3 == 3222 || $game->item4 == 3222 || $game->item5 == 3222) {
									$item_count = $item_count +1;
								}
								
								if($item_count >= 3) {
									$user->challenge_step = 4;
									$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
									$user->challenge_time = date("U")*1000;
									$user->save();
									$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
									return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
								}
							
							}
							
						}
					}
					
					
					// STEP 4
					if($user->challenge_step == 4) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $support_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								if($game->totalHeal >= 10000) {
									$challenge_done = 1;
								}
							}
							
							if($challenge_done == 1) {
								$user->challenge_step = 5;
								$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
								$user->challenge_time = date("U")*1000;
								$user->save();
								$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
								return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
							}
							
						}
					}
					
					
					// STEP 5
					if($user->challenge_step == 5) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
						->where('win', '=', 1)
						->whereIn('championId', $support_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								if($game->totalHeal >= 20000 && $game->assists >= 15 && $game->goldEarned >= 14000 && $game->wardPlaced >= 15) {
									$challenge_done = 1;
								}
							
								if($challenge_done == 1) {
									$user->achievements()->attach(37);
									$a = Achievement::where('id', '=', 37)->first();
									$user->notify(1, trans("achievements.receive").$a->name);
									$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false, 0);
									$user->challenge_time = date("U")*1000;
									$user->trophy_support = 1;
									$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step,0,0);
									$user->challenge_mode = 0;
									$user->challenge_step = 0;
									$user->save();
									return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
								}
							
							}
						}
					}
					
					// Not completed
					return Redirect::to('challenges')->with('error', trans("dashboard.quest_not_done"));
				
				}
		} else {
			return Redirect::to('login');
		}
	}

}
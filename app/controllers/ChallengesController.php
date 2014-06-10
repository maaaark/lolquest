<?php

class ChallengesController extends \BaseController {

	public function finish_challenge()
	{
		if (Auth::check()) { 
				$user = User::find(Auth::user()->id);
				$user->refresh_games();
				
				if($user->challenge_mode == 1) { // TOP CHALLENGES
					
					$challenge_done = 0;
					$item_count = 0;
					$top_champions = array(58, 48, 24, 39, 126, 62, 80, 64, 92, 68, 98, 8, 83, 122, 10, 41);
					
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
							$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false);
							$user->challenge_time = date("U")*1000;
							if($user->exp > ($user->level->exp_level)-1) {
								$user->level_id +=1;
								$user->checkAchievement(1, $user->level_id);
							}
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
								$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false);
								$user->challenge_time = date("U")*1000;
								if($user->exp > ($user->level->exp_level)-1) {
								$user->level_id +=1;
								$user->checkAchievement(1, $user->level_id);
								}
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
								if($game->item0 == 3068 || $game->item1 == 3068 || $game->item2 == 3068 || $game->item3 == 3068 || $game->item4 == 3068 || $game->item5 == 3068) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 3143 || $game->item1 == 3143 || $game->item2 == 3143 || 	$game->item3 == 3143 || $game->item4 == 3143 || $game->item5 == 3143) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 3065 || $game->item1 == 3065 || $game->item2 == 3065 || $game->item3 == 3065 || $game->item4 == 3065 || $game->item5 == 3065) {
									$item_count = $item_count +1;
								}
							}
							
							if($item_count >= 3) {
								$user->challenge_step = 4;
								$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false);
								$user->challenge_time = date("U")*1000;
								$user->save();
								$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
								return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
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
								$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false);
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
								if($game->totalDamageDealt >= 100000 && $game->championsKilled >= 5 && $game->goldEarned >= 20000 && $game->wardPlaced >= 5 && $game->turretsKilled >= 1) {
									$challenge_done = 1;
								}
							}
							
							if($challenge_done == 1) {
								$user->achievements()->attach(35);
								$user->reward(Config::get('rewards.challenge_qp'),Config::get('rewards.challenge_exp'),false);
								$user->challenge_time = date("U")*1000;
								$user->trophy_top = 1;
								$user->challenge_mode = 0;
								$user->challenge_step = 0;
								$user->save();
								$user->timeline("challenge_step", 0, 0, $user->challenge_mode, $user->challenge_step-1,0,0);
								return Redirect::to("challenges")->with('success', trans("dashboard.quest_done", array('exp'=>Config::get('rewards.challenge_exp'), 'qp'=>Config::get('rewards.challenge_qp'))));
							}
							
						}
					}
					
					
					// Not completed
					return Redirect::to('challenges')->with('error', trans("dashboard.quest_not_done"));
					
					
				} elseif($user->challenge_mode == 2) { // JUNGLE CHALLENGES
					$jungle_champions = array(64, 77, 5, 80, 121, 32, 120, 11, 111, 56, 33, 107, 35, 19, 254);
				
				} elseif($user->challenge_mode == 3) { // MID CHALLENGES
					$mid_champions = array(103, 61, 79, 55, 63, 38, 157, 7, 127, 117, 4, 74, 90, 101, 115);
				
				} elseif($user->challenge_mode == 4) { // MARKSMAN CHALLENGES
					$marksman_champions = array(222, 51, 236, 81, 15, 104, 67, 42, 29, 18, 21, 110, 96, 119, 22);
				
				} elseif($user->challenge_mode == 5) { // SUPPORT CHALLENGES
					$support_champions = array(89, 412, 37, 25, 43, 20, 44, 201, 12, 16, 40, 267, 143, 53);
				
				}
		} else {
			return Redirect::to('login');
		}
	}

}
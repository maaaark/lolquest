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
						->whereIn('championId', $top_champions)
						->where('createDate', '>', $user->challenge_time)
						->get();
						if($games_since_queststart->count() > 0) {
							
							foreach($games_since_queststart as $game) {
								if($game->item0 == 12 || $game->item1 == 12 || $game->item2 == 12 || $game->item3 == 12 || $game->item4 == 12 || $game->item5 == 12) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 12 || $game->item1 == 12 || $game->item2 == 12 || 	$game->item3 == 12 || $game->item4 == 12 || $game->item5 == 12) {
									$item_count = $item_count +1;
								}
								if($game->item0 == 12 || $game->item1 == 12 || $game->item2 == 12 || $game->item3 == 12 || $game->item4 == 12 || $game->item5 == 12) {
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
					
					
					// Not completed
					return Redirect::to('challenges')->with('error', trans("dashboard.quest_not_done"));
					
					
				} elseif($user->challenge_mode == 2) { // JUNGLE CHALLENGES
					$jungle_champions = array(64, 77, 5, 80, 121, 32, 120, 11, 111, 56, 33, 107, 35, 19, 254);
				
				} elseif($user->challenge_mode == 3) { // MID CHALLENGES
					$mid_champions = array();
				
				} elseif($user->challenge_mode == 4) { // MARKSMAN CHALLENGES
					$marksman_champions = array();
				
				} elseif($user->challenge_mode == 5) { // SUPPORT CHALLENGES
					$support_champions = array();
				
				}
		} else {
			return Redirect::to('login');
		}
	}

}
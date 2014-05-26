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
							$user->save();
							
							return Redirect::to("dashboard");
						}
					}
					
					
					// STEP 2
					if($user->challenge_step == 2) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)
						->where('gameType', '=', "MATCHED_GAME")
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
								$user->save();
								return Redirect::to("dashboard");
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
								return Redirect::to("dashboard");
							}
							
						}
					}
					
					
					// Not completed
					return Redirect::to('dashboard')->with('error', trans("dashboard.quest_not_done"));
					
					
				} elseif($user->challenge_mode == 2) { // JUNGLE CHALLENGES
				
				} elseif($user->challenge_mode == 3) { // MID CHALLENGES
				
				} elseif($user->challenge_mode == 4) { // MARKSMAN CHALLENGES
				
				} elseif($user->challenge_mode == 5) { // SUPPORT CHALLENGES
				
				}
		} else {
			return Redirect::to('login');
		}
	}

}
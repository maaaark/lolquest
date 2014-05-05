<?php

class QuestsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	
	public function cancel_quest($quest_id) {
		if (Auth::check()) { 
				$user = User::find(Auth::user()->id);
				$quest = Quest::where("user_id", "=", $user->id)->where("id", "=", $quest_id)->where("daily", "=", 1)->first();
				if($quest) {
					$quest->delete();
					$user->qp = $user->qp - Config::get('costs.delete_daily');
					$user->save();
					return Redirect::to('dashboard')->with('message', trans("dashboard.deleted"));
				} else {
					return Redirect::to('dashboard')->with('error', trans("dashboard.no_quest_found"));
				}
		} else {
			return Redirect::to('login');
		}
	}
	
	
	
	public function reroll_quest($quest_id) {
		$input = Input::all();
		$validation = Validator::make($input, Quest::$rules);
		if (Auth::check()) { 
			if ($validation->passes()) {
				$user = User::find(Auth::user()->id);
				$costs = Config::get('costs.reroll');
				if($user->qp >= $costs) {
					$quest = Quest::where('user_id', '=', $user->id)->where('id', '=', $quest_id)->first();
					$questtype = Questtype::orderBy(DB::raw('RAND()'))->first();
					$quest->type_id = $questtype->id;
					//$champion = Champion::orderBy(DB::raw('RAND()'))->first();
					//$quest->champion_id = $champion->champion_id;
					$user->qp = $user->qp - Config::get('costs.reroll');
					$user->save();
					$quest->save();
					return Redirect::to('dashboard')->with('message', trans("dashboard.rerolled"));
				}
				
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
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create_choose_quest()
	{
		$input = Input::all();
		$validation = Validator::make($input, Quest::$rules);
		if (Auth::check())
		{
			if ($validation->passes())
			{
					$champion = Input::get('choose_quest_champion');
					$user = User::find(Auth::user()->id);
					$questtype = Questtype::orderBy(DB::raw('RAND()'))->first();
					$quest = new Quest;
					if($champion == 0) {
						$champion = Champion::orderBy(DB::raw('RAND()'))->first();
						$quest->champion_id = $champion->champion_id;
					} else {
						$quest->champion_id = Input::get('choose_quest_champion');
					}
					$quest->user_id = $user->id;
					$quest->type_id = $questtype->id;
					$quest->exp = 100;
					$quest->quest_slot = "choose";
					$quest->createDate = date("U")*1000;
					$quest->save();
					return Redirect::to('dashboard')->with('message', trans("dashboard.accepted"));

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
			
			$amount_dailies = Quest::where("user_id", "=", $user->id)->where("finished", "=", "0")->where("daily", "=", "1")->count();
			if($amount_dailies>0) {
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
					$quest->daily = 1;
					$quest->quest_slot = "choose";
					$quest->createDate = date("U")*1000;
					$quest->save();
					return Redirect::to('dashboard')->with('message', trans("dashboard.accepted"));
				} else {
					return Redirect::to('dashboard')->with('error', trans("dashboard.no_free_slot"));
				}
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
				$quest = Quest::where('id', '=', $quest_id)->where('user_id', '=', Auth::user()->id)->first();
				if($quest->count() > 0) {
					
					// Refresh the Quests for this summoner
					$request = Request::create('/refresh_games', 'GET', array());
					Route::dispatch($request)->getContent();

				
				// START OF DIFFERENT QUESTS
				
					// Quest Type 1 - Play a game
					if($quest->questtype->id == 1) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->get();
						if($games_since_queststart->count() > 0) {
							$quest->finished = 1;
							$quest->save();
							$user->exp = $user->exp + $quest->questtype->exp;
							if($user->exp > Level::find($user->ulevel)->exp) {
								$user->ulevel +=1;
							}
							$user->qp = $user->qp + $quest->questtype->qp;
							$user->save();
							return Redirect::to('dashboard')->with('message', trans("dashboard.quest_done", array('exp'=>$quest->questtype->exp, 'qp'=>$quest->questtype->qp)));
						}
					}
					
					// Quest Type 2 - Win a game
					if($quest->questtype->id == 2) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->where('win', '=', 1)->get();
						if($games_since_queststart->count() > 0) {
							$quest->finished = 1;
							$quest->save();
							$user->exp = $user->exp + $quest->questtype->exp;
							$user->qp = $user->qp + $quest->questtype->qp;
							$user->save();
							return Redirect::to('dashboard')->with('message', trans("dashboard.quest_done", array('exp'=>$quest->questtype->exp, 'qp'=>$quest->questtype->qp)));
						}
					}
					
					
					// Quest Type 3 - KDA >= 3.0
					if($quest->questtype->id == 3) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->get();
						foreach($games_since_queststart as $game) {
							
							$kda = round(($game->championsKilled+$game->assists)/$game->numDeaths,1);
								
							if($kda >= 3) {
								$quest->finished = 1;
								$quest->save();
								$user->exp = $user->exp + $quest->questtype->exp;
								$user->qp = $user->qp + $quest->questtype->qp;
								$user->save();
								return Redirect::to('dashboard')->with('message', trans("dashboard.quest_done", array('exp'=>$quest->questtype->exp, 'qp'=>$quest->questtype->qp)));
							}
						}
					}
					
					
					
					// Quest Type 4 - Place at least 15 wards
					if($quest->questtype->id == 4) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->wardPlaced >= 15) {
								$quest->finished = 1;
								$quest->save();
								$user->exp = $user->exp + $quest->questtype->exp;
								$user->qp = $user->qp + $quest->questtype->qp;
								$user->save();
								return Redirect::to('dashboard')->with('message', trans("dashboard.quest_done", array('exp'=>$quest->questtype->exp, 'qp'=>$quest->questtype->qp)));
							}
						}
					}
					
					
					// Quest Type 5 - Min. 6 kills on Summoners Rift
					if($quest->questtype->id == 5) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->gameMode == "CLASSIC" && $game->championsKilled >= 6) {
								$quest->finished = 1;
								$quest->save();
								$user->exp = $user->exp + $quest->questtype->exp;
								$user->qp = $user->qp + $quest->questtype->qp;
								$user->save();
								return Redirect::to('dashboard')->with('message', trans("dashboard.quest_done", array('exp'=>$quest->questtype->exp, 'qp'=>$quest->questtype->qp)));
							}
						}
					}
					
					// Quest Type 6 - Min. 200 CS on SR
					if($quest->questtype->id == 6) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->get();
						foreach($games_since_queststart as $game) {
								
							$total_minions = $game->minionsKilled+$game->neutralMinionsKilled;
							if(($game->gameMode == "CLASSIC") && ($total_minions >= 200)) {
								$quest->finished = 1;
								$quest->save();
								$user->exp = $user->exp + $quest->questtype->exp;
								$user->qp = $user->qp + $quest->questtype->qp;
								$user->save();
								return Redirect::to('dashboard')->with('message', trans("dashboard.quest_done", array('exp'=>$quest->questtype->exp, 'qp'=>$quest->questtype->qp)));
							}
						}
					}
					
					
					// Quest Type 7 - Take Smite + mind. 50 neutral Minons
					if($quest->questtype->id == 7) {
						$games_since_queststart = Game::where('summoner_id', '=', Auth::user()->summoner->summonerid)->where('createDate', '>', $quest->createDate)->where('championId', '=', $quest->champion_id)->get();
						foreach($games_since_queststart as $game) {
								
							if($game->spell1 == 11 || $game->spell1 == 11) {
								if($game->neutralMinionsKilled >= 50) {
									$quest->finished = 1;
									$quest->save();
									$user->exp = $user->exp + $quest->questtype->exp;
									$user->qp = $user->qp + $quest->questtype->qp;
									$user->save();
									return Redirect::to('dashboard')->with('message', trans("dashboard.quest_done", array('exp'=>$quest->questtype->exp, 'qp'=>$quest->questtype->qp)));
								}
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

	
	
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
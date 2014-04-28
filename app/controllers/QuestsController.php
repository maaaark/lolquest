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

	
	public function reroll_quest($quest_id) {
		$input = Input::all();
		$validation = Validator::make($input, Quest::$rules);
		if (Auth::check()) { 
			if ($validation->passes()) {
				$user = User::find(Auth::user()->id);
				$quest = Quest::where('user_id', '=', $user->id)->where('id', '=', $quest_id)->first();
				$costs = Config::get('costs.reroll');
				
				if($quest->quest_slot == "random") {
					$questtype = Questtype::orderBy(DB::raw('RAND()'))->first();
					$quest->type_id = $questtype->id;
					$champion = Champion::orderBy(DB::raw('RAND()'))->first();
					$quest->champion_id = $champion->champion_id;
				} elseif($quest->quest_slot == "choose") {
					$questtype = Questtype::orderBy(DB::raw('RAND()'))->first();
					$quest->type_id = $questtype->id;
				}
				$user->rerolls = $user->rerolls - 1;
				$user->save();
				$quest->save();
				return Redirect::to('dashboard')->with('message', trans("dashboard.rerolled"));
				
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
				if(Input::get('choose_quest_champion') <= 0) {
					return Redirect::to('dashboard')->with('error', trans("dashboard.empty_champion"));
				} else {
					$user = User::find(Auth::user()->id);
					$questtype = Questtype::orderBy(DB::raw('RAND()'))->first();
					$quest = new Quest;
					$quest->champion_id = Input::get('choose_quest_champion');
					$quest->user_id = $user->id;
					$quest->type_id = $questtype->id;
					$quest->exp = 100;
					$quest->quest_slot = "choose";
					$quest->createDate = date("U")*1000;
					$quest->save();
					return Redirect::to('dashboard')->with('message', trans("dashboard.accepted"));
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
	
	public function create_random_quest()
	{
		$input = Input::all();
		$validation = Validator::make($input, Quest::$rules);
		if (Auth::check())
		{
			if ($validation->passes())
			{
					$user = User::find(Auth::user()->id);
					$champion = Champion::orderBy(DB::raw('RAND()'))->first();
					$questtype = Questtype::orderBy(DB::raw('RAND()'))->first();
					$quest = new Quest;
					$quest->champion_id = $champion->champion_id;
					$quest->user_id = $user->id;
					$quest->type_id = $questtype->id;
					$quest->exp = 100;
					$quest->quest_slot = "random";
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
	
	public function check_quest($quest_id) {
	
		$input = Input::all();
		$validation = Validator::make($input, Quest::$rules);
		if (Auth::check()) { 
			if ($validation->passes()) {
				$user = User::find(Auth::user()->id);
				//$quest = Quest::find($quest_id);
				$quest = Quest::where('id', '=', $quest_id)->where('user_id', '=', Auth::user()->id)->first();
				if($quest->count() > 0) {

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
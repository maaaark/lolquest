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
					$quest->save();
					return Redirect::to('dashboard')->with('message', trans("dashboard.accepted"));
				}
				
			} else {
				// Back
				return Redirect::to('dashboard')
				->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');
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
					$quest->save();
					return Redirect::to('dashboard')->with('message', trans("dashboard.accepted"));
				
			} else {
				// Back
				return Redirect::to('dashboard')
				->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');
			}
		} else {
			return Redirect::to('login');
		}
	}
	
	public function check_quest() {
	
		$input = Input::all();
		$validation = Validator::make($input, Quest::$rules);
		if (Auth::check())
		{ 
			if ($validation->passes())
			{
				$user = User::find(Auth::user()->id);
				$quest = Quest::find(17);
				
				
				
				// Quest Type 1
				if($quest->questtype->id == 1)
					$games_since_queststart = Game::where('created_at', '>', $quest->created_at)->where('championId', '=', $quest->champion_id)->get();
					if(isset($games_since_queststart)) {
						echo "Quest abgeschlossen";
						$quest->finished = 1;
						$quest->save();
					} else {
						echo "Nein nein nein";
					}
				}
				
				
				
				
				
				//foreach($games_since_queststart as $game) {
				//}
				
				
			} else {
				return Redirect::to('dashboard')
					->withInput()
					->withErrors($validation)
					->with('message', 'There were validation errors.');
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
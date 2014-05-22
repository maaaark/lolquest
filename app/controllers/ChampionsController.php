<?php

class ChampionsController extends \BaseController {

	/**
	 * Display a listing of champions
	 *
	 * @return Response
	 */
	public function index()
	{
		$champions = Champion::all();

		return View::make('champions.index', compact('champions'));
	}

	/**
	 * Show the form for creating a new champion
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('champions.create');
	}

	/**
	 * Store a newly created champion in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Champion::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Champion::create($data);

		return Redirect::route('champions.index');
	}

	/**
	 * Display the specified champion.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($name)
	{	
		$dates = "";
		$counts = "";
		$champion = Champion::where('key', '=', $name)->first();
		$champion_games = Game::where('championId', '=', $champion->champion_id)->count();
		$champion_wins = Game::where('championId', '=', $champion->champion_id)->where('win', '=', 1)->count();
		$quest_count = ChampionQuest::where('champion_id', '=', $champion->champion_id)->orderBy('quest_date', 'asc')->get();
		foreach($quest_count as $count) {
			$dates = $dates.'"'.date("d.m",strtotime($count->quest_date)).'",';
			$counts = $counts.$count->quest_count.","; 
		}
		if($champion_games==0) {
			$champion_wins = 0;
			$champion_losses = 0;
		} else {
			$champion_wins = round((100/$champion_games) * $champion_wins,2);
			$champion_losses = 100 - $champion_wins;
		}
		
		return View::make('champions.show', compact('champion', 'champion_games', 'champion_wins', 'champion_losses', 'counts', 'dates'));
	}

	/**
	 * Show the form for editing the specified champion.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$champion = Champion::find($id);

		return View::make('champions.edit', compact('champion'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$champion = Champion::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Champion::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$champion->update($data);

		return Redirect::route('champions.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Champion::destroy($id);

		return Redirect::route('champions.index');
	}
	
	

}
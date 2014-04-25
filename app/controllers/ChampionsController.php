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
	public function show($id)
	{
		$champion = Champion::findOrFail($id);

		return View::make('champions.show', compact('champion'));
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
	
	
	public function refresh_champions()
	{
		if (Auth::check())
		{
			if(Auth::user()->hasRole('admin')) {
				$api_key = Config::get('api.key');
				$summoner_data = "https://prod.api.pvp.net/api/lol/static-data/euw/v1.2/champion?locale=de_DE&dataById=true&champData=info,partype&api_key=".$api_key;
				$json = @file_get_contents($summoner_data);
				if($json === FALSE) {
					return View::make('login');
				} else {
					$obj = json_decode($json, true);
					
					foreach($obj["data"] as $champion) {
						$recent_champion = Champion::where('champion_id', '=', $champion["id"])->first();
						if(!isset($recent_champion)) {
							$new_champion = new Champion;
							$new_champion->name = $champion["name"];
							$new_champion->champion_id = $champion["id"];
							$new_champion->save();
							echo "Saved Champion".$champion["name"]."<br/>";
						}
						unset($recent_champion);
					}
				}
			} else {
				return Redirect::to('403');
			}
		} else {
			return View::make('login');
		}
	}
	
	

}
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
	
	

}
<?php

class LaddersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		/*
		SELECT user_id, SUM(exp) AS total_exp
		FROM quests
		GROUP BY user_id
		ORDER BY exp
		*/
		
		$ladder = DB::select(DB::raw('
			SELECT user_id, updated_at, 
			SUM( exp ) AS total_exp,
			COUNT( * ) AS total_quests
			FROM quests
			WHERE MONTH( updated_at ) = 4
			AND finished =1
			GROUP BY user_id
			ORDER BY total_exp DESC, total_quests DESC, updated_at ASC
			LIMIT 0 , 30'));
		$partipicant = array();
		$i = 1;
		
		foreach($ladder as $row) {
			$user = User::find($row->user_id);
			$partipicant[$i]=$user;
			$partipicant[$i]["exp"] = $row->total_exp;
			$partipicant[$i]["total_quests"] = $row->total_quests;
			$i++;
		}
		return View::make('ladders.index', compact('partipicant'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
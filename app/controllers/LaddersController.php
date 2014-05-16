<?php

class LaddersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($year = NULL, $month = NULL)
	{
		/*
		SELECT user_id, SUM(exp) AS total_exp
		FROM quests
		GROUP BY user_id
		ORDER BY exp
		*/
		if($year == NULL)
			$year = date("Y");
		
		if($month == NULL)
			$month = date("m");
		
		$ladder = Ladder::where('year', '=', $year)->where('month', '=', $month)->orderBy('rang', 'asc')->paginate(2);

		return View::make('ladders.index', compact('ladder', 'month', 'year'));
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
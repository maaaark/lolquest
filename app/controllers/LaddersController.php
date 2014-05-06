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
		
		$ladder = Ladder::where('year', '=', $year)->where('month', '=', $month)->orderBy('rang', 'asc')->get();

		return View::make('ladders.index', compact('ladder', 'month', 'year'));
	}
	
	public function refresh_ladder() {

		$year = date("Y");
		$month = date("m");
		$i = 1;
			
		$ladder = DB::select(DB::raw('
			SELECT user_id, updated_at, 
			SUM( exp ) AS total_exp,
			COUNT( * ) AS total_quests
			FROM quests
			WHERE MONTH( updated_at ) = '.$month.'
			AND YEAR( updated_at ) = '.$year.'
			AND finished = 1
			GROUP BY user_id
			ORDER BY total_exp DESC, total_quests DESC, updated_at ASC
		'));	

		
		foreach($ladder as $key => $row) {
			$user = User::find($row->user_id);
			$participant = Ladder::where('user_id', '=', $row->user_id)->where('year', '=', $year)->where('month', '=', $month)->first();
			if($participant) {
				$participant->rang = $i;
				$participant->month_exp = $row->total_exp;
				$participant->total_quests = $row->total_quests;
				$participant->save();
			} else {
				$ladder = new Ladder;
				$ladder->user_id = $row->user_id;
				$ladder->month_exp = $row->total_exp;
				$ladder->total_quests = $row->total_quests;
				$ladder->month = $month;
				$ladder->year = $year;
				$ladder->save();
			}
			$i++;
		}
		return Redirect::to('/ladders')->with('message', "Ladder refreshed");
		
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
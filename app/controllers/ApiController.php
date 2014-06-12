<?php

class ApiController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return "test from API controller";
	}


	public function user()
	{
		$user = Auth::user();
	 
		return Response::json(array(
			'error' => false,
			'user' => $user->toArray()),
			200
		);

	}
	
	
	public function champions()
	{

		$champions = Champion::orderBy('name')->get();

		return Response::json(array(
			'error' => false,
			'champions' => $champions->toArray()),
			200
		);

	}
	
	public function playerroles()
	{

		$playerroles = Playerrole::all();

		return Response::json(array(
			'error' => false,
			'playerroles' => $playerroles->toArray()),
			200
		);

	}
	
	public function dashboard()
	{
		$user = User::find(Auth::user()->id);

		$notifications = $user->notifications;
		$myquests = Quest::where('user_id', '=', $user->id)->where('finished', '=', 0)->get();
		$time = date("U");
		$time_waited = $time - $user->last_checked;
	 
		return Response::json(array(
			'error' => false,
			'user' => $user->toArray(),
			'notifications' => $notifications->toArray(),
			'myquests' => $myquests->toArray(),
			'time' => $time,
			'time_waited' => $time_waited),
			200
		);

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

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
	
	public function users_test() {
		$users = User::with('summoner')->take(20)->get();		
		$api = Response::json($users)->setCallback(Input::get('callback'));
		return $api;
	}


	public function user()
	{
		$user = Auth::user();
		
		$api = Response::json($user);
		return $api;
		
		//return Response::json(array(
		//	'error' => false,
		//	'user' => $user->toArray()),
		//	200
		//);

	}
	
	public function show($id)
	{
		$user = User::find($id);
		$api = Response::json($user);
		return $api;
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
	
	
	public function questtypes()
	{

		$champions = Champion::orderBy('name')->get();

		return Response::json(array(
			'error' => false,
			'champions' => $champions->toArray()),
			200
		);

	}
	
	
	public function ladder()
	{
		$year = date("Y");
		$month = date("m");
		$validator = Validator::make(
			array(
				'year' => $year,
				'month' => $month
			),
			array(
				'year' => 'numeric',
				'month' => 'numeric'
			)
		);
		
		if ($validator->passes())
		{
			$ladder = Ladder::where('year', '=', $year)->where('month', '=', $month)->orderBy('rang', 'asc')->get();
			return Response::json(array(
				'error' => false,
				'ladder' => $ladder->toArray()),
				200
			);
		}

	}
	
	public function top100()
	{
		$users = User::orderBy('exp', 'DESC')->limit(100)->get();
		return Response::json(array(
				'error' => false,
				'ladder' => $users->toArray()),
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
		$userquests = array();
		
		foreach($myquests as $quest) {
			$userquests["name"] = $quest->questtype->name;
		}
	 
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

}

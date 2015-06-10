<?php

class LaddersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($year = NULL, $month = NULL)
	{
		
		if($year == NULL)
			$year = date("Y");
		
		if($month == NULL)
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
			$ladder = Ladder::where('year', '=', $year)->where('month', '=', $month)->orderBy('rang', 'asc')->paginate(25);
			return View::make('ladders.index', compact('ladder', 'month', 'year'));
		} else {
			return Redirect::to('/ladders')->with('error', "Date not valid");
		} 
		
	}
	
	public function alltime()
	{
		$users = User::orderBy('exp', 'DESC')->limit(100)->get();
		return View::make('ladders.alltime', compact('users'));
	}
	
	public function update_ladder_achievements()
	{
	if(Auth::user()->hasRole('admin')) {
		$year = date("Y");
		$month = date("m");
		 if($month = 1) {
			$month2 = 12;
			$year2 = $year-1;
		} else {
			$month2 = $month-1;
			$year2 = $year;
		}
		$ladders = Ladder::where('year', '=', 2014)->where('month', '=', 7)->orderBy('rang', 'asc')->get();
		if($ladders) {
			foreach($ladders as $ladder) {
					$user= User::find($ladder->user_id);
						if ($ladder->rang ==1 && $user->hasachievement(49) == false) {
							$user->achievements()->attach(49);
							$achievement = Achievement::where('id', '=', 49)->first();
							$user->notify(1, trans("achievements.receive").$achievement->name);
						} elseif ($ladder->rang == 2 && $user->hasachievement(50) == false) {
							$user->achievements()->attach(50);
							$achievement = Achievement::where('id', '=', 50)->first();
							$user->notify(1, trans("achievements.receive").$achievement->name);
						} elseif ($ladder->rang == 3 && $user->hasachievement(51) == false) {
							$user->achievements()->attach(51);
							$achievement = Achievement::where('id', '=', 51)->first();
							$user->notify(1, trans("achievements.receive").$achievement->name);
						} elseif ($ladder->rang <= 10 && $user->hasachievement(52) == false) {
							$user->achievements()->attach(52);
							$achievement = Achievement::where('id', '=', 52)->first();
							$user->notify(1, trans("achievements.receive").$achievement->name);
						} elseif ($ladder->rang <= 50 && $user->hasachievement(53) == false) {
							$user->achievements()->attach(53);
							$achievement = Achievement::where('id', '=', 53)->first();
							$user->notify(1, trans("achievements.receive").$achievement->name);
						} elseif ($ladder->rang <= 100 && $user->hasachievement(54) == false) {
							$user->achievements()->attach(54);
							$achievement = Achievement::where('id', '=', 54)->first();
							$user->notify(1, trans("achievements.receive").$achievement->name);
						}
					}
			}
		}
	}

}
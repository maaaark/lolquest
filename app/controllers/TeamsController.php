<?php

class TeamsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /teams
	 *
	 * @return Response
	 */
	public function index()
	{
		$teams = Team::orderBy("rank", "ASC")->where("rank", ">", 0)->get();
		return View::make('teams.index', compact('teams'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /teams/create
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			if($user->team_id != 0) {
				// Already have a team
				//echo "DU HAST EIN TEAM";
				return Redirect::to("/teams/".$user->team->region."/".$user->team->clean_name)->with('error', 'Your already have a team');
			} else {
				return View::make('teams.create');
			}
		} else {
			return Redirect::to("/login");
		}
		
	}
	
	
	public function invite() {
		if(Auth::check()) {
			return View::make('teams.invite');
		} else {
			return Redirect::to("/login");
		}
	}
	
	
	public function send_invite() {
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			$team = $user->team;
			if($team->user_id == $user->id) {
				$clean_summoner_name = str_replace(" ", "", Input::get('summoner_name'));
				$clean_summoner_name = strtolower($clean_summoner_name);
				$clean_summoner_name = mb_strtolower($clean_summoner_name, 'UTF-8');
				
				$invte_user = User::where("region", "=", Input::get('region'))->where("summoner_name", "=", $clean_summoner_name)->first();
				if(!$invte_user) {
					return Redirect::to("/teams/".$team->region."/".$team->clean_name."/invite")->with("error", "No summoner found!");
				} else {
					//var_dump($invte_user);
					if($invte_user->team_id != 0) {
						return Redirect::to("/teams/".$team->region."/".$team->clean_name."/invite")->with("error", "This summoner already has a team.");
					} else {
						// SEND INVITE TO USER
						$message = "You has been invited to the team ".$team->name.".<br/><a href='/teams/join/".$team->id."/".$team->secret."'><strong>Join Team</strong></a>";
						$invte_user->notify(4, $message);
						return Redirect::to("/teams/".$team->region."/".$team->clean_name."/invite")->with("success", "Your invite has been sent");
					}
				}
			} else {
				return Redirect::to("/teams/".$team->region."/".$team->clean_name)->with("error", "You cannot invite player to this team");
			}
		} else {
			return Redirect::to("/login");
		}
	}
	
	/**
	 * Store a newly created resource in storage.
	 * POST /teams
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			
			if($user->qp < 500) {
				return Redirect::to('/teams/create')
				->withInput()
				->with('error', 'You do not have enough QP!');
			}
			
			$input = Input::all();
			$validation = Validator::make($input, Team::$rules);
			if ($validation->passes())
			{
				$clean_team_name = str_replace(" ", "", Input::get('teamname'));
				$clean_team_name = strtolower($clean_team_name);
				$clean_team_name = mb_strtolower($clean_team_name, 'UTF-8');
				
				// Is Team name taken?
				$check_teams = Team::where("region", "=", Input::get('region'))->where("clean_name", "=", $clean_team_name)->count();
				if($check_teams > 0) {
					return Redirect::to("/teams/create")->with("error", "This Team name is already taken");
				}
				
				$team = new Team;
				$team->user_id = Auth::user()->id;
				$team->team_level_id = 1;
				$team->exp = 0;
				$team->name = Input::get('teamname');
				$team->clean_name = $clean_team_name;
				$team->region = Input::get('region');
				$team->website = Input::get('website');
				if (Input::hasFile('logo'))
				{
					$extension = Input::file('logo')->getClientOriginalExtension();
					Input::file('logo')->move(public_path()."/img/teams/logo/", Input::get('region')."_".$clean_team_name.".".$extension);
					$team->logo = Input::get('region')."_".$clean_team_name.".".$extension;
				}

				
				if(Input::get('description') == "") {
					$team->description = "";
				} else {
					$team->description = Input::get('description');	
				}
				$team->save();
				$user->team_id = $team->id;
				$user->qp = $user->qp - 500;
				$user->save();
				
				return Redirect::to("/teams/".$team->region."/".$team->clean_name)->with('success', 'Your Team has been created');
				
			} else {
				return Redirect::to('/teams/create')
				->withInput()
				->withErrors($validation)
				->with('error', 'There were validation errors.');
			}
		} else {
			return Redirect::to("/login");
		}
	}

	/**
	 * Display the specified resource.
	 * GET /teams/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($region, $clean_name)
	{
		$team = Team::where("region", "=", $region)->where("clean_name", "=", $clean_name)->first();
		return View::make('teams.show', compact('team'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /teams/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}
	
	
	public function join($id, $secret)
	{
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			$team = Team::where("secret", "=", $secret)->where("id", "=", $id)->first();
			$user->team_id = $team->id;
			$user->save();
			
			return Redirect::to("/teams/".$team->region."/".$team->clean_name)->with("success", "You joined the team ".$team->name);
			
		} else {
			return Redirect::to("/login");
		}
	}
	
	public function remove_member($region, $name, $id)
	{
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			$team = Team::where("user_id", "=", $user->id)->first();
			if($team) {
				$remove_user = User::find($id);
				if($remove_user->team_id == $team->id) {
					$remove_user->team_id = 0;
					$remove_user->save();
					return Redirect::to("/teams/".$team->region."/".$team->clean_name)->with("success", $remove_user->summoner->name." has been remove from the team.");
				} else {
					return Redirect::to("/teams/".$team->region."/".$team->clean_name)->with("error", "You do not have to permission to remove this user");
				}
			} else {
				return Redirect::to("/teams/".$team->region."/".$team->clean_name)->with("error", "You do not have to permission to remove this user");
			}			
		} else {
			return Redirect::to("/login");
		}
	}
	
	
	public function delete()
	{
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			$my_team = Team::where("user_id", "=", $user->id)->first();
			
			// Remove members
			$team_members = User::where("team_id", "=", $my_team->id);
			foreach($team_members as $member) {
				$member->team_id = 0;
				$member->save();
			}
			$user->team_id = 0;
			$user->save();
			
			File::delete(public_path()."/img/teams/logo/".$my_team->logo);
			$my_team->delete();
			return Redirect::to("/teams")->with('success', 'Your Team has been deleted');
			
		} else {
			return Redirect::to("/login");
		}
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /teams/{id}
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
	 * DELETE /teams/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
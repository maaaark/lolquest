<?php

class UsersController extends \BaseController {

	protected $layout = 'templates.default';
	
	
	/**
	 * Display a listing of users
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();
		$this->layout->content = View::make('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new user
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::check()) {
			return Redirect::to("/dashboard");
		} else {
			return View::make('users.create');
		}
	}
	
	public function titles() {
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			$titles = array();
			$titles = $user->titles;
			if(Auth::user()->active_title > 0) {
				$current_title = Title::find(Auth::user()->active_title);
			} else {
				$current_title = "No title";
			}
			return View::make('settings.title', compact('user', 'titles', 'current_title'));
		} else {
			return Redirect::to('/login');
		}
	}
	
	public function livestream() {
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			return View::make('settings.livestream', compact('user'));
		} else {
			return Redirect::to('/login');
		}
	}
	
	public function save_livestream() {
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			$user->livestream_platform = Input::get('livestream_platform');
			$user->livestream_channel = Input::get('livestream_channel');
			$user->save();
			return Redirect::to("/settings/livestream")->with("success", "Livestream saved");
		} else {
			return Redirect::to('/login');
		}
	}
	
	public function streamer() {
		if(Auth::check()) {
			$myquests = Quest::where('user_id', '=', Auth::user()->id)->where('finished', '=', 0)->get();
			return View::make('users.streamer', compact('myquests'));
		} else {
			return Redirect::to('/login');
		}
	}
	
	public function update_title() {
		$user = User::find(Auth::user()->id);
		$user->active_title = Input::get('title');
		$user->save();
		return Redirect::to('/settings/title');
	}
	
	public function edit_mail()
	{
		$user = User::find(Auth::user()->id);
		return View::make('settings.email', compact('user'));
	}
	
	
	public function update_email()
	{
		$user = User::find(Auth::user()->id);
		$user->email = Input::get('email');
		$user->save();
		return View::make('settings.email', compact('user'))->with('success', trans('users.settings_saved'));
	}
	 
	public function save_skin()
	{
		$user = User::find(Auth::user()->id);
		$user->skin_left = Input::get('left_skin');
		$user->skin_right = Input::get('right_skin');
		$user->save();
		return Redirect::to("/settings/skins")->with('success', trans('users.settings_saved'));
	}
	 
	
	
	public function timeline_settings()
	{
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			return View::make('settings.timeline', compact('user'));
		} else {
			return Redirect::to("/login");
		}
		
	}
	
	public function skins()
	{
		if(Auth::check()) {
		$user = User::find(Auth::user()->id);
		$skins = Skin::where("user_id", "=", $user->id)->get();
		
		if($user->skin_right != "default_right.png") {
			$right_skin_id = explode(".",$user->skin_right);
			$skin_right = Champion::where("champion_id", "=", $right_skin_id[0])->first();
		} else {
			$skin_right = array();
			
		}
		
		if($user->skin_left != "default_left.png") {
			$left_skin_id = explode(".",$user->skin_left);
			$skin_left = Champion::where("champion_id", "=", $left_skin_id[0])->first();
		} else {
			$skin_left = array();
		}

		return View::make('settings.skins', compact('user', 'skins', 'skin_left', 'skin_right', 'left_skin_id'));
		} else {
			return Redirect::to("/login");
		}
	}
	
	public function update_timeline_settings()
	{
		// 	{{ Form::model($user, array('route' => array('users.update_email', $user->id), 'method' => 'PUT')) }}
		$user = User::find(Auth::user()->id);
		if(Input::get('show_in_timeline') == 1) {
			$user->show_in_timeline = 1;	
		} else {
			$user->show_in_timeline = 0;
		}
		
		if(Input::get('timeline_friends_only') == 1) {
			$user->timeline_friends_only = 1;	
		} else {
			$user->timeline_friends_only = 0;
		}
		
		$user->save();
		return Redirect::to("/timeline_settings")->with('success', trans('users.settings_saved'));
	}
	
	
	public function quest_finished($quest_id) {
		if(Auth::check()) {
			$quest = Quest::where("user_id", "=", Auth::user()->id)->where("id","=",$quest_id)->where("finished","=",1)->first();
			if($quest) {
				return View::make('users.quest_finish', compact('quest'));
			} else {
				return Redirect::to('/404');
			}
		} else {
			return Redirect::to('/login');
		}
	}
	
	public function verify_double($region,$summoner_name) {
		
		$api_key = Config::get('api.key');
				
		$clean_summoner_name = str_replace(" ", "", $summoner_name);
		$clean_summoner_name = strtolower($clean_summoner_name);
		$clean_summoner_name = mb_strtolower($clean_summoner_name, 'UTF-8');
		$region = "euw";
		
		
		$summoner_data = "https://".$region.".api.pvp.net/api/lol/".$region."/v1.4/summoner/by-name/".$clean_summoner_name."?api_key=".$api_key;
		$json = @file_get_contents($summoner_data);
		if($json === FALSE) {
			return Redirect::route('users.create')
			->withInput()
			->with('message', trans("users.not_found"));
		} else {
		
			$obj = json_decode($json, true);
			$summoner_id = $obj[$clean_summoner_name]["id"];
		
			$summoner_data = "https://".$region.".api.pvp.net/api/lol/".$region."/v1.4/summoner/".$summoner_id."/runes?api_key=".$api_key;
			$json = @file_get_contents($summoner_data);
			if($json === FALSE) {
				Session::flash('message', 'No Summoner found');
				return Redirect::to('/edit_summoner');
			} else {
				$obj = json_decode($json, true);
				$runes = $obj[$summoner_id]["pages"];
				
				foreach($runes as $page) {
					if($page["name"] == "@@!PaG3!@@30764684") {
						
						$old_user = User::where("summoner_name", "=", $clean_summoner_name)->first();
						$old_user->delete();
						
						return Redirect::route('users.create')->withInput()->with('success', trans("users.old_user_deleted"));
					}
				}
			}
		
		}
		
		return View::make('users.verify_double', compact('runes'));
	}
	
	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	
		$input = Input::all();
		$validation = Validator::make($input, User::$rules);

		if ($validation->passes())
		{
			
			$clean_summoner_name = str_replace(" ", "", Input::get('summoner_name'));
			$clean_summoner_name = strtolower($clean_summoner_name);
			$clean_summoner_name = mb_strtolower($clean_summoner_name, 'UTF-8');
			$region = Input::get('region');
			
			
			// check if validated summoner available
			$verified_user = User::where('summoner_name', '=', $clean_summoner_name)->where('region', '=', Input::get('region'))->first();
			if($verified_user) {
				if($verified_user->summoner_status == 2) {
					return Redirect::route('users.create')->withInput()->with('message', trans("users.already_one"));
				} elseif($verified_user->summoner_status == 1) {
					return Redirect::to('/verify_double/'.$region.'/'.$clean_summoner_name)->with('message', trans("users.already_one"));
				}
			}
			
			// Save the Summoner
			$api_key = Config::get('api.key');
			
			$summoner_data = "https://".Input::get('region').".api.pvp.net/api/lol/".Input::get('region')."/v1.4/summoner/by-name/".$clean_summoner_name."?api_key=".$api_key;
			$json = @file_get_contents($summoner_data);
			if($json === FALSE) {
				return Redirect::route('users.create')
				->withInput()
				->with('message', trans("users.not_found"));
			} else {
			
				// Create the User
				$user = new User;
				$user->summoner_name = $clean_summoner_name;
				$user->region = Input::get('region');
				$user->email = Input::get('email');
				$user->password = Hash::make(Input::get('password'));
				$roleMember = Role::where('name', 'member')->firstOrFail();
				$user->verify_string = str_random(8);
				$user->summoner_status = 1;
				$user->save();
				
				$user->roles()->attach($roleMember->id, array("user_id"=>$user->id));
				
			
				$obj = json_decode($json, true);
				$summoner = new Summoner;
				$summoner->user_id = $user->id;
				$summoner_name_clear = str_replace(' ', '',strtolower($user->summoner_name));
				$summoner->summonerid = $obj[$summoner_name_clear]["id"];
				$summoner->name = $obj[$summoner_name_clear]["name"];
				$summoner->profileIconId = $obj[$summoner_name_clear]["profileIconId"];
				$summoner->summonerLevel = $obj[$summoner_name_clear]["summonerLevel"];
				$summoner->revisionDate = $obj[$summoner_name_clear]["revisionDate"];
				$summoner->region = $user->region;
				$summoner->save();
				
				$user->get_account_id();
				
				
				// Register Key to User
				if(Session::get('beta_key')) {
					$betakey = Session::get('beta_key');
					$key = Betakey::where("key", "=", $betakey)->first();
					$key->user_id = $user->id;
					$key->save();
				}
				
				
				Mail::send('mails.welcome', array('summoner_name'=>Input::get('summoner_name')), function($message){
					$message->to(Input::get('email'), Input::get('summoner_name'))->subject('Welcome to Lolquest.net');
				});
				
				return Redirect::to('/login')->with('message', trans('users.thank_you'));
			}
		}

		return Redirect::route('users.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

    /**
     * Display the specified user.
     *
     * @param $region
     * @param $name
     * @internal param int $id
     * @return Response
     */
	public function show($region, $name)
	{
		$user = User::where('region', '=', $region)->where('summoner_name', '=', $name)->first();
		if($user) {
			if($user->summoner) {
				$games = Game::where('summoner_id', '=', $user->summoner->summonerid)->orderBy('createDate', 'desc')->take(10)->get();
				$quests_done = Quest::where('user_id', '=', $user->id)->where('finished', '=', 1)->orderBy('createDate', 'desc')->take(5)->get();
				$ladder = $user->ladder_rang($user->id);
				
				$champion_quests = DB::select(DB::raw('
				SELECT * , (
					SELECT COUNT( * ) 
					FROM quests
					WHERE user_id = '.$user->id.'
					AND finished = 1
					AND champion_id = champions.champion_id
					) AS quests
				FROM champions
				ORDER BY name ASC
				'));
			
				return View::make('users.show', compact('user', 'games', 'quests_done', 'champion_quests', 'ladder'));
			} else {
				return View::make('users.show', compact('user'));
			}
		} else {
			return Redirect::to('404');
		}
		
	}
	
	
	public function delete_notifications() {
		if (Auth::check()) {
			$user = User::find(Auth::user()->id);
			foreach($user->notifications as $note) {
				$note->delete();
			}
			return Redirect::back();
		} else {
			return Redirect::to("/login");
		}
	}
	
	public function refresh_summoner() {
		if (Auth::check()) {
			$user = User::find(Auth::user()->id);
			
			$api_key = Config::get('api.key');
			$summoner_data = "https://".$user->region.".api.pvp.net/api/lol/".$user->region."/v1.4/summoner/by-name/".$user->summoner_name."?api_key=".$api_key;
			$json = @file_get_contents($summoner_data);
			
			if($json === FALSE) {
				return Redirect::to('/api_error');
			} else {
				$summoner_name_clear = str_replace(' ', '',strtolower($user->summoner_name));
				$obj = json_decode($json, true);
				$user->summoner->profileIconId = $obj[$summoner_name_clear]["profileIconId"];
				$user->summoner->summonerLevel = $obj[$summoner_name_clear]["summonerLevel"];
				$user->summoner->save();
			}
			$user->get_account_id();
			$user->refresh_games();
			
			return Redirect::to("/settings")->with('success', trans("users.refreshed"));
		} else {
			return Redirect::to("/login");
		}
	}
	
	public function refresh_level()
	{
	if(Auth::user()->hasRole('admin')) {
		$users = User::all();
		foreach($users as $user) {
				if($user->exp > ($user->level->exp_level)-1){
					$user->level_id += 1;
					$user->save();
				}
				if(($user->exp - $user->level->exp) <= -1){
					$user->level_id -= 1;
					$user->save();
				}
		}
	}
	}	
	
	public function update_level_table()
	{
	if(Auth::user()->hasRole('admin')) {
		$levels = Level::orderBy('id')->get();
		foreach($levels as $level) {
			if($level->id > 1){
				$level->exp = Level::find($level->id-1)->exp_level;
				$level->save();
			}
		}
	}
	}	

	public function achievements()
	{
		if (Auth::check())
		{
			$achievements = Achievement::all();
			return View::make('achievements.index', compact('achievements'));
		} else {
			return Redirect::to('login');
		}
	}
	
	public function achievements_show($region, $name)
	{
		$user = User::where('region', '=', $region)->where('summoner_name', '=', $name)->first();
		$user_achievements = $user->achievements();
		$achievements = Achievement::orderBy("type", "asc")->orderBy("factor", "asc")->get();
		
		return View::make('achievements.show', compact('user', 'user_achievements', 'achievements'));
	}
	
	
	public function verify()
	{
		if (Auth::check())
		{
			$user = User::find(Auth::user()->id);

			if($user->summoner_status == 1) { 
				$api_key = Config::get('api.key');
				$summoner_data = "https://".$user->region.".api.pvp.net/api/lol/".$user->region."/v1.4/summoner/".$user->summoner->summonerid."/runes?api_key=".$api_key;
				$json = @file_get_contents($summoner_data);
				if($json === FALSE) {
					Session::flash('message', 'No Summoner found');
					return Redirect::to('/edit_summoner');
				} else {
					$obj = json_decode($json, true);
					$runes = $obj[$user->summoner->summonerid]["pages"];
					
					foreach($runes as $page) {
						if($page["name"] == $user->verify_string) {
							$user->summoner_status = 2;
							$user->save();
							return Redirect::to('verify');
						}
					}
				}
			} else {
				// No correct summoner status
				return View::make('users.verify', compact('user', 'runes'));
			}
			return View::make('users.verify', compact('user', 'runes'));
		} else {
			return Redirect::to('login');
		}
	}

	/**
	 * Show the form for editing the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		if (Auth::check())
		{
			$user = User::find(Auth::user()->id);
			if($user->id == Auth::user()->id) {
				return View::make('users.edit', compact('user'));
			} else {
				return Redirect::to('403');
			}
		} else {
			return Redirect::to('login');
		}

		
	}
	
	public function edit_summoner()
	{
		if (Auth::check())
		{
			$user = User::find(Auth::user()->id);
			if($user->id == Auth::user()->id) {
				return View::make('users.edit_summoner', compact('user'));
			} else {
				return Redirect::to('403');
			}
		} else {
			return Redirect::to('login');
		}
	}
	
	
	
	public function check_betakey()
	{
		$key = Betakey::where("key", "=", Input::get('key'))->first();
		if(isset($key)) {
			if($key->used == 0){
				Session::put('beta_user', 1);
				Session::put('beta_key', $key->key);
				$key->used = 1;
				$key->save();
				return Redirect::to("/users/create");
			} else {
				return Redirect::to("/")->withErrors("Key already used!");
			}
		} else {
			return Redirect::to("/")->withErrors("Beta Key not valid!");
		}
	}
	
	

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'name'       => 'required',
			'email'      => 'required|email'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('users/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$user = User::find($id);
			//$user->name       = Input::get('name');
			$user->email = Input::get('email');
			$user->save();

			// redirect
			Session::flash('message', 'Successfully updated!');
			return Redirect::to('users');
		}
	}
	
	public function update_summoner()
	{
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'region'      => 'required',
			'summoner_name' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('/edit_summoner')
				->withErrors($validator);
		} else {
			$mysummoner = 0;
			$myuser = 0;
			$clean_summoner_name = str_replace(" ", "", Input::get('summoner_name'));
			$clean_summoner_name = strtolower($clean_summoner_name);
			$clean_summoner_name = mb_strtolower($clean_summoner_name, 'UTF-8');
				
			$check_user = User::where("summoner_name", "=", $clean_summoner_name)->where("region", "=", Input::get('region'))->where("summoner_status", "=", 2)->first();
			if($check_user) {
				if($check_user->id == Auth::user()->id) {
					$myuser = 1;
				} else {
					$myuser = 0;
				}
			} else {
				$myuser = 1;
			}
			
			$check_summoner = Summoner::where("name", "=", Input::get('summoner_name'))->first();
			if($check_summoner) {
				if($check_summoner->user_id == Auth::user()->id) {
					$mysummoner = 1;
				} else {
					$mysummoner = 0;
				}
			} else {
				$mysummoner = 1;
			}
			
			if($myuser == 0 || $mysummoner == 0) {
				return Redirect::to('/edit_summoner')->with('error', trans('users.already_taken'));
			} else {
				$api_key = Config::get('api.key');
				$summoner_data = "https://".Input::get('region').".api.pvp.net/api/lol/".Input::get('region')."/v1.4/summoner/by-name/".$clean_summoner_name."?api_key=".$api_key;
				$json = @file_get_contents($summoner_data);
				if($json === FALSE) {
					Session::flash('message', 'No Summoner found');
					return Redirect::to('/edit_summoner');
				} else {
					$user = User::find(Auth::user()->id);
					$user->region = Input::get('region');
					$user->summoner_name = $clean_summoner_name;
					$user->summoner_status = 1;
					$user->verify_string = str_random(8);
					$user->save();
					
					if($user->summoner) {
						$summoner = $user->summoner;
					} else {
						$summoner = new Summoner;
					}
				
					$obj = json_decode($json, true);
					$summoner->user_id = $user->id;
					$summoner->summonerid = $obj[$user->summoner_name]["id"];
					$summoner->name = $obj[$user->summoner_name]["name"];
					$summoner->profileIconId = $obj[$user->summoner_name]["profileIconId"];
					$summoner->summonerLevel = $obj[$user->summoner_name]["summonerLevel"];
					$summoner->revisionDate = $obj[$user->summoner_name]["revisionDate"];
					$summoner->region = Input::get('region');
					$summoner->save();
					
					return Redirect::to('/summoner/'.$user->region.'/'.$user->summoner_name);
				}	
			}			
		}
	}
	
	public function admin_login_as($user_id) {
		if(Auth::check()) {
			if(Auth::user()->hasRole('admin')) {
				Auth::logout();
				Auth::loginUsingId($user_id, true);
				return Redirect::to('/summoner/'.Auth::user()->region.'/'.Auth::user()->summoner_name)->with("success", "Admin Login");
			}
		}
	}
	
	public function admin_update_games($user_id)
	{
		if(Auth::check()) {
			if(Auth::user()->hasRole('admin')) {
				
			$user = User::where("id", "=", $user_id)->first();
			$user->refresh_games();	
				
			return Redirect::to('/summoner/'.$user->region.'/'.$user->summoner_name)->with("message", "Admin Updated last games");
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//User::destroy($id);

		return Redirect::route('users.index');
	}
	
	public function showLogin()
	{
		// show the form
		return View::make('users.login');
	}
	
	public function dashboard()
	{
	
		if (Auth::check())
		{
			$user = User::find(Auth::user()->id);
			$notifications = $user->notifications;
			$champions = Champion::orderBy('name')->get();
			$myquests = Quest::where('user_id', '=', $user->id)->where('finished', '=', 0)->get();
			$time = date("U");
			$time_waited = $time - $user->last_checked;
			$playerroles = Playerrole::all();
			return View::make('users.dashboard', compact('user', 'notifications', 'champions', 'myquests', 'time_waited', 'my_ladder_rang', 'playerroles', 'time'));
		} else {
			return Redirect::to('login');
		}
		// show the form
		
	}
	
	public function challenges()
	{
	
		if (Auth::check())
		{
			$user = User::find(Auth::user()->id);

			$playerroles = Playerrole::all();
                        
                        // Top Champs
                        $top_champions = Config::get('settings.top_champions');
                        $jungle_champions = Config::get('settings.jungle_champions');
                        $mid_champions = Config::get('settings.mid_champions');
                        $marksman_champions = Config::get('settings.marksman_champions');
                        $support_champions = Config::get('settings.support_champions');
			
                        $full_top_champions = Champion::whereIn('champion_id', $top_champions)->get();
                        $full_jungle_champions = Champion::whereIn('champion_id', $jungle_champions)->get();
                        $full_mid_champions = Champion::whereIn('champion_id', $mid_champions)->get();
                        $full_marksman_champions = Champion::whereIn('champion_id', $marksman_champions)->get();
                        $full_support_champions = Champion::whereIn('champion_id', $support_champions)->get();
                        
			return View::make('users.challenges', compact('user','playerroles','full_top_champions','full_jungle_champions','full_mid_champions','full_marksman_champions','full_support_champions'));
                        } else {
                                return Redirect::to('login');
                        }
		// show the form
		
	}
	
	public function doLogin()
	{
		// validate the info, create rules for the inputs
		$rules = array(
			'email'    => 'required|email', // make sure the email is an actual email
			'password' => 'required|min:3' // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('login')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {

			// create our user data for the authentication
			$userdata = array(
				'email' 	=> Input::get('email'),
				'password' 	=> Input::get('password')
			);

			// attempt to do the login
			if (Auth::attempt($userdata, true)) {
				//return Redirect::route('users.show', array('region' => $userdata->region, 'name' => $userdata->summoner_name));
				return Redirect::to('/dashboard');
			} else {	 	
				return Redirect::to('login');
			}

		}
	}
	
	public function doLogout()
	{
		Auth::logout(); // log the user out of our application
		Session::flush();
		return Redirect::to('login'); // redirect the user to the login screen
	}
	
	public function makeAdmin($id)
	{
		if(Auth::user()) {
			if(Auth::user()->hasRole('admin')) {
				$user = User::findOrFail($id);
				$roleAdmin = Role::where('name', 'admin')->firstOrFail(); // Or Role::create(['name' => 'admin']);
				$user->roles()->attach($roleAdmin->id);
				echo $user->name." wurde zum Administrator gemacht.";
			} else {
				return Redirect::to('403');
			} 
		} else {
		return Redirect::to('login');
		}
	}
	
	public function generate_keys()
	{
		if(Auth::user()) {
			if(Auth::user()->hasRole('admin')) {
				$i = 1;
				while($i <= 10) {
					$key = new Betakey;
					$key->key = str_random(10);
					$key->used = 0;
					$key->user_id = 0;
					$key->save();
					echo $key->key."<br/>";
					$i++;
				}
			} else {
				return Redirect::to('403');
			} 
		} else {
		return Redirect::to('login');
		}
	}
	
	public function generate_supporter_keys()
	{
		if(Auth::user()) {
			if(Auth::user()->hasRole('admin')) {
				$i = 1;
				while($i <= 10) {
					$key = new Betakey;
					$key->key = "supporter_".str_random(10);
					$key->used = 0;
					$key->user_id = 0;
					$key->save();
					echo $key->key."<br/>";
					$i++;
				}
			} else {
				return Redirect::to('403');
			} 
		} else {
		return Redirect::to('login');
		}
	}
	

	public function makeFriend($id)
	{
		$model = new FriendUser;
		$model->setTable("friend_users");
		if(Auth::user()){
		if($model->where("friend_id","=", $id)->where('user_id','=', Auth::user()->id)->first() == false) {
				$user_friend = Auth::user();
				$user_friend->friends()->attach($id);
				$user = User::findOrFail($id);
				$user->notify(3, '<a href="/summoner/'.$user_friend->region.'/'.$user_friend->summoner_name.'">'.$user_friend->summoner_name.'</a> '.trans("friends.add").'</br> <strong><a href="/accept_friend/'.$user_friend->id.'">'.trans("friends.accept_noti").'</a>   <a href="/remove_friend/'.$user_friend->id.'">'.trans("friends.reject").'</a></strong>');				
				$notify = $model->where("friend_id","=", $id)->where('user_id','=', $user_friend->id)->first();
				$u_not = $user->notifications->last();
				$notify->notify_id = $u_not->id;
				$notify->save();
				return Redirect::back();
		} else{ return Redirect::back();}
		} else {
		return Redirect::to('login');
		}
	} 
	
	public function removeFriend($id)
	{
		if(Auth::user()) {
			$friend_user = User::findOrFail($id);
			if($friend_user){
			$user_friend = Auth::user();
			$model = new FriendUser;
			$model->setTable("friend_users");
			$friend = $model->where("user_id","=", $id)->where('friend_id','=', Auth::user()->id)->first();
			$user = $model->where("friend_id","=", $id)->where('user_id','=', Auth::user()->id)->first();
			if($friend) {			
				if($friend->notify_id != 0) {
					$note = Notification::where("id", "=", $friend->notify_id)->where("user_id", "=", $id)->get();
					if($note) {
						Notification::destroy($friend->notify_id);	
					} 
				}
			} 
			if($user) {	
				if($user->notify_id != 0) {
					$note = Notification::where("id", "=", $user->notify_id)->where("user_id", "=", Auth::user()->id)->get();
					if($note) {
						Notification::destroy($user->notify_id);	
					} 
				}
			}
			$friend_user->friends()->detach(Auth::user()->id);
			$user_friend->friends()->detach($id);
			}
			return Redirect::back();
		} else {
		return Redirect::to('login');
		}
	} 
	
	
	public function acceptFriend($id)
	{
		$model = new FriendUser;
		$model->setTable("friend_users");
		if(Auth::user()) {
			if(Auth::user()->id != $id && $friend = $model->where("user_id","=", $id)->where('friend_id','=', Auth::user()->id)->first() == true && $friend = $model->where("user_id","=", Auth::user()->id)->where('friend_id','=', $id)->first() == false){
				$user = User::findOrFail($id);
				$user_friend = User::findOrFail(Auth::user()->id);
				$user_friend->friends()->attach($user->id);
				$friend = $model->where("user_id","=", $id)->where('friend_id','=', Auth::user()->id)->first();
				$user->timeline("new_friend",0, 0, 0, 0, 0, $user_friend->id);
				$friend->validate = 1;
				$user->notify(3, ''.$user_friend->summoner_name.' '.trans("friends.confirm"));
				$user_friend->notify(3, 'You and '.$user->summoner_name.' are friends now.');
				$friend->save();
				$myfriend = $model->where("user_id","=", Auth::user()->id)->where('friend_id','=', $id)->first();
				$myfriend->validate = 1;
				$myfriend->save();
				$model->setTable("friend_users");
				$count_user = $model->where("user_id","=", Auth::user()->id)->where('validate','=', 1)->count();
				$count_friend = $model->where("user_id","=", $id)->where('validate','=', 1)->count();
				$model2 = new FriendUser;
				$model2->setTable("friend_users");
				$friend = $model2->where("user_id","=", $id)->where('friend_id','=', Auth::user()->id)->first();
				$user2 = $model2->where("friend_id","=", $id)->where('user_id','=', Auth::user()->id)->first();
				if($friend) {			
					if($friend->notify_id != 0) {
						$note = Notification::where("id", "=", $friend->notify_id)->where("user_id", "=", $id)->get();
						if($note) {
							Notification::destroy($friend->notify_id);	
						} 
					}
				} 
				if($user2) {	
					if($user2->notify_id != 0) {
						$note = Notification::where("id", "=", $user2->notify_id)->where("user_id", "=", Auth::user()->id)->get();
						if($note) {
							Notification::destroy($user2->notify_id);	
						} 
					}
				}
				$user->checkAchievement_friend($user->id, 3, $count_friend);
				$user_friend-> checkAchievement(3, $count_user);
				return Redirect::back();
			}
			return Redirect::to('/');
		} else {
		return Redirect::to('login');
		}
	}

	public function update_achievement_points(){
	if(Auth::user()->hasRole('admin')) {
		$users = User::all();
		$points = 0;
		if($users) {
			foreach($users as $user) {
				$points = 0;
				foreach($user->achievements as $achiv) {
					$points += $achiv->points;
				}
				$user->achievement_points = $points;
				$user->save();
			}
		}
	}
	}
	
}
<?php

class UsersController extends \BaseController {

	protected $layout = 'layouts.master';
	
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
		return View::make('users.create');
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
			// check if validated summoner available
			//$verified_user = User::where('summoner_name', Input::get('summoner_name')->where('region', Input::get('region')))->first();
			$verified_user = User::
			  where('summoner_name', '=', Input::get('summoner_name'))
			->where('summoner_status', '=', 2)
			->where('region', '=', Input::get('region'))
			->first();
	
	
			
			if($verified_user) {
				return Redirect::route('users.create')
				->withInput()
				->with('message', trans("users.already_one"));
			}
			
			// Save the Summoner
			$api_key = Config::get('api.key');
			$summoner_data = "https://prod.api.pvp.net/api/lol/".Input::get('region')."/v1.4/summoner/by-name/".Input::get('summoner_name')."?api_key=".$api_key;
			$json = @file_get_contents($summoner_data);
			if($json === FALSE) {
				return Redirect::route('users.create')
				->withInput()
				->with('message', trans("users.not_found"));
			} else {
				// Create the User
				$user = new User;
				$user->summoner_name = Input::get('summoner_name');
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
				$summoner->summonerid = $obj[$user->summoner_name]["id"];
				$summoner->name = $obj[$user->summoner_name]["name"];
				$summoner->profileIconId = $obj[$user->summoner_name]["profileIconId"];
				$summoner->summonerLevel = $obj[$user->summoner_name]["summonerLevel"];
				$summoner->revisionDate = $obj[$user->summoner_name]["revisionDate"];
				$summoner->save();
				Mail::send('mails.welcome', array('summoner_name'=>Input::get('summoner_name')), function($message){
					$message->to(Input::get('email'), Input::get('summoner_name'))->subject('Welcome to Lolquest.net');
				});
			}
			$user->save();
			return Redirect::to('/login')->with('message', trans('users.thank_you'));
		}

		return Redirect::route('users.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);
		//$games = Game::all();
		$games = Game::where('summoner_id', '=', $user->summoner->summonerid)->take(10)->get();
		
		return View::make('users.show', compact('user', 'games'));
	}
	
	
	public function noAccess()
	{
		return View::make('layouts.403');
	}
	
	
	public function refresh_games()
	{
		if (Auth::check())
		{
			$user = User::find(Auth::user()->id);
			$api_key = Config::get('api.key');
			$summoner_data = "https://prod.api.pvp.net/api/lol/".$user->region."/v1.3/game/by-summoner/".$user->summoner->summonerid."/recent?api_key=".$api_key;
			$json = @file_get_contents($summoner_data);
			if($json === FALSE) {
				return View::make('login');
			} else {
				$obj = json_decode($json, true);
				foreach($obj["games"] as $game) {
					$newGame = new Game;
					$newGame->summoner_id = $user->summoner->summonerid;
					$newGame->championId = $game["championId"];
					$newGame->win = $game["stats"]["win"];
					$newGame->save();
					return Redirect::back();
				}
			}
		} else {
			return View::make('login');
		}
	}
	
	
	public function verify()
	{
		if (Auth::check())
		{
			$user = User::find(Auth::user()->id);

			if($user->summoner_status == 1) { 
				$api_key = Config::get('api.key');
				$summoner_data = "https://prod.api.pvp.net/api/lol/".$user->region."/v1.4/summoner/".$user->summoner->summonerid."/runes?api_key=".$api_key;
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
	public function edit($id)
	{
		$user = User::find($id);
		
		if (Auth::check())
		{
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
			
			$api_key = Config::get('api.key');
			$summoner_data = "https://prod.api.pvp.net/api/lol/".Input::get('region')."/v1.4/summoner/by-name/".Input::get('summoner_name')."?api_key=".$api_key;
			$json = @file_get_contents($summoner_data);
			if($json === FALSE) {
				Session::flash('message', 'No Summoner found');
				return Redirect::to('/edit_summoner');
			} else {
				$user = User::find(Auth::user()->id);
				$user->region = Input::get('region');
				$user->summoner_name = Input::get('summoner_name');
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
				$summoner->save();
				
				return Redirect::route('users.show', array('user' => $user->id));
				//return Redirect::to('/users');
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
		User::destroy($id);

		return Redirect::route('users.index');
	}
	
	public function showLogin()
	{
		// show the form
		return View::make('users.login');
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
				return Redirect::to('users');
			} else {	 	
				return Redirect::to('login');
			}

		}
	}
	
	public function doLogout()
	{
		Auth::logout(); // log the user out of our application
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

}
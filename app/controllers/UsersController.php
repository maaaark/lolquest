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
			$user = new User;
			$user->name = Input::get('name');
			$user->summoner_name = Input::get('summoner_name');
			$user->region = Input::get('region');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->save();

			return Redirect::to('/users')->with('message', trans('users.thank_you'));
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

		return View::make('users.show', compact('user'));
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
				echo "Keine Rechte";
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
			'email'      => 'required|email',
			'summoner_name' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('nerds/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$user = User::find($id);
			$user->name       = Input::get('name');
			$user->email      = Input::get('email');
			$user->summoner_name = Input::get('summoner_name');
			$user->region = Input::get('region');
			$roleMember = Role::where('name', 'member')->firstOrFail();
			$user->roles()->attach($roleMember->id);
			$user->save();

			// redirect
			Session::flash('message', 'Successfully updated!');
			return Redirect::to('users');
		}

	
		/*
		$user = User::findOrFail($id);

		$validator = Validator::make($data = Input::all(), User::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$user->update($data);

		return Redirect::route('users.index');
		*/
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
				echo "Kein Zugriff";
			} 
		} else {
		return Redirect::to('login');
		}
	}

}
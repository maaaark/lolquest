<?php

class BaseController extends Controller {
	use Efficiently\AuthorityController\ControllerAdditions;

	protected $layout = 'layouts.master';
	
	
		public function __construct()
    {
        $this->beforeFilter('notifications');
		$this->beforeFilter('my_open_quests');
		$this->beforeFilter('friend_ladders');
		$this->beforeFilter('get_daily');
		$this->beforeFilter('my_ladder_rang');
    }
	
	
	/*
	View::composer('sidebar', function($view)
	{
		$myquests = Quest::where('user_id', '=', $user->id)->where('finished', '=', 0)->get();
		$view->with('my_active_quests', $myquests);
	});
	*/
	
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	
	public function noAccess()
	{
		return View::make('layouts.403');
	}
	
	public function notFound()
	{
		return View::make('layouts.404');
	}
	
	public function search_summoner() {
		
		$summoner_name = Input::get('summoner_name');
		$region = Input::get('region');
		$users = User::where('summoner_name', 'LIKE', '%'.$summoner_name.'%')->get();
		
		return View::make('search.results', compact('users'));
	}

	

}
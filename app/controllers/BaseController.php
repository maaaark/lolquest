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
		$this->beforeFilter('user_exp_percent');
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
	
	public function start() {
		if (Auth::check()) {
			return Redirect::to('dashboard');
		} else {
			$timelines = Timeline::orderBy('id', 'desc')->take(5)->get();
			return View::make('start', compact('timelines'));
		}
	}
	
	public function noAccess()
	{
		return View::make('layouts.403');
	}
	
	public function api_error()
	{
		return View::make('layouts.api_error');
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
	
	public function refresh_items()
	{
		if (Auth::check())
		{
			if(Auth::user()->hasRole('admin')) {
				$api_key = Config::get('api.key');
				$item_data = "https://prod.api.pvp.net/api/lol/static-data/euw/v1.2/item?itemListData=stats&api_key=".$api_key;
				$json = @file_get_contents($item_data);
				
				$item_data_de = "https://prod.api.pvp.net/api/lol/static-data/euw/v1.2/item?locale=de_DE&itemListData=stats&api_key=".$api_key;
				$json_de = @file_get_contents($item_data_de);
				
				if($json === FALSE) {
					return Redirect::to('404');
				} else {
					$obj = json_decode($json, true);
					$obj_de = json_decode($json_de, true);
					
					foreach($obj["data"] as $key => $item) {
						$recent_item = Item::where('item_id', '=', $item["id"])->first();
						
						if(!isset($recent_item)) {
							$new_item = new Item;
							echo "Saved Item ".$item["name"]." ********** NEW ITEM<br/>";
						} else {
							$new_item = $recent_item;
						}
						
						if(!isset($item["plaintext"])) {
							$plaintext = "";
						}
							
						if(!isset($obj_de["data"][$key]["plaintext"])) {
							$plaintext_de = "";
						}
						
						$new_item->id = $item["id"];
						$new_item->item_id = $item["id"];
						$new_item->riot_id = $item["id"];
						
						$new_item->description = $item["description"];
						$new_item->plaintext = $plaintext;
						$new_item->name = $item["name"];
						
						$new_item->description_de = $obj_de["data"][$key]["description"];
						$new_item->name_de = $obj_de["data"][$key]["name"];
						$new_item->plaintext_de = $plaintext_de;
						
						$new_item->save();
							
							
						unset($recent_item);
					}
				}
			} else {
				return Redirect::to('403');
			}
		} else {
			return View::make('login');
		}
	}
	

}
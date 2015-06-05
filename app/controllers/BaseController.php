<?php

class BaseController extends Controller {
	use Efficiently\AuthorityController\ControllerAdditions;

	protected $layout = 'layouts.master';
	
	
	public function __construct()
    {	
		$this->beforeFilter('load_settings');
		$this->beforeFilter('has_summoner', array('except' => array('register_summoner', 'save_summoner')));
        $this->beforeFilter('notifications');
		$this->beforeFilter('my_open_quests');
		$this->beforeFilter('friend_ladders');
		$this->beforeFilter('get_daily');
		$this->beforeFilter('my_ladder_rang');
		$this->beforeFilter('user_exp_percent');
    }
	
	
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
		$blogs = Blog::orderBy("created_at", "DESC")->get();
		return View::make('layouts.new_start', compact('blogs'));
	}
	
	public function noAccess()
	{
		return View::make('layouts.403');
	}
	
	public function api_error()
	{
		return View::make('layouts.api_error');
	}
	
	public function test()
	{
				
		return View::make('layouts.test');
	}
	
	public function notFound()
	{
		return View::make('layouts.404');
	}
	
	public function search_summoner() {
		$summoner_name = Input::get('summoner_name');
                if("" !== $summoner_name && NULL !== $summoner_name) {
                    $users = User::where('summoner_name', 'LIKE', "%$summoner_name%")->get();
                } else {
                    $users = [];
                }
                
                if("" !== $summoner_name && NULL !== $summoner_name) {
                    $teams = Team::where('name', 'LIKE', "%$summoner_name%")->get();
                } else {
                    $teams = [];
                }
		return View::make('search.results', compact('users', 'teams'));
	}
	
	public function register_summoner() {
		if(Auth::check()) {
			if(Auth::user()->summoner) {
				return Redirect::to("/dashboard");
			} else {
				return View::make('users.register_summoner', compact('users'));
			}
		}
	}
	
	public function save_summoner() {
		if(Auth::check()) {
		
			$clean_summoner_name = str_replace(" ", "", Input::get('summoner_name'));
			$clean_summoner_name = strtolower($clean_summoner_name);
			$clean_summoner_name = mb_strtolower($clean_summoner_name, 'UTF-8');
			
			// check if validated summoner available
			$verified_user = User::
			  where('summoner_name', '=', $clean_summoner_name)
			->where('summoner_status', '=', 2)
			->where('region', '=', Input::get('region'))
			->first();
	
			if($verified_user) {
				return Redirect::to('/register_summoner')
				->withInput()
				->with('message', trans("users.already_one"));
			}
			
			$api_key = Config::get('api.key');
			$summoner_data = "https://".Input::get('region').".api.pvp.net/api/lol/".Input::get('region')."/v1.4/summoner/by-name/".$clean_summoner_name."?api_key=".$api_key;
			$json = @file_get_contents($summoner_data);
			
			if($json === FALSE) {
				return Redirect::to("/register_summoner")
				->withInput()
				->with('error', trans("users.not_found"));
			} else {
				$user = User::find(Auth::user()->id);
				$obj = json_decode($json, true);
				$summoner = new Summoner;
				$summoner->user_id = $user->id;
				$summoner_name_clear = str_replace(' ', '',strtolower($clean_summoner_name));
				$summoner->summonerid = $obj[$summoner_name_clear]["id"];
				$summoner->name = $obj[$summoner_name_clear]["name"];
				$summoner->profileIconId = $obj[$summoner_name_clear]["profileIconId"];
				$summoner->summonerLevel = $obj[$summoner_name_clear]["summonerLevel"];
				$summoner->revisionDate = $obj[$summoner_name_clear]["revisionDate"];
				$summoner->region = Input::get('region');
				$user->region = Input::get('region');
				$user->save();
				$summoner->save();
				return Redirect::to("/dashboard");
			}
		} else {
			return Redirect::to("/login");
		}
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

    public function classes() {
        $champions = Champion::all();
        return View::make('pages.roles', compact('champions'));
    }

}
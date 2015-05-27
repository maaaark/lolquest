<?php

class ProductsController extends \BaseController {

	public function __construct()
    {
		//$this->beforeFilter('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$products = Product::all();
		//return View::make('shop.index', compact('products'));
		return Redirect::to("/shop/quest_slot");
	}
	
	public function skin_purchased()
	{
		//$products = Product::all();
		return View::make('shop.new_skin');
	}
	
	public function lp()
	{
		if(Auth::check()) {
			return View::make('shop.lp');
		} else {
			return Redirect::to("/login");
		}
	}
	
	public function payment_success()
	{
		return View::make('shop.payment_success');
	}
	
	
	public function buy($id)
	{
		if (Auth::check()) { 
			$product = Product::find($id);
			$user = User::find(Auth::user()->id);
			
			if($user->qp >= $product->price_qp) {
				
				
				// Buy another Quest slot
				if($product->id == 1) {
					if($user->quest_slots < 4 ) {
						$user->qp = $user->qp - $product->price_qp;
						$user->quest_slots = $user->quest_slots +1;
						$user->save();
						
						$transaction = new Transaction;
						$transaction->user_id = Auth::user()->id;
						$transaction->product_id = $product->id;
						$transaction->currency = "QP";
						$transaction->price = $product->price_qp;
						$transaction->description = Auth::user()->summoner_name." bought ".$product->name." (".$product->id.") for ".$product->price_qp." ".$transaction->currency;
						$transaction->save();
						
						return View::make('shop.success')->with('message', trans("shop.new_slot"));
					} else {
						return Redirect::to('/shop/quest_slot')->with('error', trans("shop.slots_full"));
					}
				}
				
				
			} else {
				return Redirect::to('shop')->with('error', trans("shop.no_qp"));
			}
			
			return View::make('shop.done', compact('products'));
		} else {
			return Redirect::to('login');
		}
	}
	
	
	public function buy_skin($id)
	{
		if (Auth::check()) { 
			$champion = Champion::find($id);
			$user = User::find(Auth::user()->id);
			
			if($user->qp >= 200) {
				
				$skin = new Skin;
				$skin->user_id = $user->id;
				$skin->champion_id = $id;
				$skin->save();
				
				$user->qp = $user->qp - 200;
				$user->save();
				
				$transaction = new Transaction;
				$transaction->user_id = Auth::user()->id;
				$transaction->product_id = 2;
				$transaction->currency = "QP";
				$transaction->price = 200;
				$transaction->description = $user->summoner->summoner_name." bought a Skin for (".$transaction->currency.")";
				$transaction->save();	

				return Redirect::to('/shop/skin_purchased')->with('success', trans("shop.new_skin"));				
				
			} else {
				return Redirect::to('shop')->with('error', trans("shop.no_qp"));
			}
			
			return View::make('shop.done', compact('products'));
		} else {
			return Redirect::to('login');
		}
	}
	
	public function buy_betakey()
	{
		if (Auth::check()) { 
			$user = User::find(Auth::user()->id);
			
			if($user->qp >= 2000) {
				
				$user->qp = $user->qp - 2000;
				$user->save();
				
				$key = new Betakey;
				$key->key = "shop_".str_random(15);
				$key->used = 0;
				$key->user_id = $user->id;
				$key->save();
				
				$transaction = new Transaction;
				$transaction->user_id = Auth::user()->id;
				$transaction->product_id = 8;
				$transaction->currency = "QP";
				$transaction->price = 2000;
				$transaction->description = $user->summoner->summoner_name." bought a Beta Key: ".$key->key;
				$transaction->save();	

				return Redirect::to("/shop/buy_betakey/success/".$key->id);			
				
			} else {
				return Redirect::to('shop')->with('error', trans("shop.no_qp"));
			}
			
			return View::make('shop.done', compact('products'));
		} else {
			return Redirect::to('login');
		}
	}
	
	public function betakey()
	{
		$product = Product::find(8);
		return View::make('shop.betakey', compact('product'));
	}
	
	public function show_betakey($id)
	{
		if(Auth::check()) {
				$product = Betakey::where("id", "=", $id)->where("user_id", "=", Auth::user()->id)->first();
				if($product) {
					return View::make('shop.thank_you_betakey', compact('product'));
				} else {
					return Redirect::to('/shop/beta_key')->with('error', "No valid key");
				}
		} else {
			return Redirect::to("/login");
		}
	}
	
	public function buy_qp()
	{
		$products = Product::where("cat_id", "=", 2)->get();
		return View::make('shop.buy_qp', compact('products'));
	}
	
	public function backgrounds()
	{
		$products = Product::where("cat_id", "=", 3)->get();
		return View::make('shop.backgrounds', compact('products'));
	}
	
	public function riot_points()
	{
		return View::make('shop.rp');
	}
	
	
	public function quest_slot()
	{
		$products = Product::where("cat_id", "=", 1)->get();
		return View::make('shop.slot', compact('products'));
	}
	
	
	public function hardware()
	{
		return View::make('shop.hardware');
	}
	
	public function ep_boosts()
	{
		return View::make('shop.boosts');
	}
	
	public function skins()
	{
		$bought_skins = array();
		if(Auth::check()) {
			$myskins = Skin::where("user_id","=",Auth::user()->id)->get();
		} else {
			$myskins = Skin::where("user_id","=",0)->get();
		}
		foreach($myskins as $skin) {
			$bought_skins[] = $skin->champion_id;
		}
		$champions = Champion::orderBy('name', 'asc')->get();
		return View::make('shop.skins', compact('champions', 'bought_skins'));
	}
	
	public function history()
	{
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			$transactions = $user->transactions;
			return View::make('shop.history', compact('transactions'));
		} else {
			return Redirect::to("/login");
		}
	}
	
	public function offers()
	{
		return View::make('shop.offers');
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

}
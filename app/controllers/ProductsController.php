<?php

class ProductsController extends \BaseController {

	public function __construct()
    {
		$this->beforeFilter('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = Product::all();
		return View::make('shop.index', compact('products'));
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
						return Redirect::to('shop')->with('error', trans("shop.slots_full"));
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
	
	public function ep_boosts()
	{
		return View::make('shop.boosts');
	}
	
	public function skins()
	{
		return View::make('shop.skins');
	}
	
	public function history()
	{
		$user = User::find(Auth::user()->id);
		$transactions = $user->transactions;
		return View::make('shop.history', compact('transactions'));
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
<?php

class ProductsController extends \BaseController {

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
						return View::make('shop.success')->with('message', trans("shop.new_slot"));
						//return Redirect::to('shop/success')->with('message', trans("shop.new_slot"));
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
	
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
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
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
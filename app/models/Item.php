<?php

class Item extends \Eloquent {

	public function games()
    {
        //return $this->belongsToMany('Game', 'game_item', 'game_id', 'item_id');
		//return $this->belongsToMany('Game', 'game_item');
		return $this->belongsToMany('Game', 'game_item');
    }

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}
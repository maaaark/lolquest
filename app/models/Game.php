<?php

class Game extends \Eloquent {
	
	public function summoner()
    {
        return $this->belongsTo('Summoner');
    }
	
	public function items()
    {
		//return $this->belongsToMany('Item', 'game_item', 'item_id', 'id');
		return $this->belongsToMany('Item', 'game_item');
    }

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}
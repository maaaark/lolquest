<?php

class Game extends \Eloquent {
	
	public function summoner()
    {
        return $this->belongsTo('Summoner');
    }

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}
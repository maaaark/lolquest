<?php

class Summoner extends \Eloquent {

	public function user()
    {
        return $this->belongsTo('User');
    }

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}
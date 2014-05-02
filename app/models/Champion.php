<?php

class Champion extends \Eloquent {
	
	public function quests()
    {
        return $this->hasMany('Quest');
		//return $this->hasMany('Quest', 'quest_id', 'champion_id');
    }
	
	public function daylies()
    {
        return $this->hasMany('Daily');
    }
	
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}
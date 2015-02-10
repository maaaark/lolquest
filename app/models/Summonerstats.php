<?php

class Summonerstats extends \Eloquent {
	protected $fillable = [];
	
	public function users()
    {
		return $this->belongsToMany('User');
    }
	
	
	
}
<?php

class Ladder extends \Eloquent {
	protected $fillable = [];
	
	public function users()
    {
        return $this->hasMany('User');
    }
	
}
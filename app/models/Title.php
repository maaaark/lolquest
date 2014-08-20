<?php

class Title extends \Eloquent {
	protected $fillable = [];
	
	public function users()
    {
        return $this->belongsToMany('User');
    }
	
	public function achievements()
    {
		return $this->hasMany('Achievement');
    }
}
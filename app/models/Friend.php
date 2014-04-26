<?php

class Friend extends \Eloquent {

	public function users()
    {
        return $this->belongsToMany('user');
    }
	
	protected $fillable = [];
}
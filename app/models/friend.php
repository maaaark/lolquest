<?php

class Friend extends \Eloquent {

	public function users()
    {
        return $this->belongsToMany('User');
    }
	
	protected $fillable = [];
}
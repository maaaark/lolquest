<?php

class Title extends \Eloquent {
	protected $fillable = [];
	
	public function users()
    {
        return $this->belongsToMany('User');
    }
}
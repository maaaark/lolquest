<?php

class Challenge extends \Eloquent {
	protected $fillable = [];
	
	public function timelines()
    {
        return $this->hasMany('Timeline');
    }
	
	
}
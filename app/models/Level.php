<?php

class Level extends \Eloquent {
	
		public function users()
    {
        return $this->hasMany('user');
    }
	
	
	protected $fillable = [];
}
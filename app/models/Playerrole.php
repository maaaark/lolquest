<?php

class Playerrole extends \Eloquent {

	public function questtypes()
    {
        return $this->hasMany('Questtype');
    }
	
	protected $fillable = [];
}
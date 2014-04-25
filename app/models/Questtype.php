<?php

class Questtype extends \Eloquent {

	public function quests()
    {
        return $this->hasMany('Quest');
    }
	
	protected $fillable = [];
}
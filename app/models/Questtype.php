<?php

class Questtype extends \Eloquent {

	public function quests()
    {
        return $this->hasMany('Quest');
    }
	
	public function playerrole()
    {
        return $this->belongsTo('Playerrole');
    }
	
	protected $fillable = [];
}
<?php

class Team extends \Eloquent {
	protected $fillable = [];
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function members()
    {
        return $this->hasMany('User');
    }
	
}
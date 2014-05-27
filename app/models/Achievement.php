<?php

class Achievement extends \Eloquent {

	public function users()
    {
		return $this->belongsToMany('User')
			->order_by('id', 'asc');

						
    }
	
	
	public function timelines()
    {
        return $this->hasMany('Timeline');
    }
	
	
	protected $fillable = [];
}
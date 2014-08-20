<?php

/**
 * Achievement
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\Timeline[] $timelines
 */
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
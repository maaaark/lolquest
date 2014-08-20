<?php

/**
 * Team
 *
 * @property-read \User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\User[] $members
 */
class Team extends \Eloquent {
	protected $fillable = [];
	
	public static $rules = array(
		'teamname'=>'required|min:3',
		'region'=>'required|alpha|min:2',
		'website'=>'url'
	);
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function members()
    {
        return $this->hasMany('User');
    }
	
}
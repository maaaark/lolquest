<?php

/**
 * Questtype
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Quest[] $quests
 * @property-read \Playerrole $playerrole
 */
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
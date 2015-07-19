<?php

class LootUser extends \Eloquent {
	protected $fillable = [];	

	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function loot()
    {
        return $this->belongsTo('loot');
    }
}
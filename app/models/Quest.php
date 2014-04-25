<?php

class Quest extends \Eloquent {
	protected $fillable = [];
	
	public static $rules = array();
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function champion()
    {
        //return $this->belongsTo('Champion');
		return $this->hasOne('Champion', 'champion_id', 'champion_id');
    }
	
	public function questtype()
    {
        //return $this->belongsTo('Questtype');
		return $this->hasOne('Questtype', 'id', 'type_id');
    }
	
}
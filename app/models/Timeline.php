<?php

class Timeline extends \Eloquent {
	protected $fillable = [];
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function friend()
    {
        return $this->hasOne('User', 'id', 'friend_id');
    }
	
	public function comment()
    {
        return $this->hasOne('Comment', 'id', 'comment_id');
    }
	
	public function quest()
    {
        return $this->belongsTo('Quest');
    }
	
	public function challenge()
    {
        return $this->belongsTo('Challenge');
    }
	
	public function achievement()
    {
        return $this->belongsTo('Achievement');
    }
}
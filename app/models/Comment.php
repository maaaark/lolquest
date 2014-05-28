<?php

class Comment extends \Eloquent {
	protected $fillable = [];
	
	public function blog()
    {
        return $this->belongsTo('Blog');
    }
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
}
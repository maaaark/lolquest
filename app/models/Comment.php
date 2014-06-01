<?php

class Comment extends \Eloquent {
	protected $fillable = [];
	
	public static $rules = array(
		'comment'=>'required|min:3',
	);
	
	
	public function blog()
    {
        return $this->belongsTo('Blog');
    }
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
}
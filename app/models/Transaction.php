<?php

class Transaction extends \Eloquent {
	protected $fillable = [];
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function product()
    {
        return $this->belongsTo('Product');
    }
}
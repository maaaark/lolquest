<?php

class Product extends \Eloquent {
	protected $fillable = [];
	
	public function transactions()
    {
        return $this->hasMany('Transaction');
    }
	
	
}
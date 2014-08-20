<?php

/**
 * Product
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Transaction[] $transactions
 */
class Product extends \Eloquent {
	protected $fillable = [];
	
	public function transactions()
    {
        return $this->hasMany('Transaction');
    }
	
	
}
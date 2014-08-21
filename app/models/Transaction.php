<?php

/**
 * Transaction
 *
 * @property-read \User $user
 * @property-read \Product $product
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property string $description
 * @property float $price
 * @property string $currency
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Transaction whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Transaction whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Transaction whereProductId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Transaction whereDescription($value) 
 * @method static \Illuminate\Database\Query\Builder|\Transaction wherePrice($value) 
 * @method static \Illuminate\Database\Query\Builder|\Transaction whereCurrency($value) 
 * @method static \Illuminate\Database\Query\Builder|\Transaction whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Transaction whereUpdatedAt($value) 
 */
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
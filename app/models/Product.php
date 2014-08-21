<?php

/**
 * Product
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Transaction[] $transactions
 * @property integer $id
 * @property string $name
 * @property string $name_de
 * @property integer $cat_id
 * @property integer $price_qp
 * @property string $description
 * @property string $description_de
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Product whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Product whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Product whereNameDe($value) 
 * @method static \Illuminate\Database\Query\Builder|\Product whereCatId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Product wherePriceQp($value) 
 * @method static \Illuminate\Database\Query\Builder|\Product whereDescription($value) 
 * @method static \Illuminate\Database\Query\Builder|\Product whereDescriptionDe($value) 
 * @method static \Illuminate\Database\Query\Builder|\Product whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Product whereUpdatedAt($value) 
 */
class Product extends \Eloquent {
	protected $fillable = [];
	
	public function transactions()
    {
        return $this->hasMany('Transaction');
    }
	
	
}
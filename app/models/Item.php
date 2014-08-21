<?php

/**
 * Item
 *
 * @property integer $id
 * @property integer $item_id
 * @property string $name
 * @property string $name_de
 * @property string $description
 * @property string $description_de
 * @property string $plaintext
 * @property string $plaintext_de
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $riot_id
 * @method static \Illuminate\Database\Query\Builder|\Item whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Item whereItemId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Item whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Item whereNameDe($value) 
 * @method static \Illuminate\Database\Query\Builder|\Item whereDescription($value) 
 * @method static \Illuminate\Database\Query\Builder|\Item whereDescriptionDe($value) 
 * @method static \Illuminate\Database\Query\Builder|\Item wherePlaintext($value) 
 * @method static \Illuminate\Database\Query\Builder|\Item wherePlaintextDe($value) 
 * @method static \Illuminate\Database\Query\Builder|\Item whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Item whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Item whereRiotId($value) 
 */
class Item extends \Eloquent {


	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}
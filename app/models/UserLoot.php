<?php

/**
 * UserLoot
 *
 * @property-read \User $user
 * @property-read \Loot $loot
 * @property integer $id
 * @property integer $user_id
 * @property integer $loot_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\UserLoot whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\UserLoot whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\UserLoot whereLootId($value) 
 * @method static \Illuminate\Database\Query\Builder|\UserLoot whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\UserLoot whereUpdatedAt($value) 
 */
class UserLoot extends \Eloquent {
	protected $fillable = [];	

	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function loot()
    {
        return $this->belongsTo('Loot');
    }
}
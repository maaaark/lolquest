<?php

/**
 * Skin
 *
 * @property-read \User $user
 * @property-read \Champion $champion
 * @property integer $id
 * @property integer $user_id
 * @property integer $champion_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Skin whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Skin whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Skin whereChampionId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Skin whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Skin whereUpdatedAt($value) 
 */
class Skin extends \Eloquent {
	protected $fillable = [];
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function champion()
    {
        return $this->belongsTo('Champion', 'champion_id', 'champion_id');;
    }
}
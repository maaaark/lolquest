<?php

/**
 * Daily
 *
 * @property-read \Champion $champion
 * @property-read \Questtype $questtype
 * @property integer $id
 * @property integer $quest_id
 * @property integer $type_id
 * @property integer $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $champion_id
 * @method static \Illuminate\Database\Query\Builder|\Daily whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Daily whereQuestId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Daily whereTypeId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Daily whereActive($value) 
 * @method static \Illuminate\Database\Query\Builder|\Daily whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Daily whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Daily whereChampionId($value) 
 */
class Daily extends \Eloquent {
	protected $fillable = [];
	
	public function champion()
    {
        return $this->hasOne('Champion', 'champion_id', 'champion_id');
    }
	
	public function questtype()
    {
		return $this->hasOne('Questtype', 'id', 'type_id');
    }
}
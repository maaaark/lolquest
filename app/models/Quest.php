<?php

/**
 * Quest
 *
 * @property-read \User $user
 * @property-read \Champion $champion
 * @property-read \Questtype $questtype
 * @property-read \Illuminate\Database\Eloquent\Collection|\Timeline[] $timelines
 * @property integer $id
 * @property integer $user_id
 * @property integer $type_id
 * @property integer $champion_id
 * @property integer $exp
 * @property integer $qp
 * @property integer $finished
 * @property string $quest_slot
 * @property integer $createDate
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $daily
 * @method static \Illuminate\Database\Query\Builder|\Quest whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Quest whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Quest whereTypeId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Quest whereChampionId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Quest whereExp($value) 
 * @method static \Illuminate\Database\Query\Builder|\Quest whereQp($value) 
 * @method static \Illuminate\Database\Query\Builder|\Quest whereFinished($value) 
 * @method static \Illuminate\Database\Query\Builder|\Quest whereQuestSlot($value) 
 * @method static \Illuminate\Database\Query\Builder|\Quest whereCreateDate($value) 
 * @method static \Illuminate\Database\Query\Builder|\Quest whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Quest whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Quest whereDaily($value) 
 */
class Quest extends \Eloquent {
	protected $fillable = [];	
	
	public static $rules = array();
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function champion()
    {
        //return $this->belongsTo('Champion');
		return $this->hasOne('Champion', 'champion_id', 'champion_id');
    }
	
	public function questtype()
    {
        //return $this->belongsTo('Questtype');
		return $this->hasOne('Questtype', 'id', 'type_id');
    }
	
	public function timelines()
    {
        return $this->hasMany('Timeline');
    }
	
}
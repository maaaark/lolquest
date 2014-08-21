<?php

/**
 * Ladder
 *
 * @property-read \User $user
 * @property integer $id
 * @property integer $user_id
 * @property integer $rang
 * @property integer $year
 * @property integer $month
 * @property integer $month_exp
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $total_quests
 * @method static \Illuminate\Database\Query\Builder|\Ladder whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Ladder whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Ladder whereRang($value) 
 * @method static \Illuminate\Database\Query\Builder|\Ladder whereYear($value) 
 * @method static \Illuminate\Database\Query\Builder|\Ladder whereMonth($value) 
 * @method static \Illuminate\Database\Query\Builder|\Ladder whereMonthExp($value) 
 * @method static \Illuminate\Database\Query\Builder|\Ladder whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Ladder whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Ladder whereTotalQuests($value) 
 */
class Ladder extends \Eloquent {
	protected $fillable = [];
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
}
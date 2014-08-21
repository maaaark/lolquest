<?php

/**
 * Arena
 *
 * @property-read \User $user
 * @property integer $id
 * @property integer $user_id
 * @property integer $rang
 * @property integer $arena_quests
 * @property integer $month
 * @property integer $year
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $arena_finished
 * @property integer $arena_quest_started
 * @property integer $arena_quest_start_time
 * @property integer $arena_quest_end_time
 * @method static \Illuminate\Database\Query\Builder|\Arena whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Arena whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Arena whereRang($value) 
 * @method static \Illuminate\Database\Query\Builder|\Arena whereArenaQuests($value) 
 * @method static \Illuminate\Database\Query\Builder|\Arena whereMonth($value) 
 * @method static \Illuminate\Database\Query\Builder|\Arena whereYear($value) 
 * @method static \Illuminate\Database\Query\Builder|\Arena whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Arena whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Arena whereArenaFinished($value) 
 * @method static \Illuminate\Database\Query\Builder|\Arena whereArenaQuestStarted($value) 
 * @method static \Illuminate\Database\Query\Builder|\Arena whereArenaQuestStartTime($value) 
 * @method static \Illuminate\Database\Query\Builder|\Arena whereArenaQuestEndTime($value) 
 */
class Arena extends \Eloquent {
	protected $fillable = [];
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
}
<?php

/**
 * Timeline
 *
 * @property-read \User $user
 * @property-read \User $friend
 * @property-read \Comment $comment
 * @property-read \Quest $quest
 * @property-read \Challenge $challenge
 * @property-read \Achievement $achievement
 * @property-read \Title $title
 * @property integer $id
 * @property integer $user_id
 * @property string $event_type
 * @property integer $quest_id
 * @property integer $achievement_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $challenge_mode
 * @property integer $challenge_step
 * @property integer $comment_id
 * @property integer $friend_id
 * @property integer $title_id
 * @method static \Illuminate\Database\Query\Builder|\Timeline whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Timeline whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Timeline whereEventType($value) 
 * @method static \Illuminate\Database\Query\Builder|\Timeline whereQuestId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Timeline whereAchievementId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Timeline whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Timeline whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Timeline whereChallengeMode($value) 
 * @method static \Illuminate\Database\Query\Builder|\Timeline whereChallengeStep($value) 
 * @method static \Illuminate\Database\Query\Builder|\Timeline whereCommentId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Timeline whereFriendId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Timeline whereTitleId($value) 
 */
class Timeline extends \Eloquent {
	protected $fillable = [];
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function friend()
    {
        return $this->hasOne('User', 'id', 'friend_id');
    }
	
	public function comment()
    {
        return $this->hasOne('Comment', 'id', 'comment_id');
    }
	
	public function quest()
    {
        return $this->belongsTo('Quest');
    }
	
	public function challenge()
    {
        return $this->belongsTo('Challenge');
    }
	
	public function achievement()
    {
        return $this->belongsTo('Achievement');
    }
	
	public function title()
    {
        return $this->belongsTo('Title');
    }
}
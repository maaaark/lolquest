<?php

/**
 * ForumLastRead
 *
 * @property-read \User $user
 * @property-read \ForumTopic $topic
 * @property integer $id
 * @property integer $user_id
 * @property integer $forum_topic_id
 * @property string $last_read
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\ForumLastRead whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumLastRead whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumLastRead whereForumTopicId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumLastRead whereLastRead($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumLastRead whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumLastRead whereUpdatedAt($value) 
 */
class ForumLastRead extends \Eloquent {
	protected $fillable = [];
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function topic()
    {
        return $this->belongsTo('ForumTopic');
    }
	
}
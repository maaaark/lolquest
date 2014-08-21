<?php

/**
 * ForumReply
 *
 * @property-read \ForumTopic $topic
 * @property-read \User $user
 * @property integer $id
 * @property integer $user_id
 * @property integer $forum_topic_id
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\ForumReply whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumReply whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumReply whereForumTopicId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumReply whereContent($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumReply whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumReply whereUpdatedAt($value) 
 */
class ForumReply extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'content' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
	
	public function topic()
    {
        return $this->hasOne('ForumTopic');
    }
	
	public function user()
    {
        return $this->belongsTo('User');
    }

}
<?php

/**
 * ForumLastRead
 *
 * @property-read \User $user
 * @property-read \ForumTopic $topic
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
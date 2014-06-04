<?php

class ForumReply extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
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
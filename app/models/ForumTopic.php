<?php

class ForumTopic extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
	
	public function category()
    {
        return $this->hasOne('ForumCategory');
    }
	
	public function replies()
    {
        return $this->hasMany('ForumReply');
    }

	public function user()
    {
        return $this->belongsTo('User');
    }
}
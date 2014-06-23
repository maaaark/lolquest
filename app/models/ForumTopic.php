<?php

class ForumTopic extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'title' => 'required',
		'content' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
	
	public function category()
    {
        return $this->belongsTo('ForumCategory', 'forum_category_id', 'id');
    }
	
	public function replies()
    {
        return $this->hasMany('ForumReply');
    }
	
	public function last_reads()
    {
        return $this->hasMany('ForumLastRead');
    }

	public function user()
    {
        return $this->belongsTo('User');
    }
}
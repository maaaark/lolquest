<?php

class ForumCategory extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];
	
	public function topics()
    {
        return $this->hasMany('ForumTopic');
    }
	
	public function replies()
    {
        return $this->hasMany('ForumReply');
    }

	// Don't forget to fill this array
	protected $fillable = [];

}
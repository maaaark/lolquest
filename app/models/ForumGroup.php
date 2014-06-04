<?php

class ForumGroup extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
	
	public function group()
    {
        return $this->hasOne('ForumGroup');
    }
	
	public function categories()
    {
        return $this->hasMany('ForumCategory');
    }

}
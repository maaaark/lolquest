<?php

/**
 * UserTitle
 *
 * @property-read \User $user
 * @property-read \Title $title
 * @property integer $id
 * @property integer $user_id
 * @property integer $title_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\UserTitle whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\UserTitle whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\UserTitle whereTitleId($value) 
 * @method static \Illuminate\Database\Query\Builder|\UserTitle whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\UserTitle whereUpdatedAt($value) 
 */
class UserTitle extends \Eloquent {
	protected $fillable = [];
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function title()
    {
        return $this->belongsTo('Title');
    }
}
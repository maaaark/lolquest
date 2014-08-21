<?php

/**
 * Comment
 *
 * @property-read \Blog $blog
 * @property-read \User $user
 * @property integer $id
 * @property integer $user_id
 * @property string $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $blog_id
 * @method static \Illuminate\Database\Query\Builder|\Comment whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Comment whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Comment whereComment($value) 
 * @method static \Illuminate\Database\Query\Builder|\Comment whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Comment whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Comment whereBlogId($value) 
 */
class Comment extends \Eloquent {
	protected $fillable = [];
	
	public static $rules = array(
		'comment'=>'required|min:3',
	);
	
	
	public function blog()
    {
        return $this->belongsTo('Blog');
    }
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
}
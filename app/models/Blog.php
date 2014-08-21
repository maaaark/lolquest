<?php

/**
 * Blog
 *
 * @property-read \User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Comment[] $comments
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property integer $user_id
 * @property integer $category_id
 * @property string $picture
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Blog whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Blog whereTitle($value) 
 * @method static \Illuminate\Database\Query\Builder|\Blog whereBody($value) 
 * @method static \Illuminate\Database\Query\Builder|\Blog whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Blog whereCategoryId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Blog wherePicture($value) 
 * @method static \Illuminate\Database\Query\Builder|\Blog whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Blog whereUpdatedAt($value) 
 */
class Blog extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];
	
	// Don't forget to fill this array
	protected $fillable = [];

	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function comments()
    {
        return $this->hasMany('Comment');
    }
	
}
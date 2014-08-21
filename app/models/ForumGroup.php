<?php

/**
 * ForumGroup
 *
 * @property-read \ForumGroup $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\ForumCategory[] $categories
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\ForumGroup whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumGroup whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumGroup whereDescription($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumGroup whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumGroup whereUpdatedAt($value) 
 */
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
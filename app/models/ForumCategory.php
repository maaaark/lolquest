<?php

/**
 * ForumCategory
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\ForumTopic[] $topics
 * @property-read \Illuminate\Database\Eloquent\Collection|\ForumReply[] $replies
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $forum_group_id
 * @property string $url_name
 * @property string $icon
 * @method static \Illuminate\Database\Query\Builder|\ForumCategory whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumCategory whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumCategory whereDescription($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumCategory whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumCategory whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumCategory whereForumGroupId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumCategory whereUrlName($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumCategory whereIcon($value) 
 */
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
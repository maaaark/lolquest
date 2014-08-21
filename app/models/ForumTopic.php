<?php

/**
 * ForumTopic
 *
 * @property-read \ForumCategory $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\ForumReply[] $replies
 * @property-read \Illuminate\Database\Eloquent\Collection|\ForumLastRead[] $last_reads
 * @property-read \User $user
 * @property integer $id
 * @property integer $user_id
 * @property string $content
 * @property string $topic
 * @property integer $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $url_name
 * @property integer $forum_category_id
 * @method static \Illuminate\Database\Query\Builder|\ForumTopic whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumTopic whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumTopic whereContent($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumTopic whereTopic($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumTopic whereStatus($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumTopic whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumTopic whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumTopic whereUrlName($value) 
 * @method static \Illuminate\Database\Query\Builder|\ForumTopic whereForumCategoryId($value) 
 */
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
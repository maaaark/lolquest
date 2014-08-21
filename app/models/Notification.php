<?php

/**
 * Notification
 *
 * @property-read \User $user
 * @property integer $id
 * @property integer $user_id
 * @property integer $seen
 * @property integer $type
 * @property string $message
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Notification whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Notification whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Notification whereSeen($value) 
 * @method static \Illuminate\Database\Query\Builder|\Notification whereType($value) 
 * @method static \Illuminate\Database\Query\Builder|\Notification whereMessage($value) 
 * @method static \Illuminate\Database\Query\Builder|\Notification whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Notification whereUpdatedAt($value) 
 */
class Notification extends \Eloquent {

	public function user()
    {
        return $this->belongsTo('User');
    }

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}
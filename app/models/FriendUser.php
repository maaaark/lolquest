<?php

/**
 * FriendUser
 *
 * @property integer $id
 * @property integer $friend_id
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $validate
 * @property integer $notify_id
 * @method static \Illuminate\Database\Query\Builder|\FriendUser whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\FriendUser whereFriendId($value) 
 * @method static \Illuminate\Database\Query\Builder|\FriendUser whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\FriendUser whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\FriendUser whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\FriendUser whereValidate($value) 
 * @method static \Illuminate\Database\Query\Builder|\FriendUser whereNotifyId($value) 
 */
class FriendUser extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}
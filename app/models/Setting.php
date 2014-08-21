<?php

/**
 * Setting
 *
 * @property integer $id
 * @property integer $livestream
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Setting whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Setting whereLivestream($value) 
 * @method static \Illuminate\Database\Query\Builder|\Setting whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Setting whereUpdatedAt($value) 
 */
class Setting extends \Eloquent {
	protected $fillable = [];
}
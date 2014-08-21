<?php

/**
 * Betakey
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $key
 * @property integer $used
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Betakey whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Betakey whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Betakey whereKey($value) 
 * @method static \Illuminate\Database\Query\Builder|\Betakey whereUsed($value) 
 * @method static \Illuminate\Database\Query\Builder|\Betakey whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Betakey whereUpdatedAt($value) 
 */
class Betakey extends \Eloquent {
	protected $fillable = [];
}
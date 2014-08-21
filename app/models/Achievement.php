<?php

/**
 * Achievement
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\Timeline[] $timelines
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $factor
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $type
 * @property string $icon
 * @property integer $points
 * @property integer $title_id
 * @property-read \Title $title
 * @method static \Illuminate\Database\Query\Builder|\Achievement whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Achievement whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Achievement whereDescription($value) 
 * @method static \Illuminate\Database\Query\Builder|\Achievement whereFactor($value) 
 * @method static \Illuminate\Database\Query\Builder|\Achievement whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Achievement whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Achievement whereType($value) 
 * @method static \Illuminate\Database\Query\Builder|\Achievement whereIcon($value) 
 * @method static \Illuminate\Database\Query\Builder|\Achievement wherePoints($value) 
 * @method static \Illuminate\Database\Query\Builder|\Achievement whereTitleId($value) 
 */
class Achievement extends \Eloquent {

	public function users()
    {
		return $this->belongsToMany('User')
			->order_by('id', 'asc');
    }
	
	public function title()
    {
        return $this->belongsTo('Title');
    }
	
	public function timelines()
    {
        return $this->hasMany('Timeline');
    }
	
	
	protected $fillable = [];
}
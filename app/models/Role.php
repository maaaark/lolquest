<?php

/**
 * Role
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Role whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Role whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Role whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Role whereUpdatedAt($value) 
 */
class Role extends Eloquent {}
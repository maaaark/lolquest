<?php

/**
 * Permission
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $type
 * @property string $action
 * @property string $resource
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Permission whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Permission whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Permission whereType($value) 
 * @method static \Illuminate\Database\Query\Builder|\Permission whereAction($value) 
 * @method static \Illuminate\Database\Query\Builder|\Permission whereResource($value) 
 * @method static \Illuminate\Database\Query\Builder|\Permission whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Permission whereUpdatedAt($value) 
 */
class Permission extends Eloquent {}
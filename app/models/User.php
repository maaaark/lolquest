<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $guarded = array("password_confirmation");
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	
	public static $rules = array(
		'summoner_name'=>'required|alpha|min:3',
		'region'=>'required|alpha|min:2',
		'email'=>'required|email|unique:users',
		'password'=>'required|between:6,12|confirmed',
		'password_confirmation'=>'required|between:6,12'
	);
	
		public function levels()
    {
		return $this->hasOne('level', 'id', 'level');
    }

	public function summoner()
    {
        return $this->hasOne('Summoner');
    }
	
	public function ladder()
    {
        return $this->hasOne('Ladder');
    }
	
	public function notifications()
    {
        return $this->hasMany('Notification');
    }
	
	public function quests()
    {
        return $this->hasMany('Quest');
    }
	
	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
	
	public function roles()
    {
        return $this->belongsToMany('Role');
    }

    public function permissions()
    {
        return $this->hasMany('Permission');
    }

    public function hasRole($key)
    {
        foreach($this->roles as $role){
            if($role->name === $key)
            {
                return true;
            }
        }
        return false;
    }
	
	public function friends()
    {
        return $this->belongsToMany('User', 'friend_user', 'user_id', 'friend_id');
    }

}

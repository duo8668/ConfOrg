<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

protected $table = 'users';
protected $primaryKey = 'user_id';

protected $fillable = ['title','firstname','lastname','email','password'];

protected $guarded = array('user_id');

public $timestamps = false;

use UserTrait, RemindableTrait;
public $errors;
protected $hidden = array('password', 'remember_token');



	public static $rules = 
	[
		'Email' => 'required',
		'Password' => 'required'
	];

	
	public function isValid($data)
	{
		$validation = Validator::make($data, static::$rules);

		if($validation->passes()) return true;

		$this->errors = $validation->messages();
		return false;
	}
 
	public function roles()
	{
		return $this->belongsToMany('Role', 'ConfUserRole');
	}

	public function hasRole($name)
    {
        foreach ($this->roles as $role)
        {
            if ($role->rolename == $name) return true;
        }
        return false;
    }

    public static function IsInRole($name,$confId){
    	$userid = Session::get('userid');
		//$confid = '1';
		$user = User::find($userid);

		return $user->hasRole($name);
    }

<<<<<<< .mine
 }
=======
		return $roles;
	}

	public function Roles(){
		return $this->hasManyThrough('Role','UserRole','roleid','roleid');
	}
}
>>>>>>> .r17

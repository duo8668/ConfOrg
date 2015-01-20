<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;
	protected $table = 'users';
	protected $primaryKey = 'user_id';

	protected $fillable = ['firstname','lastname','email','email_temp','password','password_temp','remember_token','code','active','created_at','updated_at'];

	protected $guarded = array('user_id');

	
	// public $errors;
	// protected $hidden = array('password', 'remember_token');



	// public static $rules = 
	// [
	// 'Email' => 'required',
	// 'Password' => 'required'
	// ];

	
	// public function isValid($data)
	// {
	// 	$validation = Validator::make($data, static::$rules);

	// 	if($validation->passes()) return true;

	// 	$this->errors = $validation->messages();
	// 	return false;
	// }
	
	// public function roles()
	// {
	// 	return $this->belongsToMany('Role', 'ConfUserRole');
	// }

	// public function hasRole($name)
	// {
	// 	foreach ($this->roles as $role)
	// 	{
	// 		if ($role->rolename == $name) return true;
	// 	}
	// 	return false;
	// }

	// public static function IsInRole($name,$confId){
	// 	$userid = Session::get('userid');
	// 	//$confid = '1';
	// 	//Auth::user()->user_id
	// 	$user = Auth::user();

	// 	return $user->hasRole($name);
	// }

}

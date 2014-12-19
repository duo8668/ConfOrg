<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

protected $table = 'users';

protected $fillable = ['title','firstname','lastname','email','password'];

protected $guarded = array('userid');

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

	public function IsInRole($requestedRoleId){

		$roles = ConferenceUserRole::select('roleid')->where('userid','=',$this->$userid);

		 Role::whereIn($roles->toArray())
		->select('roleid')
		->first();		

		return $roles;
	}

	public function Roles(){
		return this->hasManyThrough('Role','UserRole','roleid','roleid');
	}
}

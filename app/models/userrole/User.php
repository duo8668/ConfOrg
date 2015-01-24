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

public function isInRole($confid,$roleid)
 {

  $userid= Auth::user()->user_id;

  $role = DB::table('confuserrole')
  ->where('conf_id','=',$confid)
  ->where('user_id','=',$userid)
  ->get();

  foreach ($role as $role)
  {
   
      if($role->role_id ==$roleid)
       return true;
  }
  
   return false;
 }
}

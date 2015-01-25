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

public function hasConfRole($confid,$rolename)
 {
  $role_id = DB::table('roles')
  ->where('rolename','=',$rolename)
  ->lists('role_id');

  $userid= Auth::user()->user_id;

  $role = DB::table('confuserrole')
  ->where('conf_id','=',$confid)
  ->where('user_id','=',$userid)
  ->where('role_id','=',$role_id)
  ->first();

  return ($role != null);


 }
 public function hasConfPermission($confid,$permissionname){
    $permission_id = DB::table('permissions')
    ->where('permission_name','=',$permissionname)
    ->lists('permission_id');

    $list_of_role_that_has_permission =  
    DB::table('role_permission')
    ->where('permission_id','=',$permission_id)
    ->first();

    $userid= Auth::user()->user_id;

   $lists_of_role_user_is = 
   DB::table('confuserrole')
    ->where('conf_id','=',$confid)
    ->where('user_id','=',$userid)
    ->get();

  foreach ($lists_of_role_user_is as $lists_of_role_user_is)
  {
   
      if($lists_of_role_user_is->role_id == $list_of_role_that_has_permission->role_id)
       return true;
  }
  
   return false;
 }

 public function hasSysRole($rolename){
  $role_id = DB::table('roles')
  ->where('rolename','=',$rolename)
  ->lists('role_id');

  $userid= Auth::user()->user_id;

  $role = DB::table('sysrole')
  ->where('user_id','=',$userid)
  ->where('role_id','=',$role_id)
  ->first();

  return ($role != null);

 }

 public function hasSysPermission($permissionname){
    $permission_id = DB::table('permissions')
    ->where('permission_name','=',$permissionname)
    ->lists('permission_id');

    $list_of_role_that_has_permission =  
    DB::table('role_permission')
    ->where('permission_id','=',$permission_id)
    ->first();

    $userid= Auth::user()->user_id;

   $lists_of_role_user_is = 
   DB::table('sysrole')
    ->where('user_id','=',$userid)
    ->get();

  foreach ($lists_of_role_user_is as $lists_of_role_user_is)
  {
   
      if($lists_of_role_user_is->role_id == $list_of_role_that_has_permission->role_id)
       return true;
  }
  
   return false;
 }
}

<?php
class Role extends Eloquent {

	protected $table = 'roles';
	protected $primaryKey = 'role_id';

	protected $fillable = array('rolename', 'remarks');

	protected $guarded = array('role_id');

	public $timestamps = false;


}
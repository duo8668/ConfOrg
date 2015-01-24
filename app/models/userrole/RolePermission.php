<?php
class RolePermission extends Eloquent {

	protected $table = 'role_permission';
	protected $primaryKey = 'rolepermission_id';

	protected $fillable = array('role_id', 'permission_id');
	protected $guarded = array('rolepermission_id');

	public $timestamps = false;


}
<?php
class Role extends Eloquent {

	protected $table = 'roles';

	protected $fillable = array('rolename', 'remarks');

	protected $guarded = array('roleid');

	public $timestamps = false;


}
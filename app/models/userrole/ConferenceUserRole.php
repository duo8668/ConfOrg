<?php
class ConferenceUserRole extends Eloquent {

	protected $table = 'confuserrole';
protected $primaryKey = 'confuserrole_id';
	protected $fillable = array( 'user_id', 'role_id', 'conf_id', 'remarks');

	protected $guarded = array('confuserrole_id');

	public $timestamps = false;


}
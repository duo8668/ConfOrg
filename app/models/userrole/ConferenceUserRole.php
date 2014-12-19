<?php
class ConferenceUserRole extends Eloquent {

	protected $table = 'conferenceuserrole';

	protected $fillable = array( 'userid', 'roleid', 'confid', 'remarks');

	protected $guarded = array('confuserid');

	public $timestamps = false;


}
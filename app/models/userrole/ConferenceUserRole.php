<?php
class ConferenceUserRole extends Eloquent {

	protected $table = 'confuserrole';
	protected $primaryKey = 'confuserrole_id';
	protected $fillable = array( 'user_id', 'role_id', 'conf_id', 'remarks');

	protected $guarded = array('confuserrole_id');

	public $timestamps = false;

	public function Role(){
		return $this->belongsTo('Role', 'role_id', 'role_id');
	}

	public function User(){
		return $this->belongsTo('Role', 'user_id', 'user_id');
	}

	public function Conference(){
		return $this->belongsTo('Conference', 'conf_id', 'ConfId');
	}


}
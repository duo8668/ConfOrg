<?php

class ConferenceUserRole extends Eloquent {

	protected $table = 'confuserrole';
	protected $primaryKey = 'confuserrole_id';
	protected $fillable = array( 'user_id', 'role_id', 'conf_id', 'remarks');
	
	protected $guarded = array('confuserrole_id');
	public $timestamps = false; 

	public function Conference(){
		return $this->belongsTo('Conference', 'conf_id', 'ConfId');
	}

	public function scopeConferenceChair($query,$conf_id){
		return $query->where($this->table.'.conf_id', '=', $conf_id)
		->where($this->table.'.role_id','=',Role::ConferenceChair()->role_id)
		->leftJoin('users', 'confuserrole.user_id', '=', 'users.user_id')
		->leftJoin('roles', 'confuserrole.role_id', '=', 'roles.role_id')
		->get();
	}

	public function scopeConferenceStaffs($query,$conf_id){
		return $query->where($this->table.'.conf_id', '=', $conf_id)
		->where($this->table.'.role_id','=',Role::ConferenceStaff()->role_id)
		->leftJoin('users', 'confuserrole.user_id', '=', 'users.user_id')
		->leftJoin('roles', 'confuserrole.role_id', '=', 'roles.role_id')
		->get();

	}

	public function scopeConferenceReviewPanels($query,$conf_id){
		return $query->where($this->table.'.conf_id', '=', $conf_id)
		->where($this->table.'.role_id','=',Role::ReviewPanel()->role_id)
		->leftJoin('users', 'confuserrole.user_id', '=', 'users.user_id')
		->leftJoin('roles', 'confuserrole.role_id', '=', 'roles.role_id')
		->get();

	}


}
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
		;
	}

	public function scopeConferenceStaffs($query,$conf_id){
		return $query->where($this->table.'.conf_id', '=', $conf_id)
		->where($this->table.'.role_id','=',Role::ConferenceStaff()->role_id)
		->leftJoin('users', 'confuserrole.user_id', '=', 'users.user_id')
		->leftJoin('roles', 'confuserrole.role_id', '=', 'roles.role_id')
		;

	}

	public function scopeConferenceReviewPanels($query,$conf_id){
		return $query->where($this->table.'.conf_id', '=', $conf_id)
		->where($this->table.'.role_id','=',Role::Reviewer()->role_id)
		->leftJoin('users', 'confuserrole.user_id', '=', 'users.user_id')
		->leftJoin('roles', 'confuserrole.role_id', '=', 'roles.role_id')
		;

	}

	public function scopeConferenceparticipants($query,$conf_id){
		return $query->where($this->table.'.conf_id', '=', $conf_id)
		->where($this->table.'.role_id','=',Role::Participant()->role_id)
		->leftJoin('users', 'confuserrole.user_id', '=', 'users.user_id')
		->leftJoin('roles', 'confuserrole.role_id', '=', 'roles.role_id')
		;

	}

	public function scopeConferenceAuthors($query,$conf_id){
		return $query->where($this->table.'.conf_id', '=', $conf_id)
		->where($this->table.'.role_id','=',Role::Author()->role_id)
		->leftJoin('users', 'confuserrole.user_id', '=', 'users.user_id')
		->leftJoin('roles', 'confuserrole.role_id', '=', 'roles.role_id')
		;

	}

	public function scopeResourceProviders($query,$conf_id){
		return $query->where($this->table.'.conf_id', '=', $conf_id)
		->where($this->table.'.role_id','=',Role::ResourceProvider()->role_id)
		->leftJoin('users', 'confuserrole.user_id', '=', 'users.user_id')
		->leftJoin('roles', 'confuserrole.role_id', '=', 'roles.role_id')
		;

	}


}
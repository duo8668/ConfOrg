<?php
class Role extends Eloquent {

	protected $table = 'roles';
	protected $primaryKey = 'role_id';

	protected $fillable = array('rolename', 'remarks');
	protected $guarded = array('role_id');

	public $timestamps = false;

	public function scopeConferenceChair()
	{
		# code...
		return $this->where('rolename','=','Conference Chair')->first();
	}


	public function scopeConferenceStaff()
	{
		# code...
		return $this->where('rolename','=','Conference Staff')->first();
	}

	public function scopeReviewPanel()
	{
		# code...
		return $this->where('rolename','=','Review Panel')->first();
	}

	public function scopeParticipant()
	{
		# code...
		return $this->where('rolename','=','Participant')->first();
	}

}
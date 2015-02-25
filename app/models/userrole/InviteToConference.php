<?php

class InviteToConference extends Eloquent {

	protected $table = 'invitation_to_conference';
	protected $primaryKey = 'invitation_to_conference_id';

	protected $fillable = array('code','email','role_id','conf_id','is_used');
	protected $guarded = array('invitation_to_conference_id');

	public $timestamps = true;

	public function scopeHasInvitation($email){
		$result = $this->where('email','=',$email)->firstOrFail();
		return !empty($result);
	}

	public function scopeIsValidCode($code){
		$result = $this->where('code','=',$code)->firstOrFail();
		return !empty($result);
	}

}
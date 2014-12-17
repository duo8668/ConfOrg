<?php
class ConferenceParticipantBarred extends Eloquent {

	protected $table = 'conference_participantbarred';
	
	protected $fillable = array('ConfId','UserId','Reason');

	protected $guarded = array('CreatedBy','DateCreated');
	
	public $timestamps = false;
	
	public function users()
	{
		return $this->hasMany('User','UserId','userid');
	}
}
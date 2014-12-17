<?php
class ConferenceParticipant extends Eloquent {

	protected $table = 'conference_participant';

	protected $fillable = array('ConfId','UserId');

	protected $guarded = array('CreatedBy','DateCreated');
	
	public $timestamps = false;


	public function users()
	{
		return $this->hasMany('User','UserId','userid');
	}
	
}
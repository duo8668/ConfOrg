<?php
class ConferenceParticipant extends Eloquent {

	protected $table = 'conference_participant';

	protected $fillable = array('ConfId','UserId');

	protected $guarded = array('CreatedBy','DateCreated');
	
	public $timestamps = false;

	public function OutStandingAmount()
	{
		return this->OutStandingAmount($ConfId);
	}

	public function ConferenceBill(){
		return ConferenceBill::where('ConfId','=',this->$ConfId)
		->where('UserId','=',this->$UserId)
		->get();
	}

}
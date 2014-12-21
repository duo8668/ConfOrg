<?php 

class ConferenceVenue extends Eloquent {

	protected $table = 'conference_venue';
	
	protected $fillable = array('ConfId','UserId');

	protected $guarded = array('BillId','DateCreated');
	
	public $timestamps = false;
	
}
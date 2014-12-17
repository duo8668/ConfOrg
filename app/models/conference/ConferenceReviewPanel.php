<?php
class ConferenceReviewPanel extends Eloquent {

	protected $table = 'conference_reviewpanel';
	
	protected $fillable = array('ConfId','UserId');

	protected $guarded = array('BillId','DateCreated');
	
	public $timestamps = false;
	
}
<?php

class ConferenceReviewPanel extends Eloquent {

	protected $table = 'conference_reviewpanel';
	
	protected $fillable = array('ConfId','UserId','CreatedBy');

	protected $guarded = array('CC_Id','DateCreated');
	
	public $timestamps = false;
	
}
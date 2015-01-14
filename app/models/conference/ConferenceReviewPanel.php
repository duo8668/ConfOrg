<?php

class ConferenceReviewPanel extends Eloquent {

	protected $table = 'conference_reviewpanel';
	
	protected $fillable = array('conf_id','user_id','created_by','modified_by');

	protected $guarded = array('conferencereviewpanel_id');
	
	public $timestamps = true;

	
	
}
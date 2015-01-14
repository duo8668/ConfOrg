<?php 

class ConferenceEntertainment extends Eloquent {

	protected $table = 'user_bill';

	protected $fillable = array('conf_id','entertainment_id','remarks','created_by','modified_by');

	protected $guarded = array('conference_entertainment_id');
	
	public $timestamps = true;

	
}
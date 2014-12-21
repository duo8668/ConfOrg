<?php 

class ConferenceType extends Eloquent {

	protected $table = 'conferencetype';
	
	protected $fillable = array('ConferenceType','IsEnabled','CreatedBy');

	protected $guarded = array('ConfTypeId','DateCreated');
	
	public $timestamps = false;
	
}
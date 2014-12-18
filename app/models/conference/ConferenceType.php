<?php
class ConferenceType extends Eloquent {

	protected $table = 'conferencetype';
	
	protected $fillable = array('IsEnabled','CreatedBy');

	protected $guarded = array('ConferenceType','DateCreated');
	
	public $timestamps = false;
	
}
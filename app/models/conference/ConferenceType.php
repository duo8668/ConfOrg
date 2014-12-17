<?php
class ConferenceType extends Eloquent {

	protected $table = 'conferencetype';
	
	protected $fillable = array('ConfId','UserId');

	protected $guarded = array('BillId','DateCreated');
	
	public $timestamps = false;
	
}
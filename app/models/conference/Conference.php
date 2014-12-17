<?php
class Conference extends Eloquent {

	protected $table = 'conference';

	protected $fillable = array('Title', 'ConferenceType', 'Description','BeginDate','BeginTime','EndDate','EndTime','IsFree','Speaker','CreatedBy');

	protected $guarded = array('ConfId','DateCreated');
	
	public $timestamps = false;

	

}
<?php 

class InterestField extends Eloquent {

	protected $table = 'interest_field';
	
	protected $fillable = array('Name','Remarks','CreatedBy');

	protected $guarded = array('FieldId','DateCreated');
	
	public $timestamps = false;
	
}

<?php 

class InterestField extends Eloquent {

	protected $table = 'interest_field';
	
	protected $fillable = array('name','remarks','created_by','modified_by');

	protected $guarded = array('interestfield_id');
	
	public $timestamps = true;
	 
}
<?php 

class PaymentType extends Eloquent {

	protected $table = 'paymenttype';
	
	protected $fillable = array('name','is_enabled','created_by','modified_by');

	protected $guarded = array('paymenttype_id');
	
	public $timestamps = true;
	
}
<?php 

class PaymentType extends Eloquent {

	protected $table = 'paymenttype';
	
	protected $fillable = array('PaymentType','IsEnabled','CreatedBy');

	protected $guarded = array('PaymentId','DateCreated');
	
	public $timestamps = false;
	
}
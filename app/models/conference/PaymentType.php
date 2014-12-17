<?php
class PaymentType extends Eloquent {

	protected $table = 'paymenttype';
	
	protected $fillable = array('ConfId','UserId');

	protected $guarded = array('BillId','DateCreated');
	
	public $timestamps = false;
	
}
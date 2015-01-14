<?php 

class PaymentCreditCard extends Eloquent {

	protected $table = 'payment_creditcard';
	
	protected $fillable = array('user_id','bill_id','amount_paid','created_by','modified_by');

	protected $guarded = array('transaction_id','date_paid');
	
	public $timestamps = true;
	
}
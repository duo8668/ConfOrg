<?php 

class PaymentCash extends Eloquent {

	protected $table = 'payment_cash';
	
	protected $fillable = array('UserId','BillId','AmountPaid');

	protected $guarded = array('TransactionId','DatePaid');
	
	public $timestamps = false;
	
}
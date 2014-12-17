<?php
class PaymentCreditCard extends Eloquent {

	protected $table = 'payment_creditcard';
	
	protected $fillable = array('UserId','BillId','CardNumber','AmountPaid');

	protected $guarded = array('TransactionId','DatePaid');
	
	public $timestamps = false;
	
}
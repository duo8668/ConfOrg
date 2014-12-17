<?php
class ConferencePaymentTransaction extends Eloquent {

	protected $table = 'conference_paymenttransaction';
	
	protected $fillable = array('PaymentType','BillId');

	protected $guarded = array('TransactionId','DateCreated');
	
	public $timestamps = false;

	public function ConferenceBill()
	{
		return $this->belongsTo('ConferenceBill','BillId','BillId');
	}
 
	public function PaymentCash()
	{		 
		return $this->hasMany('PaymentCash','BillId','BillId');
	}

	public function PaymentCreditCard()
	{
		return $this->hasMany('PaymentCreditCard','BillId','BillId');
	}

}
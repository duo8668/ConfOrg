<?php
class ConferencePaymentTransaction extends Eloquent {

	protected $table = 'conference_paymenttransaction';
	
	protected $fillable = array('ConfId','UserId','BillId');

	protected $guarded = array('DateCreated');
	
	public $timestamps = false;

	public function ConferenceBill()
	{
		return ConferenceBill::where('ConfId', '=', this->$ConfId)
		->where('UserId', '=', this->$UserId)
		->where('BillId', '=', this->$BillId)
		->first();
		//return $this->belongsTo('User','UserId','userid');
	}

	public function PaymentCash()
	{
		return PaymentCash::where('UserId', '=', this->$UserId)
		->where('BillId', '=', this->$BillId)
		->get();
		//return $this->belongsTo('User','UserId','userid');
	}

	public function PaymentCreditCard()
	{
		return PaymentCash::where('UserId', '=', this->$UserId)
		->where('BillId', '=', this->$BillId)
		->get();
		//return $this->belongsTo('User','UserId','userid');
	}

}
<?php 

class ConferencePaymentTransaction extends Eloquent {

	protected $table = 'conference_paymenttransaction';
	
	protected $fillable = array('PaymentTypeId','BillId','CreatedBy');

	protected $guarded = array('TransactionId','DateCreated');
	
	public $timestamps = false;

	public function ConferenceBill()
	{
		return $this->belongsTo('ConferenceBill','BillId','BillId');
	}

	public function PaymentCash()
	{		 
		return $this->hasOne('PaymentCash','TransactionId','TransactionId');
	}

	public function PaymentCreditCard()
	{
		return $this->hasOne('PaymentCreditCard','TransactionId','TransactionId');
	}

	public function PaidCash(){

		$amount = DB::tables('payment_cash')
		->select(DB::raw('sum(AmountPaid)'))
		->where('BillId','=',this->$BillId);

		return $amount;
	}

	public function PaidCreditCard(){

		$amount = DB::tables('payment_creditcard')
		->select(DB::raw('sum(AmountPaid)'))
		->where('BillId','=',this->$BillId);

		return $amount;
	}

}
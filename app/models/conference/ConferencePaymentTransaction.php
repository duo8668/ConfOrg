<?php 

class ConferencePaymentTransaction extends Eloquent {

	protected $table = 'conference_paymenttransaction';
	
	protected $fillable = array('bill_id','paymenttype_id','created_by','modified_by');

	protected $guarded = array('transaction_id');
	
	public $timestamps = true;

	public function UserBill()
	{
		return $this->where('UserBill','bill_id','bill_id');
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
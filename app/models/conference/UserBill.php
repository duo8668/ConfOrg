<?php 

class UserBill extends Eloquent {

	protected $table = 'user_bill';

	protected $fillable = array('user_id','created_by','modified_by');

	protected $guarded = array('bill_id');
	
	public $timestamps = true;


	public function BillAmount(){

		$amount = DB::tables('bill_component')
		->select(DB::raw('sum(Amount)'))
		->where('BillId','=',this->$BillId);

		return $amount;
	}

	public function PaidAmount(){
		ConferencePaymentTransaction::where('BillId','=',this->$BillId);



		return $totalPaid;
	}

	public function BillComponents(){
		return this->hasMany('BillComponent','BillId','BillId');
	}

	public function PaymentCashs()
	{
		return $this->hasManyThrough('PaymentCash', 'ConferencePaymentTransaction','TransactionId','TransactionId');
	}

	public function PaymentCreditCards()
	{
		return $this->hasManyThrough('PaymentCreditCard', 'ConferencePaymentTransaction','TransactionId','TransactionId');
	}

	public function ConferencePaymentTransactions(){
		return this->hasMany('ConferencePaymentTransaction','BillId','BillId');
	}

}

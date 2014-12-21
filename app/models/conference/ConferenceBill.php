<?php namespace ConfOrg\Model\Conference;
 
class ConferenceBill extends Eloquent {

	protected $table = 'conference_bill';

	protected $fillable = array('ConfId','UserId','BillId');

	protected $guarded = array('DateCreated');
	
	public $timestamps = false;


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



<?php
class ConferenceBill extends Eloquent {

	protected $table = 'conference_bill';

	protected $fillable = array('ConfId','UserId','BillId');

	protected $guarded = array('DateCreated');
	
	public $timestamps = false;


	public function BillAmount(){

		$billComponents = this->hasMany('BillComponent','BillId','BillId');
		$amount=0;
		foreach ($billComponents as $billComp) {
			$amount += $billComp->sum('Amount');
		}

		return $amount;
	}

	public function PaidAmount(){
		$allTransactions = this->hasMany('ConferencePaymentTransaction','BillId','BillId');

		$totalPaid = 0;

		foreach ($allTransactions as $transaction) {
			$totalPaid += $transaction->PaymentCash('Amount');

		}

		return $totalPaid;
	}

	public function BillComponents(){
		return this->hasMany('BillComponent','BillId','BillId');
	}

	public function ConferencePaymentTransactions(){
		return this->hasMany('ConferencePaymentTransaction','BillId','BillId');
	}

}
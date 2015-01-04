<?php 

class ConferenceParticipant extends Eloquent {

	protected $table = 'conference_participant';

	protected $fillable = array('ConfId','UserId');

	protected $guarded = array('CreatedBy','DateCreated');
	
	public $timestamps = false;

	public function OutStandingAmount()
	{
		


	}

	public function BillComponents(){
		return $this->hasManyThrough('BillComponent','ConferenceBill','confId','BillId');
	}

	public function CashPayments(){
		return $this>ConferenceBill()->hasMany('PaymentCash','BillId');
	}

	public function CreditCardPayments(){
		return $this->ConferenceBill()->hasMany('PaymentCreditCard','BillId');
	}
 
	public function Conference(){

		return $this->belongsTo('Conference', 'ConfId', 'ConfId');
	}

	public function ConferenceBill(){
		return ConferenceBill::where('ConfId','=',$this->$ConfId)
		->where('UserId','=', $this->$UserId)
		->get();
	}

}
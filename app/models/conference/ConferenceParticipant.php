<?php
class ConferenceParticipant extends Eloquent {

	protected $table = 'conference_participant';

	protected $fillable = array('ConfId','UserId');

	protected $guarded = array('CreatedBy','DateCreated');
	
	public $timestamps = false;

	public function OutStandingAmount()
	{
		return this->OutStandingAmount($ConfId);
	}

	public function OutStandingAmount($_confId)
	{
		$confBills = ConferenceBill::where('ConfId','=',$_confId)
		->where('UserId','=',$UserId);

		$outstanding = ($confBills->BillComponents()
			->sum('Amount')
			)
		- (
			ConferencePaymentTransaction::PaymentCashs()
			->whereIn('BillId',$bills->toArray())
			->sum('AmountPaid')
			)
		- (
			ConferencePaymentTransaction::PaymentCreditCards()
			->whereIn('BillId',$bills->toArray())
			->sum('AmountPaid')
			)
		;

		return $outstanding;

	} 

}
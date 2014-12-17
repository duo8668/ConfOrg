

<?php
class ConferenceBill extends Eloquent {

	protected $table = 'conference_bill';

	protected $fillable = array('ConfId','UserId');

	protected $guarded = array('BillId','DateCreated');
	
	public $timestamps = false;
}
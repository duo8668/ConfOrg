<?php

class Payment extends Eloquent {	
	
	protected $primaryKey = 'payment_id';
	protected $table = 'payment';

	protected $fillable = array('invoice_id', 'amount', 'payment_type');

	public function invoice(){
		return $this->belongsTo('Payment', 'invoice_id','invoice_id');
	}	
}
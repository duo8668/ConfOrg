<?php

class Invoice extends Eloquent {	
	
	protected $primaryKey = 'invoice_id';
	protected $table = 'invoice';

	protected $fillable = array('user_id', 'conf_id', 'quantity', 'price','created_by','total','status');

	public function payments(){
		return $this->hasmany('Payment', 'invoice_id','invoice_id');
	}

	public function conference() {
		return $this->belongsTo('Conference','conf_id');
	}

	public function user() {
		return $this->belongsTo('User','user_id');
	}
}


 
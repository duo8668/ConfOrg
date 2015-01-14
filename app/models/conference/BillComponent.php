<?php 

class BillComponent extends Eloquent {

	protected $table = 'bill_component';

	protected $fillable = array('bill_id', 'billcomponenttype_id', 'description', 'amount');

	protected $guarded = array('billcomponent_id');

	public $timestamps = true;


}
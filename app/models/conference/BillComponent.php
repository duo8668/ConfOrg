<?php 

class BillComponent extends Eloquent {

	protected $table = 'bill_component';

	protected $fillable = array('BillId', 'ComponentTypeId', 'ComponentDescription', 'Amount');

	protected $guarded = array('ComponentId', 'DateCreated');

	public $timestamps = false;


}
<?php
class BillComponent extends Eloquent {

	protected $table = 'bill_component';

	protected $fillable = array('BillId', 'ComponentType', 'ComponentDescription');

	protected $guarded = array('ComponentId', 'DateCreated', 'Amount');

	public $timestamps = false;


}
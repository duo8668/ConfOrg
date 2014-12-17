<?php
class ConferenceEquipmentRequest extends Eloquent {

	protected $table = 'conference_equipmentrequest';
	
	protected $fillable = array('ConfId','Requestor','EquipmentCatId','EquipmentId','Qty');

	protected $guarded = array('DateCreated');
	
	public $timestamps = false;
	
}
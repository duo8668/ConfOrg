<?php 

class ConferenceEquipmentRequest extends Eloquent {

	protected $table = 'conference_equipmentrequest';
	
	protected $fillable = array('conf_id','requestor_id','equipmentcat_id','equipment_id','quantity','created_by','modified_by');

	protected $guarded = array('conferenceequipmentrequest_id');
	
	public $timestamps = true;
	
}
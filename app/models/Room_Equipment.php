<?php

class Room_Equipment extends Eloquent {	

	public $timestamps = false;	

	protected $primaryKey = 'roomEquipment_ID';
	protected $table = 'room_equipment';

	protected $fillable = array('Room_ID', 'Equipment_ID');

	public function equipmentcategory(){
		return $this->belongsTo('equipmentcategory');
	}

	public function rooms(){
		return $this->belongsToMany('Room', 'Room_Equipment', 'equipment_ID', 'room_ID');
	}
}

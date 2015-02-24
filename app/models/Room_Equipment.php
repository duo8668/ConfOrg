<?php

class Room_Equipment extends Eloquent {		

	protected $primaryKey = 'roomEquipment_id';
	protected $table = 'room_equipment';

	protected $fillable = array('Room_id', 'Equipment_id');

	public function equipmentcategory(){
		return $this->belongsTo('equipmentcategory');
	}

	public function rooms(){
		return $this->belongsToMany('Room', 'Room_Equipment', 'equipment_id', 'room_id');
	}
}

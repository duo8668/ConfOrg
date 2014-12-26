<?php

class Equipment extends Eloquent {	

	public $timestamps = false;	

	protected $primaryKey = 'ID';
	protected $table = 'equipment';

	protected $fillable = array('EquipmentName', 'EquipmentRemarks', 'CategoryID', 'RentalCost');

	public function category(){
		return $this->belongsTo('Category');
	}

	public function rooms(){
		return $this->belongsToMany('Room', 'Rooms_Equipment', 'equipment_id', 'room_id');
	}
}

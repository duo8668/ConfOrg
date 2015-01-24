<?php

class Equipment extends Eloquent {	

	public $timestamps = false;	

	protected $primaryKey = 'equipment_id';
	protected $table = 'equipment';

	protected $fillable = array('equipment_name', 'equipment_remark', 'equipmentcategory_id', 'rental_cost');

	public function equipmentCategory(){
		return $this->belongsTo('equipmentCategory', 'equipmentcategory_id','equipmentcategory_id');
		//return $this->hasone('Category','equipmentcategory_ID')->select(['equipment_ID', 'equipmentName']);
	}

	public function rooms(){
		return $this->belongsToMany('Room', 'Room_Equipment', 'equipment_id', 'room_id')->withPivot('quantity');	
	}
}

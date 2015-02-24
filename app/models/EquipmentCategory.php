<?php

class EquipmentCategory extends Eloquent {	

	protected $primaryKey = 'equipmentcategory_id';
	protected $table = 'equipment_category';

	protected $fillable = array('equipmentcategory_name', 'status');

	public function equipments(){
		return $this->hasmany('Equipment', 'equipmentcategory_id','equipmentcategory_id');
	}

	// public function category(){
	// 	return $this->belongsTo('Category', 'categoryID');
	// }
}

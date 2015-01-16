<?php

class EquipmentCategory extends Eloquent {	

	public $timestamps = false;	
	protected $primaryKey = 'equipmentcategory_id';
	protected $table = 'equipment_category';

	protected $fillable = array('equipmentcategory_name', 'equipmentcategory_remark');

	public function equipments(){
		return $this->hasmany('Equipment', 'equipmentcategory_id','equipmentcategory_id');
	}

	// public function category(){
	// 	return $this->belongsTo('Category', 'categoryID');
	// }
}

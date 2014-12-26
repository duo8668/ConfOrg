<?php

class Equipment extends Eloquent {	

	public $timestamps = false;	

	protected $primaryKey = 'ID';
	protected $table = 'equipment';

	protected $fillable = array('EquipmentName', 'EquipmentRemarks', 'CategoryID', 'RentalCost');

	public function category(){
		return $this->belongsTo('Category');
	}

	public function equipmentCategory()
	{

	}
}

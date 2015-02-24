<?php

class Pending extends Eloquent {	

	protected $primaryKey = 'pending_id';
	protected $table = 'pending';

	protected $fillable = array('equipmentcategory_name', 'status');

	public function user() {
		return $this->belongsTo('User','user_id');
	}

	public function equipment(){
		return $this->belongsTo('Equipment', 'equipment_id');
	}
	//start with this
	public function equipmentcategory(){
		return $this->belongsTo('EquipmentCategory', 'equipmentcategory_id');
	}

	public function room(){
		return $this->belongsTo('Room','room_id');
	}

	public function venue(){
		return $this->belongsTo('Venue','venue_id');
	}

	// public function category(){
	// 	return $this->belongsTo('Category', 'categoryID');
	// }
}

// CREATE TABLE `pending` (
//   `pending_id` int(11) NOT NULL AUTO_INCREMENT,
//   `user_id` int(11) Null,
//   `equipment_id` int(11) NULL,
//   `equipmentcategory_id` int(11) Null,  
//   `room_id` int(11) Null,
//   `venue_id` int(11) Null,
//   `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,  
//   `avaliable` int(11) NOT NULL,
//   `modified_by` int(11) DEFAULT NULL,
//   `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
//   `updated_at` datetime DEFAULT NULL,
//   PRIMARY KEY (`pending_id`)
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

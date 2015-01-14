<?php

class Room extends Eloquent {	

	public $timestamps = false;	

	protected $primaryKey = 'room_id';
	protected $table = 'room';

	protected $fillable = array('room_name', 'capacity', 'venue_id');
	
	public function venue(){
		return $this->belongsTo('Venue');
	}


	public function equipments(){
		return $this->belongsToMany('Equipment', 'room_equipment', 'room_id', 'equipment_id');	
	}


}
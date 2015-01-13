<?php

class Room extends Eloquent {	

	public $timestamps = false;	

	protected $primaryKey = 'room_ID';
	protected $table = 'room';

	protected $fillable = array('RoomName', 'Capacity', 'Venue_ID');
	
	public function venue(){
		return $this->belongsTo('Venue');
	}


	public function equipments(){
		return $this->belongsToMany('Equipment', 'Room_Equipment', 'room_ID', 'equipment_id');	
	}


}
<?php

class Room extends Eloquent {	

	public $timestamps = false;	

	protected $primaryKey = 'ID';
	protected $table = 'room';

	protected $fillable = array('RoomName', 'Capacity', 'Venue_ID');
	
	public function venue(){
		return $this->belongsTo('Venue');
	}


	public function equipments(){
		return $this->belongsToMany('Equipment', 'Rooms_Equipment', 'room_id', 'equipment_id');	
	}


}
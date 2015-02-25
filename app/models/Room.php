<?php

class Room extends Eloquent {	

	protected $table = 'room';
	protected $primaryKey = 'room_id';
	protected $fillable = array('room_name', 'capacity', 'venue_id', 'available');
	protected $guarded = array('room_id');

	public function Venue(){
		// return $this->belongsTo('Venue','venue_id','venue_id');
		return Venue::where('venue_id','=',$this->venue_id)->first();
	}

	public function Equipments(){
		return $this->belongsToMany('Equipment', 'room_equipment', 'room_id', 'equipment_id')->withPivot('quantity','roomequipment_id');	
	}

	public function Pending(){	
		return $this->belongsTo('Pending','room_id','room_id');
	}

	public function Venues(){
		return $this->belongsTo('Venue','venue_id','venue_id');
	}

}
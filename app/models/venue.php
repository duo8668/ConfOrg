<?php

class Venue extends Eloquent {	

	 
	protected $table = 'venue';
	protected $fillable = array('venue_id','name', 'venue_address', 'latitude', 'longtitude');
	

	public function Rooms(){
		return $this->hasMany('Room');
	}

	
}

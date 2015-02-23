<?php

class Venue extends Eloquent {	

	 
	protected $table = 'venue';
	protected $primaryKey = 'venue_id';
	protected $fillable = array('venue_id','venue_name', 'venue_address', 'latitude', 'longtitude','company_id','available');
	

	public function Rooms(){
		return $this->hasMany('Room','venue_id','venue_id');
	}
}

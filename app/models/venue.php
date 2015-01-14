<?php

class Venue extends Eloquent {	

	public $timestamps = false;	
	protected $primaryKey = 'venue_id';
	protected $table = 'venue';

	public function room(){
		return $this->hasMany('Room');
	}

	protected $fillable = array('venue_name', 'venue_address', 'latitude', 'longtitude');
}

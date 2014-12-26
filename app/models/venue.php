<?php

class Venue extends Eloquent {	

	public $timestamps = false;	
	protected $primaryKey = 'ID';
	protected $table = 'venue';

	public function room(){
		return $this->hasMany('Room');
	}

	protected $fillable = array('Name', 'Address', 'Latitude', 'Longtitude');
}

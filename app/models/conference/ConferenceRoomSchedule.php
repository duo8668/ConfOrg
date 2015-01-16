<?php 

class ConferenceRoomSchedule extends Eloquent {

	protected $table = 'conference_room_schedule';
	
	protected $fillable = array('conf_id','room_id','description','date_start','date_end','begin_time','end_time','remarks','created_by','modified_by');

	protected $guarded = array('confroomschedule_id');
	
	public $timestamps = true;

	
	public  function Room()
	{
		return $this->belongsTo('Room', 'room_id', 'room_id');
	}

	public  function Conference()
	{
		return $this->belongsTo('Conference', 'conf_id', 'conf_id');
	}

}

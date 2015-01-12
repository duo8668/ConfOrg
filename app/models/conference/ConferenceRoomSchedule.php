<?php 

class ConferenceRoomSchedule extends Eloquent {

	protected $table = 'conference_room_schedule';
	
	protected $fillable = array('conf_id','room_id','Description','DateStart','DateEnd','BeginTime','EndTime','Remarks','CreatedBy');

	protected $guarded = array('conf_room_schedule_id','DateCreated');
	
	public $timestamps = false;

	
	public  function Room()
	{
		return $this->hasOne('Room', 'room_id', 'room_id');
	}
}
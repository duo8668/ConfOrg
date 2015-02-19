<?php

class ConferenceScheduleEvent extends Eloquent {

    protected $table = 'conference_schedule_event';
    protected $fillable = array('conference_room_schedule_id', 'submission_id', 'title', 'day', 'start', 'end', 'className');
    protected $guarded = array('conference_schedule_event_id');
    public $timestamps = false;

    public function ConferenceRoomSchedule() {
        $thisConferenceRoomSchedule = ConferenceRoomSchedule::where('confroomschedule_id', '=', $this->conference_room_schedule_id)->get();
        
        if(!empty($thisConferenceRoomSchedule)){
            return $thisConferenceRoomSchedule->first();
        }
        return NULL;
    }

}

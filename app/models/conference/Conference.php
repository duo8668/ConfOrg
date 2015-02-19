<?php

class Conference extends Eloquent {

    protected $table = 'conference';
    protected $fillable = array('title', 'description', 'begin_date', 'begin_time', 'end_date', 'end_time', 'is_free', 'cutoff_time', 'min_score', 'created_by', 'modified_by');
    protected $guarded = array('conf_id');
    protected $primaryKey = 'conf_id';
    public $timestamps = true;

    public function scopeConferenceParticipants($query) {
        $thisConferenceUserRoles = ConferenceUserRole::where('conf_id', '=', $this->conf_id)
        ->where('role_id', '=', Role::Participant())
        ->get();

        if (!empty($thisConferenceUserRoles)) {
            return $thisConferenceUserRoles;
        }
        return NULL;
    }

    public function scopeConferenceStaffs($query) {
        $thisConferenceUserRoles = ConferenceUserRole::where('conf_id', '=', $this->conf_id)
        ->where('role_id', '=', Role::ConferenceStaff())
        ->get();

        if (!empty($thisConferenceUserRoles)) {
            return $thisConferenceUserRoles;
        }
        return NULL;
    }

    public function scopeConferenceUserRole($query) {
        $loggedInUserId = Auth::user()->user_id;
        $thisConferenceUserRole = ConferenceUserRole::where('conf_id', '=', $this->conf_id)
        ->where('user_id', '=', $loggedInUserId)
        ->get();


        if (!empty($thisConferenceUserRole)) {
            return $thisConferenceUserRole->first();
        }
        return NULL;
    } 

    public function ConferenceSubmissions(){
        return $this->hasMany('Submission', 'conf_id', 'conf_id');
    }

    public function RoomSchedule(){
        $roomSchedule = ConferenceRoomSchedule::where('conf_id' ,'=', $this->conf_id)->get();
        if (!empty($roomSchedule)) {
            return $roomSchedule->first();
        }
        return NULL;
    }

    public function scopeConferenceRoomSchedule($query) {
        $thisConferenceRoomSchedule = ConferenceRoomSchedule::where('conf_id', '=', $this->conf_id);
        if (!empty($thisConferenceRoomSchedule)) {
            return $thisConferenceRoomSchedule->first();
        }
        return NULL;
    }

    public function ConferenceTopic() {
        return $this->hasMany('ConferenceTopic', 'conf_id', 'conf_id');
    }

    public function Room() {
        $roomSchedule = ConferenceRoomSchedule::where('conf_id', '=', $this->conf_id)->first();

        $rooms = Room::where('room_id', '=', $roomSchedule->room_id)->get();
        if (!empty($rooms)) {
            return $rooms->first();
        }

        return null;
    }

    public function getStatusInConference() {

        $confUserRole = $this
        ->ConferenceUserRoles()
        ->where('user_id', '=', Auth::user()->user_id)
        ->first();

        if ($confUserRole == null) {
            // mean this person has not participant yet
            return 'Not Participating';
        } else {
            return $confUserRole->Role->rolename;
        }
    }

}

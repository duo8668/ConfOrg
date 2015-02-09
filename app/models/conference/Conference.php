<?php  

class Conference extends Eloquent {

	protected $table = 'conference';

	protected $fillable = array('title', 'description','begin_date','begin_time','end_date','end_time','is_free','cutoff_time','min_score','created_by','modified_by');

	protected $guarded = array('conf_id');
	
	protected $primaryKey = 'conf_id';
	
	public $timestamps = true;

	public function ConferenceParticipants(){
		return $this->hasMany('ConferenceParticipant', 'ConfId', 'conf_id');
	}

	public function ConferenceUserRoles(){
		return $this->hasMany('ConferenceUserRole', 'conf_id', 'conf_id');
	}
	
	public function ConferenceRoomSchedule(){
		return $this->hasOne('ConferenceRoomSchedule', 'conf_id', 'conf_id');
	}

	public function ConferenceTopic(){
		return $this->hasMany('ConferenceTopic', 'conf_id', 'conf_id');
	}

	public function Room(){
		$roomSchedule = ConferenceRoomSchedule::where('conf_id' ,'=', $this->conf_id)->first();

		$rooms = Room::where('room_id','=',$roomSchedule->room_id)->get();
		if($rooms !=null){
			return $rooms->first();
		}

		return null;
	}
	
	public function getStatusInConference(){ 

		$confUserRole = $this
		->ConferenceUserRoles()
		->where('user_id','=',Auth::user()->user_id)
		->first();
		
		//dd(DB::getQueryLog());
		if($confUserRole == null){
			// mean this person has not participant yet
			return 'Not Participating';
		}else{
			return $confUserRole->Role->rolename;
		}
	}
	
}
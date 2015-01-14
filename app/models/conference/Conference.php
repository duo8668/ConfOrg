<?php  

class Conference extends Eloquent {

	protected $table = 'conference';

	protected $fillable = array('title', 'description','begin_date','begin_time','end_date','end_time','is_free','created_by','modified_by');

	protected $guarded = array('conf_id');
	
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
	
	public function getStatusInConference(){

		//$user = User::where('user_id','=',1)->first();
		//Auth::login($user);
		//dd(Auth::user()->user_id);

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
<?php  

class Conference extends Eloquent {

	protected $table = 'conference';

	protected $fillable = array('Title', 'Description','BeginDate','BeginTime','EndDate','EndTime','IsFree','Speaker','CreatedBy');

	protected $guarded = array('conf_id','DateCreated');
	
	public $timestamps = false;

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
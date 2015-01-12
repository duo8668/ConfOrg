<?php

class ConferenceController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| ConferenceController
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		$confs = Conference::where('beginDate','>',DB::raw('curdate()'))
		->get();

		$view = View::make('conference.index',array('confs'=>$confs)); 

		return $view;
	}

	public function create()
	{
		$user = User::where('user_id','=',1)->first();
		Auth::login($user);

		$fields=InterestField::lists('Name', 'FieldId');

		$view = View::make('conference.management.create',array('fields'=>$fields)); 

		return $view;
	}

	public function register()
	{
		//
		$selectedConfId = $this->ValidateConference();

		if($selectedConfId == -9999){
			return 'NOT OK';
		}else{
			$conf=Conference::where('confId','=',$selectedConfId) 
			->first();

			if($conf == null){
				return 'NOT OK';
			}else{

				// confId isvalid, check if the person already participated
				if(User::IsInRole('',$selectedConfId)){
					return 'NOT OK';
				}else{

					// the user has not been participated
					try{
						$confUserRole = ConferenceUserRole::create(array('role_id' => $roleId,'user_id'=> Auth::user()->user_id,'conf_id'=>$confId));
					}catch(Exception $ex)
					{
						throw $ex;
					}
					return $confUserRole;
				}
			}

			return $selectedConfId;
		}

		return 'OK';
	}

	public function theConf()
	{
		$selectedConfId = $this->ValidateConference();

		$conf=Conference::where('confId','=',$selectedConfId) 
		->first();

		$view = View::make('conference.confview',array('selectedConfId'=>$selectedConfId,'conf'=>$conf)); 

		return $view;
	}

	public function ValidateConference(){
		//conf_id_col_\d+$

		$subject = Input::get('subject');

		$pattern = '/'.'^conf_id_col_(?P<confId>\d+)$'.'/';

		$matching = preg_match($pattern, $subject, $output_array);

		if($matching){

			return intval($output_array["confId"]);

		}else{
			return -9999;
		}
	}

	public function conferenceEvents($begin,$end)
	{
		$confs = Conference::where('BeginTime','>=',  $begin)
		->where('EndTime','<=',  $end)
		//->get()
		->select(DB::raw('conf_id as id ,title as title ,DATE_FORMAT(BeginTime, "%Y-%m-%d") as start ,DATE_FORMAT(EndTime,"%Y-%m-%d") as end'))
		->get();

		//dd($confs[1]);
		//dd(DB::getQueryLog());

		$output_arrays = array();
		$timezone = new DateTimeZone('UTC');
		$range_start = DateUtility::parseDateTime($begin);
		$range_end =  DateUtility::parseDateTime($end);

		foreach ($confs as $array) {

			// Convert the input array into a useful Event object
			$event = new CalendarEvent($array, $timezone);

			// If the event is in-bounds, add it to the output
			if ($event->isWithinDayRange($range_start, $range_end)) {
				$event->editable = false;
				$event->end = $event->end->add(new DateInterval('P1D'));
				$output_arrays[] = $event->toArray();
			}
		}

		return $output_arrays;
	}

	public function allRoomSchedules(){
		$confRoomSchedule = ConferenceRoomSchedule::where('room_id','=',Input::get('roomId'))
		->select(DB::raw('DATE_FORMAT(BeginTime, "%Y-%m-%d") as start ,DATE_FORMAT(EndTime,"%Y-%m-%d") as end'))
		->get();

		return $confRoomSchedule;
	}

	public function createConference()
	{
		$conf= null;
		
		if(Auth::check()){
			
			$confTitle = Input::get('conferenceTitle');
			$confType = Input::get('confType'); 
			$confDesc = Input::get('confDesc');
			$isFree = Input::get('isFree') === 'true'? true: false;
			$beginDate = Input::get('beginDate');
			$endDate = Input::get('endDate'); 

			try
			{ 
				if(strlen($confTitle)>6 && Utility::checkPositiveInteger($confType) && strlen($confDesc)>0 && Utility::checkIsAValidDate($beginDate) && Utility::checkIsAValidDate($endDate) && is_bool($isFree)){

					$conf = Conference::create(array('Title' => $confTitle
						,'Description' => $confDesc
						,'BeginDate' => date("Y-m-d", strtotime($beginDate)) 
						,'BeginTime' => date("Y-m-d", strtotime($beginDate)) 
						,'EndDate' => date("Y-m-d", strtotime($endDate)) 
						,'EndTime' => date("Y-m-d", strtotime($endDate)) 
						,'IsFree' => $isFree
						,'Speaker' => -1
						,'CreatedBy' => Auth::user()->user_id));
				}
			}
			catch(Exception $ex)
			{
				dd($ex);

				throw $ex;
			}

		}else{
			return 'Not LoggedIn';
		}

		return $conf;
	}

	public function checkConferenceTitle(){

		$confTitle = trim(Input::get('confTitle'));

		$conf = Conference::where('Title','=',$confTitle)->first();

		if($conf==null){
			return 'true';
		}else{
			return 'The Conference Title exists in database !';
		}
	}



}
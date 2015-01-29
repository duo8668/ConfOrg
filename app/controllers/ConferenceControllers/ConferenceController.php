<?php

use Illuminate\Support\MessageBag;

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
		$confs = Conference::where('begin_date','>',DB::raw('curdate()'))
		->get();

		$view = View::make('conference.index',array('confs'=>$confs)); 

		return $view;
	}

	public function create()
	{
		$user = User::where('user_id','=',1)->first();
		Auth::login($user);

		$fields=InterestField::select(DB::raw('interestfield_id as id, name as label'))
		->get();

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

		$conf=Conference::where('conf_id','=',$selectedConfId) 
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

	public function manage()
	{
		$user = User::where('user_id','=',1)->first();
		Auth::login($user);

		$fields=InterestField::select(DB::raw('interestfield_id as id, name as label'))
		->get();

		$conf = Conference::where('conf_id','=',Input::get('conf_id'))->first();

		$view = View::make('conference.management.manage',array('fields'=>$fields,'conf' =>$conf)); 

		return $view;
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

	public function createConference()
	{
		$conf= null;
		
		$data = [
		'conferenceTitle' => Input::get('conferenceTitle'),
		'chkField' => Input::get('chkField'),
		'beginDate' => date("Y-m-d", strtotime(Input::get('beginDate'))),
		'endDate' => date("Y-m-d", strtotime(Input::get('endDate'))),
		'maxSeats' => Input::get('maxSeats'),
		'venue' => Input::get('venue'),
		'chkIsFree' => Input::get('chkIsFree') === 'true'? true: false
		];

		$rules = [
		'conferenceTitle' => 'required|unique:conference,title|min:6',
		'chkField'=>'required|array',
		'beginDate'=>'required|date|before:endDate',
		'endDate'=>'required|date|after:beginDate',
		'maxSeats'=>'required|numeric',
		'venue'=>'required|numeric',
		'chkIsFree'=>'boolean'
		];

		$validator = Validator::make($data, $rules);

		if(Auth::check()){
			if($validator->fails()){

				return array('invalidFields'=>$validator->errors()); 

			}else{
				//$isFree = $data['chkIsFree'] === 'true'? true: false;		 

				try
				{  
					$result = DB::transaction(function() use ($data)
					{ 
						$createdConf = Conference::create(array('title' => $data['conferenceTitle']
							,'begin_date' => $data['beginDate']
							,'end_date' => $data['endDate']
							,'is_free' => $data['chkIsFree']
							,'created_by' => Auth::user()->user_id));

						$confRoom = ConferenceRoomSchedule::create(
							array('conf_id' => $createdConf->conf_id
								,'room_id' => $data['venue']
								,'date_start' => $data['beginDate']
								,'date_end' => $data['endDate']
								,'created_by' => Auth::user()->user_id)
							);

						return array('createdConf'=>$createdConf,'confRoom'=>$confRoom);
					});					

				}
				catch(Exception $ex)
				{					 
					throw $ex;
				}
			}
		}

		return array('success'=>$result);
	}

	public function validateCreateConference(){

		$confTitle = trim(Input::get('conferenceTitle'));

		$conf = Conference::where('Title','=',$confTitle)->first();

		return	json_encode(array('valid' => ($conf==null)));

	}



}
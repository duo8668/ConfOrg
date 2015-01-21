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
		/*
		$arrayField ="";

		foreach ($fields as &$field) {
			dd(json_encode($fields));
			$arrayField += json_encode($field)+",";
		}

		$arrayField = "["+rtrim($arrayField,',') + "]";
 */ 
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

	public function createConference()
	{
		$conf= null;
		
		$data = [
		'conferenceTitle' => Input::get('conferenceTitle'),
		'chkField' => Input::get('chkField'),
		'beginDate' => Input::get('beginDate'),
		'endDate' => Input::get('endDate'),
		'maxSeats' => Input::get('maxSeats'),
		'ddlVenue' => Input::get('ddlVenue'),
		'chkIsFree' => Input::get('chkIsFree')
		];

		$rules = [
		'conferenceTitle' => 'required|unique:conference,title|min:6',
		'chkField'=>'required|array',
		'beginDate'=>'required|date|before:endDate',
		'endDate'=>'required|date|after:beginDate',
		'maxSeats'=>'required|numeric',
		'ddlVenue'=>'required|numeric',
		'chkIsFree'=>'boolean'
		];

		$validator = Validator::make($data, $rules);
 
		if(Auth::check()){
			if($validator->fails()){

				return $validator->errors(); 

			}else{
				$isFree = $data['chkIsFree'] === 'true'? true: false;		 

				try
				{  
					$conf = Conference::create(array('title' => $data['title']
						,'description' => Input::get('confDesc')
						,'begin_date' => date("Y-m-d", strtotime($data['beginDate']))
						,'end_date' => date("Y-m-d", strtotime($data['endDate'])) 
						,'is_free' => $isFree
						,'created_by' => Auth::user()->user_id));

				}
				catch(Exception $ex)
				{					 
					throw $ex;
				}
			}
		}

		return $conf;
	}

	public function validateCreateConference(){

		$confTitle = trim(Input::get('conferenceTitle'));

		$conf = Conference::where('Title','=',$confTitle)->first();

		return	json_encode(array('valid' => ($conf==null)));

	}



}
<?php

use Illuminate\Support\MessageBag;

class ConferenceController extends \BaseController {

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

	public function detail()
	{ 
		$fields=InterestField::select(DB::raw('interestfield_id as id, name as label'))
		->get();

		$confChairUsers = ConferenceUserRole::ConferenceChair(Input::get('conf_id'))->toArray();

		$allStaffs = ConferenceUserRole::ConferenceStaffs(Input::get('conf_id'))->toArray();

		$reviewPanels = ConferenceUserRole::ConferenceReviewPanels(Input::get('conf_id'))->toArray();

		$conf = Conference::where('conf_id','=',Input::get('conf_id'))->first();

		$view = View::make('conference.detail',array('fields'=>$fields,'conf' =>$conf,'confChairUsers'=>$confChairUsers,'allStaffs'=>$allStaffs,'reviewPanels'=>$reviewPanels)); 

		// SET SESSION
		Session::put('orafer_conf_id', Input::get('conf_id'));
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
		'cutOffDate' => date("Y-m-d", strtotime(Input::get('cutOffDate'))),
		'minScore' => Input::get('minScore'),
		'venue' => Input::get('venue'),
		'chkIsFree' => Input::get('chkIsFree') === 'true'? true: false
		];

		$rules = [
		'conferenceTitle' => 'required|unique:conference,title|min:6',
		'chkField'=>'required|array',
		'beginDate'=>'required|date|before:endDate',
		'endDate'=>'required|date|after:beginDate',
		'maxSeats'=>'required|numeric',
		'cutOffDate' => 'date',
		'minScore' => 'numeric',
		'venue'=>'required|numeric',
		'chkIsFree'=>'boolean'
		];

		$validator = Validator::make($data, $rules);

		if(Auth::check()){
			if($validator->fails()){

				return array('invalidFields'=>$validator->errors()); 

			}else{

				try
				{  
					$user =Auth::user();

					$result = DB::transaction(function() use ($data,$user)
					{ 

						$role_id = Role::where('rolename','=','conference_chair')->first()->role_id;

						$createdConf = Conference::create(array('title' => $data['conferenceTitle']
							,'begin_date' => $data['beginDate']
							,'end_date' => $data['endDate']
							,'is_free' => $data['chkIsFree']
							,'cutoff_time' => $data['cutOffDate']
							,'min_score' => $data['minScore']
							,'created_by' => $user->user_id));

						$confRoom = ConferenceRoomSchedule::create(
							array('conf_id' => $createdConf->conf_id
								,'room_id' => $data['venue']
								,'date_start' => $data['beginDate']
								,'date_end' => $data['endDate']
								,'created_by' => $user->user_id)
							);

						$confUserRole = ConferenceUserRole::create(array('user_id' => $user->user_id
							,'role_id' => $role_id
							, 'conf_id' => $createdConf->conf_id ));

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

	public function updateDescription()
	{ 
		$data = [ 
		'conf_id' => Input::get('conf_id') 
		];

		$rules = [ 
		'conf_id'=>'required|numeric'
		];

		$validator = Validator::make($data,$rules);

		if(Auth::check()){
			if($validator->fails()){

				return array('invalidFields'=>$validator->errors()); 

			}else{
				try
				{  
					$user =Auth::user();

					$result = DB::transaction(function() use ($data,$user)
					{ 
						$numRowUpdated = Conference::where('conf_id','=',$data['conf_id'])
						->update(array('description'=>Input::get('description')
							,'modified_by' => $user->user_id)); 

						return array('numRowUpdated'=>$numRowUpdated);
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

	public function updateParticulars()
	{ 
		$data = [ 
		'conf_id' => Input::get('conf_id')
		,'cutOffDate' => date("Y-m-d H:i", strtotime(Input::get('cutOffDate')))
		,'minScore' => Input::get('minScore')
		];

		$rules = [ 
		'conf_id'=>'required|numeric'
		,'cutOffDate' => 'date'
		,'minScore' => 'numeric|min:1'
		];

		$validator = Validator::make($data,$rules);

		if(Auth::check()){
			if($validator->fails()){

				return array('invalidFields'=>$validator->errors()); 

			}else{
				try
				{  
					$user =Auth::user();

					$result = DB::transaction(function() use ($data,$user)
					{ 
						$numRowUpdated = Conference::where('conf_id','=',$data['conf_id'])
						->update(array('cutoff_time'=>$data['cutOffDate']
							,'min_score'=>$data['minScore']
							,'modified_by' => $user->user_id));
						$conf = Conference::where('conf_id','=',$data['conf_id'])->first();
						return array('numRowUpdated'=>$numRowUpdated,'conf'=> $conf);
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

	public function updateConfStaffs()
	{ 
		$data = [ 
		'conf_id' => Input::get('conf_id'),
		'emails' => Input::get('emails'),
		];

		$rules = [ 
		'conf_id'=>'required|numeric',
		'emails' =>'array'
		];

		$validator = Validator::make($data,$rules);

		if(Auth::check()){
			if($validator->fails()){

				return array('invalidFields'=>$validator->errors()); 

			}else{
				try
				{  
					$user =Auth::user();
					$originalStaffs = ConferenceUserRole::ConferenceStaffs($data['conf_id']);
					$numRowUpdated =0;
					$result = DB::transaction(function() use ($data,$user,$originalStaffs,$numRowUpdated){
						

						$roleid = Role::ConferenceStaff()->role_id;

						// add all first
						if(!empty($data['emails'] )){
							foreach ($data['emails'] as $email) {

								$targetUser = User::where('email','=',$email)->first();

								if(!empty($targetUser)){ 								 
									if(empty(ConferenceUserRole::where(array('conf_id' =>$data['conf_id']))
										->Where(array('user_id' =>$targetUser->user_id))
										->first())){

										if(!empty(ConferenceUserRole::create(array('conf_id' =>$data['conf_id'], 'role_id' =>$roleid ,'user_id' => $targetUser->user_id,'created_by' => $user->user_id )))){
											$numRowUpdated ++;
										}
									}
								}else{
								// not exists, send invitation to create staff

								}
							}
						}

						// delete not exist
						if(!empty($originalStaffs)){
							if(empty($data['emails'])){
								$data['emails']=array();
							}
							foreach ($originalStaffs as $oristaff) {

								if (!in_array($oristaff->email, $data['emails'], true)) {
									$numRowUpdated += $oristaff->forceDelete();
								} 
							}
						}
						return array('numRowUpdated'=>$numRowUpdated,'conStaffs'=>ConferenceUserRole::ConferenceStaffs($data['conf_id']));
					}); 
}catch(Exception $ex){
	throw $ex;
}
}
}

return array('success'=>$result);
}

public function updateReviewPanels()
{ 
	$data = [ 
	'conf_id' => Input::get('conf_id'),
	'emails' => Input::get('emails'),
	];

	$rules = [ 
	'conf_id'=>'required|numeric',
	'emails' =>'array'
	];

	$validator = Validator::make($data,$rules);

	if(Auth::check()){
		if($validator->fails()){

			return array('invalidFields'=>$validator->errors()); 

		}else{
			try
			{  
				$user =Auth::user();
				$originalRPs = ConferenceUserRole::ConferenceReviewPanels($data['conf_id']);
				$numRowUpdated =0;

				$result = DB::transaction(function() use ($data,$user,$originalRPs,$numRowUpdated)
				{
					$roleid = Role::ReviewPanel()->role_id;

						// add all first
					if(!empty($data['emails'] )){
						foreach ($data['emails'] as $email) {

							$targetUser = User::where('email','=',$email)->first();

							if(!empty($targetUser)){
								// exists, directly assign the staff								 
								if(empty(ConferenceUserRole::where(array('conf_id' =>$data['conf_id']))
									->Where(array('user_id' =>$targetUser->user_id))
									->first())){

									if(!empty(ConferenceUserRole::create(array('conf_id' =>$data['conf_id'], 'role_id' =>$roleid ,'user_id' => $targetUser->user_id,'created_by' => $user->user_id )))){
										$numRowUpdated ++;
									}
								}
							}else{
								// not exists, send invitation to create staff

							}
						}
					}

					// delete not exist
					if(!empty($originalRPs)){
						if(empty($data['emails'])){
							$data['emails']=array();
						}
						foreach ($originalRPs as $oristaff) {

							if (!in_array($oristaff->email, $data['emails'], true)) {
								$numRowUpdated += $oristaff->forceDelete();
							} 
						}

						// return to the $result variable
						return array('numRowUpdated'=>$numRowUpdated,'conStaffs'=>ConferenceUserRole::ConferenceReviewPanels($data['conf_id']));
					}});
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

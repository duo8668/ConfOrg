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

		//dd(DB::getQueryLog());
		//dd($confs);

		$view = View::make('conference.index',array('confs'=>$confs)); 

		return $view;
	}

	public function create()
	{
		$user = User::where('user_id','=',1)->first();
		Auth::login($user);



		$confTypes=ConferenceType::where('IsEnabled','=','1')
		->lists('ConferenceType', 'ConfTypeId');

		$view = View::make('conference.management.create',array('confTypes'=>$confTypes)); 

		return $view;
	}

	public function register()
	{
		/*
		$confs=Conference::where('IsEnabled','=','1')
		->where(DB::raw('beginDate > curdate()'))
		->get();

		$view = View::make('conference.management.create',array('confTypes'=>$confTypes)); 
*/
		return '';
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
		$conf = new Conference();

		$confsCal = $conf->AllJsonConference($begin,$end);

		return $confsCal;
	}

	public function createConference()
	{
		if(Auth::check()){
			$conf= null;
			$confTitle = Input::get('conferenceTitle');
			$confType = Input::get('confType'); 
			$confDesc = Input::get('confDesc');
			$isFree = Input::get('isFree') === 'true'? true: false;
			$beginDate = Input::get('beginDate');
			$endDate = Input::get('endDate'); 

			try
			{ 
				if(strlen($confTitle)>6 &&$this->checkConfType($confType) && strlen($confDesc)>0 && $this->checkIsAValidDate($beginDate) && $this->checkIsAValidDate($endDate) && is_bool($isFree)){

					$conf = Conference::create(array('Title' => $confTitle
						,'ConfTypeId' => intval($confType)
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

		}

		return $conf;
	}

	public function checkConferenceTitle(){

		$confTitle = trim(Input::get('confTitle'));

		$conf = Conference::where('Title','=',$confTitle)->first();

		return ($conf==null)? 'true':'false';
	}

	function checkConfType($vale){

		if(is_numeric($vale)){
			if(intval($vale)>0){
				return true;
			}
		}

		return false;
	}

	function checkIsAValidDate($myDateString){
		return (bool)strtotime($myDateString);
	}

}
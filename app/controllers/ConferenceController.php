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
		try
		{
			//$duplicateTitle  =Conference::where('','','');
			
			$conf = Conference::create(array('Title' => Input::get('conferenceTitle')
				,'ConfTypeId' => Input::get('confType')
				,'Description' => Input::get('conferenceTitle')
				,'BeginDate' => date("Y-m-d", strtotime(Input::get('beginDate'))) 
				,'BeginTime' => date("Y-m-d", strtotime(Input::get('beginDate'))) 
				,'EndDate' => date("Y-m-d", strtotime(Input::get('endDate'))) 
				,'EndTime' => date("Y-m-d", strtotime(Input::get('endDate'))) 
				,'IsFree' => Input::get('isFree')
				,'Speaker' => -1
				,'CreatedBy' => 0 ));
		}
		catch(Exception $ex)
		{
			dd($ex);

			throw $ex;
		}

		return $conf;
	}

}
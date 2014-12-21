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

		$view = View::make('conference.management.index',array('wtf'=>'wtf','wtf2'=>'wtf2')); 

		return $view;
	}

	public function create()
	{
		
		$confTypes=ConferenceType::where('IsEnabled','=','1')->lists('ConferenceType', 'ConfTypeId');
		//$confTypes=ConferenceType::where('IsEnabled','=','1');

		$view = View::make('conference.management.create',array('confTypes'=>$confTypes)); 

		return $view;
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
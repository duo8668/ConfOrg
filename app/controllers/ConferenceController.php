<?php

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
		
		$conferences=Conference::all();

		$view = View::make('conference.management.index',array('wtf'=>'wtf','wtf2'=>'wtf2')); 

		return $view;
	}

	public function create()
	{
		
		$confTypes=ConferenceType::where('IsEnabled','=','1')->lists('ConferenceType', 'ConferenceType');
		//$confTypes=ConferenceType::where('IsEnabled','=','1');

		$view = View::make('conference.management.create',array('confTypes'=>$confTypes)); 

		return $view;
	}


	public function createConference()
	{
		 

		return 'WTH';
	}

}
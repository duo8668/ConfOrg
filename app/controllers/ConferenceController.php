<?php

class ConferenceController extends \BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		
		$conferences=Conference::all();

		$view = View::make('conference.management.index',array('wtf'=>'wtf','wtf2'=>'wtf2')); 

		return $view;
	}

}
<?php
class UtilsController extends \BaseController {

	/*
	|--------------------------------------------------------------------------
	| UtilsController
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function customCalender()
	{ 
		$view = View::make('utils.customcalendar',array('title' =>Input::get('title'))); 

		return $view;
	} 

}
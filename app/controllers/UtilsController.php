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
		$view = View::make('utils.customcalendar'); 

		return $view;
	} 

}
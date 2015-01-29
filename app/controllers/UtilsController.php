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

	public function uploadImage() {

		$file = Input::file('image');
		$input = array('image' => $file);
		$rules = array(
			'image' => 'image'
			);

		$validator = Validator::make($input, $rules);
		if ( $validator->fails())
		{
			return array('success' => false, 'errors' => $validator->getMessageBag()->toArray());

		}
		else {
			$destinationPath = 'uploads/';
			 
			$filename = $file->getClientOriginalName();
			Input::file('image')->move($destinationPath, $filename);
			return array('success' => true, 'file' => URL::to($destinationPath.$filename));
		}

	}
}
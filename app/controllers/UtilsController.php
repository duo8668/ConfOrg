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
			$conf_id = Session::get('util.conference.image.upload');

			if(empty($conf_id)){
				$conf_id ='unknownConfId';
			}

			$destinationPath = 'uploads/'.Auth::user()->email.'/'.$conf_id.'/';
			
			//$filename = $file->getClientOriginalName();
			$filename = hash('md5', $file->getClientOriginalName());;


			Input::file('image')->move($destinationPath, $filename);
			return array('success' => true, 'file' => urldecode(asset($destinationPath.$filename.$file->getClientOriginalExtension())));
		}
	}

	public function registerImageUploadConference() {

		$conf_id = Input::get('conf_id');
		
		if(!empty($conf_id)){
			Session::put('util.conference.image.upload', $conf_id);
		}

		//return com_create_guid();
		return array('success' => true);
		
	}
}
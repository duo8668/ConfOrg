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

	public static function acceptRejectSubs() {
		
		$dt = new DateTime("now", new DateTimeZone('Asia/Singapore'));
		$confs = Conference::where('cutoff_time', '<=', $dt)->get();
		foreach ($confs as $conf) {

			//accept submissions who passed the minimum score
			DB::table('submissions')
            	->where('overall_score', '>=', $conf->min_score)
            	->where('conf_id', '=', $conf->conf_id)
            	->update(array('status' => 1));

            //reject the rest of the submissions
            DB::table('submissions')
            	->where('overall_score', '<', $conf->min_score)
            	->where('conf_id', '=', $conf->conf_id)
            	->update(array('status' => 9));

            $chair_email = DB::table('conference')
            			->join('confuserrole', 'conference.conf_id', '=', 'confuserrole.conf_id')
						->join('users', 'confuserrole.user_id', '=', 'users.user_id')
						->select('users.email')
						->where('confuserrole.role_id', '=', 4)
						->where('conference.conf_id', '=', $conf->conf_id)
						->get();

            Mail::queue('emails.submission.to_chairman',
				array(
					'confname' => $conf->title
					), 
				function($message) use ($chair_email)
				{
					$message->to($chair_email[0]->email)->subject('Conference submissions have been automatically marked as accepted or rejected');
				});
		}
		Log::info($dt->format('Y-m-d H:i:s') . ' acceptRejectSubs');
	}

	public static function checkHasRole($array, $role) {
	    foreach ($array as $item)
        if (isset($item->role_id) && $item->role_id == $role)
            return true;
    return false;
	               
	}

	public static function updateScore($id) {
		$submission = Submission::where('sub_id' , '=', $id)->get()->first();
		$reviews = $submission->reviews()->get();

		$qlty = 0;
		$ori = 0;
		$relv = 0;
		$sigf = 0;
		$pres = 0;
		$recm = 0;
		$count = 0;

		foreach ($reviews as $rev) {
			$qlty += $rev->quality_score;
			$ori += $rev->originality_score;
			$relv += $rev->relevance_score;
			$sigf += $rev->significance_score;
			$pres += $rev->presentation_score;
			$count++;
		}

		$overall = 0;
		if ($count > 0) {
			$overall = ( ($qlty + $ori + $relv + $sigf + $pres) / ($count * 50) ) * 100;
			$submission->overall_score = $overall;
			$submission->save();
		}
			
	}
}
<?php

use Illuminate\Support\MessageBag;

class ConferenceUserRoleController extends \BaseController {

	public function updateConfStaffs() {
		$data = [
		'conf_id' => Input::get('conf_id'),
		'emails' => Input::get('emails'),
		];

		$rules = [
		'conf_id' => 'required|numeric',
		'emails' => 'array'
		];

		$validator = Validator::make($data, $rules);

		if (Auth::check()) {
			if ($validator->fails()) {

				return array('invalidFields' => $validator->errors());
			} else {

				try {
					$user = Auth::user();
					$originalStaffs = ConferenceUserRole::ConferenceStaffs($data['conf_id'])->get();
					$originalPStaffs = InviteToConference::where('conf_id','=', $data['conf_id'])->where('role_id','=',Role::ConferenceStaff()->role_id)->where('is_used','=',0)->get();

                    dd(empty($originalStaffs));
                    $numRowUpdated = 0;
                    $result = DB::transaction(function() use ($data, $user, $originalStaffs, $numRowUpdated) {


                      $roleid = Role::ConferenceStaff()->role_id;

                      // add all first
                      if (!empty($data['emails'])) {
                         foreach ($data['emails'] as $email) {

                            $targetUser = User::where('email', '=', $email)->first();

                            if (!empty($targetUser)) {
                                $conferenceUserRole = new ConferenceUserRole();

                                $conferenceUserRole->conf_id = $data['conf_id'];
                                $conferenceUserRole->role_id = $roleid;
                                $conferenceUserRole->user_id =$targetUser->user_id ;
                                $conferenceUserRole->created_by = Auth::user()->user_id;
                                $saved = $conferenceUserRole->save(); 

                                if (!empty($saved)) {
                                    $numRowUpdated ++;
                                } 
                            } else {
                                $inviteToConference = InviteToConference::where(array('conf_id' => $data['conf_id']))
                                ->Where('email','=', $email)
                                ->first();

                                $sentSaved  = $this->emailForInviteToConference($data['conf_id'],$roleid,$email);

                                if($sentSaved){
                                    $numRowUpdated ++;
                                }
                            }
                        }
                    }

                    // delete not exist in ConfUserRole
                    if (!empty($originalStaffs)) {
                      if (empty($data['emails'])) {
                       $data['emails'] = array();
                   }
                   foreach ($originalStaffs as $oristaff) {

                       if (!in_array($oristaff->email, $data['emails'], true)) {
                        $numRowUpdated += $oristaff->forceDelete();
                    }
                }
            }

            // delete not exist in InviteToConference
            if (!empty($originalPStaffs)) {
              if (empty($data['emails'])) {
               $data['emails'] = array();
           }
           foreach ($originalPStaffs as $oriPstaff) {

               if (!in_array($oriPstaff->email, $data['emails'], true)) {
                $numRowUpdated += $oriPstaff->forceDelete();
            }
        }
    }


    return array('numRowUpdated' => $numRowUpdated
      , 'conStaffs' => ConferenceUserRole::ConferenceStaffs($data['conf_id'])
      , 'pendingConfStaffs' =>  InviteToConference::where('conf_id','=', $data['conf_id'])
      ->where('role_id','=',Role::ConferenceStaff()->role_id)
      ->where('is_used','=',0)->get());
});
} catch (Exception $ex) {
	throw $ex;
}
}
}

return array('success' => $result);
}

public function updateReviewPanels() {
    $data = [
    'conf_id' => Input::get('conf_id'),
    'emails' => Input::get('emails'),
    ];

    $rules = [
    'conf_id' => 'required|numeric',
    'emails' => 'array'
    ];

    $validator = Validator::make($data, $rules);

    if (Auth::check()) {
        if ($validator->fails()) {

            return array('invalidFields' => $validator->errors());
        } else {
            try {

                $user = Auth::user();
                $originalRPs = ConferenceUserRole::ConferenceReviewPanels($data['conf_id']);
                $originalPRPs = InviteToConference::where('conf_id','=', $data['conf_id'])->where('role_id','=',Role::Reviewer()->role_id)->where('is_used','=',0)->get();
                
                $numRowUpdated = 0;

                $result = DB::transaction(function() use ($data, $user, $originalRPs,$originalPRPs, $numRowUpdated) {

                    $roleid = Role::Reviewer()->role_id;

                    // add all first
                    if (!empty($data['emails'])) {
                        foreach ($data['emails'] as $email) {

                            $targetUser = User::where('email', '=', $email)->first();

                            if (!empty($targetUser)) {
                                // exists, directly assign the review panel
                                $conferenceUserRole = new ConferenceUserRole();

                                $conferenceUserRole->conf_id = $data['conf_id'];
                                $conferenceUserRole->role_id = $roleid;
                                $conferenceUserRole->user_id =$targetUser->user_id ;
                                $conferenceUserRole->created_by = $user->user_id;
                                $saved = $conferenceUserRole->save(); 

                                if ($saved) {
                                    $numRowUpdated ++;
                                } 
                            } else {
                                $inviteToConference = InviteToConference::where(array('conf_id' => $data['conf_id']))
                                ->Where('email','=', $email)
                                ->first();

                                if (empty($inviteToConference)) {
                                    // not exists in InviteToConference, send invitation to create review panel
                                    $sentSaved  = $this->emailForInviteToConference($data['conf_id'],$roleid,$email);

                                    if($sentSaved){
                                        $numRowUpdated ++;
                                    }
                                }

                            }
                        }
                    }

                    // delete not exist in ConfUserRole
                    if (!empty($originalRPs)) {
                        if (empty($data['emails'])) {
                            $data['emails'] = array();
                        }
                        foreach ($originalRPs as $oriRP) {

                            if (!in_array($oriRP->email, $data['emails'], true)) {
                                $numRowUpdated += $oriRP->forceDelete();
                            }
                        }
                    }

                    // delete not exist in InviteToConference
                    if (!empty($originalPRPs)) {
                        if (empty($data['emails'])) {
                            $data['emails'] = array();
                        }

                        foreach ($originalPRPs as $oriPRP) {

                            if (!in_array($oriPRP->email, $data['emails'], true)) {

                                $numRowUpdated += $oriPRP->forceDelete();
                            }
                        }
                    }
                    return array('numRowUpdated' => $numRowUpdated
                        , 'reviewPanels' => ConferenceUserRole::ConferenceReviewPanels($data['conf_id'])->get()
                        , 'pendingReviewPanels' =>  InviteToConference::where('conf_id','=', $data['conf_id'])
                        ->where('role_id','=',Role::Reviewer()->role_id)
                        ->where('is_used','=',0)->get());

                });
                //* end try
} catch (Exception $ex) {
    throw $ex;
}
}
}

return array('success' => $result);
}
    //**    emailForInviteToConference
private function emailForInviteToConference($conf_id,$role_id,$email){
    $code = str_random(60);

    $invite = new InviteToConference();
    $invite->code = $code;
    $invite->email = $email;
    $invite->role_id = $role_id;
    $invite->conf_id = $conf_id;
    $saved = $invite->save();

    $data = array('role_name' => Role::where('role_id','=', $role_id)->firstOrFail()->rolename ,'conf_title' => Conference::where('conf_id','=', $conf_id)->firstOrFail()->title);

    Mail::queue('emails.auth.invite_to_conference', array('link'=>URL::route('users-create', $code)
        , 'role_name' => $data['role_name']
        , 'conf_title' => $data['conf_title']) ,  function($message) use ($email,$data)
    {
        $message->to($email)->subject('You are invited to join ORAFER as '. $data['role_name'] .' for Conference \''.$data['conf_title'].'\'!');
    });

    //* return result
    return $saved;
}

}
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
					$originalStaffs = ConferenceUserRole::ConferenceStaffs($data['conf_id']);
					$originalPStaffs = InviteToConference::where('conf_id','=', $data['conf_id'])->where('role_id','=',Role::ConferenceStaff()->role_id)->where('is_used','=',0)->get();

					$numRowUpdated = 0;
					$result = DB::transaction(function() use ($data, $user, $originalStaffs, $numRowUpdated) {


						$roleid = Role::ConferenceStaff()->role_id;

                                // add all first
						if (!empty($data['emails'])) {
							foreach ($data['emails'] as $email) {

								$targetUser = User::where('email', '=', $email)->first();

								if (!empty($targetUser)) {
									if (empty(ConferenceUserRole::where(array('conf_id' => $data['conf_id']))
										->Where(array('user_id' => $targetUser->user_id))
										->first())) {

										if (!empty(ConferenceUserRole::create(array('conf_id' => $data['conf_id'], 'role_id' => $roleid, 'user_id' => $targetUser->user_id, 'created_by' => $user->user_id)))) {
											$numRowUpdated ++;
										}
									}
								} else {
									if (empty(InviteToConference::where(array('conf_id' => $data['conf_id']))
										->Where(array('user_id' => $targetUser->user_id))
										->first())) {
                                        // not exists in InviteToConference, send invitation to create staff
										$this->emailForInviteToConference($data['conf_id'],$roleid,$email);
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
                                // exists, directly assign the staff								 
                                if (empty(ConferenceUserRole::where(array('conf_id' => $data['conf_id']))
                                    ->Where(array('user_id' => $targetUser->user_id))
                                    ->first())) {

                                    if (!empty(ConferenceUserRole::create(array('conf_id' => $data['conf_id'], 'role_id' => $roleid, 'user_id' => $targetUser->user_id, 'created_by' => $user->user_id)))) {
                                        $numRowUpdated ++;
                                    }
                                }
                            } else {
                                if (empty(InviteToConference::where(array('conf_id' => $data['conf_id']))
                                    ->Where(array('user_id' => $targetUser->user_id))
                                    ->first())) {
                                    // not exists in InviteToConference, send invitation to create review panel
                                    $this->emailForInviteToConference($data['conf_id'],$roleid,$email);
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
} catch (Exception $ex) {
    throw $ex;
}
}
}

return array('success' => $result);
}

}
<?php

use Illuminate\Support\MessageBag;

class ConferenceController extends \BaseController {
    /*
      |--------------------------------------------------------------------------
      | ConferenceController
      |--------------------------------------------------------------------------
      |
      |
     */

    public function index() {
        $confs = Conference::where('begin_date', '>', DB::raw('curdate()'))
        ->get();

        $view = View::make('conference.index', array('confs' => $confs));

        return $view;
    }

    public function create() {
        $fields = InterestField::select(DB::raw('interestfield_id as id, name as label'))
        ->get();

        $view = View::make('conference.management.create', array('fields' => $fields));

        return $view;
    }

    public function register() {
        //
        $selectedConfId = $this->ValidateConference();

        if ($selectedConfId == -9999) {
            return 'NOT OK';
        } else {
            $conf = Conference::where('confId', '=', $selectedConfId)
            ->first();

            if ($conf == null) {
                return 'NOT OK';
            } else {

                // confId isvalid, check if the person already participated
                if (User::IsInRole('', $selectedConfId)) {
                    return 'NOT OK';
                } else {

                    // the user has not been participated
                    try {
                        $confUserRole = ConferenceUserRole::create(array('role_id' => $roleId, 'user_id' => Auth::user()->user_id, 'conf_id' => $confId));
                    } catch (Exception $ex) {
                        throw $ex;
                    }
                    return $confUserRole;
                }
            }

            return $selectedConfId;
        }

        return 'OK';
    }

    public function theConf() {
        $selectedConfId = $this->ValidateConference();

        $conf = Conference::where('conf_id', '=', $selectedConfId)
        ->first();

        $view = View::make('conference.confview', array('selectedConfId' => $selectedConfId, 'conf' => $conf));

        return $view;
    }

    public function ValidateConference() {
        //conf_id_col_\d+$

        $subject = Input::get('subject');

        $pattern = '/' . '^conf_id_col_(?P<confId>\d+)$' . '/';

        $matching = preg_match($pattern, $subject, $output_array);

        if ($matching) {

            return intval($output_array["confId"]);
        } else {
            return -9999;
        }
    }

    public function RetrieveCheckboxValue($inputString) {
        //conf_id_col_\d+$

        $subject = Input::get('subject');

        $pattern = '/' . '^chkField_(?P<fieldId>\d+)$' . '/';

        $matching = preg_match($pattern, $inputString, $output_array);

        if ($matching) {

            return intval($output_array["fieldId"]);
        } else {
            return -9999;
        }
    }

    public function detail() {
        $fields = InterestField::select(DB::raw('interestfield_id as id, name as label'))
        ->get();

        $confChairUsers = ConferenceUserRole::ConferenceChair(Input::get('conf_id'))->toArray();

        $allStaffs = ConferenceUserRole::ConferenceStaffs(Input::get('conf_id'))->get()->toArray();

        $reviewPanels = ConferenceUserRole::ConferenceReviewPanels(Input::get('conf_id'))->get()->toArray();

        $conf = Conference::where('conf_id', '=', Input::get('conf_id'))->first();

        $submissions = Submission::where('conf_id', '=', Input::get('conf_id'))->get();

        $invoices= Invoice::where('status','=','Paid')->where('conf_id','=', Input::get('conf_id'))->get();

       $topics = DB::table('conference_topic')
                    ->leftJoin('submission_topic', 'conference_topic.topic_id', '=', 'submission_topic.topic_id')
                    ->select('conference_topic.topic_id', 'conference_topic.topic_name', Db::raw('count(sub_id) as total_subs'))
                    ->where('conference_topic.conf_id', '=', Input::get('conf_id'))
                    ->groupBy('conference_topic.topic_name')
                    ->get();

        $view = View::make('conference.detail', array('fields' => $fields, 'conf' => $conf
            , 'confChairUsers' => $confChairUsers
            , 'allStaffs' => $allStaffs
            , 'reviewPanels' => $reviewPanels 
            , 'submissions' => $submissions
            , 'invoices' => $invoices
            , 'topics' => $topics));

        // SET SESSION
        Session::put('orafer_conf_id', Input::get('conf_id'));
        return $view;
    }

    public function conferenceEvents($begin, $end) {
        $confs = Conference::where('BeginTime', '>=', $begin)
        ->where('EndTime', '<=', $end)
                //->get()
        ->select(DB::raw('conf_id as id ,title as title ,DATE_FORMAT(BeginTime, "%Y-%m-%d") as start ,DATE_FORMAT(EndTime,"%Y-%m-%d") as end'))
        ->get();

        $output_arrays = array();
        $timezone = new DateTimeZone('UTC');
        $range_start = DateUtility::parseDateTime($begin);
        $range_end = DateUtility::parseDateTime($end);

        foreach ($confs as $array) {

            // Convert the input array into a useful Event object
            $event = new CalendarEvent($array, $timezone);

            // If the event is in-bounds, add it to the output
            if ($event->isWithinDayRange($range_start, $range_end)) {
                $event->editable = false;
                $event->end = $event->end->add(new DateInterval('P1D'));
                $output_arrays[] = $event->toArray();
            }
        }

        return $output_arrays;
    }

    public function createConference() {
        $conf = null;

        $data = [
        'conferenceTitle' => Input::get('conferenceTitle'),
        'chkField' => Input::get('chkField'),
        'beginDate' => date("Y-m-d", strtotime(Input::get('beginDate'))),
        'endDate' => date("Y-m-d", strtotime(Input::get('endDate'))),
        'maxSeats' => Input::get('maxSeats'),
        'cutOffDate' => date("Y-m-d", strtotime(Input::get('cutOffDate'))),
        'minScore' => Input::get('minScore'),
        'venue' => Input::get('venue'),
        'topicStr' => Input::get('conferenceTopic'),
        'chkIsFree' => Input::get('chkIsFree') === 'true' ? true : false
        ];

        $rules = [
        'conferenceTitle' => 'required|unique:conference,title|min:6',
        'chkField' => 'required|array',
        'beginDate' => 'required|date|before:endDate',
        'endDate' => 'required|date|after:beginDate',
        'maxSeats' => 'required|numeric',
        'cutOffDate' => 'date',
        'minScore' => 'numeric',
        'venue' => 'required|numeric',
        'chkIsFree' => 'boolean'
        ];

        $validator = Validator::make($data, $rules);

        if (Auth::check()) {
            if ($validator->fails()) {

                return array('invalidFields' => $validator->errors());
            } else {

                try {
                    $user = Auth::user();

                    $result = DB::transaction(function() use ($data, $user) {

                        $role_id = Role::ConferenceChair()->role_id;

                        $createdConf = Conference::create(array('title' => $data['conferenceTitle']
                            , 'begin_date' => $data['beginDate']
                            , 'end_date' => $data['endDate']
                            , 'is_free' => $data['chkIsFree']
                            , 'cutoff_time' => $data['cutOffDate']
                            , 'min_score' => $data['minScore']
                            , 'created_by' => $user->user_id));

                        $confRoom = ConferenceRoomSchedule::create(
                            array('conf_id' => $createdConf->conf_id
                                , 'room_id' => $data['venue']
                                , 'date_start' => $data['beginDate']
                                , 'date_end' => $data['endDate']
                                , 'created_by' => $user->user_id)
                            );

                        $confUserRole = ConferenceUserRole::create(array('user_id' => $user->user_id
                            , 'role_id' => $role_id
                            , 'conf_id' => $createdConf->conf_id));

                        foreach ($data['chkField'] as $key) {
                            ConferenceField::create(array('interestfield_id' => $this->RetrieveCheckboxValue($key)
                                , 'conf_id' => $createdConf->conf_id 
                                , 'created_by' => $user->user_id ));
                        }

                        $invoice = invoice::find(Input::get('invoice_id'));         
                        $invoice->conf_id = $createdConf->conf_id;       
                        $invoice->save();

                        //save topics
                        $topics_array = explode(",", $data['topicStr']);

                        if (!empty($topics_array)) {
                            $conf_topics = array();
                            foreach ($topics_array as $topic) {
                                $topic = ConferenceTopic::create(['topic_name' => $topic
                                    , 'conf_id' => $createdConf->conf_id
                                    , 'created_by' => $user->user_id]);
                            }

                        }

                        return array('createdConf' => $createdConf, 'confRoom' => $confRoom);
                    });
} catch (Exception $ex) {
    throw $ex;
}
}
}

return array('success' => $result);
}

public function updateDescription() {
    $data = [
    'conf_id' => Input::get('conf_id')
    ];

    $rules = [
    'conf_id' => 'required|numeric'
    ];

    $validator = Validator::make($data, $rules);

    if (Auth::check()) {
        if ($validator->fails()) {

            return array('invalidFields' => $validator->errors());
        } else {
            try {
                $user = Auth::user();

                $result = DB::transaction(function() use ($data, $user) {
                    $numRowUpdated = Conference::where('conf_id', '=', $data['conf_id'])
                    ->update(array('description' => Input::get('description')
                        , 'modified_by' => $user->user_id));

                    return array('numRowUpdated' => $numRowUpdated);
                });
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

    return array('success' => $result);
}

public function updateParticulars() {
    $data = [
    'conf_id' => Input::get('conf_id')
    , 'cutOffDate' => date("Y-m-d H:i", strtotime(Input::get('cutOffDate')))
    , 'minScore' => Input::get('minScore')
    ];

    $rules = [
    'conf_id' => 'required|numeric'
    , 'cutOffDate' => 'date'
    , 'minScore' => 'numeric|min:1'
    ];

    $validator = Validator::make($data, $rules);

    if (Auth::check()) {
        if ($validator->fails()) {

            return array('invalidFields' => $validator->errors());
        } else {
            try {
                $user = Auth::user();

                $result = DB::transaction(function() use ($data, $user) {
                    $numRowUpdated = Conference::where('conf_id', '=', $data['conf_id'])
                    ->update(array('cutoff_time' => $data['cutOffDate']
                        , 'min_score' => $data['minScore']
                        , 'modified_by' => $user->user_id));
                    $conf = Conference::where('conf_id', '=', $data['conf_id'])->first();
                    return array('numRowUpdated' => $numRowUpdated, 'conf' => $conf);
                });
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

    return array('success' => $result);
}

public function updateTopics() {
    $data = [
    'conf_id' => Input::get('conf_id')
    , 'topic_name' => Input::get('topic_name')
    , 'topic_id' => Input::get('topic_id')
    , 'delete_topic'  => Input::get('delete_topic')
    ];

    //validation is using HTML5 required attribute

    if (Auth::check()) {
    
        try {
            $user = Auth::user();

            // $result = DB::transaction(function() use ($data, $user) {
                //update for each conference topic
                for ($i = 0; $i < count($data['topic_name']); $i++) {

                    //check if topic marked for deletion
                    if ( !empty( $data['delete_topic'][$i] ) ) {
                        //if yes
                        //delete entries on conference_topics first
                        DB::table('submission_topic')->where('topic_id', '=', $data['delete_topic'][$i])->delete();

                        //delete the topics itself
                        $conf_topic = ConferenceTopic::where('topic_id', '=', $data['delete_topic'][$i])->first();
                        if ( !empty($conf_topic) ) $conf_topic->delete();
                    } else {
                        //else, just update based on value inside the text field
                        $conf_topic = ConferenceTopic::where('topic_id', '=', $data['topic_id'][$i])->first();
                        $conf_topic->topic_name = $data['topic_name'][$i];
                        $conf_topic->modified_by = $user->user_id;
                        $conf_topic->save();
                    }
                    
                }
            // });
        } catch (Exception $ex) {
            throw $ex;
        }
        
    }

    return array('success' => 'Updated!');
}

public function addNewTopic() {
    $data = [
    'conf_id' => Input::get('conf_id')
    , 'topic_name' => Input::get('topic_name')
    ];

    //validation is using HTML5 required attribute

    if (Auth::check()) {
    
        try {
            $user = Auth::user();

            //add in new topic
            $topic = ConferenceTopic::create(['topic_name' => $data['topic_name']
                                    , 'conf_id' => $data['conf_id']
                                    , 'created_by' => $user->user_id]);
                
            // });
        } catch (Exception $ex) {
            throw $ex;
        }
        
    }

    return array('success' => 'Updated!');
}

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

public function validateCreateConference() {

    $confTitle = trim(Input::get('conferenceTitle'));

    $conf = Conference::where('Title', '=', $confTitle)->first();

    return json_encode(array('valid' => ($conf == null)));
}

public function conf_public_list() {
    //get all conferences sorted by begin date
    //$confs = Conference::with('confRoom')->orderBy('begin_date', 'desc')->get();
    $confs = ConferenceRoomSchedule::with('Conferences','Rooms.venues')->get();
    // dd($data->first()->toArray());
    return View::make('conf_list')->with('confs', $confs);
    
}

public function conf_public_detail($id) {

    $conf = ConferenceRoomSchedule::with('Conferences','Rooms.venues')->where('conf_id', '=', $id)->first();
    //dd($conf->toArray());
    //$conf = Conference::where('conf_id', '=', $id)->first();
    $chair = DB::table('users')
    ->join('confuserrole', 'confuserrole.user_id', '=', 'users.user_id')
    ->select('users.email', 'users.firstname', 'users.lastname')
    ->where('confuserrole.role_id', '=', 4)
    ->where('confuserrole.conf_id', '=', $id)
    ->first();
    $topics = DB::table('conference_topic')
    ->join('conference', 'conference.conf_id', '=', 'conference_topic.conf_id')
    ->select('conference_topic.topic_name')
    ->where('conference_topic.conf_id', '=', $id)
    ->get();    

    if (empty($conf)) {
        return Redirect::route('conference.public_list')->with('message', 'Conference not found!');
    } else {
        return View::make('conf_detail')->with('conf', $conf)->with('chair', $chair)->with('topics', $topics);
    }
}


private function emailForInviteToConference($conf_id,$role_id,$email){
    $code = str_random(60);

    $invite = new InviteToConference();
    $invite->code = $code;
    $invite->email = $email;
    $invite->role_id = $role_id;
    $invite->conf_id = $conf_id;
    $invite->save();

    $data = array('role_name' => Role::where('role_id','=', $role_id)->firstOrFail()->rolename
        ,'conf_title' => Conference::where('conf_id','=', $conf_id)->firstOrFail()->title);

    Mail::queue('emails.auth.invite_to_conference',
        array('link'=>URL::route('users-create', $code),
            'role_name' => $data['role_name'] ,
            'conf_title' => $data['conf_title'] ,
            ), 
        function($message) use ($email,$data)
        {
            $message->to($email)->subject('You are invited to join ORAFER as '. $data['role_name'] .' for Conference \''.$data['conf_title'].'\'!');
        });
}

}


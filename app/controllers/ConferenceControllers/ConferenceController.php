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
        //* conf_id assign
        $conf_id = Input::get('conf_id');

        $conf = Conference::where('conf_id', '=', $conf_id)->first();

        if(empty($conf)){
            return Redirect::route('users.dashboard')->with('message', 'Conference not found!');
        }

        $fields = InterestField::select(DB::raw('interestfield_id as id, name as label'))
        ->get();

        $confChairUser = ConferenceUserRole::ConferenceChair($conf_id)->first();
        
        $allStaffs = ConferenceUserRole::ConferenceStaffs($conf_id)->get();

        $reviewPanels = ConferenceUserRole::ConferenceReviewPanels($conf_id)->get();

        

        $submissions = Submission::where('conf_id', '=', $conf_id)->get();
         
        $invoices= Invoice::where('status','=','Paid')
        ->where('conf_id','=', $conf_id)
        ->where('user_id','<>', $confChairUser->user_id)
        ->get();

        $topics = DB::table('conference_topic')
        ->leftJoin('submission_topic', 'conference_topic.topic_id', '=', 'submission_topic.topic_id')
        ->select('conference_topic.topic_id', 'conference_topic.topic_name', Db::raw('count(sub_id) as total_subs'))
        ->where('conference_topic.conf_id', '=', $conf_id)
        ->groupBy('conference_topic.topic_name')
        ->get();

        $view = View::make(
            'conference.detail', array('fields' => $fields, 'conf' => $conf
            , 'confChairUser' => $confChairUser
            , 'allStaffs' => $allStaffs
            , 'reviewPanels' => $reviewPanels 
            , 'submissions' => $submissions
            , 'invoices' => $invoices
            , 'topics' => $topics
            , 'isCancel' => !empty($conf->ConferenceCancel()->first())
			, 'isChair' => ($confChairUser->user_id == Auth::user()->user_id )
            , 'isStaff' => Auth::user()->hasConfRole($conf->conf_id, Role::ConferenceStaff()->rolename)
            , 'isReviewer' => Auth::user()->hasConfRole($conf->conf_id, Role::Reviewer()->rolename)
            ));

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
    , 'ticketPrice' => str_replace ('S$','',Input::get('ticketPrice'))
    ];

    $rules = [
    'conf_id' => 'required|numeric'
    , 'cutOffDate' => 'date'
    , 'minScore' => 'numeric|min:0'
    , 'ticketPrice' => 'numeric'
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
                        , 'modified_by' => $user->user_id
                        , 'ticket_price' => $data['ticketPrice'] ));
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
 
public function validateCreateConference() {

    $confTitle = trim(Input::get('conferenceTitle'));

    $conf = Conference::where('Title', '=', $confTitle)->first();

    return json_encode(array('valid' => ($conf == null)));
}

public function conf_public_list() {
    //get all conferences sorted by begin date
    //$confs = Conference::with('confRoom')->orderBy('begin_date', 'desc')->get();
    // $this->RetrieveCheckboxValue($key)

    $searchList = Input::get('chkField');
    $item = array();

    if(!empty($searchList)){
        foreach($searchList as $searchItem)
        {
            $item[] = $this->RetrieveCheckboxValue($searchItem);
        }
    }    

    $data = ConferenceRoomSchedule::with('Conferences.ConferenceFields','Rooms.venues')->whereHas('Conferences.ConferenceFields', function($Query) use($item) {
        if(!empty($item))
            $Query->whereIn('interestfield_id', $item);
    });

    $datas = $data->get();

    $confs = $this->filterConferences();

    $fields = InterestField::select(DB::raw('interestfield_id as id, name as label'))
    ->get();
    
    return View::make('conf_list')->with(array('fields' => $fields,'datas' => $datas , 'items' => json_encode($item)));

}

public function filterConferencesByTitle(){

    //$confTitle = Conference::where('title','LIKE','%abc%')->get();

    $value = Input::get('iTitle');

    $data = ConferenceRoomSchedule::with('Conferences','Rooms.venues')->whereHas('conferences', function($Query) use($value) {
        $Query->where('title', 'LIKE', '%'.$value.'%');
    });

    $datas = $data->get();

    $titleList = array();

    foreach($datas as $data)
    {
        $title = $data->Conference()->title;
        $titleList[] = array('title' => $title); 
    }

    return $titleList;
}

public function filterConferences(){

    //$confTitle = Conference::where('title','LIKE','%abc%')->get();
    $value = Input::get('iTitle');
    $data = ConferenceRoomSchedule::with('Conferences','Rooms.venues')->whereHas('conferences', function($Query) use($value) {
        $Query->where('title', 'LIKE', '%'.$value.'%');
    });

    $data = $data->get();
    //dd($data->toArray());

    return $data;
}

public function conf_public_detail($id) {

    $conf = ConferenceRoomSchedule::with('Conferences','Rooms.venues')->where('conf_id', '=', $id)->first();

    $remaining = $conf->rooms->capacity - Invoice::where('conf_id','=', $id)->sum('quantity');
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

      //$participants = ConferenceUserRole::Conferenceparticipants($conf->conf_id)->get();
 
    if (empty($conf)) {
        return Redirect::route('conference.public_list')->with('message', 'Conference not found!');
    } else {
        return View::make('conf_detail')->with('conf', $conf)
        ->with('chair', $chair)
        ->with('topics', $topics)
        ->with('remaining',$remaining);
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

public function cancelConference() {
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



                    //* email to add review panel inform of cancellation
                    $endUsers = ConferenceUserRole::ConferenceReviewPanels($data['conf_id'])->get();
                    
                    foreach ($endUsers as $endUser) {
                        # code...
                        $this->emailForCancelConference($data['conf_id'], $endUser);
                    }

                    //* email to all conference staff inform cancellation
                    $endUsers = ConferenceUserRole::ConferenceStaffs($data['conf_id'])->get();
                    foreach ($endUsers as $endUser) {
                        # code...
                        $this->emailForCancelConference($data['conf_id'], $endUser);
                    }

                    //* email to all author inform cancellation
                    $endUsers = ConferenceUserRole::ConferenceAuthors($data['conf_id'])->get();                    
                    foreach ($endUsers as $endUser) {
                        # code...
                        $this->emailForCancelConference($data['conf_id'], $endUser);
                    }

                    //* email to all participants inform cancellation
                    $endUsers = ConferenceUserRole::Conferenceparticipants($data['conf_id'])->get();
                    foreach ($endUsers as $endUser) {
                        # code...
                        $this->emailForCancelConference($data['conf_id'], $endUser);
                    }

                    //* email to resource provider telling about the cancellation
                    $endUsers = ConferenceUserRole::ResourceProviders($data['conf_id'])->get();
                    foreach ($endUsers as $endUser) {
                        # code...
                        $this->emailForCancelConference($data['conf_id'], $endUser);
                    }

                    $confCancel = new ConferenceCancel();
                    $confCancel->conf_id = $data['conf_id'];
                    $confCancel->created_by = $user->user_id;
                    $updateResult = $confCancel->save();
                    
                    return array('updateResult' => $updateResult);
                });
} catch (Exception $ex) {
    throw $ex;
}
}
}

return array('success' => $result);
}

private function emailForCancelConference($conf_id,$endUser){

    $data = array('peoplename' => $endUser->firstname .', '. $endUser->lastname
        ,'conference_name' => Conference::where('conf_id','=', $conf_id)->firstOrFail()->title);
    // http://localhost:5080/laravel/public/conference_detail/18
    Mail::queue('emails.auth.conference_cancel',
        array('link'=>URL::to('conference_detail').'/'.$conf_id,
            'peoplename' => $data['peoplename'] ,
            'conference_name' => $data['conference_name']
            ), 
        function($message) use ($endUser,$data)
        {  
            $message->to($endUser->email)->subject('Information : Cancallation of \''. $data['conference_name'] .'\' conference !');
            Log::info('Sending email to :: '. $endUser->email);
        });
}

}


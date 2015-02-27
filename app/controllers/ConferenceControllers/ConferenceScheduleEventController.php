<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ConferenceScheduleEventController extends BaseController {

    public function addConferenceScheduleEvents() {

        $allEvents = Input::get('allEvents');

        $data = [
        'allEvents' => Input::get('allEvents')
        ,'scheduleId' => Input::get('scheduleId')
        ];

        $rules = [
        'allEvents' => 'required|array'
        ,'scheduleId' => 'required|numeric'
        ];

        $validator = Validator::make($data, $rules);

        if (Auth::check()) {
            if ($validator->fails()) {

                return array('invalidFields' => $validator->errors());
            } else {

                try {
                    $user = Auth::user();

                    $result = DB::transaction(function() use ($data, $user) {

                        $allEvents = $data['allEvents'];
                        $numRowAffected = 0;

                        $conference_room_schedule_id = $data['scheduleId'];

                        // find all eventId in the database and if it is not in the incoming list, delete it away
                        $idSInTable = ConferenceScheduleEvent::where('conference_room_schedule_id','=',$data['scheduleId'])
                            ->get()
                            ->lists('conference_schedule_event_id');
                        $idsInSource  = array();

                        
                        foreach ($allEvents as $event) {
                            $className = empty($event['className'])? '':$event['className'][0];

                            
                            if(!empty($event['eventId'])){ 

                                array_push($idsInSource, $event['eventId']);
                            // if the eventId is not empty, juz update the record
                                $numRowAffected += ConferenceScheduleEvent::where('conference_schedule_event_id','=',$event['eventId'])
                                ->update( array('day' => date("Y-m-d", strtotime($event['start']))
                                    , 'start' => date("Y-m-d H:i:s", strtotime($event['start']))
                                    , 'end' => date("Y-m-d H:i:s", strtotime($event['end']))
                                    , 'className' => $className));
                            }else{
                                // it is new record
                               $confScheduleEvent = ConferenceScheduleEvent::create(array('conference_room_schedule_id' => $data['scheduleId']
                                , 'submission_id' => empty($event['sub_id'])? '':$event['sub_id']
                                , 'title' => $event['title']
                                , 'day' => date("Y-m-d", strtotime($event['start']))
                                , 'start' => date("Y-m-d H:i:s", strtotime($event['start'])) 
                                , 'end' => date("Y-m-d H:i:s", strtotime($event['end'])) 
                                , 'className' => $className ));

                               if (!empty($confScheduleEvent)) {
                                    $numRowAffected++;
                                }
                            }
                        }

                        //* Now, delete those exist in table but not in the source
                        foreach ($idSInTable as $event_id) {

                            if(!in_array($event_id, $idsInSource)){
                                 $numRowAffected += ConferenceScheduleEvent::where('conference_schedule_event_id','=',$event_id)
                                 ->delete();
                            }
                        }
                        
                    $confScheduleEvents = ConferenceScheduleEvent::where('conference_room_schedule_id', '=', $conference_room_schedule_id)
                    ->get();

                    return array('numRowAffected' => $numRowAffected, 'confScheduleEvents' => $confScheduleEvents);
                });
} catch (Exception $ex) {
    throw $ex;
}
}
}
return array('success' => $result);
}

public function getConferenceScheduleEvents() {

    $allEvents = Input::get('conference_room_schedule_id');


    $data = [
    'scheduleId' => Input::get('scheduleId')
    ];

    $rules = [
    'scheduleId' => 'required|numeric'
    ];

    $validator = Validator::make($data, $rules);

    if (Auth::check()) {
        if ($validator->fails()) {

            return array('invalidFields' => $validator->errors());
        } else {

            try {
                $user = Auth::user();

                $conferenceScheduleEvents = ConferenceScheduleEvent::where('conference_room_schedule_id','=',$data['scheduleId'])
                //->where('day','=',$data['selectedDate'])
                ->select(DB::raw('conference_schedule_event_id as eventId, conference_room_schedule_id as id ,title as title ,start , end, className, submission_id as sub_id'))
                ->get()
                ->toArray();

                //$output_arrays = array();

            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }
    return array('conferenceScheduleEvents' => $conferenceScheduleEvents);
}


public function getAvailableConferenceScheduleEvents() {

    $data = [
    'scheduleId' => Input::get('scheduleId')
    ];

    $rules = [
    'scheduleId' => 'required|numeric'
    ];

    $validator = Validator::make($data, $rules);

    if (Auth::check()) {
        if ($validator->fails()) {

            return array('invalidFields' => $validator->errors());
        } else {

            try {
                $user = Auth::user();

                $confRoomSchedule = ConferenceRoomSchedule::where('confroomschedule_id','=',$data['scheduleId'])
                ->first();

                if(!empty($confRoomSchedule)){

                    $submissionTableName = with(new Submission)->getTable();

                    $createdSubmissions = ConferenceScheduleEvent::where('conference_room_schedule_id','=',$data['scheduleId'])
                    ->get()
                    ->lists('submission_id');

                    $confSubmissions = $confRoomSchedule->Conference()->ConferenceSubmissions()
                    ->join('users','users.user_id','=',$submissionTableName.'.user_id')
                    ->where('status','=',1)
                    ->whereNotIn('sub_id',$createdSubmissions)
                    ->select(DB::raw('CONCAT(sub_title,": ", users.firstname,", ", users.lastname) as title, sub_id'))
                    ->get();

                    return ($confSubmissions);
                }


            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }
    return array('conferenceScheduleEvents' => $conferenceScheduleEvents);
}
}

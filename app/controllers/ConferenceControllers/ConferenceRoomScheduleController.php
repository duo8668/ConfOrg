<?php

class ConferenceRoomScheduleController extends BaseController {

    public function conferenceEvents($begin, $end) {
        $confs = Conference::where('BeginTime', '>=', $begin)
        ->where('EndTime', '<=', $end)
        ->select(DB::raw('conf_id as id ,title as title ,DATE_FORMAT(begin_date, "%Y-%m-%d") as start ,DATE_FORMAT(end_date,"%Y-%m-%d") as end'))
        ->get();

        //dd($confs[1]);
        //dd(DB::getQueryLog());

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

    public function allRoomSchedules() {
        $confRoomSchedule = ConferenceRoomSchedule::
        select(DB::raw('DATE_FORMAT(date_start, "%m/%d/%Y") as start ,DATE_FORMAT(date_end,"%m/%d/%Y") as end'))
        ->get();

        return $confRoomSchedule;
    }

    /*
      select * from conference_room_schedule
      where date_start < '2015-02-06' And date_end > '2015-02-01'
     */

      public function availableRooms() {

        //select(DB::raw('DATE_FORMAT(date_start, "%Y-%m-%d") as start ,DATE_FORMAT(date_end,"%Y-%m-%d") as end'))

        if (Input::has('date_start') && Input::has('date_end')) {
            if (Utility::checkIsAValidDate(Input::get('date_start')) && Utility::checkIsAValidDate(Input::get('date_end'))) {

                $used = ConferenceRoomSchedule::where('date_start', '<', date('Y-m-d', strtotime(Input::get('date_end'))))
                ->where('date_end', '>', date('Y-m-d', strtotime(Input::get('date_start'))))
                ->get();

                $listUsed = $used->lists(DB::raw('room_id'));

                $maxSeat = 0 ;
                if(Input::has('max_seats')){
                    $maxSeat = (int)Input::get('max_seats');
                }

                if (!empty($listUsed)) {
                    $available = Room::join('venue','room.venue_id','=','venue.venue_id')
                    ->whereNotIn('room_id', $listUsed)
                    ->where('room.available','=','yes')
                    ->where('capacity','>=',$maxSeat)
                    ->select('room_id', 'room_name', 'venue_name','rental_cost','capacity')
                    ->orderBy('capacity')
                    ->get();
                } else {
                    $available = Room::join('venue','room.venue_id','=','venue.venue_id')
                    ->where('room.available','=','yes')
                    ->where('capacity','>=',$maxSeat)
                    ->select('room_id', 'room_name', 'venue_name', 'rental_cost','capacity')
                    ->orderBy('capacity')
                    ->get();
                }
                return $available;
            }
        }


        return NULL;
    }

}

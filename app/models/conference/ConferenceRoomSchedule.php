<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ConferenceRoomSchedule extends Eloquent {
  
    use SoftDeletingTrait;

    protected $table = 'conference_room_schedule';
    protected $fillable = array('conf_id', 'room_id', 'description', 'date_start', 'date_end', 'begin_time', 'end_time', 'remarks', 'created_by', 'modified_by');
    protected $guarded = array('confroomschedule_id');
    protected $primaryKey = 'confroomschedule_id';

    public $timestamps = true;  
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    

    public function scopeRoom() {
        $thisRoom = Room::where('room_id', '=', $this->room_id)->get();

        if (!empty($thisRoom)) {
            
            return $thisRoom->first();
        }
        return NULL;
    }

    public function Conference() {
        $thisConference = Conference::where('conf_id', '=', $this->conf_id)->get();

        if (!empty($thisConference)) {
            return $thisConference->first();
        }
        return NULL;
    }

    public function Conferences(){
        return $this->belongsTo('Conference','conf_id');
    }

    public function Rooms(){
        return $this->belongsTo('Room','room_id');
    }


    public function scopeScheduleDates($query) {

        $results = DB::select(DB::raw("SELECT
            CAST(
                (
                    CRS.date_start + INTERVAL(H + T + U) DAY
                    ) AS date
    ) AS 'date'
        FROM
        (
            SELECT 0 H UNION ALL SELECT 100 UNION ALL SELECT 200 UNION ALL SELECT 300 UNION ALL SELECT 400 UNION ALL SELECT 500 UNION ALL SELECT 600
            ) H
        CROSS JOIN(
            SELECT 0 T UNION ALL SELECT 10 UNION ALL SELECT 20 UNION ALL SELECT 30 UNION ALL SELECT 40 UNION ALL SELECT 50 UNION ALL SELECT 60 UNION ALL SELECT 70 UNION ALL SELECT 80 UNION ALL SELECT 90
            ) T
        CROSS JOIN(
            SELECT 0 U UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
            ) U
        CROSS JOIN conference_room_schedule CRS
        WHERE
        (
            CRS.date_start + INTERVAL(H + T + U) DAY
            ) BETWEEN CRS.date_start
        AND CRS.date_end
        AND CRS.conf_id = " . $this->conf_id . "
        "), array());
$date_selector = array();
foreach ($results as $result) {
    $date_selector[$result->date] = $result->date;
}
return $date_selector;
}

}

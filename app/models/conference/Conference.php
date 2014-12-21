<?php  

class Conference extends Eloquent {

	protected $table = 'conference';

	protected $fillable = array('Title', 'ConfTypeId', 'Description','BeginDate','BeginTime','EndDate','EndTime','IsFree','Speaker','CreatedBy');

	protected $guarded = array('ConfId','DateCreated');
	
	public $timestamps = false;

	
	public function AllJsonConference($beginTime,$endTime){

		//$five = date("Y-m-d",strtotime("-5 minutes",strtotime($thestime)));

		$confs = Conference::where('BeginTime','>=',  $beginTime)
		->where('EndTime','<=',  $endTime)
		//->get()
		->select(DB::raw('ConfId as id ,title as title ,DATE_FORMAT(BeginTime, "%Y-%m-%d") as start ,DATE_FORMAT(EndTime,"%Y-%m-%d") as end'))
		->get();

		//dd($confs);
		//dd(DB::getQueryLog());

		$output_arrays = array();
		$timezone = new DateTimeZone('UTC');
		$range_start = Conference::parseDateTime($beginTime);
		$range_end =  Conference::parseDateTime($endTime);

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

	// Parses a string into a DateTime object, optionally forced into the given timezone.
	public function parseDateTime($string, $timezone=null) {
		$date = new DateTime(
			$string,
			$timezone ? $timezone : new DateTimeZone('UTC')
			// Used only when the string is ambiguous.
			// Ignored if string has a timezone offset in it.
			);
		if ($timezone) {
		// If our timezone was ignored above, force it.
			$date->setTimezone($timezone);
		}
		return $date;
	}

}
<?php

class InterestsController extends \BaseController {


public function getInterests(){
	$fields=InterestField::select(DB::raw('interestfield_id as id, name as label'))
  ->get();
   $view = View::make('home',array('fields'=>$fields,'fields'=>$fields)); 

  return $view;
}
}

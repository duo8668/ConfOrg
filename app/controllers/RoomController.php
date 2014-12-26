<?php

class RoomController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$data = DB::table('Room')
    	->join('venue', 'venue.ID', '=', 'room.venue_ID')
    	->get(array('room.ID','room.RoomName', 'room.Capacity', 'venue.Name'));	

    	return View::make('Room.index')->with('data',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$venues = ['' => ''] + Venue::select('ID', DB::raw('CONCAT(Name, " - ", Address) AS full_name'))->lists('full_name', 'ID');
		$equipments = ['' => ''] + Equipment::select('ID', DB::raw('CONCAT(equipmentName, " - ", equipmentRemarks) AS full_name'))->lists('full_name', 'ID');
		return View::make('room.create')
	    ->with('venues', $venues)
	    ->with('equipments', $equipments);	   
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//	    
        if(Input::get('Create')) {		 	
            $rules = array(
            'roomName'       => 'required',
            'roomCapacity'      => 'required|Integer',			                      
            'venue' 				=>'required',
	        );
	        $validator = Validator::make(Input::all(), $rules);

	        // process the login
	        if ($validator->fails()) {
	            return Redirect::to('room/create')
	                ->withErrors($validator)
	                ->withInput(Input::all());
	        } 	        
	        else {
	            // store	           
	        	$room = new room;
	            $room->RoomName = Input::get('roomName');
	            $room->Capacity = Input::get('roomCapacity');	            
	            $room->Venue_ID = Input::get('venue');
	            $room->save();            

	            // redirect
	            Session::flash('message', 'room Successfully Created!');
	            return Redirect::to('room');
	        }

        } elseif(Input::get('Add')) {
	           // validate
	        // read more on validation at http://laravel.com/docs/validation
	        $rules = array(
	            'equipment'       => 'required',	            
	        );
	        $validator = Validator::make(Input::all(), $rules);

	        // process the login
	        if ($validator->fails()) {
	            return Redirect::to('room/create')
	                ->withErrors($validator)
	                ->withInput(Input::all());
	        } 
	        else{
	        	//store it!
	        }
	        //return Redirect::to('room') with the list of equipment with a ID;
	    }

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$room = Room::find($id);
    	$venue = venue::find($room->Venue_ID);    	    	

    	$geoLocation = $venue->Latitude.' , '.$venue->Longitude;        

  //       list($lat, $lng, $error) = Gmaps::get_lat_long_from_address(Input::get('venueAddress'));		
		// $geoLocation = ((string) $lat).' , '.((string) $lng);

		$config['center'] = $geoLocation;
		$config['zoom'] = 'auto';
		Gmaps::initialize($config);
		
		$marker = array();
		$marker['position'] = $geoLocation;
		Gmaps::add_marker($marker);
		$map = Gmaps::create_map();						    	
        return View::make('room.show')->with('room', $room)->with('venue',$venue)->with('map',$map);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		$room = Room::find($id);
		$venues = ['' => ''] + Venue::select('ID', DB::raw('CONCAT(Name, " - ", Address) AS full_name'))->lists('full_name', 'ID');
        // show the edit form and pass the room
        return View::make('room.edit')
            ->with('room', $room)
            ->with('venues', $venues);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	    $rules = array(
            'roomName'       => 'required',
            'roomCapacity'      => 'required|Integer',			                      
            'venue' 				=>'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('room/' .$id. '/edit')
                ->withErrors($validator)
                ->withInput(Input::all());
        } 	        
        else {
            // store	           
        	$room = Room::find($id);
            $room->RoomName = Input::get('roomName');
            $room->Capacity = Input::get('roomCapacity');	            
            $room->Venue_ID = Input::get('venue');
            $room->save();            

            // redirect
            Session::flash('message', 'Room Successfully Updated!');
            return Redirect::to('room');
        }         
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		$room = Room::find($id);
		$room->delete();       
        // redirect
        Session::flash('message', 'Successfully deleted the Room!');
        return Redirect::to('room');
	}


}

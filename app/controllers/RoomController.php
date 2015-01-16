<?php

class RoomController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$data = DB::table('Room')
    	->join('venue', 'venue.venue_id', '=', 'room.venue_id')
    	->get(array('room.room_id','room.room_name', 'room.capacity', 'venue.venue_name'));	

    	// $data = DB::table('Room')
    	// ->Where('room.Venue_ID', 'venue.ID')
    	// ->get();`

    	return View::make('Room.index')->with('data',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{		
		$venues = ['' => ''] + Venue::select('venue_id', DB::raw('CONCAT(venue_name, " - ", venue_address) AS full_name'))->lists('full_name', 'venue_id');					
		$equipments = Equipment::selectRaw('equipment_id as id, concat(equipmentcategory_name, " - ", equipment_name) as full_name')
	    ->join('equipment_category', 'equipment.equipmentcategory_id', '=', 'equipment_category.equipmentcategory_id')
	    ->lists('full_name', 'id');

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
		
		//dd(Input::get('duallistbox_demo2'));	
		// foreach ($accounttypes as $accounttype) {
  		//DB::insert('INSERT INTO tb_accounts (accounttype,client) VALUES (?,?)', array($selectedvalue,1);}
			
		//dd(Input::all());
         	
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
	            $room->room_name = Input::get('roomName');
	            $room->capacity = Input::get('roomCapacity');	            
	            $room->venue_id = Input::get('venue');
	            $room->save();            

	            //$LastInsertId = $room->id;
            	$selectedValues = Input::get('duallistbox_demo2');

            	if(!empty($selectedValues))
            	{
					foreach($selectedValues as $selectedvalue)
					{					
						$equipment = Equipment::find($selectedvalue);					
						$room->equipments()->attach($equipment->equipment_id);
					}
				}

	            // redirect
	            Session::flash('message', 'room Successfully Created!');
	            return Redirect::to('room');

	        }                    
	        //return Redirect::to('room') with the list of equipment with an ID;	    
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
    	$venue = venue::find($room->venue_id);    	    	

    	$geoLocation = $venue->latitude.' , '.$venue->longitude;        

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
		// // get the picnics that Cerms goes to ------------------------
  //   	$cerms = Bear::where('name', '=', 'Cerms')->first();

  //   	// get the picnics and their names and taste levels
  //   	foreach ($cerms->picnics as $picnic) 
  //       echo $picnic->name . ' ' . $picnic->taste_level;
		// //$business_in_category = Category::find($id)->company;		

		
		// foreach($room->equipments as $equipment)
		// echo $equipment->equipment_name .' '.$equipment->equipment_id;
		
        // show the edit form and pass the room

        $room = Room::find($id);
        $selectedEquipment = $room->equipments;
        $venues = ['' => ''] + Venue::select('venue_id', DB::raw('CONCAT(venue_name, " - ", venue_address) AS full_name'))->lists('full_name', 'venue_id');
        $equipments = Equipment::selectRaw('equipment_id as id, concat(equipmentcategory_name, " - ", equipment_name) as full_name')
	    ->join('equipment_category', 'equipment.equipmentcategory_id', '=', 'equipment_category.equipmentcategory_id')
	    ->lists('full_name', 'id');

		return View::make('room.edit')
	    ->with('venues', $venues)
	    ->with('equipments', $equipments)
	   	->with('room',$room);
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
            $room->room_name = Input::get('roomName');
            $room->capacity = Input::get('roomCapacity');	            
            $room->venue_ID = Input::get('venue');
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

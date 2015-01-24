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

		
		
		if (Session::has('edit'))
		{			
			session::forget('edit');
			Session::flash('message', 'Room Successfully Updated!');
			return Redirect::to('room');
		}

		else
		{
			return View::make('Room.index')->with('data',$data);
		}
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{	
		Session::forget('message');
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
			$SelectedValues = Input::get('duallistbox_demo2');

			if(!empty($SelectedValues))
			{
				foreach($SelectedValues as $Selectedvalue)
				{					
					$equipment = Equipment::find($Selectedvalue);					
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

		// dd(Input::all()); 
		// //
		// $rules = array(
		// 	'roomName'       => 'required',
		// 	'roomCapacity'      => 'required|Integer',			                      
		// 	'venue' 				=>'required',
		// 	);
		// $validator = Validator::make(Input::all(), $rules);

  //       // process the login
		// if ($validator->fails()) {
		// 	return Redirect::to('room/' .$id. '/edit')
		// 	->withErrors($validator)
		// 	->withInput(Input::all());
		// } 	        
		// else {
		// 	// $customer->drinks()->detach($drink_id);
  //           // store	           
		// 	$room = Room::find($id);
		// 	$room->room_name = Input::get('roomName');
		// 	$room->capacity = Input::get('roomCapacity');	            
		// 	$room->venue_ID = Input::get('venue');
		// 	$room->save();            

		// 	// $room->equipments()->detach();
	 //  //           //$LastInsertId = $room->id;
		// 	// $selectedValues = Input::get('duallistbox_demo2');

		// 	// if(!empty($selectedValues))
		// 	// {
		// 	// 	foreach($selectedValues as $selectedvalue)
		// 	// 	{					
		// 	// 		$equipment = Equipment::find($selectedvalue);					
		// 	// 		$room->equipments()->attach($equipment->equipment_id);
		// 	// 	}
		// 	// }

		
		// }         
		//get saved info from fan profile
	    $errors         = array();      // array to hold validation errors
		$data           = array();      // array to pass back data

		// validate the variables ======================================================
		    // if any of these variables don't exist, add an error to our $errors array

		if (empty(Input::get('roomName')))
			$errors['roomName'] = 'Room Name is required';

		if (empty(Input::get('roomCapacity')))
			$errors['roomCapacity'] = 'Missing Capacity';

		if (empty(Input::get('venue')))
			$errors['venue'] = 'Venue is required';

		if (empty(Input::get('roomCost')))
			$errors['roomCost'] = 'Missing Room Cost';

		// return a response ===========================================================

		    // if there are any errors in our errors array, return a success boolean of false
		if ( ! empty($errors)) {

		        // if there are items in our errors array, return those errors
			$data['success'] = false;
			$data['errors']  = $errors;


		} else {

			$data['success'] = true;
			$data['redirect']  = '/laravel/public/room';			
			//do session store here
			//Session::put('message',$message);
			Session::put('edit', 'edit');

			$room = Room::find($id);
			$room->room_name = Input::get('roomName');
			$room->capacity = Input::get('roomCapacity');	            
			$room->venue_id = Input::get('venue');
			$room->rental_cost = Input::get('roomCost');
			$room->save();            

			//$room->equipments()->detach();
	            //$LastInsertId = $room->id;
			$SelectedValues = Input::get('SelectedValues');

			//dd(Equipment::where('equipment_name' , '=', 'Speaker')->select('equipment_id')->first());			
			// $pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";
			// $pieces = explode(" ", $pizza);
			// echo $pieces[0]; // piece1
			// echo $pieces[1]; // piece2

			$room2 = Room::find(4);

			foreach ($room2->equipments as $eq)
			{
				// var_dump($eq->pivot->quantity);
				// var_dump($eq->equipment_name);
				$eqCatName = EquipmentCategory::where('equipmentcategory_id' , '=', $eq->equipmentcategory_id)->Select('equipmentcategory_name')->first();				
				$fullName = $eqCatName->equipmentcategory_name." - ".$eq->equipment_name." - ".$eq->pivot->quantity;
				var_dump($fullName);
			}
			// if(!empty($SelectedValues))
			// {
			// 	foreach($SelectedValues as $SelectedValue)
			// 	{												
			// 		$breakDown = explode("-", $SelectedValue);			

			// 		$eName = trim($breakDown[1]);									
			// 		$eID = Equipment::where('equipment_name' , '=', $eName)->select('equipment_id')->first();
			// 		$eQty = $breakDown[2];						
			// 	    //echo $eQty;
			// 		//$room->equipments()->attach($eID);
			// 		// dd($equipment = Equipment::find($eID));					
			// 		$room->equipments()->attach($eID, array('quantity' => $eQty));
			// 	}
			// }

		}
		echo json_encode($data);

		    // return all our data to an AJAX call
		
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

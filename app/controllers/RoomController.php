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
		else if (Session::has('create'))
		{
			session::forget('create');
			Session::flash('message', 'Room Successfully Created!');
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
			'roomCost'      => 'required|Integer',	
			'venue' 				=>'required',
			);

        //run validation rules        
		$validation = Validator::make(Input::all(), $rules);

		if ( ! $validation->passes()) {
			$response_values = array(
				'validation_failed' => 1,
				'errors' => $validation->errors()->toArray());
			return Response::json($response_values);

		} 
		else {            

			$data['success'] = true;
			$data['redirect']  = '/laravel/public/room';			
			
			Session::put('create', 'create');

			$room = new room;
			$room->room_name = Input::get('roomName');
			$room->capacity = Input::get('roomCapacity');	            
			$room->venue_id = Input::get('venue');
			$room->rental_cost = Input::get('roomCost');
			$room->save();            
			
			$SelectedValues = Input::get('SelectedValues');			

			if(!empty($SelectedValues))
			{
				foreach($SelectedValues as $SelectedValue)
				{												
					$breakDown = explode("-", $SelectedValue);								
					$eID = Equipment::where('equipment_name' , '=', trim($breakDown[1]))->select('equipment_id')->first();					
					$room->equipments()->attach($eID, array('quantity' => $breakDown[2]));
				}
			}
			echo json_encode($data);
		}        

		// $rules = array(
		// 	'roomName'       => 'required',
		// 	'roomCapacity'      => 'required|Integer',			                      
		// 	'venue' 				=>'required',
		// 	);
		// $validator = Validator::make(Input::all(), $rules);

	 //        // process the login
		// if ($validator->fails()) {
		// 	return Redirect::to('room/create')
		// 	->withErrors($validator)
		// 	->withInput(Input::all());
		// } 	        
		// else {
	 //            // store	           
		// 	$room = new room;
		// 	$room->room_name = Input::get('roomName');
		// 	$room->capacity = Input::get('roomCapacity');	            
		// 	$room->venue_id = Input::get('venue');
		// 	$room->save();            

	 //            //$LastInsertId = $room->id;
		// 	$SelectedValues = Input::get('duallistbox_demo2');

		// 	if(!empty($SelectedValues))
		// 	{
		// 		foreach($SelectedValues as $Selectedvalue)
		// 		{					
		// 			$equipment = Equipment::find($Selectedvalue);					
		// 			$room->equipments()->attach($equipment->equipment_id);
		// 		}
		// 	}

	 //        // redirect
		// 	Session::flash('message', 'room Successfully Created!');
		// 	return Redirect::to('room');

		// }                    
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

		$eqfullname = Room::join('room_equipment', 'room.room_id', '=', 'room_equipment.room_id')
		->join('equipment', 'equipment.equipment_id', '=', 'room_equipment.equipment_id')
		->join('equipment_category', 'equipment.equipmentcategory_id', '=', 'equipment_category.equipmentcategory_id')
		->where('room.room_id', "=", $id)
		->selectRaw("concat_ws(' - ', equipment_category.equipmentcategory_name, equipment.equipment_name, room_equipment.quantity) as fullname")
		->lists('fullname');

		return View::make('room.edit')
		->with('venues', $venues)
		->with('equipments', $equipments)
		->with('room',$room)
		->with('eqfullname', $eqfullname);	
	}	


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{		 
		$rules = array(
			'roomName'       => 'required',
			'roomCapacity'      => 'required|Integer',			                      
			'roomCost'      => 'required|Integer',	
			'venue' 				=>'required',
			);

        //run validation rules        
		$validation = Validator::make(Input::all(), $rules);

		if ( ! $validation->passes()) {
			$response_values = array(
				'validation_failed' => 1,
				'errors' => $validation->errors()->toArray());
			return Response::json($response_values);

		} 
		else {            

			$data['success'] = true;
			$data['redirect']  = '/laravel/public/room';			
			
			Session::put('edit', 'edit');

			$room = Room::find($id);
			$room->room_name = Input::get('roomName');
			$room->capacity = Input::get('roomCapacity');	            
			$room->venue_id = Input::get('venue');
			$room->rental_cost = Input::get('roomCost');
			$room->save();            

			$room->equipments()->detach();
			$SelectedValues = Input::get('SelectedValues');			

			if(!empty($SelectedValues))
			{
				foreach($SelectedValues as $SelectedValue)
				{												
					$breakDown = explode("-", $SelectedValue);								
					$eID = Equipment::where('equipment_name' , '=', trim($breakDown[1]))->select('equipment_id')->first();					
					$room->equipments()->attach($eID, array('quantity' => $breakDown[2]));
				}
			}
			echo json_encode($data);
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

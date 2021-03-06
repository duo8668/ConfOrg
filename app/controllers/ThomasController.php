<?php		
			class ThomasController extends \BaseController {
			/**
			* Display a listing of the resource.
			*
			* @return Response
			*/
			public function index()
			{  	
				$privilege = false;				
				if(Auth::User()->hasSysRole('Admin'))
				{
					$venue = Venue::with('Rooms')->get();													
					$privilege = true;					
					// load the view and pass the venue				
					return View::make('venue.index')
					->with('venue', $venue)
					->with('privilege',$privilege);
				}
				else if(Auth::User()->hasSysRole('Resource Provider'))
				{
					$company_id = CompanyUser::where('user_id','=',Auth::user()->user_id)->pluck('company_id');
					$venue = Venue::with('Rooms','Pending')->where('company_id', $company_id)->get();
					$privilege = false;					
					// load the view and pass the venue				
					return View::make('venue.index')
					->with('venue', $venue)
					->with('privilege',$privilege);
				} else {
					return Redirect::to('/dashboard')->with('message', 'You do not have access to this page!');
				}	
				
			}

			public function pendingDeleteRequest($id)
			{							
				if(empty(Pending::where('venue_id','=',$id)->get()->toArray())) {										
					$pending = new Pending;
					$pending->venue_id = $id;
					$pending->user_id = Auth::user()->user_id;
					$pending->save();	
					return Redirect::back()->withMessage('Delete Request Submitted');				
				}
				else {
					//if request already existed, cancel the delete request!
					$pending = Pending::where('venue_id','=',$id);
        			$pending->delete();
        			return Redirect::back()->withMessage('Delete Request Cancelled');
				}								
			}

			public function modify($id)
			{
				$venue = Venue::find($id);
				if($venue->available == 'no')        		        				
				{
					$venue->available = 'yes';  
					Session::flash('message', 'The venue is now available!');
				}
				else        
				{
					$venue->available = 'no';  
					Session::flash('message', 'The venue is now unavailable!');
				}
				$venue->save();    
					//Redirect::back()->withMessage('Profile saved!')
				return Redirect::back();					
			}

			/**
			* Show the form for creating a new resource.
			*
			* @return Response
			*/
			public function create()
			{										
				if(Auth::User()->hasSysRole('Admin') || Auth::User()->hasSysRole('Resource Provider'))
				{
					return View::make('venue.create');	
				}
				else
				{
					return Redirect::to('/dashboard')->with('message', 'You do not have access to this page!');
				}
			}

			/**
			* Store a newly created resource in storage.
			*
			* @return Response
			*/
			public function store()
			{
				if(Input::get('Preview')) {		 	
					if($this->validateLocation(Input::get('venue_address'))==false)
					{
			//invalid address
						Session::flash('message', 'Invalid Address!');
						return Redirect::to('venue/create')            
						->withInput(Input::all());
					}
					else
					{					
						$map = $this->makeMap(Input::get('venue_address'));
						return Redirect::to('venue/create')            
						->withInput(Input::all())->with('map',$map);
					}

				} elseif(Input::get('Create')) {
			// validate
			// read more on validation at http://laravel.com/docs/validation
					$rules = array(
						'venue_name'       => 'required',
						'venue_address'      => 'required',            
						);
					$validator = Validator::make(Input::all(), $rules);

			// process the login
					if ($validator->fails()) {
						return Redirect::to('venue/create')
						->withErrors($validator)
						->withInput(Input::all());
					} 
					else if($this->validateLocation(Input::get('venue_address'))==false)
					{
			//invalid address
						Session::flash('message', 'Invalid Address!');
						return Redirect::to('venue/create')            
						->withInput(Input::all());
					}

					else {						
			// Store						
						list($lat, $lng, $error) = Gmaps::get_lat_long_from_address(Input::get('venue_address'));		
						$venue = new venue;
						$venue->venue_name = Input::get('venue_name');
						$venue->venue_address = Input::get('venue_address');
						$venue->latitude = $lat;
						$venue->longitude = $lng;          
						$venue->company_id = CompanyUser::where('user_id','=',Auth::user()->user_id)->pluck('company_id');
						$venue->created_by = Auth::user()->user_id;
						$venue->save();            

			// redirect
						Session::flash('message', 'Venue Successfully Created!');
						return Redirect::to('venue');
					} 
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
				if(Auth::User()->hasSysRole('Admin') || Auth::User()->hasSysRole('Resource Provider'))
				{
					$privilege = false;
					if(Auth::User()->hasSysRole('Admin'))
					{														
						$privilege = true;
					}				
					$venue = Venue::find($id);				
					$created_by = User::find($venue->created_by);				
					$modified_by = User::find($venue->modified_by);
					$geoLocation = $venue->latitude.' , '.$venue->longitude;        

					$config['center'] = $geoLocation;
					$config['zoom'] = 'auto';
					Gmaps::initialize($config);

					$marker = array();
					$marker['position'] = $geoLocation;
					Gmaps::add_marker($marker);
					$map = Gmaps::create_map();		

					$data  = Room::with('Pending')->where('venue_id','=',$id)->get();				

			// show the view and pass the venue to it
					return View::make('venue.show')
					->with('venue', $venue)
					->with('data',$data)
					->with('map',$map)
					->with('privilege',$privilege)
					->with('created_By',$created_by)
					->with('modified_By',$modified_by);
				}
				else
				{
					return Redirect::to('/dashboard')->with('message', 'You do not have access to this page!');
				}
				// get the venue
				
			}


			/**
			* Show the form for editing the specified resource.
			*
			* @param  int  $id
			* @return Response
			*/
			public function edit($id)
			{
				if(Auth::User()->hasSysRole('Admin') || Auth::User()->hasSysRole('Resource Provider'))
				{
					$venue = Venue::find($id);
					// show the edit form and pass the venue
					return View::make('venue.edit')
					->with('venue', $venue);
				}
				else
				{
					return Redirect::to('/dashboard')->with('message', 'You do not have access to this page!');
				}
			}


			/**
			* Update the specified resource in storage.
			*
			* @param  int  $id
			* @return Response
			*/
			public function update($id)
			{		 
				if(Input::get('Preview')) {		 	
					if($this->validateLocation(Input::get('venue_address'))==false)
					{
			//invalid address
						Session::flash('message', 'Invalid Address!');
						return Redirect::to('venue/' .$id. '/edit')            
						->withInput(Input::all());
					}
					else
					{
						$map = $this->makeMap(Input::get('venue_address'));				
						return Redirect::to('venue/' .$id. '/edit')->withInput(Input::all())->with('map',$map);
					}

				} elseif(Input::get('Edit')) {
			// validate
			// read more on validation at http://laravel.com/docs/validation
					$rules = array(
						'venue_name'       => 'required',
						'venue_address'      => 'required',            
						);
					$validator = Validator::make(Input::all(), $rules);

			// process the login
					if ($validator->fails()) {
						return Redirect::to('venue/' .$id. '/edit')
						->withErrors($validator)
						->withInput(Input::all());	            
					} 
					else if($this->validateLocation(Input::get('venue_address'))==false)
					{
			//invalid address
						Session::flash('message', 'Invalid Address!');
						return Redirect::to('venue/edit')            
						->withInput(Input::all());
					}

					else {
			// store
						$venue = Venue::find($id);        		        
						list($lat, $lng, $error) = Gmaps::get_lat_long_from_address(Input::get('venue_address'));			        	
						$venue->venue_name = Input::get('venue_name');
						$venue->venue_address = Input::get('venue_address');
						$venue->latitude = $lat;
						$venue->longitude = $lng;   
						$venue->modified_by = Auth::user()->user_id;
						$venue->save();       

			// redirect
						Session::flash('message', 'Venue Successfully Updated!');
						return Redirect::to('venue');
					} 
				}}

			/**
			* Remove the specified resource from storage.
			*
			* @param  int  $id
			* @return Response
			*/
			public function destroy($id)
			{		
				$venue = Venue::find($id);
				$venue->delete();
				Session::flash('message', 'Successfully deleted the Venue!');
				return Redirect::to('venue');
			}

			public function validateLocation($venueAddress)
			{	
				list($lat, $lng, $error) = Gmaps::get_lat_long_from_address($venueAddress);		
				$geoLocation = ((string) $lat).' , '.((string) $lng);

				if($geoLocation != '0 , 0')
				{
					return $geoLocation;
				}
				else
				{
					return false;
				}
			}

			public function makeMap($venueAddress)
			{
				list($lat, $lng, $error) = Gmaps::get_lat_long_from_address($venueAddress);		
				$geoLocation = ((string) $lat).' , '.((string) $lng);

				$config['center'] = $geoLocation;
				$config['zoom'] = 'auto';
				Gmaps::initialize($config);

				$marker = array();
				$marker['position'] = $geoLocation;
				Gmaps::add_marker($marker);
				$map = Gmaps::create_map();	

				return $map;
			}

			public function import()
			{				
				if(Auth::User()->hasSysRole('Admin') || Auth::User()->hasSysRole('Resource Provider'))
				{
					return View::make('import');
				}
				else
				{
					return Redirect::to('/dashboard')->with('message', 'You do not have access to this page!');
				}
			}

			public static $valid =true;
						

			public function importData()
			{				
				if(Auth::User()->hasSysRole('Admin') || Auth::User()->hasSysRole('Resource Provider'))
				{
					if(Input::get('Export')) {
						$this->exportTemplate();
						Session::flash('message', 'Successful!');
						return Redirect::to('import');		
					}
					elseif(Input::get('Preview'))
					{										
						$rules = array(						
							'venue_name'       => 'required|unique:venue',
							'venue_address'      => 'required',            
							);
						$validator = Validator::make(Input::all(), $rules);

						if ($validator->fails()) {											
							return Redirect::to('import')
							->withErrors($validator)
							->withInput(Input::all());	
						}

						else if(!$this->validateLocation(Input::get('venue_address')))
						{																
							Session::flash('message2', 'Invalid Address!');
							return Redirect::to('import')            
							->withInput(Input::all());
						}

						else {
						// store
							$map = $this->makeMap(Input::get('venue_address'));				
							return Redirect::to('import')            
							->withInput(Input::all())->with('map',$map);
						} 	
					}
					elseif(Input::get('Import')){
					//dd(Input::all())					

						$rules = array(
							'venue_name'       => 'required|unique:venue',
							'venue_address'      => 'required',
							'imported_File'            => 'required|mimes:xlsx,xls',
							);					

						$validator = Validator::make(Input::all(), $rules);					
						if ($validator->fails()) {					
							$map = $this->makeMap(Input::get('venue_address'));
							return Redirect::to('import')
							->withErrors($validator)
							->withInput(Input::except('imported_File'))
							->with('map',$map);	
						}

						else if(!$this->validateLocation(Input::get('venue_address')))
						{																
							Session::flash('message2', 'Invalid Address!');
							return Redirect::to('import')            
							->withInput(Input::all());
						}

						else 
						{
							$file = Input::file('imported_File');					
							$name = time() . '-' . $file->getClientOriginalName();
						//$name = preg_replace("/\([^)]+\)/","",$name);
							$file = $file->move(public_path().'/laravel/public/Excel', $name); 

							if (strpos($name,'Venue-Room Details') === false) {
								echo 'Invalid File Name. Please download and import the template Venue-Room Details.xlsx provided.';
							}		
							else 
							{ 										
								$allError = $this->validateExcel($file);							
								$numError = count($allError);
								if($numError!=0)
								{							
									return View::make('venue.importError')->with('allError',$allError) ->with('numError',$numError);	
								}
								else if($numError == 0)
								{																				
								// $eq = EquipmentCategory::where('equipmentcategory_name','=','Logistics')->first()->equipmentcategory_id;
								// dd($eq);

									$results = Excel::load($file)->all();
									$roomCount = sizeof($results[0]);//number of row in the Rooms sheet //example 2							
									$roomEquipmentCount = sizeof($results[1]);//number of row in the Room Equipment sheet //example 3									
									//room									
									//database records									
									//only same equipmentName and Remarks can pass the validation screening
									

									list($lat, $lng, $error) = Gmaps::get_lat_long_from_address(Input::get('venue_address'));
									$venue = new Venue;
									$venue->venue_name = Input::get('venue_name');
									$venue->venue_address = Input::get('venue_address');
									$venue->latitude = $lat;
									$venue->longitude = $lng;
									$venue->created_by = Auth::user()->user_id;
									$venue->company_id = CompanyUser::where('user_id','=',Auth::user()->user_id)->pluck('company_id');      
									$venue->save();    

									for($i = 0; $i < $roomCount; ++$i)
									{										
										$room = new Room;
										$room->room_name = $results[0][$i]['room_name'];
										$room->capacity = $results[0][$i]['room_capacity'];
										$room->venue_id = $venue->venue_id;
										$room->rental_cost = $results[0][$i]['room_cost'];
										$room->created_by = Auth::user()->user_id;
										$room->save();    											
									}						

									for($i = 0; $i < $roomEquipmentCount; ++$i)
									{														
										//iF(!inarray)
										$eCatID = 0;
										$eID = 0;
										$equipmentName = strtolower($results[1][$i]['equipment_name']);										
//										if(!in_array(array($equipmentName), $currentEquipmentNameList))//if not in the database
//										{								
										$equipmentcategorycurrent = EquipmentCategory::where('equipmentcategory_name','=',$results[1][$i]['equipment_category'])->first();
										$equipmentcurrent = Equipment::where('equipment_name','=',$results[1][$i]['equipment_name'])->first();
											//add or ignore category
											if(is_null($equipmentcategorycurrent)) {
												$equipmentcategory = new EquipmentCategory;
												$equipmentcategory->equipmentcategory_name = $results[1][$i]['equipment_category']; 
												$equipmentcategory->created_by=Auth::user()->user_id;
												$equipmentcategory->save();
												$eCatID = $equipmentcategory->equipmentcategory_id;

												$pending = new Pending();
												$pending->user_id = Auth::user()->user_id;
												$pending->equipmentcategory_id = $equipmentcategory->equipmentcategory_id;
												$pending->save();
											}	
											else {
												$eCatID = $equipmentcategorycurrent->equipmentcategory_id;
											}
											//add or ignore equipment
											if(is_null($equipmentcurrent)) {
												$equipment = new Equipment;
												$equipment->equipment_name = $results[1][$i]['equipment_name'];
												$equipment->equipment_remark = $results[1][$i]['equipment_remarks'];
												$equipment->created_by=Auth::user()->user_id;												
												$equipment->equipmentcategory_id = $eCatID;
												$equipment->save();    																																			
												$eID = $equipment->equipment_id;

												$pending = new Pending();
												$pending->user_id = Auth::user()->user_id;
												$pending->equipment_id = $eID;
												$pending->save();
											}
											else
											{
												//attach the equipment id to something
												$eID = $equipmentcurrent->equipment_id;
											}											
										//}

										$room = Room::where('venue_id','=',$venue->venue_id)->where('room_name','=',$results[1][$i]['room_name'])->first();										
										$room->equipments()->attach($eID, array('quantity' => $results[1][$i]['quantity']));															
									}

									
									return Redirect::to('venue');
								}
							}
						}
					}
				}
				else
				{
					return Redirect::to('/dashboard')->with('message', 'You do not have access to this page!');
				}
			}

	public function exportTemplate()
	{
		Excel::create('Venue-Room Details', function($excel) {

						$excel->sheet('Rooms', function($sheet) {				

							$sheet->row(1, array(
								'Room Name', 'Room Capacity', 'Room Cost', 'Remarks'
								));			

							$sheet->row(2, array(
								'Conference Room A', '80', '650', 'This is a VIP room'
								));			

							$sheet->cells('A1:D1', function($cells) {
									// manipulate the range of cells
								$cells->setBackground('#E5E5E5');
								$cells->setFontWeight('bold');	
								$cells->setAlignment('center');				
								$cells->setFontFamily('Arial Narrow');	
								$cells->setFontSize(12);
							});

							$sheet->cells('A2:D2', function($cells) {
									// manipulate the range of cells
								$cells->setFontColor('#E01D1D');
								$cells->setAlignment('left');
								$cells->setFontFamily('Arial Narrow');	
								$cells->setFontSize(12);
							});

							$sheet->setWidth(array(
								'A'     =>  30,
								'B'     =>  15,
								'C'     =>  30,
								'D'     =>  50
								));
							$sheet->setBorder('A1:D1', 'thin');		
							$sheet->setStyle(array(
								'font' => array(
									'name'      =>  'Arial Narrow',
									'size'      =>  12,						
									)
								));						
						});

					$excel->sheet('Room Equipments', function($sheet) {				

						$sheet->row(1, array(
							'Room Name', 'Equipment Category', 'Equipment Name', 'Quantity', 'Equipment Remarks'
							));			

						$sheet->row(2, array(
							'Conference Room A', 'Logistic', 'Conference Round Table', '650', 'This is a VIP room'
							));			

						$sheet->cells('A1:E1', function($cells) {

					    			// manipulate the range of cells
							$cells->setBackground('#E5E5E5');
							$cells->setFontWeight('bold');
							$cells->setAlignment('center');				
						});

						$sheet->cells('A2:E2', function($cells) {
					   				// manipulate the range of cells
							$cells->setFontColor('#E01D1D');
							$cells->setAlignment('left');	
							$cells->setFontFamily('Arial Narrow');	
						});

						$sheet->setWidth(array(
							'A'     =>  30,
							'B'     =>  30,
							'C'     =>  30,
							'D'     =>  15,
							'E'		=>  50
							));
						$sheet->setBorder('A1:D1', 'thin');								
						$sheet->setStyle(array(
							'font' => array(
								'name'      =>  'Arial Narrow',
								'size'      =>  12,						
								)
							));						
					});	

				})->download('xlsx');
	}
	public function validateExcel($file)
	{		
			$allError = [];
			$roomList = [];
			$roomEquipmentList = [];
									
			$results = Excel::load($file)->all();			
			$firstrow = $results->first()->toArray();	
			$secondrow = $results[1]->first()->toArray();				
						
			if (count($results) != 2) { //check number of worksheet
					echo 'Invalid Number of Worksheet. Please download and import the template Venue-Room Details.xlsx provided. <br />';	
					self::$valid = false;    							 		
			}

			if(self::$valid) {
				if($results[0]->getTitle()!=='Rooms' or $results[1]->getTitle()!=='Room Equipments')
				{					
					echo "Invalid Sheet Name: Did you edit any of the exel worksheet name?";
					self::$valid = false;	
				}
			}

			if(self::$valid)
			{
				if(!array_key_exists('room_name', $firstrow[0]) or !array_key_exists('room_capacity', $firstrow[0]) or !array_key_exists('room_cost', $firstrow[0]) or !array_key_exists('remarks', $firstrow[0])){											
					echo 'Header got problem!';
					self::$valid = false;	
				}	
			}			  

			if(self::$valid)
			{
				if(!array_key_exists('room_name', $secondrow) or !array_key_exists('equipment_category', $secondrow) or !array_key_exists('equipment_name', $secondrow) or !array_key_exists('quantity', $secondrow) or !array_key_exists('equipment_remarks', $secondrow)){											
					echo 'Header got problem!';
					self::$valid = false;	
				}	
			}

			if(self::$valid)
			{
				$roomCount = sizeof($results[0]);//number of row in the Rooms sheet //example 2							
				$roomEquipmentCount = sizeof($results[1]);//number of row in the Room Equipment sheet //example 3	
				if($roomCount == 0 && $roomEquipmentCount == 0){											
					echo 'There are no data to be imported';
					self::$valid = false;	
				}
				else if($roomCount == 00)
				{
					echo 'There are room data to be imported';
					self::$valid = false;		
				}
			}																			

			if(self::$valid)
			{																					
				for($i = 0; $i < $roomCount; ++$i)
				{										
					$emptyRow = false; 						
					$roomName = $results[0][$i]['room_name'];						
					$roomCapacity = $results[0][$i]['room_capacity'];
					$roomCost = $results[0][$i]['room_cost'];
					$remarks = $results[0][$i]['remarks'];
					$i2 = $i+1;										

					if(empty($roomName) && empty($roomCapacity) && empty($roomCost) && empty($remarks))
					{										
						$emptyRow = true;																							
					}
					if($emptyRow!=true)
					{
						if(!empty($roomName))
						{						
							if(count($roomList)>0)
							{							
								if($this->ifRoomExist($roomList,$roomName))
								// if(in_array(strtolower($roomName), $roomList[0]))
								{
									$allError[] = array('Sheet'=>'Excel Sheet: '.$results[0]->getTitle(),'column'=>'Room Name','Row'=>'Row: '.$i2, 'error'=>"Identical Room Name is not allowed: '{$roomName}'' is repeated");				
								}
								else
								$roomList[] = array(strtoLower($roomName));																	
							}
							else
							$roomList[] = array(strtoLower($roomName));																	
						}
						else
						{
							$allError[] = array('Sheet'=>'Excel Sheet: '.$results[0]->getTitle(),'column'=>'Room Name','Row'=>'Row: '.$i2, 'error'=>'Cell is empty, please provide the relevant information');											
						}

						if(empty($roomCapacity))
						{												
							$allError[] = array('Sheet'=>'Excel Sheet: '.$results[0]->getTitle(),'column'=>'Room Capacity','Row'=>'Row: '.$i2, 'error'=>'Cell is empty, please provide the relevant information');
						}
						else if(!is_numeric($roomCapacity))
						{
							$allError[] = array('Sheet'=>'Excel Sheet: '.$results[0]->getTitle(),'column'=>'Room Capacity','Row'=>'Row: '.$i2, 'error'=>"Input '{$roomCapacity}' is NOT a valid numeric input");				
						}
						else
						{
							//echo $i2.':'.$roomCapacity.'<br />';
						}

						if(empty($roomCost))
						{																							
							$allError[] = array('Sheet'=>'Excel Sheet: '.$results[0]->getTitle(),'column'=>'Room Cost','Row'=>'Row: '.$i2, 'error'=>'Cell is empty, please provide the relevant information');
						}
						else if(!is_numeric($roomCost))
						{																					

							$allError[] = array('Sheet'=>'Excel Sheet: '.$results[0]->getTitle(),'column'=>'Room Cost','Row'=>'Row: '.$i2, 'error'=>"Input '{$roomCost}' is NOT a valid numeric input");

						}
						else
						{
							//echo $i2.':'.$roomCost.'<br />';
						}

						if(!empty($remarks))
						{
							//echo 'Remarks '.$i2.':'.$remarks.'<br />';
						}
						else
						{											
							$allError[] = array('Sheet'=>'Excel Sheet: '.$results[0]->getTitle(),'column'=>'Remarks','Row'=>'Row: '.$i2, 'error'=>'Cell is empty, please provide the relevant information');
						}
					}
				}				

				if(self::$valid && $roomEquipmentCount!=0)
				{
					for($i = 0; $i < $roomEquipmentCount; ++$i)
					{										
						$emptyRow = false; 						
						$roomName = $results[1][$i]['room_name'];						
						$equipmentCategory = $results[1][$i]['equipment_category'];
						$equipmentName = $results[1][$i]['equipment_name'];
						$quantity = $results[1][$i]['quantity'];
						$equipmentRemarks = $results[1][$i]['equipment_remarks'];
						$i2 = $i+1;	

						$currentEquipmentList = Equipment::get(array('equipment_name','equipment_remark'))->toArray();	
						$currentEquipmentNameList = Equipment::get(array('equipment_name'))->toArray();	

						foreach($currentEquipmentList as &$value)
						{
							$value['equipment_name'] = strtolower($value['equipment_name']);  									
							$value['equipment_remark'] = strtolower($value['equipment_remark']);  									
						}			  						
						foreach($currentEquipmentNameList as &$value)
						{
							$value['equipment_name'] = strtolower($value['equipment_name']);  																
						}				  						

						if(empty($roomName) && empty($equipmentCategory) && empty($equipmentName) && empty($quantity) && empty($equipmentRemarks))
						{										
							$emptyRow = true;										
							$allError[] = array('Sheet'=>'Excel Sheet: '.$results[1]->getTitle(),'column'=>'Entire Row','Row'=>'Row: '.$i2, 'error'=>'Empty Row');											
						}
						if($emptyRow!=true)
						{
							if(!empty($roomName))
							{								
								//validate if room name exist on the Room Sheet		
								if(!$this->ifRoomExist($roomList,$roomName))
								//if(!in_array(strtolower($roomName), $roomList[0]))
								{									
									$allError[] = array('Sheet'=>'Excel Sheet: '.$results[1]->getTitle(),'column'=>'Room Name','Row'=>'Row: '.$i2, 'error'=>"Invalid Room Name: The room name: {$roomName} does not exist on the Rooms Worksheet, please rename or include the room on the worksheet.");
								}
							}
							else
							{
								$allError[] = array('Sheet'=>'Excel Sheet: '.$results[1]->getTitle(),'column'=>'Room Name','Row'=>'Row: '.$i2, 'error'=>'Cell is empty, please provide the relevant information');											
							}

							if(empty($equipmentCategory))
							{												
								$allError[] = array('Sheet'=>'Excel Sheet: '.$results[1]->getTitle(),'column'=>'Equipment Category','Row'=>'Row: '.$i2, 'error'=>'Cell is empty, please provide the relevant information');
							}							
							else
							{
								//echo $i2.':'.$equipmentCategory.'<br />';
							}

							if(empty($equipmentName))
							{																							
								$allError[] = array('Sheet'=>'Excel Sheet: '.$results[1]->getTitle(),'column'=>'Equipment Name','Row'=>'Row: '.$i2, 'error'=>'Cell is empty, please provide the relevant information');
							}							
							else
							{																
								if(!empty($roomName))
								{																	
									$roomName2 = strtolower($roomName);									
									$equipmentName2 = strtolower($equipmentName);																											
									$alreadyExist = false;									

									if(!empty($roomName2) && !empty($equipmentRemarks))
									{																		
										$remarks2 = strtolower($equipmentRemarks);																				
										if(!in_array(array('equipment_name'=>$equipmentName2,'equipment_remark'=>$remarks2), $currentEquipmentList)){																						

											if(in_array(array('equipment_name'=>$equipmentName2), $currentEquipmentNameList))
											{
												for($i = 0; $i < count($currentEquipmentList); ++$i)
												{
													if($currentEquipmentList[$i]['equipment_name']==$equipmentName2)
													{
														$allError[] = array('Sheet'=>'Excel Sheet: '.$results[1]->getTitle(),'column'=>'Equipment Name','Row'=>'Row: '.$i2, 'error'=>"Overriding is not allowed: Equipment {$equipmentName} has already exist in the database with the remark '{$currentEquipmentList[$i]['equipment_remark']}' ");
													}
												}
											}
										}
										else
										{
											$alreadyExist = true;											
										}										
									}
									if($alreadyExist){									
										if(count($roomEquipmentList)>0)
										{										
											if (in_array(array($roomName2,$equipmentName2), $roomEquipmentList))										
											{																						
												$allError[] = array('Sheet'=>'Excel Sheet: '.$results[1]->getTitle(),'column'=>'Equipment Name','Row'=>'Row: '.$i2, 'error'=>"Identical Equipment Name is not allowed: '{$equipmentName}'' is repeated");				
											}																				
											else
											{
												$roomEquipmentList[] = array($roomName2,$equipmentName2);	
											}
										}								
										else
											$roomEquipmentList[] = array($roomName2,$equipmentName2);	
									}
									
								}								
							}

							if(empty($quantity))
							{
								//echo 'quantity '.$i2.':'.$quantity.'<br />';
								$allError[] = array('Sheet'=>'Excel Sheet: '.$results[1]->getTitle(),'column'=>'Quantity','Row'=>'Row: '.$i2, 'error'=>'Cell is empty, please provide the relevant information');
							}
							else if(!is_numeric($quantity))
							{																					
								$allError[] = array('Sheet'=>'Excel Sheet: '.$results[1]->getTitle(),'column'=>'Quantity','Row'=>'Row: '.$i2, 'error'=>"Input '{$quantity}' is NOT a valid numeric input");
							}
							else
							{											
										
							}

							if(empty($equipmentRemarks))
							{																							
								$allError[] = array('Sheet'=>'Excel Sheet: '.$results[1]->getTitle(),'column'=>'Equipment Remarks','Row'=>'Row: '.$i2, 'error'=>'Cell is empty, please provide the relevant information');
							}							
							else
							{
								//echo $i2.':'.$roomCost.'<br />';
							}
						}
					}
				}
			}			
		return $allError;
	}

	public function ifRoomExist($array, $value)
	{
		// if(in_array(strtolower($roomName), $roomList[0]))
		$value = strtolower($value);
		$exist = false;
		foreach($array as $array)
		{
			if(in_array($value, $array))
			{				
				$exist = true;
				break;
			}
		}
		return $exist;
	}
}					
?>
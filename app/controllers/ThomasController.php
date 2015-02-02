<?php		
			class ThomasController extends \BaseController {
			/**
			* Display a listing of the resource.
			*
			* @return Response
			*/
			public function index()
			{  	
				$venue = Venue::all();
			// load the view and pass the venue
				return View::make('venue.index')
				->with('venue', $venue);
			}


			/**
			* Show the form for creating a new resource.
			*
			* @return Response
			*/
			public function create()
			{			
				return View::make('venue.create');
			}

			/**
			* Store a newly created resource in storage.
			*
			* @return Response
			*/
			public function store()
			{
				if(Input::get('Preview')) {		 	
					if($this->validateLocation(Input::get('venueAddress'))==false)
					{
			//invalid address
						Session::flash('message', 'Invalid Address!');
						return Redirect::to('venue/create')            
						->withInput(Input::all());
					}
					else
					{					
						$map = $this->makeMap(Input::get('venueAddress'));
						return Redirect::to('venue/create')            
						->withInput(Input::all())->with('map',$map);
					}

				} elseif(Input::get('Create')) {
			// validate
			// read more on validation at http://laravel.com/docs/validation
					$rules = array(
						'venueName'       => 'required',
						'venueAddress'      => 'required',            
						);
					$validator = Validator::make(Input::all(), $rules);

			// process the login
					if ($validator->fails()) {
						return Redirect::to('venue/create')
						->withErrors($validator)
						->withInput(Input::all());
					} 
					else if($this->validateLocation(Input::get('venueAddress'))==false)
					{
			//invalid address
						Session::flash('message', 'Invalid Address!');
						return Redirect::to('venue/create')            
						->withInput(Input::all());
					}

					else {
			// store
						list($lat, $lng, $error) = Gmaps::get_lat_long_from_address(Input::get('venueAddress'));		
						$venue = new venue;
						$venue->venue_name = Input::get('venueName');
						$venue->venue_address = Input::get('venueAddress');
						$venue->latitude = $lat;
						$venue->longitude = $lng;          
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
			// get the venue
				$venue = Venue::find($id);
				$geoLocation = $venue->latitude.' , '.$venue->longitude;        

				$config['center'] = $geoLocation;
				$config['zoom'] = 'auto';
				Gmaps::initialize($config);

				$marker = array();
				$marker['position'] = $geoLocation;
				Gmaps::add_marker($marker);
				$map = Gmaps::create_map();						    	
			// show the view and pass the venue to it
				return View::make('venue.show')
				->with('venue', $venue)
				->with('map',$map);
			}


			/**
			* Show the form for editing the specified resource.
			*
			* @param  int  $id
			* @return Response
			*/
			public function edit($id)
			{
			// get the nerd
				$venue = Venue::find($id);
			// show the edit form and pass the venue
				return View::make('venue.edit')
				->with('venue', $venue);
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
					if($this->validateLocation(Input::get('venueAddress'))==false)
					{
			//invalid address
						Session::flash('message', 'Invalid Address!');
						return Redirect::to('venue/' .$id. '/edit')            
						->withInput(Input::all());
					}
					else
					{
						$map = $this->makeMap(Input::get('venueAddress'));				
						return Redirect::to('venue/' .$id. '/edit')->withInput(Input::all())->with('map',$map);
					}

				} elseif(Input::get('Edit')) {


			// validate
			// read more on validation at http://laravel.com/docs/validation
					$rules = array(
						'venueName'       => 'required',
						'venueAddress'      => 'required',            
						);
					$validator = Validator::make(Input::all(), $rules);

			// process the login
					if ($validator->fails()) {
						return Redirect::to('venue/' .$id. '/edit')
						->withErrors($validator)
						->withInput(Input::all());	            
					} 
					else if($this->validateLocation(Input::get('venueAddress'))==false)
					{
			//invalid address
						Session::flash('message', 'Invalid Address!');
						return Redirect::to('venue/edit')            
						->withInput(Input::all());
					}

					else {
			// store
						$venue = Venue::find($id);        		        
						list($lat, $lng, $error) = Gmaps::get_lat_long_from_address(Input::get('venueAddress'));			        	
						$venue->venue_name = Input::get('venueName');
						$venue->venue_address = Input::get('venueAddress');
						$venue->latitude = $lat;
						$venue->longitude = $lng;          
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
			// redirect
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

			public function about()
			{
				return View::make('test');
			}

			public static $valid =true;
						

			public function download()
			{				
				if(Input::get('Export')) {
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
				Session::flash('message', 'Successful!');
				return Redirect::to('about');		
				}
				elseif(Input::get('Preview'))
				{
					$rules = array(
						'venueName'       => 'required',
						'venueAddress'      => 'required',            
						);
					$validator = Validator::make(Input::all(), $rules);

					if ($validator->fails()) {					
						if(!empty($venueAddress))
						{
							if($this->validateLocation($venueAddress)==false)
							{
								Session::flash('message', 'Invalid!');
								return Redirect::to('about')
								->withErrors($validator)            
								->withInput(Input::all());					
							}
							else
							{
								return Redirect::to('about')
								->withErrors($validator)
								->withInput(Input::all());				
							}									
						}
						else
						{
							return Redirect::to('about')
							->withErrors($validator)
							->withInput(Input::all());	
						}
					}

					else if($this->validateLocation(Input::get('venueAddress'))==false)
					{			
													//invalid address
						Session::flash('message', 'Invalid Address!');
						return Redirect::to('about')            
						->withInput(Input::all());
					}

					else {
													// store
						$map = $this->makeMap(Input::get('venueAddress'));				
						return Redirect::to('about')            
						->withInput(Input::all())->with('map',$map);
					} 	
				}
				elseif(Input::get('Import')){
				
					if (Input::hasFile('excel'))
					{
						$file = Input::file('excel');					
						$name = time() . '-' . $file->getClientOriginalName();
				//$name = preg_replace("/\([^)]+\)/","",$name);
						$file = $file->move(public_path().'/laravel/public/Excel', $name); 

						if (strpos($name,'Venue-Room Details') === false) {
							echo 'Invalid File Name. Please download and import the template Venue-Room Details.xlsx provided.';
						}		
						else 
						{

							Excel::load($file, function($reader) {					
							$results = $reader->all();													
							$roomCount = sizeof($results[0]);//number of row in the Rooms sheet //example 2							
							$roomEquipmentCount = sizeof($results[1]);//number of row in the Room Equipment sheet //example 3							
							$firstrow = $reader->first()->toArray();
				
							if (count($results) != 2) { //check number of worksheet
								echo 'Invalid Number of Worksheet. Please download and import the template Venue-Room Details.xlsx provided. <br />';	
								self::$valid = false;    							 		
							}  
							
							if(self::$valid==true) {
								if($results[0]->getTitle()!=='Rooms' or $results[1]->getTitle()!=='Room Equipments')
								{					
									echo "Invalid Sheet Name: Did you edit the worksheet name?";											
									self::$valid = false;	
								}
							}
							
							if(self::$valid==true)
							{
								if(!array_key_exists('room_name', $firstrow[0]) or !array_key_exists('room_capacity', $firstrow[0]) or !array_key_exists('room_cost', $firstrow[0]) or !array_key_exists('remarks', $firstrow[0])){											
									echo 'Header got problem!';
									self::$valid = false;	
								}	
							}
							
							if(self::$valid==true)
							{
								if($roomCount == 0 && $roomEquipmentCount == 0){											
									echo 'There are no data to input';
									self::$valid = false;	
								}	
							}									
							
							if(self::$valid==true)
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
										echo 'Worksheet '.$results[0]->getTitle().': Row '.$i2. ' - Is Empty <br />';
									}
									if($emptyRow!=true)
									{
										if(!empty($roomName))
										{
											echo 'Room Name '.$i2.':'.$roomName.'<br />';
										}
										else
										{
											echo 'Worksheet '.$results[0]->getTitle().': Row '.$i2. ' - Column Room Name is empty, please provide the relevant information <br />';
										}

										if(empty($roomCapacity))
										{												
											echo 'Worksheet '.$results[0]->getTitle().': Row '.$i2. ' - Column Room Capacity is empty, please provide the relevant information <br />';
										}
										else if(!is_numeric($roomCapacity))
										{												
											echo $results[0]->getTitle().': Row '.$i2. " -Column Room Capacity '{$roomCapacity}' is NOT numeric", PHP_EOL;												
											echo '<br />';
										}
										else
										{
											echo $i2.':'.$roomCapacity.'<br />';
										}


										if(empty($roomCost))
										{												
											echo 'Worksheet '.$results[0]->getTitle().': Row '.$i2. ' - Column Room Cost is empty, please provide the relevant information <br />';
										}
										else if(!is_numeric($roomCost))
										{																					
											echo $results[0]->getTitle().': Row '.$i2. " -Column Room Cost '{$roomCost}' is NOT numeric", PHP_EOL;												
											echo '<br />';
										}
										else
										{
											echo $i2.':'.$roomCost.'<br />';
										}

										if(!empty($remarks))
										{
											echo 'Remarks '.$i2.':'.$remarks.'<br />';
										}
										else
										{											
											echo 'Worksheet '.$results[0]->getTitle().': Row '.$i2. ' - Column Remarks is empty, please provide the relevant information <br />';
										}
									}
								}							
							}	
						}); 

				}
			}
		}
	}			
}					
?>

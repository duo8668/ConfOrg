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
	        		list($lat, $lng, $error) = Gmaps::get_lat_long_from_address(Input::get('venueAddress'));		
					$geoLocation = ((string) $lat).' , '.((string) $lng);

	        		$config['center'] = $geoLocation;
					$config['zoom'] = 'auto';
					Gmaps::initialize($config);
					
					$marker = array();
					$marker['position'] = $geoLocation;
					Gmaps::add_marker($marker);
					$map = Gmaps::create_map();						
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
	            $venue->name = Input::get('venueName');
	            $venue->address = Input::get('venueAddress');
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
	        		list($lat, $lng, $error) = Gmaps::get_lat_long_from_address(Input::get('venueAddress'));		
					$geoLocation = ((string) $lat).' , '.((string) $lng);

	        		$config['center'] = $geoLocation;
					$config['zoom'] = 'auto';
					Gmaps::initialize($config);
					
					$marker = array();
					$marker['position'] = $geoLocation;
					Gmaps::add_marker($marker);
					$map = Gmaps::create_map();											
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
	            $venue->name = Input::get('venueName');
	            $venue->address = Input::get('venueAddress');
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

	
	public function venue2()
	{
		$data = Input::all();		
		$errorMessage='';
		$map='';				

		if(!empty($data))
		{
			$venueName = $data['venueName'];
			$venueAddress = $data['venueAddress'];	

			list($lat, $lng, $error) = Gmaps::get_lat_long_from_address($venueAddress);		
			$geoLocation = ((string) $lat).' , '.((string) $lng);

			if($geoLocation != '0 , 0')
			{				
				$config['center'] = $geoLocation;
				$config['zoom'] = 'auto';
				Gmaps::initialize($config);
				
				$marker = array();
				$marker['position'] = $geoLocation;
				Gmaps::add_marker($marker);
				$map = Gmaps::create_map();	

				$venue = new venue;
	            $venue->name = Input::get('venueName');
	            $venue->address = Input::get('venueAddress');
	            $venue->latitude = $lat;
	            $venue->longitude = $lng;			

	            $venue->save();
	            $errorMessage = 'Venue Successfully Created!';
			}
			else
			{
				$errorMessage = 'Invalid Address!';
			}
			
		}
		else
		{
			$venueName = 'Type the name of the venue here...';
			$venueAddress = 'Type the address of the venue here...';		
			$errorMessage = 'Invalid Address!';
		}	

		//if map is valid


		return View::make('venue2')->with('venueName',$venueName)->with('venueAddress', $venueAddress)->with('errorMessage',$errorMessage)->with('map',$map);	
	}
}

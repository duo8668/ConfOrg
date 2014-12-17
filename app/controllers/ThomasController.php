<?php

class ThomasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
	}

	public function home()
	{
		return View::make('hello');
	}

	public function about()
	{
		return View::make('about');
	}

	public function venue2()
	{
		return View::make('venue2');
	}

	public function venue()
	{

		$data = Input::all();
		$randomText = "";
		$address = 'Singapore 528788';		
		if(!empty($data))
		{
			$randomText = $data['randomText'];
			$address = $randomText;
		}

		
		list($lat, $lng, $error) = Gmaps::get_lat_long_from_address($address);		

		$str1 = ((string) $lat);
		$str2 = ' , '; 
		$str3 = ((string) $lng);
		$geoLocation = $str1.$str2.$str3;

		$invalid = '0 , 0';
		if($geoLocation == $invalid)
		{
			list($lat, $lng, $error) = Gmaps::get_lat_long_from_address('Japan');		
			$str1 = ((string) $lat);
			$str2 = ' , '; 
			$str3 = ((string) $lng);
			$geoLocation = $str1.$str2.$str3;
			$randomText = "invalid location!";
		}		

			$config['center'] = $geoLocation;
			$config['zoom'] = 'auto';
			Gmaps::initialize($config);


			$marker = array();
			$marker['position'] = $geoLocation;
			Gmaps::add_marker($marker);
			$map = Gmaps::create_map();				


			return View::make('venue')->with('map',$map)->with('randomText',$randomText)->with('error', $error);
	}
}

<?php

class EquipmentController extends \BaseController {

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
			$privilege = true;
		}   
		$data = equipment::with('equipmentCategory')->get();    	
		return View::make('Equipment.index')->with('data',$data)->with('privilege',$privilege);
	}

	public function modify($id)
	{

		$Equipment = Equipment::find($id);

		$Equipment->equipment_status = 'Approved';  
		$Equipment->save();
		Session::flash('message', 'Approved Equipment!');

		$pending = Pending::where('equipment_id','=',$id);
        $pending->delete();

		return Redirect::back();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		//$categories = ['' => ''] + EquipmentCategory::select('equipmentcategory_id', DB::raw('CONCAT(equipmentcategory_name, " - ", equipmentcategory_remark) AS full_name'))->lists('full_name', 'equipmentcategory_id');
		$categories = ['' => ''] + DB::table('equipment_category')->lists('equipmentcategory_name','equipmentcategory_id');
		return View::make('equipment.create')
		->with('categories', $categories);	    
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$rules = array(
			'equipmentName'      => 'required|unique:equipment,equipment_name',			
			'equipmentRemarks'   => 'required',            
			'equipmentcategory'  =>'required',
			);
		$validator = Validator::make(Input::all(), $rules);

        // process the login
		if ($validator->fails()) {
			return Redirect::to('equipment/create')
			->withErrors($validator)
			->withInput(Input::all());
		} 	        
		else {
            // store	           
			$equipment = new equipment;
			$equipment->equipment_name = Input::get('equipmentName');
			$equipment->equipment_remark = Input::get('equipmentRemarks');	            
			$equipment->equipmentcategory_id = Input::get('equipmentcategory');
			$equipment->created_by = Auth::user()->user_id;
			if(Auth::User()->hasSysRole('Admin'))           
				$equipment->equipment_status='Approved';  
			$equipment->save();   

			if(!Auth::User()->hasSysRole('Admin'))
            $pending = new Pending;
            $pending->user_id = Auth::user()->user_id;         
            $pending->equipment_id = $equipment->equipment_id;
            $pending->status = 'Pending';
            $pending->save();       

            // redirect
			Session::flash('message', 'Equipment Successfully Created!');
			return Redirect::to('equipment');
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
		//not used!
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// show the edit form and pass the equipment
		$equipment = Equipment::find($id);
		$categories = ['' => ''] + DB::table('equipment_category')->lists('equipmentcategory_name','equipmentcategory_id');	        
		return View::make('equipment.edit')
		->with('equipment', $equipment)
		->with('categories', $categories);	  			      
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
			'equipmentName'       => 'required|unique:equipment,equipment_name,'.$id.',equipment_id',
			'equipmentRemarks'    => 'required',            
			'equipmentcategory'   =>'required',
			);
		$validator = Validator::make(Input::all(), $rules);

        // process the login
		if ($validator->fails()) {
			return Redirect::to('equipment/' .$id. '/edit')
			->withErrors($validator)
			->withInput(Input::all());
		} 	        
		else {
            // store            
			$updated =false;
			$equipment = Equipment::find($id);
			if($equipment->equipment_name != Input::get('equipmentName')) {
				$equipment->equipment_name = Input::get('equipmentName');
				$updated=true;	
			}
			if ($equipment->equipment_remark != Input::get('equipmentRemarks')) {
				$equipment->equipment_remark = Input::get('equipmentRemarks');	   
				$updated=true;	
			}
			if ($equipment->equipmentcategory_id != Input::get('equipmentcategory')) {
				$equipment->equipmentcategory_id = Input::get('equipmentcategory');	   
				$updated=true;	
			}                       
			if($updated==true)
			{
				$equipment->modified_by = Auth::user()->user_id;
				
				if(Auth::User()->hasSysRole('Admin'))
				{
					$equipment->equipment_status='Approved';
					$pending = Pending::where('equipment_id','=',$id);
					$pending->delete();
				}           				
				else {
					$equipment->equipment_status='Pending';					
					if(empty(Pending::where('equipment_id','=',$equipment->equipment_id)->get()->toArray()))
					{
                        //create a pending notification to inform the admin on this needing attention!
						$pending = new Pending;
						$pending->user_id = Auth::user()->user_id;         
						$pending->equipment_id = $id;
						$pending->status = 'Pending';
						$pending->save();    
					}
					else
					{
						$pending = Pending::where('equipment_id','=',$equipment->equipment_id)->first();
						$pending->user_id = Auth::user()->user_id;
						$pending->equipment_id = $id;       
						$pending->status = 'Pending';
						$pending->touch();
						$pending->save();    
					}											
				}									
				Session::flash('message', 'Equipment Successfully Edited!');
			}			    		              
			$equipment->save();            

            // redirect			
			return Redirect::to('equipment');
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
		$equipment = Equipment::find($id);
		$equipment->delete();       
        // redirect
		Session::flash('message', 'Successfully deleted the Equipment!');
		return Redirect::to('equipment');
	}


}

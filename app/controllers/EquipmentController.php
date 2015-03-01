<?php

class EquipmentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{		
		if(Auth::User()->hasSysRole('Admin') || Auth::User()->hasSysRole('Resource Provider'))
		{
			$privilege = false;
			if(Auth::User()->hasSysRole('Admin'))
			{            
				$privilege = true;
			}   
			$data = Equipment::with('equipmentCategory','Pending')->get();    	
			//dd($data->toArray());
			return View::make('equipment.index')->with('data',$data)->with('privilege',$privilege);
		}
		else
		{
			return Redirect::to('/dashboard')->with('message', 'You do not have access to this page!');
		}		
	}


	public function pendingDeleteRequest($id)
	{			
		if(empty(Pending::where('equipment_id','=',$id)->first())) {										
			$pending = new Pending;
			$pending->equipment_id = $id;			
			$pending->user_id = Auth::user()->user_id;
			$pending->delete = 'true';
			$pending->save();	
			return Redirect::back()->withMessage('Delete Request Submitted');				
		}		
		else {
			//if pending already existed check if its a delete request.			
			$pending = Pending::where('equipment_id','=',$id)->first();									
			if($pending->delete == 'false')
			{
				$pending->delete = 'true';
				$pending->save();
			}
			else
			{
				$Equipment = Equipment::find($id);
				if($Equipment->status=='Pending')
				{
					//edit delete request to false if pending status = Pending
					$pending->delete = 'false';
					$pending->save();
				}
				else
				{					
					//delete if pending is approved!
					$pending->delete();	
				}				
			}			
			return Redirect::back()->withMessage('Delete Request Cancelled');
		}								
	}

	public function modify($id)
	{
		//approve without deleting equipment
		$pending = Pending::where('equipment_id','=',$id)->first();
		$Equipment = Equipment::find($id);		
		if($pending->delete=='true')
		{
			//dont delete pending			
			$Equipment->equipment_status = 'Approved';				
			$Equipment->save();									
		}
		else
		{
			$Equipment->equipment_status = 'Approved';				
			$Equipment->save();	
			$pending->delete();
			//delete
		}
				
		Session::flash('message', 'Approved Equipment!');
        

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
			$categories = ['' => ''] + DB::table('equipment_category')->lists('equipmentcategory_name','equipmentcategory_id');
			return View::make('equipment.create')
			->with('categories', $categories);	    
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
			$equipment = new Equipment;
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
		//show equipments with room attached to it.
		if(Auth::User()->hasSysRole('Admin') || Auth::User()->hasSysRole('Resource Provider'))
		{
			$equipmentRoomList = RoomEquipment::where('equipment_id','=',$id)->get();
			dd($equipmentRoomList->toArray());
		}
		else
		{
			return Redirect::to('/dashboard')->with('message', 'You do not have access to this page!');
		}
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
		
		if(Auth::User()->hasSysRole('Admin') || Auth::User()->hasSysRole('Resource Provider'))
		{
			$equipment = Equipment::find($id);
			$categories = ['' => ''] + DB::table('equipment_category')->lists('equipmentcategory_name','equipmentcategory_id');	        
			return View::make('equipment.edit')
			->with('equipment', $equipment)
			->with('categories', $categories);	
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
						$pending->save();    
					}
					else
					{
						$pending = Pending::where('equipment_id','=',$equipment->equipment_id)->first();
						$pending->user_id = Auth::user()->user_id;
						$pending->equipment_id = $id;       						
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

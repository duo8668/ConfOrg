<?php

class PendingController extends \BaseController {

	public function index()
	{		
		if(Auth::User()->hasSysRole('Admin'))
		{
			$data = Pending::with('user','equipment','equipmentcategory','venue','room')->get();
			$privilege = true;
			return View::make('pending.index')->with('data',$data)->with('privilege',$privilege);	
		}
		else{
			return Redirect::to('/dashboard')->with('message', 'You do not have access to this page!');
		}
	}
	public function editCategory($id)
	{		
		$equipmentcategory = equipmentCategory::find($id);
        // show the edit form and pass the equipmentcategory
		return View::make('pending.editCategory')
		->with('equipmentcategory', $equipmentcategory);
		// $equipmentcategory = equipmentCategory::find($id);        
		// return View::make('equipmentcategory.edit')->with('equipmentcategory', $equipmentcategory);		
	}

	public function editEquipment($id)	
	{		
		if(Auth::User()->hasSysRole('Admin'))
		{
			$categories = ['' => ''] + DB::table('equipment_category')->lists('equipmentcategory_name','equipmentcategory_id');	        
			$equipment = equipment::find($id);
        // show the edit form and pass the equipment
			return View::make('pending.editEquipment')
			->with('equipment', $equipment)
			->with('categories', $categories);	  
		}
		else{
			return Redirect::to('/dashboard')->with('message', 'You do not have access to this page!');
		}			      
		// $equipmentcategory = equipmentCategory::find($id);        
		// return View::make('equipmentcategory.edit')->with('equipmentcategory', $equipmentcategory);		
	}

	public function removeRoom($id)
	{		
		if(Auth::User()->hasSysRole('Admin'))
		{
			$room = Room::find($id);
			$room->delete();               
			$pending = Pending::where('room_id','=',$id);
			$pending->delete();
			Session::flash('message', 'Successfully deleted the Room!');
			return Redirect::to('pending');
		}
		else{
			return Redirect::to('/dashboard')->with('message', 'You do not have access to this page!');
		}	
	}

	public function removeVenue($id)
	{		
		$venue = venue::find($id);
		$venue->delete();               
		$pending = Pending::where('venue_id','=',$id);
		$pending->delete();
		
		Session::flash('message', 'Successfully deleted the venue!');
		return Redirect::to('pending');				
	}

	public function updateCategory($id)
	{
        //
		$rules = array(
			'categoryName'       => 'required|unique:equipment_category,equipmentcategory_name,'.$id.',equipmentcategory_id',
        //    'categoryRemarks'      => 'required',            
			);
		$validator = Validator::make(Input::all(), $rules);

        // process the login
		if ($validator->fails()) {
			return Redirect::to('pending/editCategory/' .$id. '/edit')
			->withErrors($validator)
			->withInput(Input::all());              
		}         
		else {
            // store
			$updated =false;
			$equipmentcategory = equipmentCategory::find($id);                                
			if($equipmentcategory->equipmentcategory_name != Input::get('categoryName')) {
				$equipmentcategory->equipmentcategory_name = Input::get('categoryName');
				$updated=true;  
			}            
			if($updated==true)
			{
				$equipmentcategory->modified_by = Auth::user()->user_id;

				if(Auth::User()->hasSysRole('Admin'))           
				{
					$equipmentcategory->status='Approved';
					$pending = Pending::where('equipmentcategory_id','=',$id);
					$pending->delete();
				}

				else {
					$equipmentcategory->status='Pending';                                      
					if(empty(Pending::where('equipmentcategory_id','=',$equipmentcategory->equipmentcategory_id)->get()->toArray()))
					{
                            //create a pending notification to inform the admin on this needing attention!
						$pending = new Pending;
						$pending->user_id = Auth::user()->user_id;         
						$pending->equipmentcategory_id = $id;
						$pending->status = 'Pending';
						$pending->save();    
					}
					else
					{
						$pending = Pending::where('equipmentcategory_id','=',$equipmentcategory->equipmentcategory_id)->first();
						$pending->user_id = Auth::user()->user_id;
						$pending->equipmentcategory_id = $id;       
						$pending->status = 'Pending';
						$pending->touch();
						$pending->save();    
					}                  
				}

				Session::flash('message', 'Equipment Category Successfully Edited!');


                // $equipmentcategory->created_by = Auth::user()->user_id;
                // if(Auth::User()->hasSysRole('Admin'))           
                // $equipmentcategory->status='Approved';  
                // //$equipmentcategory->equipmentcategory_remark = Input::get('categoryRemarks');               
                // $equipmentcategory->save();  
			}
			$equipmentcategory->save();
            // redirect            
			return Redirect::to('/pending');
		} 
	}
	public function updateEquipment($id)
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
			return Redirect::to('/pending');
		} 

	} 	

// }
}
?>
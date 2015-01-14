<?php

class EquipmentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$data = DB::table('equipment')
    	->join('equipmentcategory', 'equipmentcategory.equipmentcategory_id', '=', 'equipment.equipmentcategory_id')
    	->get(array('equipment.equipment_ID','equipment.equipmentName', 'equipmentRemarks', 'equipmentcategory.Remarks', 'equipmentcategory.Name'));	

    	return View::make('Equipment.index')->with('data',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$categories = ['' => ''] + EquipmentCategory::select('equipmentcategory_id', DB::raw('CONCAT(Name, " - ", Remarks) AS full_name'))->lists('full_name', 'equipmentcategory_id');
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
            'equipmentName'       => 'required',
            'equipmentRemarks'      => 'required',            
            'equipmentcategory' 				=>'required',
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
            $equipment->save();            

            // redirect
            Session::flash('message', 'equipment Successfully Created!');
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
		// $data = DB::table('equipment')
  //       ->join('equipmentcategory', function($join) use($id)
  //       {
  //           $join->on('equipmentcategory.ID', '=', 'equipment.equipmentcategory_id')
  //                ->where('equipment.ID', '=', $id);
  //       })
  //       ->get(array('equipmentcategory.Remarks', 'equipmentcategory.Name'));  
    	//dd($equipment2);
    	$equipment = Equipment::find($id);
    	$equipmentcategory = EquipmentCategory::find($equipment->equipmentCategory_id);
    	$cat = $equipmentcategory->Name .' - '. $equipmentcategory->Remarks;
    	
        return View::make('equipment.show')->with('equipment', $equipment)->with('cat',$cat);


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
		$equipment = Equipment::find($id);
		$categories = ['' => ''] + EquipmentCategory::select('equipmentcategory_id', DB::raw('CONCAT(Name, " - ", Remarks) AS full_name'))->lists('full_name', 'equipmentcategory_id');
        // show the edit form and pass the equipment
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
            'equipmentName'       => 'required',
            'equipmentRemarks'      => 'required',            
            'equipmentcategory' 				=>'required',
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
        	$equipment = Equipment::find($id);
            $equipment->equipment_name = Input::get('equipmentName');
            $equipment->equipment_remark = Input::get('equipmentRemarks');	            
            $equipment->equipmentcategory_id = Input::get('equipmentcategory');
            $equipment->save();            

            // redirect
            Session::flash('message', 'Equipment Successfully Edited!');
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

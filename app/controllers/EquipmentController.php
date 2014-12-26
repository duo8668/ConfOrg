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
    	->join('category', 'category.ID', '=', 'equipment.category_ID')
    	->get(array('equipment.ID','equipment.equipmentName', 'equipmentRemarks', 'category.Remarks', 'category.Name'));	

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
		$categories = ['' => ''] + Category::select('ID', DB::raw('CONCAT(Name, " - ", Remarks) AS full_name'))->lists('full_name', 'ID');
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
            'category' 				=>'required',
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
            $equipment->equipmentName = Input::get('equipmentName');
            $equipment->equipmentRemarks = Input::get('equipmentRemarks');	            
            $equipment->category_ID = Input::get('category');
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
  //       ->join('category', function($join) use($id)
  //       {
  //           $join->on('category.ID', '=', 'equipment.category_ID')
  //                ->where('equipment.ID', '=', $id);
  //       })
  //       ->get(array('category.Remarks', 'category.Name'));  
    	//dd($equipment2);
    	$equipment = Equipment::find($id);
    	$category = Category::find($equipment->Category_ID);
    	$cat = $category->Name .' - '. $category->Remarks;
    	
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
		$categories = ['' => ''] + Category::select('ID', DB::raw('CONCAT(Name, " - ", Remarks) AS full_name'))->lists('full_name', 'ID');
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
            'category' 				=>'required',
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
            $equipment->equipmentName = Input::get('equipmentName');
            $equipment->equipmentRemarks = Input::get('equipmentRemarks');	            
            $equipment->category_ID = Input::get('category');
            $equipment->save();            

            // redirect
            Session::flash('message', 'Equipment Successfully Created!');
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

<?php

class EquipmentCategoryController extends \BaseController {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {        
        // $equipmentcategory = EquipmentCategory::with('equipments')->count();
        // dd($equipmentcategory);

        $privilege = false;
        if(Auth::User()->hasSysRole('Admin'))
        {            
            $privilege = true;
        }        
        $equipmentcategory = EquipmentCategory::with('equipments')->get();        
        // load the view and pass the venue
        return View::make('equipmentcategory.index')
        ->with('equipmentcategory', $equipmentcategory)
        ->with('privilege',$privilege);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return View::make('equipmentcategory.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
                'categoryName'       => 'required'
                //'categoryRemarks'      => 'required',            
            );
            $validator = Validator::make(Input::all(), $rules);

            // process the login
            if ($validator->fails()) {
                return Redirect::to('equipmentcategory/create')
                    ->withErrors($validator)
                    ->withInput(Input::all());
            }           
            else {
                // store               
                $equipmentcategory = new EquipmentCategory;
                $equipmentcategory->equipmentcategory_name = Input::get('categoryName');
                //$equipmentcategory->equipmentcategory_remark = Input::get('categoryRemarks');               
                $equipmentcategory->save();            

                // redirect
                Session::flash('message', 'Category Successfully Created!');
                return Redirect::to('equipmentcategory');
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
        //get this equipmentcategory
        $privilege = false;
        if(Auth::User()->hasSysRole('Admin'))
        {            
            $privilege = true;
        }
        else
        {
            $privilege = false;   
        }                   
        $equipmentcategory = equipmentCategory::find($id);
        $equipmentList = equipment::where('equipmentcategory_id','=',$id)->get();        

        // show the view and pass the nerd to it
        return View::make('equipmentcategory.show')
            ->with('equipmentcategory', $equipmentcategory)
            ->with('equipmentList',$equipmentList)
            ->with('privilege',$privilege);
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
        $equipmentcategory = equipmentCategory::find($id);

        // show the edit form and pass the equipmentcategory
        return View::make('equipmentcategory.edit')
            ->with('equipmentcategory', $equipmentcategory);
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
        $rules = array(
            'categoryName'       => 'required',
        //    'categoryRemarks'      => 'required',            
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('equipmentcategory/' .$id. '/edit')
                ->withErrors($validator)
                ->withInput(Input::all());              
        }         
        else {
            // store
            $equipmentcategory = equipmentCategory::find($id);                                
            $equipmentcategory->equipmentcategory_name = Input::get('categoryName');
          //  $equipmentcategory->equipmentcategory_remark = Input::get('categoryRemarks');                                     
            $equipmentcategory->save();       

            // redirect
            Session::flash('message', 'Category Successfully Updated!');
            return Redirect::to('equipmentcategory');
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
        $equipmentcategory = equipmentcategory::find($id);
        $equipmentcategory->delete();       
        // redirect
        Session::flash('message', 'Successfully deleted the Category!');
        return Redirect::to('equipmentcategory');
    }



}

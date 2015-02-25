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

        // $pending = Pending::with('equipmentcategory')->where('equipmentcategory_id','=','7')->get();
        // dd($pending->toArray());
        $user_id = Auth::user()->user_id;
        $privilege = false;
        if(Auth::User()->hasSysRole('Admin'))
        {                        
            $privilege = true;
        }        
        $equipmentcategory = EquipmentCategory::with('equipments')->get();        
        // load the view and pass the venue
        return View::make('equipmentcategory.index')
        ->with('equipmentcategory', $equipmentcategory)
        ->with('privilege',$privilege)
        ->with('user_id',$user_id);
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
            'categoryName'       => 'required|unique:equipment_category,equipmentcategory_name'
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
            $equipmentcategory->created_by = Auth::user()->user_id;
            if(Auth::User()->hasSysRole('Admin'))           
                $equipmentcategory->status='Approved';  
                //$equipmentcategory->equipmentcategory_remark = Input::get('categoryRemarks');           
            $equipmentcategory->save();            

            if(!Auth::User()->hasSysRole('Admin'))
                $pending = new Pending;
            $pending->user_id = Auth::user()->user_id;         
            $pending->equipmentcategory_id = $equipmentcategory->equipmentcategory_id;
            $pending->status = 'Pending';
            $pending->save();

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
        $equipmentcategory = EquipmentCategory::find($id);
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
        $equipmentcategory = EquipmentCategory::find($id);
        // show the edit form and pass the equipmentcategory
        return View::make('equipmentcategory.edit')
        ->with('equipmentcategory', $equipmentcategory);
    }

    public function modify($id)
    {
        //delete pending here
        $equipmentcategory = Equipmentcategory::find($id);

        $equipmentcategory->status = 'Approved';  
        $equipmentcategory->save();

        $pending = Pending::where('equipmentcategory_id','=',$id);
        $pending->delete();
        Session::flash('message', 'Approved Equipment Category!');  

        return Redirect::to('equipmentcategory');
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
            'categoryName'       => 'required|unique:equipment_category,equipmentcategory_name,'.$id.',equipmentcategory_id',
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
            $updated =false;
            $equipmentcategory = EquipmentCategory::find($id);                                
            if($equipmentcategory->equipmentcategory_name != Input::get('categoryName')) {
                $equipmentcategory->equipmentcategory_name = Input::get('categoryName');
                $updated=true;  
            }            
            if($updated==true)
            {                
                $equipmentcategory->modified_by = Auth::user()->user_id;
                
                if(Auth::User()->hasSysRole('Admin'))           
                {
                    dd('realy');
                    $equipmentcategory->status='Approved';
                    if(!empty(Pending::where('equipmentcategory_id','=',$equipmentcategory->equipmentcategory_id)->get()->toArray()))
                    {
                        $pending = Pending::where('equipmentcategory_id','=',$id);
                        $pending->delete();
                    }
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
        }
        $equipmentcategory->save();
            // redirect
            //Session::flash('message', 'Category Successfully Updated!');
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
        $equipmentcategory = Equipmentcategory::find($id);
        $equipmentcategory->delete();       
        // redirect
        Session::flash('message', 'Successfully deleted the Category!');
        return Redirect::to('equipmentcategory');
    }



}

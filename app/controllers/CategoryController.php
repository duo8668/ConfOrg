<?php

class CategoryController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$category = Category::all();
	    // load the view and pass the venue
	    return View::make('category.index')
	    ->with('category', $category);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return View::make('category.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $rules = array(
	            'categoryName'       => 'required',
	            'categoryRemarks'      => 'required',            
	        );
	        $validator = Validator::make(Input::all(), $rules);

	        // process the login
	        if ($validator->fails()) {
	            return Redirect::to('category/create')
	                ->withErrors($validator)
	                ->withInput(Input::all());
	        } 	        
	        else {
	            // store	           
	        	$category = new category;
	            $category->name = Input::get('categoryName');
	            $category->remarks = Input::get('categoryRemarks');	            
	            $category->save();            

	            // redirect
	            Session::flash('message', 'Category Successfully Created!');
	            return Redirect::to('category');
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
		//get this category		 
        $category = Category::find($id);

        // show the view and pass the nerd to it
        return View::make('category.show')
            ->with('category', $category);
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
		$category = Category::find($id);

        // show the edit form and pass the category
        return View::make('category.edit')
            ->with('category', $category);
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
            'categoryRemarks'      => 'required',            
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('category/' .$id. '/edit')
                ->withErrors($validator)
                ->withInput(Input::all());	            
        }         
        else {
            // store
        	$category = Category::find($id);        		                  
            $category->name = Input::get('categoryName');
            $category->remarks = Input::get('categoryRemarks');	                                  
            $category->save();       

            // redirect
            Session::flash('message', 'Category Successfully Updated!');
            return Redirect::to('category');
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
		$category = category::find($id);
		$category->delete();       
        // redirect
        Session::flash('message', 'Successfully deleted the Category!');
        return Redirect::to('category');
	}


}

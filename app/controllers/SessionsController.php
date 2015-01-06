<?php

use Illuminate\Support\MessageBag;

class SessionsController extends BaseController {


public function create()
{
	if (Auth::check()) 
		{
			return Redirect::action('ConferenceController@index');			
		}

	return View::make('sessions.create');
}

//authenticate user
public function store()
{

    $credentials = [
      'email'     => Input::get('email'),
      'password'  => Input::get('password')    
    ];

    $rules = [
        'email' => 'required',
        'password'=>'required'
        ];
 
 	$validator = Validator::make($credentials,$rules);

 	if($validator->passes())
 	{
		if (Auth::attempt($credentials))
		{
			return Redirect::action('ConferenceController@index');	
		}

			return Redirect::to('/login')->withInput()->with('failure','username or password is invalid!');
	}

	else
	{
		return Redirect::to('/login')->withErrors($validator)->withInput();
		
	}

}

//logout user
public function destroy()
{
	Auth::logout();
	return Redirect::route('sessions.create');
}

public function welcome()
{
	return View::make('welcome');
}


}
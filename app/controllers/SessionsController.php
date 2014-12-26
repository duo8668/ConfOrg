<?php

class SessionsController extends BaseController {

public function create()
{
	if (Auth::check()) 
		{
			return Redirect::to('/welcome');
			
		}

	return View::make('sessions.create');
}

//auth user
public function store()
{
	if (Auth::attempt(Input::only('email', 'password')))
	{
		
		return Redirect::action('ConferenceController@index');	
	}

	return Redirect::to('/login')->withInput();
}


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
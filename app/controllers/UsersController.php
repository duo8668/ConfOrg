<?php

class UsersController extends \BaseController {


	protected $user;

	public function __construct(User $user)
	{

		$this->user = $user;
	}


	public function index()
	{
		$users = $this->user->all();
		return View::make('users/index')->with('users', $users);
	}


	public function create()
	{
		return View::make('users.create');
	}

	public function store()
	{
		if ( ! $this->user->isValid(Input::only('email', 'password')))
		{
			return Redirect::back()->withInput()->withErrors($this->user->errors);
		}
		else{
			$user = new User;
		    $user->email = Input::get('email');
		    $user->password = Hash::make(Input::get('password'));
		    $user->save();
			
		}
		
			return Redirect::route('users.index');
		
	}

	
	public function show($email)
	{
		$user = $this->user->whereemail($email)->first();
		return View::make('users.show', ['user' => $user]);
	}

	
	public function edit($id)
	{
		//
	}

	
	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

}
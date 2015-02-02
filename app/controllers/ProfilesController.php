<?php

class ProfilesController extends \BaseController {


	/*
	| Get User Profile Page, parameter email 
 	*/
	public function getProfile($email){
		try{
		$user = User::with('Profile')->whereEmail($email)-> firstOrFail();

		}
		catch(Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			return Redirect::to('/dashboard')
 					->with('message','User does not exist.');
		}	
		return View::make('users.profile')->withUser($user);
	}


	/*
	| Get User Edit Profile Page, parameter email 
	*/
	public function getProfileEdit($email){
		try{
		$user = User::with('Profile')->whereEmail($email)-> firstOrFail();

		}
		catch(Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			return Redirect::to('/dashboard')
 					->with('message','User does not exist.');
		}	
		$country_options =array('' => 'Please Select Your Country') + DB::table('countries')->orderBy('short_name', 'asc')->lists('short_name','country_id');
	
		return View::make('users.profileedit')->with('country_options',$country_options)->withUser($user);
	}


	/*
	| For user to Input new password if there is no password. (sign in via facebook) 
	*/
	public function postInputPassword(){
 		$validator = Validator::make(Input::all(),
 			array(
 				'password' 			=> 'required|min:6',
 				'confirm_password' 	=> 'required|same:password'

 			));
 		if($validator->fails()){
 			//redirect 
 			return Redirect::to('/users/'.Auth::user()->email .'/edit')
 					->withErrors($validator);
 		}
 		else{
 			//change password
 			$user = User::find(Auth::user()->user_id);
 			$password = Input::get('password');
 			
 				$user->password = Hash::make($password);

 				if($user->save()){
 					return Redirect::to('/users/'.Auth::user()->email .'/edit')
 						->with('message', 'Your password has been changed');
 				}
 			
 				else{
 				return Redirect::to('/users/'.Auth::user()->email .'/edit')
 				->with('message','Your password could not be input. Please contact admin it144a@gmail.com');
 				}

 		}
 		return Redirect::to('/users/'.Auth::user()->email .'/edit')
 		->with('message','Your password could not be input. Please contact admin it144a@gmail.com');
 	}

 	/*
	| For user to change password
	*/
 	public function postChangePassword(){
 		$validator = Validator::make(Input::all(),
 			array(
 				'old_password' 		=> 'required',
 				'password' 			=> 'required|min:6',
 				'confirm_password' 	=> 'required|same:password'

 			));
 		if($validator->fails()){
 			//redirect 
 			return Redirect::to('/users/'.Auth::user()->email .'/edit')
 					->withErrors($validator);
 		}
 		else{
 			//change password
 			$user = User::find(Auth::user()->user_id);

 			$old_password = Input::get('old_password');
 			$password = Input::get('password');
 			if(Hash::check($old_password, $user->getAuthPassword())){
 				//password user provided matches
 				$user->password = Hash::make($password);

 				if($user->save()){
 					return Redirect::to('/users/'.Auth::user()->email .'/edit')
 						->with('message', 'Your password has been changed');
 				}
 			}
 			else{
 				return Redirect::to('/users/'.Auth::user()->email .'/edit')
 				->with('message','Your old password is incorrect.');
 			}

 		}
 		return Redirect::to('/users/'.Auth::user()->email .'/edit')
 		->with('message','Your password could not be changed. Please contact admin it144a@gmail.com');
 	}

 	/*
	| For User to request to change email. (will send out email for verification)
	*/
 	public function postRequestEmail(){
 		$validator = Validator::make(Input::all(),
 						array(
				 				'new_email' => 'required|unique:users,email|email'
				 				));
 		
 		if($validator->fails()){
 			//redirect 
 			return Redirect::to('/users/'.Auth::user()->email .'/edit')
 					->withErrors($validator);
 		}
 		else{
 			
 			//send email to user
			$user = User::find(Auth::user()->user_id);
 			$new_email = Input::get('new_email');
 			$old_email = Auth::user()->email;

 			$code = str_random(60);
 			$user->email_temp = $new_email;
 			$user->code = $code;
 			
 			if($user->save()){
 			Mail::send('emails.auth.changeEmail',
 					array('link'=>URL::route('users-change-email', $code),
 						'firstname' => $user->firstname,
 						'lastname' 	=> $user->lastname,
 						'new_email' => $new_email,
 						'old_email' => $old_email), 
 					function($message) use ($user) 
 					{
 					$message->to($user->email_temp, $user->firstname, $user->lastname) ->subject('ORAFER Change of Email Confirmation Required');
 					});

 					return Redirect::to('/users/'.Auth::user()->email .'/edit')
 					->with('message','We had sent you an email to your new email for confirmation.');
 			}
 			
 		}
 	}

 	/*
	| User to change email
	*/
	public function getChangeEmail($code){
	$user = User::Where('code','=',$code)
 			->where('email_temp','!=','');
 		if($user->count()){
 			$user = $user->first();
 			$user->email = $user->email_temp;
 			$user->email_temp = '';
 			$user->code = '';

 			if($user->save())
 			{
				return Redirect::to('/dashboard')
	 				->with('message','Your Email has been changed. You can now sign in with your new email');
 			}

 		}
 		
 		return Redirect::to('/dashboard')
 			->with('message','Could not change your email. Please contact admin it144a@gmail.com');
 	}

 	/*
	| For user to change location
	*/
 	public function postChangeLocation(){

 		$validator = Validator::make(Input::all(),
 			array(
 				'country' 	=> 'required',

 			));
 		if($validator->fails()){
 			//redirect 
 			return Redirect::to('/users/'.Auth::user()->email .'/edit')
 					->withErrors($validator)->with('message', 'Please select a location');
 		}
 		else{
 			//change password
 			$user = User::find(Auth::user()->user_id);
 			$new_location_int = Input::get('country');
 			$new_location_string = DB::table('countries')
  			->where('country_id','=',$new_location_int)
 			->pluck('short_name');

 			$user->profile->location = $new_location_string;

 				if($user->profile->save()){
 					return Redirect::to('/users/'.Auth::user()->email .'/edit')
 						->with('message', 'Your location has been changed');
 				}
 				else{
 				return Redirect::to('/users/'.Auth::user()->email .'/edit')
 					->with('message','Your location could not be changed. Please contact admin it144a@gmail.com');
 				}

 		}
 
 	}

 	/*
	| For user to change firstname
	*/
	public function postChangeFirstName(){

 		$validator = Validator::make(Input::all(),
 			array(
 				'firstname' 	=> 'required',

 			));
 		if($validator->fails()){
 			//redirect 
 			return Redirect::to('/users/'.Auth::user()->email .'/edit')
 					->with('message', 'Please input your first name');
 		}
 		else{
 			//change 
 			$user = User::find(Auth::user()->user_id);
 			$new_firstname = Input::get('firstname');
 		

 			$user->firstname = $new_firstname;

 				if($user->save()){
 					return Redirect::to('/users/'.Auth::user()->email .'/edit')
 						->with('message', 'Your first name has been changed');
 				}
 				else{
 				return Redirect::to('/users/'.Auth::user()->email .'/edit')
 					->with('message','Your first name could not be changed. Please contact admin it144a@gmail.com');
 				}

 		}
 
 	}

  	/*
	| For user to change last name
	*/
	public function postChangeLastName(){

 		$validator = Validator::make(Input::all(),
 			array(
 				'lastname' 	=> 'required',

 			));
 		if($validator->fails()){
 			//redirect 
 			return Redirect::to('/users/'.Auth::user()->email .'/edit')
 					->with('message', 'Please input your last name');
 		}
 		else{
 			//change 
 			$user = User::find(Auth::user()->user_id);
 			$new_lastname = Input::get('lastname');
 		

 			$user->lastname = $new_lastname;

 				if($user->save()){
 					return Redirect::to('/users/'.Auth::user()->email .'/edit')
 						->with('message', 'Your last name has been changed');
 				}
 				else{
 				return Redirect::to('/users/'.Auth::user()->email .'/edit')
 					->with('message','Your last name could not be changed. Please contact admin it144a@gmail.com');
 				}

 		}
 
 	}

  	/*
	| For user to change bio
	*/
	public function postChangeBio(){

 		$validator = Validator::make(Input::all(),
 			array(
 				'bio' 	=> 'required',

 			));
 		if($validator->fails()){
 			//redirect 
 			return Redirect::to('/users/'.Auth::user()->email .'/edit')
 					->with('message', 'Please input something in your bio');
 		}
 		else{
 			//change 
 			$user = User::find(Auth::user()->user_id);
 			$new_bio = Input::get('bio');
 		

 			$user->profile->bio = $new_bio;

 				if($user->profile->save()){
 					return Redirect::to('/users/'.Auth::user()->email .'/edit')
 						->with('message', 'Your Bio has been changed');
 				}
 				else{
 				return Redirect::to('/users/'.Auth::user()->email .'/edit')
 					->with('message','Your Bio could not be changed. Please contact admin it144a@gmail.com');
 				}

 		}
 
 	}

  	/*
	| For user to remove fb
	*/
	public function postRemoveFb(){

 		$user = User::find(Auth::user()->user_id);
 		$user->profile->fb_email = '';
 		$user->profile->uid = '0';
 		
 		if($user->profile->save()){
 					return Redirect::to('/users/'.Auth::user()->email .'/edit')
 						->with('message', 'Your Facebook account has been unlinked');
 				}
 				else{
 				return Redirect::to('/users/'.Auth::user()->email .'/edit')
 					->with('message','Your Facebook account could not be unlinked. Please contact admin it144a@gmail.com');
 				}
 	}

	/*
	| For user to add fb
	*/
	public function postAddFb(){

 		//link with fb
 	}
}//controller

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
 				'firstname' 	=> 	'required',
 				'lastname' 		=> 	'required',
 				'email'			=>	'required|unique:users,email|email'

 			));

 		if($validator->fails()){
 			//redirect 
 			return Redirect::to('/users/'.Auth::user()->email .'/edit')
 					->withErrors($validator); 		
 		}
 		
 		else{
 			 
 			$user = User::find(Auth::user()->user_id);

 			//first name and last name
 			$new_firstname = Input::get('firstname');
 			$new_lastname = Input::get('lastname');
 			$user->firstname = $new_firstname;
 			$user->lastname = $new_lastname;
 			
 			//email
 			$new_email = Input::get('email');
 			$old_email = Auth::user()->email;

 			if($new_email !== $old_email)
 			{

 			$code = str_random(60);
 			$user->email_temp = $new_email;
 			$user->code = $code;
 			$user->save();
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
 			}
 			

 			if($user->save()){
 			return Redirect::to('/users/'.Auth::user()->email .'/edit')
 			->with('message','Your Profile has been changed, if you have requested for a new email address, a email will be send to you for confirmation');
 			}
 			
 			else{
 			return Redirect::to('/users/'.Auth::user()->email .'/edit')
 			->with('message','Your profile could not be changed. Please contact admin it144a@gmail.com');
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
 				'country' 	=> 'required',

 			));
 		if($validator->fails()){
 			//redirect 
 			return Redirect::to('/users/'.Auth::user()->email .'/edit')
 					->withErrors($validator); 
 		}
 		else{
 			
 			//change 
 			$user = User::find(Auth::user()->user_id);
 			$new_bio = Input::get('bio');
 			$new_location_int = Input::get('country');
 			$new_location_string = DB::table('countries')
  			->where('country_id','=',$new_location_int)
 			->pluck('short_name');

 			$user->profile->location = $new_location_string;


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
 		$user->profile->access_token = '';
 		$user->profile->photo = '';
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
	public function getAddFb(){

    $facebook = new Facebook(Config::get('facebook'));
    $params = array(
        'redirect_uri' => url('/users/add-fb-redirect'),
        'scope' => 'email',
    );
    return Redirect::to($facebook->getLoginUrl($params));

 	}
	/*
	| For user to add fb redirect
	*/
 	public function getAddFbRedirect(){

    $code = Input::get('code');
    if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');

    $facebook = new Facebook(Config::get('facebook'));
    $uid = $facebook->getUser();

    if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');

    $me = $facebook->api('/me');

    $user = User::find(Auth::user()->user_id);
    $user->profile->uid = $uid;
	$user->profile->photo = 'https://graph.facebook.com/'.$me['id'].'/picture?type=normal';
	$user->profile->bio = 'Hi! Thanks for visiting';
 	$user->profile->fb_email = $me['email'];
	$user->profile->access_token = $facebook->getAccessToken();
    $user->profile->save();  

	return Redirect::to('/users/'.Auth::user()->email .'/edit')
 					->with('message','Your Facebook account is linked.');
 				

 	}
}//controller

<?php

class UsersController extends \BaseController {


public function getHome(){
	$fields=InterestField::select(DB::raw('interestfield_id as id, name as label'))
  ->get();
   $view = View::make('home',array('fields'=>$fields,'fields'=>$fields)); 

  return $view;
}

	public function getCreate(){
		return View::make('users.create');

	}

	public function postCreate(){
		$validator = Validator::make(Input::all(),array(
				'email' 			=>  'required|email|unique:users',
				'first_name'		=>	'required',
				'last_name'			=>	'required',
				'password'			=>	'required|min:6',
				'confirm_password'	=>	'required|same:password'
			));

		if($validator->fails()){
			return Redirect::route('users-create')
				->withErrors($validator)
				->withInput();
		}		
		else{
			$email = Input::get('email');
			$first_name = Input::get('first_name');
			$last_name = Input::get('last_name');
			$password = Input::get('password');

			//Activiation code 
			$code =  str_random(60);

			$user = User::create(array(
				'email' => $email,
				'firstname' => $first_name,
				'lastname' => $last_name,
				'password' => Hash::make($password),
				'code' => $code,
				'active' => 0
				));

 			if($user){
 				//send email
 				Mail::send('emails.auth.activate',
 					array('link' => URL::route('users-activate',$code),'firstname' => $first_name, 'lastname' => $last_name)
 					, function($message) use ($user) 
 					{
 					$message->to($user->email, $user->firstname, $user->lastname) ->subject('Activate your new ORAFER account');
 					});

 				//change the home to our homepage
 				return Redirect::route('users-create')
 					->with('message', 'Your account has been created! we have sent you an email to activate your account');
 			}

		}
	}
		

	public function getActivate($code){
		$user = User::where('code', '=', $code)->where('active', '=', 0);

		if($user->count()){
			$user = $user->first();

			//Update user to active
			$user->active = 1;
			$user->code = '';
			$user->save();

			if($user->save()){
				return Redirect::to('/users/sign-in')
					->with('message', 'Account activated! You can now login.');
			}
		}
		return Redirect::to('/users/sign-in')
			->with('message', 'We could not activate your account. Please contact the admin it144a@gmail.com');
	} 	

	public function getSignIn(){
		return View::make('users.signin');
	}

	public function getSignOut(){
		Auth::logout();
		return Redirect::to('/');
	}

	public function postSignIn(){
		
		$validator = Validator::make(Input::all(),
		array(
			'email'	=> 'required|email',
			'password' => 'required'
			)
		);

		 	if($validator->fails()){
		 		//redirect to sign in 
		 		return 	Redirect::route('users-sign-in')
		 				->withErrors($validator)
		 				->withInput();
		 	}

		 	else{

		 		$remember = (Input::has('remember')) ? true  : false; 
		 		//attempt user sign in
		 		$auth = Auth::attempt(array(
		 			'email' => Input::get('email'),
		 			'password' => Input::get('password'),
		 			'active' => 1
		 			),$remember);

		 		if($auth){
		 				//redirect to intended page
		 			return Redirect::to('/dashboard');
		 		} 
		 		else{
		 			return Redirect::route('users-sign-in')
		 					->with('message','Email/password wrong, Or account not activated');
		 		}
		 	}
		 	return Redirect::route('users-sign-in')
		 		->with('message','There was a problem signing you in. Please contact admin it144a@gmail.com');

 	}
	
 	public function getChangePassword(){
 		return View::make('users.password');
 	}

 	public function postChangePassword(){
 		$validator = Validator::make(Input::all(),
 			array(
 				'old_password' 		=> 'required',
 				'password' 			=> 'required|min:6',
 				'confirm_password' 	=> 'required|same:password'

 			));
 		if($validator->fails()){
 			//redirect 
 			return Redirect::route('users-change-password')
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
 					return Redirect::route('users-change-password')
 						->with('message', 'Your password has been changed');
 				}
 			}
 			else{
 				return Redirect::route('users-change-password')
 				->with('message','Your old password is incorrect.');
 			}

 		}
 		return Redirect::route('users-change-password')
 		->with('message','Your password could not be changed. Please contact admin it144a@gmail.com');
 	}

 	public function getForgetPassword(){
 		return View::make('users.forget');
 	}

 	 public function postForgetPassword(){
 		$validator =Validator::make(Input::all(),array(
 			'email' => 'required|email'

 			));

 		if($validator->fails()){
 			return Redirect::route('users-forget-password')
 				->withErrors($validator)
 				->withInput();
 		}
 		else{
 			//change password
 			$user = User::where('email', '=', Input::get('email'));
 			if($user->count()){
 				$user = $user->first();
 				//generate a new code and password
 				$code = str_random(60);
 				$password = str_random(10);

 				$user->code = $code;
 				$user->password_temp = Hash::make($password);

 				if($user->save()){
 					Mail::send('emails.auth.forget',
 					array('link'=>URL::route('users-recover', $code),'firstname' => $user->firstname,'lastname' => $user->lastname,'password' => $password)
 					, function($message) use ($user) 
 					{
 					$message->to($user->email, $user->firstname, $user->lastname) ->subject('ORAFER Password Reset Request');
 					});

 					return Redirect::route('users-forget-password')
 					->with('message','We had sent you an new password by email.');
 				}
 			}
 		}
 		return Redirect::route('users-forget-password')
 		->with('message','Could not request new password. Please contact admin it144a@gmail.com');
 	}

 	public function getRecover($code){
 		$user = User::Where('code','=',$code)
 			->where('password_temp','!=','');
 		if($user->count()){
 			$user = $user->first();
 			$user->password = $user->password_temp;
 			$user->password_temp = '';
 			$user->code = '';

 			if($user->save())
 			{
				return Redirect::to('/users/sign-in')
	 				->with('message','Your account has been recovered. You can now sign in with your new password');
 			}

 		}
 		
 		return Redirect::route('users-forget-password')
 			->with('message','Could not recover your account. Please contact admin it144a@gmail.com');
 	}

	public function getRequestEmail(){
		
		
			return View::make('users.email');
		
 	}

 	public function postRequestEmail(){
 		$validator = Validator::make(Input::all(),
 						array(
				 				'new_email' => 'required|unique:users,email|email'
				 				));
 		
 		if($validator->fails()){
 			//redirect 
 			return Redirect::route('users-change-email')
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

 					return Redirect::to('/dashboard')
 					->with('message','We had sent you an email to your new email for confirmation.');
 			}
 			
 		}
 	}


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


	public function getInviteFriend(){
		return View::make('users.invite');
	}

	public function postInviteFriend(){
			$validator = Validator::make(Input::all(),
 						array(
				 				'email' 			=> 'required|email',
				 				'firstname'			=>	'required',
								'lastname'			=>	'required'
				 				));
 		
 		if($validator->fails()){
 			//redirect 
 			return Redirect::route('users-invite-friend')
 					->withErrors($validator);
 		}
 		else{
 			//send email to invite friend
 			$user = User::find(Auth::user()->user_id);
 			$friend_email = Input::get('email');
 			$friend_firstname = Input::get('firstname');
 			$friend_lastname = Input::get('lastname');
			Mail::send('emails.auth.invite',
 					array('link'=>URL::route('users-invite-friend'),
 						'firstname' => $user->firstname,
 						'lastname' 	=> $user->lastname,
 						'email' 	=> $user->email,
 						'friend_email' => $friend_email,
 						'friend_firstname' => $friend_firstname,
 						'friend_lastname' => $friend_lastname
 						), 
 					function($message) use ($friend_email,$friend_firstname,$friend_lastname,$user)
 					{
 					$message->to($friend_email, $friend_firstname, $friend_lastname) ->cc($user->email) ->subject('You are invited to join ORAFER!');
 					});

 					return Redirect::to('/dashboard')
 					->with('message','We had sent you an invite to your friend.');

 		}
 	}
}//controller
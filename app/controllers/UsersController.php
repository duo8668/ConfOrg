<?php

class UsersController extends \BaseController {

	/*
	| For the interests dropdown checkbox
 	*/
	public function getHome(){
		$fields=InterestField::select(DB::raw('interestfield_id as id, name as label'))
		->get();
		$view = View::make('home',array('fields'=>$fields,'fields'=>$fields)); 

		return $view;
	}


	/*
	| User sign up page 
 	*/
	public function getCreate($code = null){
		
		if(!empty($code)){

			//* check if the person's code is valid
			$inviteToConf = InviteToConference::where('code','=',$code)
			->first();

			if(!empty($inviteToConf) && !$inviteToConf->is_used){
				return View::make('users.create')->with(array('inviteToConf' => $inviteToConf));
			}else if(!empty($inviteToConf) && $inviteToConf->is_used){
				return Redirect::route('users-create')
				->with('message', 'Invalid Code !!!'); 				
			}else if (empty($inviteToConf)){
				return Redirect::route('users-create')
				->with('message', 'Invalid Code !!!'); 
			}
		}
		return View::make('users.create');
	}

	/*
	| User submit sign up page
 	*/
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
			$iCode = Input::get('iCode');

			//Activiation code 
			$inviteToConf = InviteToConference::where('code','=',$iCode)->where('is_used','=',0)->firstOrFail();

			$code =  empty($inviteToConf)? str_random(60):'';

			$user = User::create(array(
				'email' => $email,
				'firstname' => $first_name,
				'lastname' => $last_name,
				'password' => Hash::make($password),
				'code' => $code,
				'active' => empty($inviteToConf)? 0:1
				));

			if($user){

				if(empty($inviteToConf)){
					Mail::send('emails.auth.activate',
						array('link' => URL::route('users-activate',$code),'firstname' => $first_name, 'lastname' => $last_name)
						, function($message) use ($user) 
						{
							$message->to($user->email, $user->firstname, $user->lastname) ->subject('Activate your new ORAFER account');
						});
					return Redirect::route('users-create')
					->with('message', 'Your account has been created! we have sent you an email to activate your account');
				}else{

					$role = Role::where('role_id','=', $inviteToConf->role_id)->first();
					$conf = Conference::where ('conf_id','=', $inviteToConf->conf_id)->first();
					$profile = new Profile();
					$profile->user_id = $user->user_id;
					$profile->bio = 'Hi! Thanks for accept offer to become ' . $role->rolename . ' for ' . $conf->title . ' !';
					$profile->save();

					$sysrole = new SysRole();
					$sysrole->user_id = $user->user_id;
					$sysrole->role_id = '1';
					$sysrole->save();

					$confUserRole = ConferenceUserRole::create(array('conf_id' => $inviteToConf->conf_id
						, 'user_id' => $user->user_id
						, 'role_id' => $inviteToConf->role_id ));

					$inviteToConf->is_used = 1;
					$inviteToConf->save();

					return Redirect::to('/users/sign-in')
					->with('message', 'Account created! You can now login.');
				} 				
			}

		}
	}
	
	/*
	| Activiate account 
 	*/
	public function getActivate($code){
		$user = User::where('code', '=', $code)->where('active', '=', 0);

		if($user->count()){
			$user = $user->first();

			//Update user to active
			$user->active = 1;
			$user->code = '';
			$user->save();

			$profile = new Profile();
			$profile->user_id = $user->user_id;
			$profile->bio = 'Hi! Thanks for visiting';
			$profile->save();

			$sysrole = new SysRole();
			$sysrole->user_id = $user->user_id;
			$sysrole->role_id = '1';
			$sysrole->save();

			if($user->save()){
				return Redirect::to('/users/sign-in')
				->with('message', 'Account activated! You can now login.');
			}
		}
		return Redirect::to('/users/sign-in')
		->with('message', 'We could not activate your account. Please contact the admin admin@orafer.com');
	} 	

	/*
	| Sign in page
 	*/
	public function getSignIn(){
		return View::make('users.signin');
	}

	/*
	| Sign in validation
 	*/
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
				return Redirect::intended('/dashboard');
				//return Redirect::to('/dashboard');
			} 
			else{
				return Redirect::route('users-sign-in')
				->with('message','Email/password wrong, Or account not activated');
			}
		}
		return Redirect::route('users-sign-in')
		->with('message','There was a problem signing you in. Please contact admin admin@orafer.com');

	}
	
 	/*
	| Sign Out
 	*/
	public function getSignOut(){
		Auth::logout();
		return Redirect::to('/');
	}


	/*
	| Forget password page
 	*/
	public function getForgetPassword(){
		return View::make('users.forget');
	}

	/*
	| Forget password (send email to user with new password to reset password)
 	*/
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
		->with('message','Could not request new password. Please contact admin admin@orafer.com');
	}

	/*
	| Recover account (After user click link in email for forget password)
 	*/
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
		->with('message','Could not recover your account. Please contact admin admin@orafer.com');
	}

	/*
	| invite friends
 	*/

	public function getInviteFriend(){
		return View::make('users.invite');
	}

	/*
	| invite reviewers
 	*/

	public function getInviteResource(){
		$company_options =array('' => 'Please Select Company') + DB::table('company')->orderBy('company_name', 'asc')->lists('company_name','company_id');
		return View::make('admins.invite_resource')->with('company_options',$company_options);
	}

	/*
	| Invite Resource provider. send email to them!
 	*/

	public function postInviteResource(){
		$validator = Validator::make(Input::all(),
			array(
				'email' 			=> 'required|email|unique:users,email',
				'company'			=>	'required'
				));
		if($validator->fails()){
 			//redirect 
			return Redirect::to('/admins/invite-resource')
			->withErrors($validator);
		}	
		else{
 			//send email
			$email = Input::get('email');
			$company_no = Input::get('company');
			$company_name = DB::table('company')
			->where('company_id','=',$company_no)
			->pluck('company_name');

			$code = str_random(60);

			$invite = new Invite();
			$invite->code = $code;
			$invite->email = $email;
			$invite->company = $company_name;
			$invite->save();

			Mail::send('emails.auth.invite_resource',
				array('link'=>URL::route('users-resource', $code),
					'company' => $company_name,
					'email' 	=> $email,
					), 
				function($message) use ($email,$company_name)
				{
					$message->to($email)->subject('You are invited to join ORAFER as Resource Provider!');
				});

			return Redirect::to('/admins/invite-resource')
			->with('message','We had sent you an invite to the email.');
		}

	}

	/*
	| get Resource provider sign up page
 	*/
	public function getResource($code){
		$invite = Invite::Where('code','=',$code)->firstOrFail();
		return View::make('users.resource_create')->withInvite($invite);
	}

	/*
	| Resource provider submit sign up page
 	*/
	public function postResource(){
		$validator = Validator::make(Input::all(),array(
			'first_name'		=>	'required',
			'last_name'			=>	'required',
			'password'			=>	'required|min:6',
			'confirm_password'	=>	'required|same:password'
			));

		if($validator->fails()){
			return Redirect::back()
			->withErrors($validator)
			->withInput();
		}//if		
		else{
			$company = Input::get('company');
			$email = Input::get('email');
			$first_name = Input::get('first_name');
			$last_name = Input::get('last_name');
			$password = Input::get('password');

			$user = User::create(array(
				'email' => $email,
				'firstname' => $first_name,
				'lastname' => $last_name,
				'password' => Hash::make($password),
				'active' => 1
				));
			$user->save();

			$profile = new Profile();
			$profile->user_id = $user->user_id;
			$profile->bio = 'Hi! Thanks for visiting';
			$profile->save();

			$sysrole = new SysRole();
			$sysrole->user_id = $user->user_id;
			$sysrole->role_id = '2';
			$sysrole->save();

			$company_id = DB::table('company')->where('Company_name', $company)->pluck('company_id');

			DB::table('company_user')->insert(
				array('company_id' => $company_id, 'user_id' => $user->user_id)
				);

			return Redirect::to('/users/sign-in')
			->with('message','Succesfully created! Login now!');
			}//else


		}


	/*
	| For admin to add in company 
 	*/
	public function postAddCompany(){
		$validator = Validator::make(Input::all(),
			array(
				'new' 	=> 'required|unique:company,company_name'
				));

		if($validator->fails()){
 			//redirect 
			return Redirect::to('/admins/invite-resource')
			->withErrors($validator);
		}
		else{
			$new = Input::get('new');
			$company = new Company();
			$company->company_name = $new;
			$company->save();


			return Redirect::to('/admins/invite-resource')
			->with('message', 'New company has been added');



		} 
	}


	/*
	| Invite friend. send email to them!
 	*/
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

	public function getUsersLike(){

		$data = [
		'partialname' => Input::get('partialname'),
		'conf_id' => Input::get('conf_id')
		];

		$rules = [
		'partialname' => 'required|min:3',
		'conf_id' => 'required|numeric'
		];

		$validator = Validator::make($data, $rules); 

		if($validator->fails()){
 			//redirect 
			return array('invalidFields'=>$validator->errors()); 
		}
		else{

			$emailLike = User::EmailLike(Input::get('partialname'),$data['conf_id']);

			$overall = null;
			if(!empty($emailLike)){
				$overall = $emailLike->lists('text');
			}

			return $overall;
		}
	}

	public function getConferenceStaffs(){

		$data = [
		'conf_id' => Input::get('conf_id')
		];

		$rules = [
		'conf_id' => 'required|numeric'
		];

		$validator = Validator::make($data, $rules); 

		if($validator->fails()){
 			//redirect 
			return array('invalidFields'=>$validator->errors()); 
		}
		else{

			$allStaffs = ConferenceUserRole::ConferenceStaffs($data['conf_id']);


			$overall = null;
			if(!empty($allStaffs)){

				$overall = $allStaffs->lists('email'); 
			}

			return $overall;

		}
	}

	public function getConferenceReviewPanels(){

		$data = [
		'conf_id' => Input::get('conf_id')
		];

		$rules = [
		'conf_id' => 'required|numeric'
		];

		$validator = Validator::make($data, $rules); 

		if($validator->fails()){
 			//redirect 
			return array('invalidFields'=>$validator->errors()); 
		}
		else{

			$reviewPanels = ConferenceUserRole::ConferenceReviewPanels($data['conf_id']);


			$overall = null;
			if(!empty($reviewPanels)){

				$overall = $reviewPanels->lists('email'); 
			}

			return $overall;

		}
	}
	
	public function getDashboard() {

		if (Auth::User()->hasSysRole('Resoure Provider')) {

			$venue = Venue::where('created_by', '=', Auth::user()->user_id)->get();
			return View::make('layouts.dashboard.index')
			->with('venue', $venue)
			->with('flag', 'RP');

		} else if (Auth::User()->hasSysRole('Admin')){

			return View::make('layouts.dashboard.index')
			->with('flag', 'SA');

		} else {

			$confs = DB::table('conference')
			->join('confuserrole', 'conference.conf_id', '=', 'confuserrole.conf_id')
			->join('conference_room_schedule', 'conference_room_schedule.conf_id', '=', 'conference.conf_id')
			->join('room', 'conference_room_schedule.room_id', '=', 'room.room_id')
			->join('venue', 'venue.venue_id', '=', 'room.venue_id')
			->select('conference.conf_id', 'conference.title', 'conference.begin_date', 'conference.end_date', 'confuserrole.role_id', 'venue.venue_name')
			->where('confuserrole.user_id', '=', Auth::user()->user_id)
			->groupBy('conference.title')
			->get();

			$has_participant = UtilsController::checkHasRole($confs, 8);
			$has_chair = UtilsController::checkHasRole($confs, 4);
			$has_reviewer = UtilsController::checkHasRole($confs, 7);
			$has_staff = UtilsController::checkHasRole($confs, 5);

			// return var_dump($not_participant);

			return View::make('layouts.dashboard.index')
			->with('confs', $confs)
			->with('flag', 'NONRP')
			->with('p_flag', $has_participant)
			->with('c_flag', $has_chair)
			->with('r_flag', $has_reviewer)
			->with('s_flag', $has_staff);

		}
	}


}//controller
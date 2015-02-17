<?php
/*
| testing homepage
*/
Route::get('/home',array(
	'as' => 'home',
	'uses' => 'UsersController@getHome'
	));		

/*
| Unauthenticated group
*/
Route::group(array('before' => 'guest'),function(){

	/*
	| CRSF Protection Group 
	*/
	Route::group(array('before' => 'crsf'),function(){

		/*
		| Create account (POST)
		*/
		Route::post('/users/create',array(
			'as' => 'users-create-post',
			'uses' => 'UsersController@postCreate'
			));

		/*
		| Create resource account (POST)
		*/
		Route::post('/users/resource/{code}',array(
			'as' => 'users-resource-post',
			'uses' => 'UsersController@postResource'
			));

		/*
		| Sign in (POST)
		*/
		Route::post('/users/sign-in',array(
			'as' => 'users-sign-in-post',
			'uses' => 'UsersController@postSignIn'
			));

		/*
		| Forget Password (POST)
		*/
		Route::post('/users/forget-password',array(
			'as' =>	'users-forget-password-post',
			'uses' => 'UsersController@postForgetPassword'

			));
	});


		/*
		| Recover account (GET)
		*/
		Route::get('/users/recover/{code}',array(
			'as' =>	'users-recover',
			'uses' => 'UsersController@getRecover'
			));

		/*
		| sign up for resource provider
		*/
		Route::get('/users/resource/{code}',array(
			'as' =>	'users-resource',
			'uses' => 'UsersController@getResource'
			));


		/*
		| Forget Password (GET)
		*/
		Route::get('/users/forget-password',array(
			'as' =>	'users-forget-password',
			'uses' => 'UsersController@getForgetPassword'

			));

		/*
		| Sign in (GET)
		*/
		Route::get('/users/sign-in',array(
			'as' => 'users-sign-in',
			'uses' => 'UsersController@getSignIn'
			));

		/*
		| Create account (GET)
		*/
		Route::get('/users/create',array(
			'as' => 'users-create',
			'uses' => 'UsersController@getCreate'
			));

		/*
		| Activate account (GET)
		*/
		Route::get('/users/activate/{code}',array(
			'as' => 'users-activate',
			'uses' => 'UsersController@getActivate'
			));

		

		/*
		| Facebook login (GET)
		*/
		Route::get('login/fb', function() {
			$facebook = new Facebook(Config::get('facebook'));
			$params = array(
				'redirect_uri' => url('/login/fb/callback'),
				'scope' => 'email',
				);
			return Redirect::to($facebook->getLoginUrl($params));
		});

		/*
		| Facebook login upon approval (GET)
		*/
		Route::get('login/fb/callback', function() {
			$code = Input::get('code');
			if (strlen($code) == 0) return Redirect::to('/users/sign-in')->with('message', 'There was an error communicating with Facebook');

			$facebook = new Facebook(Config::get('facebook'));
			$uid = $facebook->getUser();

			if ($uid == 0) return Redirect::to('/users/sign-in')->with('message', 'There was an error');

			$me = $facebook->api('/me');
			$profile = Profile::whereUid($uid)->first();
			$check_email_exist = DB::table('users')
			->where('email','=',$me['email'])
			->first();

			
		//if uid is not found(means users not created or fb not assoicated)
			if(empty($profile)){
				//if user has nv been created before
				if(empty($check_email_exist)){
					$user = new User;
					$user->firstname = $me['first_name'];
					$user->lastname = $me['last_name'];
					$user->email = $me['email'];
					$user->active = '1';
					$user->save();

					$profile = new Profile();
					$profile->uid = $uid;
					$profile->photo = 'https://graph.facebook.com/'.$me['id'].'/picture?type=normal';
					$profile->bio = 'Hi! Thanks for visiting';
					$profile->fb_email = $me['email'];
					$profile = $user->profile()->save($profile);
					$profile->access_token = $facebook->getAccessToken();
					$profile->save();

					$sysrole = new SysRole();
					$sysrole->user_id = $user->user_id;
					$sysrole->role_id = '1';
					$sysrole->save();

					Auth::login($user);
					return Redirect::to('/dashboard')->with('message', 'Logged in with Facebook');	
				}

				//if user is created before. add in profile
				else{
					$compare = $me['email'];
					$user = User::where('email','=',$compare)->first();
					$profile = Profile::where('user_id','=', $user->user_id)->first();
					$profile->uid = $uid;
					$profile->photo = 'https://graph.facebook.com/'.$me['id'].'/picture?type=normal';
					$profile->bio = 'Hi! Thanks for visiting';
					$profile->fb_email = $me['email'];
					$profile->access_token = $facebook->getAccessToken();
					$profile->save(); 
					Auth::login($user);
					return Redirect::to('/dashboard')->with('message', 'Logged in with Facebook');
				}
			}
			//if uid is found
			else{
				$get_user_id = DB::table('profiles')
				->where('uid','=',$uid)
				->pluck('user_id');
				$user = User::where('user_id','=',$get_user_id)->first();
				Auth::login($user);
				return Redirect::to('/dashboard')->with('message', 'Logged in with Facebook');
			}
		});//Facebook login upon approval (GET)


});//unath group

/*
| Authenticated group
*/

Route::group(array('before' => 'auth'),function(){
	
	/*
	| CRSF Protection Group 
	*/
	Route::group(array('before' => 'crsf'),function(){
		
		/*
		| Change Password (Post)
		*/
		Route::post('/users/change-password',array(
			'as' => 'users-change-password-post',
			'uses' => 'ProfilesController@postChangePassword'
			));

		/*
		| Input Password (Post)
		*/
		Route::post('/users/input-password',array(
			'as' => 'users-input-password-post',
			'uses' => 'ProfilesController@postInputPassword'
			));

		/*
		| Request Email (Post)
		*/
		Route::post('/users/request-email',array(
			'as' => 'users-request-email-post',
			'uses' => 'ProfilesController@postRequestEmail'
			));

		/*
		| Invite Friend (Post)
		*/
		Route::post('/users/invite-friend',array(
			'as' => 'users-invite-friend-post',
			'uses' => 'UsersController@postInviteFriend'
			));

		/*
		| Invite Resource (Post)
		*/
		Route::post('/admins/invite-resource',array(
			'as' => 'admins-invite-resource-post',
			'uses' => 'UsersController@postInviteResource'
			));


		/*
		| Change location (Post)
		*/
		Route::post('/users/change-location',array(
			'as' => 'users-change-location-post',
			'uses' => 'ProfilesController@postChangeLocation'
			));

		/*
		| Change first name (Post)
		*/
		Route::post('/users/change-firstname',array(
			'as' => 'users-change-firstname-post',
			'uses' => 'ProfilesController@postChangeFirstName'
			));

		/*
		| Change last name (Post)
		*/
		Route::post('/users/change-lastname',array(
			'as' => 'users-change-lastname-post',
			'uses' => 'ProfilesController@postChangeLastName'
			));

		/*
		| Change bio (Post)
		*/
		Route::post('/users/change-bio',array(
			'as' => 'users-change-bio-post',
			'uses' => 'ProfilesController@postChangeBio'
			));

		/*
		| Change bio (Post)
		*/
		Route::post('/admins/add-company',array(
			'as' => 'admins-add-company-post',
			'uses' => 'UsersController@postAddCompany'
			));

		/*
		| Remove fb (Post)
		*/
		Route::post('/users/remove-fb',array(
			'as' => 'users-remove-fb-post',
			'uses' => 'ProfilesController@postRemoveFb'
			));

		/*
		| Get Account like (ANY)
		*/
		Route::get('/users/likeany',array(
			'as' => 'users-likeany',
			'uses' => 'UsersController@getUsersLike'
			));

		/*
		| Get Conference Staff Emails
		*/
		Route::get('/users/conference_staffs',array(
			'as' => 'users-conference_staffs',
			'uses' => 'UsersController@getConferenceStaffs'
			));
		/*
		| Get Conference Review Panels Emails
		*/
		Route::get('/users/conference_reviewpanels',array(
			'as' => 'users-conference_reviewpanels',
			'uses' => 'UsersController@getConferenceReviewPanels'
			));


	});
		/*
		| Invite Friend (GET)
		*/
		Route::get('/users/invite-friend',array(
			'as' => 'users-invite-friend',
			'uses' => 'UsersController@getInviteFriend'
			));

		/*
		| Invite Reviewer (GET)
		*/
		Route::get('/admins/invite-resource',array(
			'as' => 'admins-invite-resource',
			'uses' => 'UsersController@getInviteResource'
			));

		/*
		| Sign Out (GET)
		*/
		Route::get('/users/sign-out',array(
			'as' => 'users-sign-out',
			'uses' => 'UsersController@getSignOut'
			));

		/*
		| Change Email (GET)
		*/
		Route::get('/users/change-email/{code}',array(
			'as' =>	'users-change-email',
			'uses' => 'ProfilesController@getChangeEmail'
			));

		
		/*
		| Add fb (GET)
		*/
		Route::get('/users/add-fb',array(
			'as' => 'users-add-fb-get',
			'uses' => 'ProfilesController@getAddFb'
			));		

		/*
		| Add fb redirect (GET)
		*/
		Route::get('/users/add-fb-redirect',array(
			'as' => 'users-add-fb-redirect-get',
			'uses' => 'ProfilesController@getAddFbRedirect'
			));		
/*
		| Profile (GET)
		*/
		Route::get('/users/{profile}',array(
			'as' => 'users-profile',
			'uses' => 'ProfilesController@getProfile'
			));
		Route::group(array('before' => 'currentUser'),function(){
		/*
		| Profile Edit (GET)
		*/
		Route::get('/users/{profile}/edit',array(
			'as' => 'users-profile-edit',
			'uses' => 'ProfilesController@getProfileEdit'
			));
	});
	});
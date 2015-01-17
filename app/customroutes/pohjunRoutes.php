<?php


Route::get('/users/profile/{user_id}',array(
	'as' =>	'users-profile',
	'uses' => 'ProfileController@user'
	));

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

		

		Route::get('/users/recover/{code}',array(
			'as' =>	'users-recover',
			'uses' => 'UsersController@getRecover'
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

		//activate account
		Route::get('/users/activate/{code}',array(
			'as' => 'users-activate',
			'uses' => 'UsersController@getActivate'
			));

});

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
			'uses' => 'UsersController@postChangePassword'
			));

		/*
		| Request Email (Post)
		*/
		Route::post('/users/request-email',array(
			'as' => 'users-request-email-post',
			'uses' => 'UsersController@postRequestEmail'
			));

		/*
		| Invite Friend (Post)
		*/
		Route::post('/users/invite-friend',array(
			'as' => 'users-invite-friend-post',
			'uses' => 'UsersController@postInviteFriend'
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
		| Request Email (GET)
		*/
		Route::get('/users/request-email',array(
			'as' => 'users-request-email',
			'uses' => 'UsersController@getRequestEmail'
			));

		/*
		| Change Password (GET)
		*/
		Route::get('/users/change-password',array(
			'as' => 'users-change-password',
			'uses' => 'UsersController@getChangePassword'
			));

		/*
		| Sign Out (GET)
		*/
		Route::get('/users/sign-out',array(
			'as' => 'users-sign-out',
			'uses' => 'UsersController@getSignOut'
			));

		Route::get('/users/change-email/{code}',array(
			'as' =>	'users-change-email',
			'uses' => 'UsersController@getChangeEmail'
			));

		

});
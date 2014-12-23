<?php
Route::resource('users', 'UsersController');

Route::resource('sessions', 'SessionsController');
Route::get('/login','SessionsController@create');
Route::get('/logout','SessionsController@destroy');
Route::get('/welcome','SessionsController@welcome')->before('auth');

Route::get('/sessions/create', function()
{
	return View::make('/sessions/create');
});


Route::get('/createUser', function()
{
	User::create([
		'title' => 'mr',
		'firstname' => 'pewpew',
		'lastname' => 'pewpew',
		'email' => 'pewpew@gmail.com',
		'password' => Hash::make('pewpew')
		]);

	// 	$reviewer = Role::create(['rolename' => 'reviewer','remarks' => 'reviewer',]);
	// 	$participant = Role::create(['rolename' => 'participant','remarks' => 'participant',]);
	// 	$author = Role::create(['rolename' => 'athuor','remarks' => 'author',]);

	// 	$xbox = Conference::create(['title' => 'xbox','conferencetype' => 'xbox','description' => 'xbox',
	// 		'begindate' => '221214','begintime' => '0000','enddate' => '231214','endtime' => '0000',
	// 		'isfree' => 'free','speaker' => 'xbox']);

});

Route::get('/conf1', function()
{
	return View::make('/conf1');
});

Route::get('/conf2', function()
{
	return View::make('/conf2');
});
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
		'firstname' => 'jason',
		'lastname' => 'ng',
		'email' => 'jason@gmail.com',
		'password' => Hash::make('changeme')

		]);

});

Route::get('/conf1', function()
{
	return View::make('/conf1');
});

Route::get('/conf2', function()
{
	return View::make('/conf2');
});
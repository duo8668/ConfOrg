<?php

/* 
* Bella's Routes
*/

Route::get('/dashboard', function()
{
	return View::make('layouts.dashboard.index');
});
Route::get('submission/results', 'SubmissionController@results');
Route::resource('submission', 'SubmissionController');
Route::resource('review', 'ReviewController');
<?php

/* 
* Bella's Routes
*/

Route::get('/dashboard', function()
{
	return View::make('layouts.dashboard.index');
});

Route::resource('submission', 'SubmissionController');

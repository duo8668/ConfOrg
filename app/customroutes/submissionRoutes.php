<?php


/* 
* Dashboard
*/
Route::get('/dashboard', function()
{
	return View::make('layouts.dashboard.index');
});

/* 
* Submissions
*/
Route::get('/submission/{sub_id}/reviews', array(
    'as'    => 'submission.reviews',
    'uses'  => 'SubmissionController@reviews'
));
Route::resource('submission', 'SubmissionController');

/* 
* Reviews
*/
Route::get('/reviews', array(
    'as'    => 'reviews.index',
    'uses'  => 'ReviewController@index'
));
Route::get('/reviews/{sub_id}/create', array(
    'as'    => 'reviews.add',
    'uses'  => 'ReviewController@add'
));



Route::resource('review', 'ReviewController');
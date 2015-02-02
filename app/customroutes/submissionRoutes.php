<?php


/* 
* Dashboard
*/
//Route::group(array('before' => 'auth'),function(){
Route::get('/dashboard', function()
{
	return View::make('layouts.dashboard.index');
});
//});
/* 
* Submissions
*/
Route::get('/submission/{sub_id}/reviews', array(
    'as'    => 'submission.reviews',
    'uses'  => 'SubmissionController@reviews'
));

/* 
* Editing Authors
*/
Route::get('/submission/{sub_id}/edit_authors', array(
    'as'    => 'submission.edit_authors',
    'uses'  => 'SubmissionController@edit_authors'
));

Route::put('/submission/{sub_id}/authors', array(
    'as'    => 'submission.update_authors',
    'uses'  => 'SubmissionController@update_authors'
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
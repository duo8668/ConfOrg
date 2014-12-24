<?php

// Route::get('/', 'ThomasController@home');

// Route::get('/venue', 'ThomasController@venue');
// Route::post('/venue', array('as' => 'venue', 'uses'=>'ThomasController@venue'));
// Route::get('/venue2', 'ThomasController@venue2');
// Route::post('/venue2', array('as' => 'venue2', 'uses'=>'ThomasController@venue2'));
// Route::get('/venue2/test', 'ThomasController@test');
//Route::post('/about', 'NewQuoteController@ ');
//Route::put('/newquote', 'NewQuoteController@quoteUpdate');

// Route::get('/about', array('as' => 'about', 'uses' => 'ThomasController@about'));
Route::resource('venue', 'ThomasController');
Route::resource('category', 'CategoryController');


//Route::get('foo/bar', 'FooController@about');
//Route::resource('foo', 'FooController');




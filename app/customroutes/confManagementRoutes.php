<?php

/*
|--------------------------------------------------------------------------
| Maou Sheng Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::get('/conference/management/index', 'ConferenceController@index');
Route::get('/conference/management/create', 'ConferenceController@create');
Route::post('/conference/management/submitCreateConf', 'ConferenceController@createConference');

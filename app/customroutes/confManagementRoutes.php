<?php

/*
|--------------------------------------------------------------------------
| Maou Sheng Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::get('conference/management/', 'ConferenceController@index');
Route::get('conference/management/index', 'ConferenceController@index');
Route::get('conference/management/create', 'ConferenceController@create'); 
Route::get('conference/management/conferenceevents/{beginTime}/{endTime}', 'ConferenceController@conferenceEvents'); 
Route::post('conference/management/submitCreateConf', 'ConferenceController@createConference');

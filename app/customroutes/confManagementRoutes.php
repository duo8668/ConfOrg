<?php

/*
|--------------------------------------------------------------------------
| Maou Sheng Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::get('conference/', 'ConferenceController@index')->before('auth');
Route::get('conference/index', 'ConferenceController@index')->before('auth');
Route::get('conference/confParticular', 'ConferenceController@theConf');
Route::get('conference/management/create', 'ConferenceController@create');
Route::get('conference/management/participate', 'ConferenceController@register');
Route::get('conference/management/roomSchedules', 'ConferenceController@allRoomSchedules');
Route::get('conference/management/conferenceevents/{beginTime}/{endTime}', 'ConferenceController@conferenceEvents'); 

Route::post('conference/checkUserInConf', 'ConferenceController@ValidateConference');
Route::post('conference/management/submitCreateConf', 'ConferenceController@createConference');
Route::post('conference/management/checkConfTitle', 'ConferenceController@checkConferenceTitle');


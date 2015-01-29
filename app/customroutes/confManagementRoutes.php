<?php

/*
|--------------------------------------------------------------------------
| Maou Sheng Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::get('conference/', 'ConferenceController@index');
Route::get('conference/index', 'ConferenceController@index');
Route::get('conference/confParticular', 'ConferenceController@theConf');
Route::get('conference/management/create', 'ConferenceController@create');
Route::get('conference/management/participate', 'ConferenceController@register');
Route::get('conference/management/manage', 'ConferenceController@manage');

Route::get('conference/management/conferenceevents/{beginTime}/{endTime}', 'ConferenceController@conferenceEvents');

Route::get('conference/roomSchedule/unavailabledates', 'ConferenceRoomScheduleController@allRoomSchedules');
Route::get('conference/roomSchedule/availableRooms', 'ConferenceRoomScheduleController@availableRooms');


Route::any('conference/checkUserInConf', 'ConferenceController@ValidateConference');
Route::any('conference/management/submitCreateConf', 'ConferenceController@createConference');
Route::any('conference/management/validateConference', 'ConferenceController@validateCreateConference');


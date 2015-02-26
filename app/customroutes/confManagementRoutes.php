<?php

/*
|--------------------------------------------------------------------------
| Maou Sheng Routes
|--------------------------------------------------------------------------
|
|
|
*/
Route::get('conference/', 'ConferenceController@conf_public_list');
Route::get('conference/index', 'ConferenceController@conf_public_list');
Route::get('/conference_detail/{conf_id}', array(
    'as'    => 'conference.public_detail',
    'uses'  => 'ConferenceController@conf_public_detail'
));

Route::group(array('before' => 'auth'),function(){
		
	Route::get('conference/confParticular', 'ConferenceController@theConf');
	Route::get('conference/management/create', 'ConferenceController@create');
	Route::get('conference/management/updateConfStaffs', 'ConferenceController@updateConfStaffs');
	Route::get('conference/management/updateReviewPanels', 'ConferenceController@updateReviewPanels');
	Route::get('conference/management/updateDescription', 'ConferenceController@updateDescription');
	Route::get('conference/management/updateParticulars', 'ConferenceController@updateParticulars');
	Route::get('conference/management/updateTopics', 'ConferenceController@updateTopics');
	Route::get('conference/management/addNewTopic', 'ConferenceController@addNewTopic');
	Route::get('conference/management/participate', 'ConferenceController@register');
	Route::get('conference/detail', 'ConferenceController@detail');

	Route::get('conference/management/conferenceevents/{beginTime}/{endTime}', 'ConferenceController@conferenceEvents');

	//*  Room Schedule
	Route::get('conference/roomSchedule/unavailabledates', 'ConferenceRoomScheduleController@allRoomSchedules');
	Route::get('conference/roomSchedule/availableRooms', 'ConferenceRoomScheduleController@availableRooms');

	//*  Conference Events
	Route::get('conference/conferenceEvents/addConferenceScheduleEvents', 'ConferenceScheduleEventController@addConferenceScheduleEvents');
	Route::get('conference/conferenceEvents/getConferenceScheduleEvents', 'ConferenceScheduleEventController@getConferenceScheduleEvents');
	Route::get('conference/conferenceEvents/getAvailableConferenceScheduleEvents', 'ConferenceScheduleEventController@getAvailableConferenceScheduleEvents');


	Route::any('conference/checkUserInConf', 'ConferenceController@ValidateConference');
	Route::any('conference/management/submitCreateConf', 'ConferenceController@createConference');
	Route::any('conference/management/validateConference', 'ConferenceController@validateCreateConference');

});


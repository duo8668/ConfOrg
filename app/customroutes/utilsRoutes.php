<?php

/*
|--------------------------------------------------------------------------
| Maou Sheng Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::post('utils/customcalendar', 'UtilsController@customCalender'); 
Route::any('utils/uploadImage', 'UtilsController@uploadImage'); 
Route::any('utils/registerImageUploadConference', 'UtilsController@registerImageUploadConference'); 
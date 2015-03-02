<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//mousheng's route
include('customroutes/confManagementRoutes.php');
include('customroutes/utilsRoutes.php');

//bella's route
include('customroutes/submissionRoutes.php');
//thomas's route
include('customroutes/thomasRoutes.php');
//pohjun's route
include('customroutes/pohjunRoutes.php');


// Route::group(array('before' => 'guest'),function(){

Route::get('/', function()
{
    return View::make('hello');
});

Route::get('/contact', function()
{
    return View::make('contact');
});

Route::any('/conference_list', array(
    'as'    => 'conference.public_list',
    'uses'  => 'ConferenceController@conf_public_list'
));

Route::get('/conference_detail/{conf_id}', array(
    'as'    => 'conference.public_detail',
    'uses'  => 'ConferenceController@conf_public_detail'
));

Route::post('/send_message', array(
    'as'    => 'homepage.contact',
    'uses'  => 'UtilsController@send_msg_orafer'
));

// TESTING
Route::get('/cron', 'UtilsController@cron');


// });


<?php

// Route::get('/', 'ThomasController@home');

//Route::get('/venue', 'ThomasController@venue');
// Route::post('/venue', array('as' => 'venue', 'uses'=>'ThomasController@venue'));
// Route::get('/venue2', 'ThomasController@venue2');
// Route::post('/venue2', array('as' => 'venue2', 'uses'=>'ThomasController@venue2'));
// Route::get('/venue2/test', 'ThomasController@test');

Route::get('/about', 'ThomasController@about');
//Route::post('/about', array('as' => 'about', 'uses'=>'ThomasController@test'));
Route::get('/download', 'ThomasController@download');
Route::post('download', array('uses' => 'ThomasController@download'));
Route::post('previewMap', array('uses' => 'ThomasController@previewMap'));
Route::post('import', array('uses' => 'ThomasController@import'));

Route::resource('venue', 'ThomasController');
Route::resource('equipmentcategory', 'EquipmentCategoryController');
Route::resource('equipment', 'EquipmentController');
Route::resource('room', 'RoomController');





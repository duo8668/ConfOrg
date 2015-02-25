<?php

Route::group(array('before' => 'auth'),function(){
	//-----------------------SHIN's Route--------------------------
	Route::get('/conferenceFinance/{id}','BillController@populate');
	Route::get('/conferenceFilterRoom','BillController@populateFilter');
	//-----------------------For the finance information-----------
	Route::get('/payment', 'BillController@payment');
	Route::post('payment', 'BillController@createInvoice');
	Route::any('/payment/actionCreateInvoice', 'BillController@actionCreateInvoice');
	Route::any('/payment/actionCreatePayment', 'BillController@actionCreatePayment');

	Route::get('/payment/charges/{id}', 'BillController@charges');
	Route::post('/payment/charges/{id}', 'BillController@chargeUser');

	Route::get('/import', 'ThomasController@import');
	Route::post('import', array('uses' => 'ThomasController@import'));

	Route::get('/importData', 'ThomasController@importData');
	Route::post('importData', array('uses' => 'ThomasController@importData'));
	Route::post('previewMap', array('uses' => 'ThomasController@previewMap'));

	//----------pending -> Resource Provider -> Submit/Cancel delete request -------------------	
	Route::post('venue/deleterequest/{id}', 'ThomasController@pendingDeleteRequest');
	Route::post('room/deleterequest/{id}', 'RoomController@pendingDeleteRequest');

	//----------pending -> show -------------------	
	Route::get('pending','PendingController@index');
	Route::post('pending/removeVenue/{id}','PendingController@removeVenue');
	Route::post('pending/removeRoom/{id}','PendingController@removeRoom');
	Route::get('pending/editCategory/{id}/edit','PendingController@editCategory');	
	Route::get('pending/editEquipment/{id}/edit','PendingController@editEquipment');
	Route::put('pending/{id}','PendingController@updateCategory');
	
	Route::post('equipmentcategory/modify/{id}', 'EquipmentCategoryController@modify');
	Route::post('equipment/modify/{id}', 'EquipmentController@modify');
	Route::post('room/modify/{id}', 'RoomController@modify');
	Route::post('venue/modify/{id}', 'ThomasController@modify');
	Route::resource('invoice', 'BillController');
	Route::resource('venue', 'ThomasController');
	Route::resource('equipmentcategory', 'EquipmentCategoryController');
	Route::resource('equipment', 'EquipmentController');
	Route::resource('room', 'RoomController');

});

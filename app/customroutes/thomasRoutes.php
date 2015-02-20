<?php

// Route::get('/', 'ThomasController@home');

// Route::get('/venue', 'ThomasController@venue');
// Route::post('/venue', array('as' => 'venue', 'uses'=>'ThomasController@venue'));
// Route::get('/venue2', 'ThomasController@venue2');
// Route::post('/venue2', array('as' => 'venue2', 'uses'=>'ThomasController@venue2'));
// Route::get('/venue2/test', 'ThomasController@test');
// Route::post('/about', array('as' => 'about', 'uses'=>'ThomasController@test'));

// Route::get('/invoice', 'BillController@index');
// Route::get('/invoice/{id}', 'BillController@show');

Route::get('/payment', 'BillController@payment');
Route::post('payment', 'BillController@createInvoice');

Route::get('/payment/charges/{id}', 'BillController@charges');
Route::post('/payment/charges/{id}', 'BillController@chargeUser');

Route::get('/import', 'ThomasController@import');
Route::post('import', array('uses' => 'ThomasController@import'));

Route::get('/importData', 'ThomasController@importData');
Route::post('importData', array('uses' => 'ThomasController@importData'));
Route::post('previewMap', array('uses' => 'ThomasController@previewMap'));

Route::resource('invoice', 'BillController');
Route::resource('venue', 'ThomasController');
Route::resource('equipmentcategory', 'EquipmentCategoryController');
Route::resource('equipment', 'EquipmentController');
Route::resource('room', 'RoomController');



// Route::get('/payment', 'BillController@payment');
// Route::get('/charges', 'BillController@charges');
// Route::get('/payment/charges', 'BillController@charges');
// Route::post('/payment/charges', 'BillController@charges');

// Route::post('/payment/charges/process', function(){		
// 		$billing = App::make('Acme\Billing\BillingInterface');
// 		$customerId= $billing->charge([
// 			'email' => Input::get('email'),
// 			'token' => Input::get('stripe-token')
// 			]);		
		
// 		if(array_key_exists('error', $customerId))		
// 		return Redirect::refresh()->withMessage($customerId['message'])->withInput(Input::all());
// 		// $user::User::first();
// 		// $user->billingID
// 		else
// 		{
// 			return Redirect::refresh()->withMessage('Charge was successful!');				
// 		}	
		
// });

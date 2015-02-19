<?php		
class BillController extends \BaseController {

	public function charges()
	{  						
		Input::all();
		return View::make('charges.charge');
	}

	public function charges2()
	{			
		$conference = Conference::find(Input::get('conf_id'));
		$user = User::find(Auth::user()->user_id);										
		return View::make('charges.charge')->with(Input::all())->with('user',$user)->with('conference',$conference)->with(Input::all());		
	}

	public function payment()
	{
			// dd(Input::get('conf_id'));
			// dd($conference = Conference::find(Input::get('conf_id')));			
		$userID = Auth::user()->user_id;
		return View::make('charges.conferenceInformation')->with('userID', $userID);
	}

	public function paymentCharges()
	{
		$ticketPrice = Input::get('TicketPrice');			
		$conference = Conference::find(Input::get('conf_id'));
		$user = User::find(Auth::user()->user_id);													
		return View::make('charges.charge')->with(Input::all())->with('user',$user)->with('conference',$conference)->with(Input::all());
		//return View::make('charges.charge')->with(Input::all())->with('user',$user)->with('conference',$conference)->with('ticketPrice',$ticketPrice);		
	}

	public function chargeUser()
	{		
		dd(Input::all());
		$billing = App::make('Acme\Billing\BillingInterface');
		$customerId= $billing->charge([
			'email' => Input::get('email'),
			'token' => Input::get('stripe-token')
			]);		

		if(array_key_exists('error', $customerId))		
			return Redirect::to('charges.charges')->withMessage($customerId['message'])->withInput(Input::all());
				// $user::User::first();
				// $user->billingID
		else
			return Redirect::to('charges.charges')->withMessage('Charge was successful!');		
		
	}
		// Route::get('/payment', 'BillController@payment');
		// Route::get('/charges', 'BillController@charges');
		// Route::post('/payment/charges', 'BillController@charges2');
}

?>
<?php		
class BillController extends \BaseController {

	// public function charges()
	// {  	
	// 	dd(Input::all());
	// 	$ticketPrice = Input::get('TicketPrice');			
	// 	$conference = Conference::find(Input::get('conf_id'));
	// 	$user = User::find(Auth::user()->user_id);	
	// 	return Redirect::to('payment/charges')->with(Input::all())->with('user',$user)->with('conference',$conference)->with(Input::all());	
	// 	//return View::make('charges.charge');
	// }

// 	Route::get('/payment', 'BillController@payment');
// Route::post('payment', 'BillController@paymentCharges');

// Route::get('/payment/charges', 'BillController@charges');
// Route::post('/payment/charges', 'BillController@chargeUser');
	public function index()
	{  					
		$privilege = false;
		if(Auth::User()->hasSysRole('Admin'))
		{
			$user = 'Hello Admin!';						
			$data=invoice::all();			
			$privilege = true;
		}
		else if(Auth::User()->hasSysRole('Resource Provider'))
		{
			$user = User::find(Auth::user()->user_id)->firstname.', '.User::find(Auth::user()->user_id)->lastname;
			$data = invoice::with('conference','user')->where('user_id', '=', Auth::user()->user_id)->orderBy('created_at','Desc')->get();		
		}
		
		return View::make('invoice.index')		
		->with('user', $user)
		->with('data', $data)
		->with('privilege',$privilege);
	}	

	public function show($id)
	{
        //get this equipmentcategory         
		$invoice = invoice::with('conference','user')->where('invoice_id','=', $id)->first();		
        // show the view and pass the nerd to it
		return View::make('invoice.show')
		->with('invoice', $invoice);
	}

	public function destroy($id)
	{
		//
		$invoice = invoice::find($id);
		$invoice->delete(); 
        // redirect
		Session::flash('message', 'Successfully removed the invoice!');
		return Redirect::to('invoice');
	}

	public function charges($id)
	{  	
		$invoice =invoice::find($id);			
		return View::make('charges.charge')->with('invoice',$invoice);	
		//return View::make('charges.charge');		
	}	

	public function payment()
	{		
		$userID = Auth::user()->user_id;
		return View::make('charges.conferenceInformation')->with('userID', $userID);
	}

	public function createInvoice()
	{						
		if($this->invoiceExsit(Input::get('user_id'),Input::get('conf_id')))
		{						
			$invoice = invoice::with('conference','user')->where('user_id','=',Input::get('user_id'))->where('conf_id','=',Input::get('conf_id'))->first();
			return Redirect::to('payment/charges/'.$invoice->invoice_id);
			//redirect invalid with message. redirect to invoice index		
			// Session::flash('message', 'Please pay or delete the existing invoice before attempting to make payment.');
			// return Redirect::to('invoice');
		}
		else
		{
			$invoice = new invoice;
			$invoice->user_id = Input::get('user_id');
			$invoice->conf_id = Input::get('conf_id');			
			$invoice->created_by = Input::get('user_id');
			$invoice->save();

			$invoice2 = Invoice::with('conference','user')->where('invoice_id', '=', $invoice->invoice_id)->first();
			return Redirect::to('payment/charges/'.$invoice->invoice_id);			
			//redirect to payment/charges page
			//hardcorded the price
		}			
	}

	public function invoiceExsit($user_id,$conf_id)
	{
		$exist = false;
		$invoice = invoice::all();		
		foreach($invoice as $invoice)
		{
			if($invoice->user_id == $user_id && $invoice->conf_id == $conf_id)
			{
				if($invoice->status == 'unpaid')
				{
					$exist = true;
					break;
				}
			}
		}
		return $exist;
	}


	// public function paymentCharges($id)
	// {			
	// 	$invoice =invoice::find($id);	
	// 	return View::make('payment/charges/'.$id)->with('invoice',$invoice);
	// }

	public function actionCreateInvoice()
	{
		$success = true;
		$invoiceID = 0;

		$user_id = Auth::user()->user_id;

		$invoice = new invoice;
		$invoice->user_id = $user_id;		
		$invoice->created_by = $user_id;
		$invoice->save();
		$invoiceID = $invoice->invoice_id;

		return array('createResult'=>$success,'invoiceId'=>$invoiceID);
	}

	public function actionCreatePayment(){
		$success = true;

		preg_match('/[0-9]+[\.]*[0-9]*/',Input::get('total'), $match);
		$total = $match[0] * 100;

		preg_match('/[0-9]+[\.]*[0-9]*/', Input::get('price'), $match);

		$price  = $match[0];

		$billing = App::make('Acme\Billing\BillingInterface');
		$customerId= $billing->charge([
			'email' => Auth::user()->email,
			'token' => Input::get('stripeToken'),
			'total' => $total
			]);		

		$invoice = invoice::find(Input::get('invoice_id'));			
		$invoice->quantity = Input::get('quantity'); 

		$invoice->price = $price;
		$invoice->total = $total;
		$invoice->created_by = Auth::user()->user_id;
		$invoice->save();
		if(array_key_exists('error', $customerId))
		{
			$success = false;		 
		} 
		else
		{
			$payment = new payment;			
			$payment->invoice_id = $invoice->invoice_id;
			$payment->amount = $invoice->total;		
			$payment->created_by = Auth::user()->user_id;
			$payment->save();			
			$invoice->status = 'paid';
			$invoice->save();

		}
		return array('createResult'=>$success,'message'=> $customerId);
	}

	public function chargeUser($id)
	{						
		$total = Input::get('total');
		$total = ltrim ($total, '$');
		$total = $total * 100;		
		$billing = App::make('Acme\Billing\BillingInterface');
		$customerId= $billing->charge([
			'email' => Input::get('email'),
			'token' => Input::get('stripe-token'),
			'total' => $total
			]);		

		$invoice = invoice::find($id);			
		$invoice->quantity = Input::get('quantity');      
		$invoice->price = ltrim(Input::get('price'),'$');
		$invoice->total = $total;
		$invoice->created_by = Auth::user()->user_id;
		$invoice->save();

		if(array_key_exists('error', $customerId))
		{
			// $ticketPrice = Input::get('ticketPrice');			
			// $conference = Conference::find(Input::get('conf_id'));			
			// $user = User::find(Auth::user()->user_id);							
			return Redirect::to('payment/charges/'.$id)->withInput(Input::all())->withMessage($customerId['message']);
			//return Redirect::to('payment/charges')->withMessage($customerId['message'])->withInput(Input::all());
		}
				// $user::User::first();
				// $user->billingID
		else
		{
			$payment = new payment;			
			$payment->invoice_id = $invoice->invoice_id;
			$payment->amount = $invoice->total;		
			$payment->created_by = Auth::user()->user_id;
			$payment->save();			
			$invoice->status = 'paid';
			$invoice->save();

			return Redirect::to('invoice')->withMessage('Charge was successful!');					
		}

	}
}

?>
<?php namespace Acme\Billing;

use Stripe; 
use Stripe_Charge;
use Stripe_Customer;
use Stripe_InvalidRequestError;
use Stripe_CardError;
use Config;

class StripeBilling implements BillingInterface {

	public function __construct()
	{
		Stripe::setApiKey(Config::get('stripe.secret_key'));
	}
	public function charge(array $data){
		try{

			// $customer = Stripe_Customer::create([
			// 	'card' => $data['token'],
			// 	'description' => $data['email']
			// 	]);
			return Stripe_Charge::create([
			//refer amount from the database
				// 'customer' => $customer->id,
				'amount' =>11*100,
				'currency' => 'usd',
				'description' => $data['email'],
				'card' => $data['token']
				]);	

			// return $customer->id;
		}
		catch(Stripe_InvalidRequestError $e)
		{
			$error=array('error'=>true, 'message'=>$e->getMessage());
			return $error;		
		}

		catch(Stripe_CardError $e)
		{
			$error=array('error'=>true, 'message'=>$e->getMessage());
			return $error;			
		}
		
	}
}
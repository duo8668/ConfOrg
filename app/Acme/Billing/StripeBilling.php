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

			$customer = Stripe_Customer::create([
				'source' => $data['token'],
				'description' => $data['email']
				]);


			$charge = Stripe_Charge::create([
			//refer amount from the database
				'customer' => $customer->id,
				'amount' =>$data['total'],
				'currency' => 'usd',
				'description' => $data['email']
				//,'source' => $data['token']
				]);	
				
			return array('success' => true, 'customer'=> $charge->customer);
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
<?php

namespace App\Http\Controllers;

use Stripe;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    

     public function paymentPost(Request $request)
    {
	       
	Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $request->sub*100,
                "currency" => "MYR",
                "source" => $request->stripeToken,
                "description" => "This payment is testing purpose of southern online",
        ]);
           
        return back();
    }
}
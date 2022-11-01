<?php

namespace App\Http\Controllers;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Http\Request;
use App\Models\SpotLight;
use Session;
use DataTables;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Exceptions\Handler;
class StripeController extends Controller
{
    
    public function create_customer_on_stripe(){
       // $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
       // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        /*$data = $stripe->customers->create(
          [
            'email' => 'hetaljogadiya48@gmail.com',
            'name'=>'Hetal Jogadiya',
            'payment_method' => 'pm_card_visa',
            'invoice_settings' => ['default_payment_method' => 'pm_card_visa'],
          ]
        );*/

        \Stripe\Stripe::setApiKey('sk_test_f3RYvBQhUeqpO7H7UX3Chnnh00uQxjLO3m');

// Create a Customer:
/*$customer = \Stripe\Customer::create([
    'source' => 'tok_1Kb6L2C4yvWuoGmTAsBybwsk',
    'email' => 'hetaljogadiya48@gmail.com',
    'name'=>'Hetal Jogadiya',
]);*/

// Charge the Customer instead of the card:
$charge = \Stripe\Charge::create([
    'amount' => 5*100,
    'currency' => 'usd',
    'customer' => 'cus_LHfijChkeqtXCU',
]);

        
        

        

        echo "<pre>";
        print_r($charge);exit;

    }
   
}

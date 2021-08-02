<?php

namespace App\Http\Controllers;

use App\Package;
use App\Menu;
use App\Config;
use App\Multiplescreen;
use App\PaypalSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Mollie\Laravel\Facades\Mollie;

class PayViaMollieController extends Controller
{
    public function payment(Request $request){
    	$p= json_decode($request->metadata,true);
    	$plan = Package::find($p['plan_id']);
    	// return $plan;
    	$amount = sprintf("%.2f",$request->amount);
    	$payment = Mollie::api()->payments()->create([
	    "amount" => [
	        "currency" => $request->currency,
	        "value" => $amount, // You must send the correct number of decimals, thus we enforce the use of strings
	    ],
	    "description" => "Payment For ".$plan->name ,
	    "redirectUrl" => route('moli.pay.success_subscription'),
	    ]);
    	Session::put('plan', $plan);
	    $payment = Mollie::api()->payments()->get($payment->id);
        \Session::put('payment_id',$payment->id);
	    // redirect customer to Mollie checkout page
	    return redirect($payment->getCheckoutUrl(), 303);
    }

    public function success(Request $request){
    	$payment_id = \Session::get('payment_id');
    	$payment = Mollie::api()->payments()->get($payment_id);
    	// return response()->json($payment->id);
    	$menus = Menu::all();
    	$plan = Session::get('plan');
    	$user_email = Auth::user()->email;
        $com_email = Config::findOrFail(1)->w_email;

        Session::put('user_email', $user_email);
        Session::put('com_email', $com_email);

    	Session::forget('plan');

    	
    	if ($payment->isPaid())
		{

		    //return 'Payment received.';
		    // Do your thing ...


		    $current_date = Carbon::now();
            $end_date = null;

            if ($plan->interval == 'month') {
                $end_date = Carbon::now()->addMonths($plan->interval_count);
            } else if ($plan->interval == 'year') {
                $end_date = Carbon::now()->addYears($plan->interval_count);
            } else if ($plan->interval == 'week') {
                $end_date = Carbon::now()->addWeeks($plan->interval_count);
            } else if ($plan->interval == 'day') {
                $end_date = Carbon::now()->addDays($plan->interval_count);
            }

            $auth = Auth::user();

            $created_subscription = PaypalSubscription::create([
                'user_id' => $auth->id,
                'payment_id' => $payment->id,
                'user_name' => $auth->name,
                'package_id' => $plan->id,
                'price' => $plan->amount,
                'status' => 1,
                'method' => 'mollie',
                'subscription_from' => $current_date,
                'subscription_to' => $end_date
            ]);

            if ($created_subscription) {
              Session::forget('coupon_applied');
              if(isset($mlt_screen) && $mlt_screen == 1){
                $auth = Auth::user();
                $screen = $plan->screens;
                if($screen > 0){
                  $multiplescreen = Multiplescreen::where('user_id',$auth->id)->first();
                  if(isset($multiplescreen)){
                    $multiplescreen->update([
                      'pkg_id' => $plan->id,
                      'user_id' => $auth->id,
                      'screen1' => $screen >= 1 ? $auth->name :  null,
                      'screen2' => $screen >= 2 ? 'Screen2' :  null,
                      'screen3' => $screen >= 3 ? 'Screen3' :  null,
                      'screen4' => $screen >= 4 ? 'Screen4' :  null
                    ]);
                  }
                  else{
                    $multiplescreen = Multiplescreen::create([
                      'pkg_id' => $plan->id,
                      'user_id' => $auth->id,
                      'screen1' => $screen >= 1 ? $auth->name :  null,
                      'screen2' => $screen >= 2 ? 'Screen2' :  null,
                      'screen3' => $screen >= 3 ? 'Screen3' :  null,
                      'screen4' => $screen >= 4 ? 'Screen4' :  null
                    ]);
                  }
                }
              }
                
                if(env('MAIL_DRIVER') != NULL && env('MAIL_HOST') != NULL && env('MAIL_PORT') != NULL) {
                    try{
                        Mail::send('user.invoice', ['paypal_sub' => $created_subscription, 'invoice' => null], function($message) {
                            $message->from(Session::get('com_email'))->to(Session::get('user_email'))->subject('Invoice');
                        });
                        Session::forget('user_email');
                        Session::forget('com_email');
                    }catch(\Swift_TransportException $e){
                        header( "refresh:5;url=./" );
                        dd("Payment Successfully ! but Invoice will not sent because admin not updated the mail setting in admin dashboard ! Redirecting you to homepage... !");
                     }
                 }
            }

            if (isset($menus) && count($menus) > 0) {
              return redirect()->route('home', $menus[0]->slug)->with('added', 'Your are now a subscriber !');
            }
            return redirect('/')->with('added', 'Your are now a subscriber !');
		}else{
			
            return back()->with('deleted','Fail Transcation !');
		}

    }
}

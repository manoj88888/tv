<?php

namespace App\Http\Controllers;

use App\Package;
use App\Menu;
use App\Config;
use App\PaypalSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Mollie\Laravel\Facades\Mollie;

class PayViaCashFreeController extends Controller
{
   
    public function payment(Request $request)
    {
    	$apiEndpoint = env('CASHFREE_API_END_URL');
	   	$opUrl = $apiEndpoint."/api/v1/order/create";
	   	$orderid = uniqid();
	   	$cf_request = array();
	  	$cf_request["appId"] = env('CASHFREE_APP_ID');
	   	$cf_request["secretKey"] = env('CASHFREE_SECRET_ID');
	  	$cf_request["orderId"] = $orderid; 
	   	$cf_request["orderAmount"] = $request->amount;
	   	$cf_request["orderNote"] = "Subscription";
	   	$cf_request["customerPhone"] = Auth::user()->mobile;
	   	$cf_request["customerName"] = Auth::user()->name;
	   	$cf_request["customerEmail"] = Auth::user()->email;
	   	$cf_request["returnUrl"] = ''.url("/cashfree/success").'';
	   	$cf_request["notifyUrl"] = ''.url("/test/cf/notify").'';

	   	$timeout = 20;
	   
	   $request_string = "";
	   foreach($cf_request as $key=>$value) {
	     $request_string .= $key.'='.rawurlencode($value).'&';
	   }
	   
	   $ch = curl_init();
	   curl_setopt($ch, CURLOPT_URL,"$opUrl?");
	   curl_setopt($ch,CURLOPT_POST, count($cf_request));
	   curl_setopt($ch,CURLOPT_POSTFIELDS, $request_string);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	   curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
	   $curl_result=curl_exec ($ch);
	   curl_close ($ch);

	   $jsonResponse = json_decode($curl_result);

	  

	   if ($jsonResponse->{'status'} == "OK") {
	     $paymentLink = $jsonResponse->{"paymentLink"};
	      \Session::put('orderid',$orderid);
	      \Session::put('plan_id',$request->plan_id);
	     return redirect($paymentLink);
	    
	   } else {
	   	return back()->with('deleted',$jsonResponse->{'reason'});

	   } 

         
    }
    public function success()
    {
    	$user_email = Auth::user()->email;
        $com_email = Config::findOrFail(1)->w_email;

        Session::put('user_email', $user_email);
        Session::put('com_email', $com_email);
        
	    $curl = curl_init();
	    curl_setopt_array($curl, array(
	    CURLOPT_URL => env('CASHFREE_API_END_URL').'/api/v1/order/info/status',
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_ENCODING => "",
	    CURLOPT_MAXREDIRS => 10,
	    CURLOPT_TIMEOUT => 30,
	    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    CURLOPT_CUSTOMREQUEST => "POST",
	    CURLOPT_POSTFIELDS => 'appId='.env("CASHFREE_APP_ID").'&secretKey='.env("CASHFREE_SECRET_ID").'&orderId='.\Session::get('orderid'),
	    CURLOPT_HTTPHEADER => array(
	        "cache-control: no-cache",
	        "content-type: application/x-www-form-urlencoded"
	    ),
	    ));

	    $response = curl_exec($curl);
	    $err = curl_error($curl);

	    curl_close($curl);

	    if ($err) {
	    echo "cURL Error #:" . $err;
	    } 
	    else
	    {
	    	$response = json_decode($response,true);
	    	if (isset($response))
		{

		    //return 'Payment received.';
		    // Do your thing ...

				$plan = Package::findorfail(\Session::get('plan_id'));

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
                'payment_id' => $response['referenceId'],
                'user_name' => $auth->name,
                'package_id' => $plan->id,
                'price' => $plan->amount,
                'status' => 1,
                'method' => 'cashfree',
                'subscription_from' => $current_date,
                'subscription_to' => $end_date
            ]);

            Session::forget('orderid');
            Session::forget('plan_id');

            if ($created_subscription) {
            	Session::forget('coupon_applied');
            	if(isset($mlt_screen) && $mlt_screen ==1){
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

            	if(env('MAIL_DRIVER') != NULL && env('MAIL_HOST') != NULL && env('MAIL_PORT') != NULL)
                {
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
			
			return back()->with('deleted','Fail Transcation');
		}
	    }
    }
    
}

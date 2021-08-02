<?php

namespace App\Http\Controllers;

use App\Config;
use App\Http\Requests;
use App\Menu;
use App\Package;
use Auth;
use App\Multiplescreen;
use App\PaypalSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Redirect;
use Session;
use Validator;
use App\Mail\SendInvoiceMailable;
use Illuminate\Support\Facades\Mail;

class Kingspaypayment extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
	/**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function kingspaypayment(Request $request)
    {
    	$KINGSPAY_KEY = env('KINGSPAY_KEY');
        $KINGSPAY_SECRET = env('KINGSPAY_SECRET');
        $plan = Package::findOrFail($request->plan_id);
        if(Session::has('coupon_applied')){
            $amount_coupon = $plan->amount - Session::get('coupon_applied')['amount'];
        }else{
            $amount_coupon = $plan->amount;
        }
        $amount_coupon = str_replace(".","",$amount_coupon);
        $currency_code = Config::first()->currency_code;
        $currency_code = strtoupper($currency_code);
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.kingspay-gs.com/api/payment/initialize',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{"amount":'.$amount_coupon.',
            "currency":"'.$currency_code.'",
            "description":"'.$plan->name.'",
            "merchant_callback_url":"https://app.alphatv.global/Kingspaypayment/getPaymentStatus",
            "payment_type":"international"
            }',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$KINGSPAY_SECRET,
                'Content-Type: application/json'
              ),
            ));

$response = curl_exec($curl);
curl_close($curl);
// echo $response;
// die;
$payment_id = json_decode($response);
$payment_id = json_decode(json_encode($payment_id), true);
// print_r($payment_id['payment_id']);
if(array_key_exists("payment_id",$payment_id)){
Session::put('kingspay_payment_id', $payment_id['payment_id']);
        Session::put('plan', $plan);
return redirect('https://kingspay-gs.com/payment?id='.$payment_id['payment_id']);
}else{
return redirect('https://app.alphatv.global/account/purchase/'.$request->plan_id);
}
    }

    public function getPaymentStatus(Request $request)
    {
        $menus = Menu::all();
        $user_email = Auth::user()->email;
        $com_email = Config::findOrFail(1)->w_email;

        Session::put('user_email', $user_email);
        Session::put('com_email', $com_email);

        /** Get the payment ID before session clear **/
        $payment_id = Session::get('kingspay_payment_id');
        $plan = Session::get('plan');
        if(Session::has('coupon_applied')){
            $amount_coupon = $plan->amount - Session::get('coupon_applied')['amount'];
        }else{
            $amount_coupon = $plan->amount;
        }
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        Session::forget('plan');
        
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.kingspay-gs.com/api/payment/'.$payment_id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;
$payment_status = json_decode($response);
$payment_status = json_decode(json_encode($payment_status), true);
        
        
        if ($payment_status['status'] == 'SUCCESS') { 
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            $current_date = Carbon::now();
            $end_date = null;

            if ($plan->interval == 'month') {
                $end_date = Carbon::now()->addMonths($plan->interval_count);
            } else if($plan->interval == 'year') {
                $end_date = Carbon::now()->addYears($plan->interval_count);
            } else if($plan->interval == 'week') {
                $end_date = Carbon::now()->addWeeks($plan->interval_count);
            } else if($plan->interval == 'day') {
                $end_date = Carbon::now()->addDays($plan->interval_count);
            }
            $auth = Auth::user();

            $created_subscription = PaypalSubscription::create([
                'user_id' => $auth->id,
                'payment_id' => $payment_id,
                'user_name' => $auth->name,
                'package_id' => $plan->id,
                'price' => $amount_coupon,
                'status' => 1,
                'method' => 'kingpay',
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
                
              if(env('MAIL_DRIVER') != NULL && env('MAIL_HOST') != NULL && env('MAIL_PORT') != NULL)
                {
                    try{
                        Mail::send('user.invoice', ['paypal_sub' => $created_subscription, 'invoice' => null], function($message) {
                            $message->from(Session::get('com_email'))->to(Session::get('user_email'))->subject('Invoice');
                        });
                        Session::forget('user_email');
                        Session::forget('com_email');
                    }
                    catch(\Swift_TransportException $e){
                      header( "refresh:5;url=./" );
                      dd("Payment Successfully ! but Invoice will not sent because admin not updated the mail setting in admin dashboard ! Redirecting you to homepage... !");
                    }
                }
                
               
            }

            if (isset($menus) && count($menus) > 0) {
              return redirect()->route('home', $menus[0]->slug)->with('added', 'Your are now a subscriber !');
            }
            return redirect('/')->with('added', 'Your are now a subscriber !');
        }

		return redirect('/')->with('deleted', 'Payment failed');
    }

    public function getPaymentFailed()
    {
        return redirect('/')->with('deleted', 'Payment failed');
    }

}

<?php

namespace App\Http\Controllers;

use Session;
use Cookie;
use Auth;
use App\Multiplescreen;
use App\Menu;
use App\Package;
use App\PaypalSubscription;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class PayViaInstamojoController extends Controller
{
   public function __construct(){

         $this->api = new \Instamojo\Instamojo(
               config('services.instamojo.api_key'),
               config('services.instamojo.auth_token'),
               config('services.instamojo.url')
           );
   }
   public function pay(Request $request)
   {

	  $plan = Package::find($request->plan_id);
      Cookie::queue('plan', $plan,10);
      Session::put('plan',$plan);
      

	  if(!isset($plan) && $plan == NULL){
         return back()->with('deleted','Plan Not Found !');
      }
	   try {

        
         $response = $this->api->paymentRequestCreate(array(
            "purpose" => "Membership Plan for ".$plan->name,
            "amount" => $request->amount,
            "buyer_name" => $request->name,
            "send_email" => true,
            "email" => $request->email,
            "phone" => $request->mobile,
            "redirect_url" => url('/instamojo/pay-success')
            ));
          
            header('Location: ' . $response['longurl']);
            exit();
	   }catch (Exception $e) 
      {
	        print('Error: ' . $e->getMessage());
	   }
	 }
	 
 	public function success(Request $request){
	  try {
//return Session::get('plan');
	     $plan = Session::get('plan');

        $api = new \Instamojo\Instamojo(
            config('services.instamojo.api_key'),
            config('services.instamojo.auth_token'),
            config('services.instamojo.url')
        );
	 
	     $response = $api->paymentRequestStatus(request('payment_request_id'));
        

         if (!isset($response['payments'][0]['status'])) {
                return back()->with('deleted','Payment failed !');
         } else if ($response['payments'][0]['status'] != 'Credit') {
               return back()->with('deleted','Payment failed !');
         } else {
            
            $payment_id = $response['payments'][0]['payment_id'];
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
                'payment_id' => $payment_id,
                'user_name' => $auth->name,
                'package_id' => $plan->id,
                'price' => $response['payments'][0]['amount'],
                'status' => 1,
                'method' => 'instamojo',
                'subscription_from' => $current_date,
                'subscription_to' => $end_date
            ]);
            if(isset($created_subscription)){
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
                
            }

            \Cookie::forget('plan');


            if (isset($menus) && count($menus) > 0)
            {
               return redirect()->route('home', $menus[0]->slug)->with('added', 'Your are now a subscriber !');
            }else{
                return redirect('/')->with('added', 'Your are now a subscriber !');
            }
         }
      }
	   catch (\Exception $e) {
	         return back()->with('deleted',$e->getMessage());
	    
     }
	    
	}
}

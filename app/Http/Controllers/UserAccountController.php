<?php

namespace App\Http\Controllers;

use App\User;
use App\Config;
use App\Mail\SendInvoiceMailable;
use App\Menu;
use App\Package;
use App\PaypalSubscription;
use App\PricingText;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Stripe\Customer;
use Stripe\Subscription;
use \Stripe\Coupon;
use \Stripe\Invoice;
use \Stripe\Stripe;
use Laravel\Cashier\Cashier;
use Session;
use Illuminate\Support\Facades\View;
use App\Mail\SendOTPEmail;

class UserAccountController extends Controller
{
    public function paywithKingsPay(Request $request){
        
        $config = Config::first();
        $kingspay = env('KINGSPAY_SECRET');
        
        $cardCharge = $kingspay->charges()->create([
            'amount'   => $request->amount,
            'currency' => 'usd',
            'customer' => $request->card_num,
            'description' => 'Payment Foro '.$request->description
        ]);
        dd($cardCharge);
    }
    
    public function sendMyOTP(Request $request, $id){
        $findMail = User::where('id', $id)->first();
        $user = User::whereEmail($findMail->email)->first();
        
        if($user){
            $uni_col = array(User::pluck('code'));
            do {
              $code = str_random(5);
            } while (in_array($code, $uni_col));            
            try{
                $config = Config::findOrFail(1);
                $logo = $config->logo;
                $email = $config->w_email;
                $company = $config->title;
                // Mail::send('forgotemail', ['code' => $code, 'logo' => $logo, 'company'=>$company], function($message) use ($user, $email) {
                //     $message->from($email)->to($user->email)->subject('Reset Password Code');
                // });
                
                Mail::to($user->email)->send(new SendOTPEmail($code, $logo, $company, $user->email)); 
                
                // $test = View::make('forgotemail', compact('code', 'logo', 'company', $request->email))->render();
                // echo $test;
                // die;
                $user->code = $code;
                $user->save();
                return back()->with('message','Data added Successfully');
                // return response()->json(['type' => 'success', 'message' => 'OTP Sent Successfully!']);
            }
            catch(\Swift_TransportException $e){
                return back()->with('deleted', 'Mail Sending Error!');
            }
        }
        else{
            return back()->with('deleted', 'User Not Found!');
        }
    }
    
    public function updateMyEmail(Request $request, $id){
        
        $user = User::where('id', $id)->first();
        if($request->verificationCode == $user->code) {
            $user->email = $request->newEmail;
            $user->save();
            return back()->with('added', 'Email Updated Successfully!');
        } else {
            return back()->with('deleted', 'Sorry! Your Verification Code Is Incorrect!');
        }
    }

    public function index()
    {
        // Set your secret key: remember to change this to your live secret key in production
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $auth = Auth::user();
        if ($auth->stripe_id != null) {
            // $customer = Customer::retrieve($auth->stripe_id);
           $customer = Cashier::findBillable($auth->stripe_id);
        }
        $paypal = $auth->paypal_subscriptions->sortBy('created_at');
        $plans = Package::all();
        $current_subscription = null;
        $method = null;
        $current_date = Carbon::now()->toDateString();
        if (isset($customer)) {
            //return $alldata = $user->asStripeCustomer()->subscriptions->data;
            $alldata = $auth->subscriptions;
            $data = $alldata->last();
        }
        if (isset($paypal) && $paypal != null && count($paypal) > 0) {
            $last = $paypal->last();
        }
        $stripedate = isset($data) ? $data->created_at : null;
        $paydate = isset($last) ? $last->created_at : null;
        if ($stripedate > $paydate) {
            if ($auth->subscribed($data->name)) {
                $current_subscription = $data;
                $method = 'stripe';
            }
        } elseif ($stripedate < $paydate) {
            if (date($current_date) <= date($last->subscription_to)) {
                $current_subscription = $last;
                $method = 'paypal';
            }
        }
        $paypalSubscription = \App\PaypalSubscription::where('user_id',$auth->id)->first();
        // return view('user.index', compact('plans', 'current_subscription', 'method'));
        return view('user.new_design', compact('plans', 'current_subscription', 'paypalSubscription', 'method'));
    }

    public function purchase_plan()
    {
        $plans = Package::where('packages.status', 1)->where('packages.delete_status', 1)->get();
        $pricingTexts = PricingText::all();
        // $plans = Package::select('packages.id', 'packages.plan_id', 'packages.name', 'packages.currency', 'packages.currency_symbol', 'packages.amount', 'interval', 'packages.interval_count', 'packages.trial_period_days', 'packages.status',  'packages.screens',  'packages.download', 'packages.downloadlimit', 'packages.delete_status','pricing_texts.title1', 'pricing_texts.title2', 'pricing_texts.title3', 'pricing_texts.title4', 'pricing_texts.title5', 'pricing_texts.title6')
        //                     ->leftJoin('pricing_texts', 'pricing_texts.package_id', '=', 'packages.id')
        //                     ->where('packages.status', 1)
        //                     ->where('packages.delete_status', 1)
        //                     ->get();
        return view('user.purchaseplan', compact('plans', 'pricingTexts'));
        // return view('user.new_purchaseplan', compact('plans', 'pricingTexts'));
    }

    public function get_payment(Request $request,$id)
    {
        $plan = Package::findOrFail($id);
        $config = Config::find(1);
        
        // echo "<pre>";
        // print_r(\Session::get('coupon_applied'));
        // exit;
        if(!isset($config) && $config == NULL){
            return back()->with('deleted','Default Settings not found !');
        }
        $bankdetails = $config->bankdetails;
        $razorpay_payment = $config->razorpay_payment;
        $instamojo_payment = $config->instamojo_payment;
        $stripe_payment = $config->stripe_payment;
        $kingspay_payment = $config->kingspay_payment;
        $mollie_payment = $config->mollie_payment;
        $cashfree_payment = $config->cashfree_payment;
        $account_name = $config->account_name;
        $account_no = $config->account_no;
        $ifsc_code = $config->ifsc_code;
        $bank = $config->bank_name;

        if(env('STRIPE_SECRET') != NULL && env('STRIPE_KEY') != NULL && $stripe_payment == 1){
            $paymentMethods = $request->user()->paymentMethods();

            $intent = $request->user()->createSetupIntent();
        }
        
        if(env('KINGSPAY_SECRET') != NULL && env('KINGSPAY_KEY') != NULL && $kingspay_payment == 1){
            $paymentMethods = $request->user()->paymentMethods();

            $kingspayintent = $request->user()->createSetupIntent();
        }

        //Session::forget('coupon_applied');     
        

        return view('subscribe', compact('plan', 'bankdetails', 'account_no', 'account_name', 'ifsc_code', 'bank','razorpay_payment','intent', 'kingspayintent', 'instamojo_payment','mollie_payment','cashfree_payment', 'kingspay_payment'));
    }

    public function subscribe(Request $request)
    {
        // require_once base_path().'/vendor/stripe/stripe-php/init.php';

        $menus = Menu::all();
        ini_set('max_execution_time', 80);
        // Set your secret key: remember to change this to your live secret key in production
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $auth = Auth::user();
        $token = $request->stripeToken;
        $coupon_valid = false;
        $coupon = $request->coupon;
        $plan = Package::find($request->plan);
        $paymentMethod = $request->paymentMethod;
        
        if(!$plan){
            return back()->with('delete','Plan not found !');
           
        }

        if ($coupon != null) {
            try
            {
                $stripe_coupon = Coupon::retrieve($coupon);
                $coupon_valid = true;
                if ($stripe_coupon->valid == false) {
                    $coupon_valid = false;
                    return back()->with('deleted', 'Coupon has been expired');
                }
            } catch (\Exception $e) {
                $error =  $e->getMessage();
                $coupon_valid = false;
            }
        }

        if($coupon_valid == false && $request->coupon){
            return back()->with('deleted', $error);
        }

        
            $plan_id = $plan->plan_id;
            $plan_name = $plan->name;

            if($coupon_valid == true && $request->coupon){
                try{
                    $purchased = $auth->newSubscription($plan_name, $plan_id)->withCoupon($request->coupon)->create($paymentMethod, [
                    'email' => $auth->email,
                    ]);
    
                    $last_plan = $auth->subscriptions->last(); 
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
    
                   \DB::table('subscriptions')->where('id','=',$last_plan->id)->update([
                        'subscription_from'=>$current_date,
                        'subscription_to'=> $end_date,
                        'amount' => $plan->amount
                   ]);
                   
                   if (isset($purchased) || $purchased != null) {
                        Mail::to($auth->email)->send(new SendInvoiceMailable());
                        if (isset($menus) && count($menus) > 0) {
                            return redirect()->route('home', $menus[0]->slug)->with('added', 'Your are now a subscriber !');
                        }
                        return redirect('/')->with('added', 'Your are now a subscriber !');
                    } else {
                        return back()->with('deleted', 'Subscription failed ! Please check your debit or credit card.');
                    }
                }
                catch(\Exception $e){
                    return back()->with('deleted', $e->getMessage());
                }
                 

            }
            else{

                try{
                    $purchased = $auth->newSubscription($plan_name, $plan_id)
                        ->create($paymentMethod, [
                        'email' => $auth->email
                    ]);
    
                       $last_plan = $auth->subscriptions->last(); 
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
    
                   \DB::table('subscriptions')->where('id','=',$last_plan->id)->update([
                        'subscription_from'=>$current_date,
                        'subscription_to'=> $end_date,
                        'amount' => $plan->amount
                   ]);
                   
                   if (isset($purchased) || $purchased != null) {
                        Mail::to($auth->email)->send(new SendInvoiceMailable());
                        if (isset($menus) && count($menus) > 0) {
                            return redirect()->route('home', $menus[0]->slug)->with('added', 'Your are now a subscriber !');
                        }
                        return redirect('/')->with('added', 'Your are now a subscriber !');
                    } else {
                        return back()->with('deleted', 'Subscription failed ! Please check your debit or credit card.');
                    }
                

                }catch(\Exception $e){
                    return back()->with('deleted', $e->getMessage());
                }
            }
    }

    public function edit_profile()
    {
        return view('user.edit_profile');
    }

    public function update_profile(Request $request)
    {
        $auth = Auth::user();

        if (Hash::check($request->current_password, $auth->password)) {
            if ($request->new_email !== null) {
                $request->validate([
                    'new_email' => 'required|email',
                    'current_password' => 'required',
                ]);
                $auth->update([
                    'email' => $request->new_email,
                ]);
                return back()->with('updated', 'Email has been updated');
            }

            if ($request->new_name !== null) {
                $request->validate([
                    'new_name' => 'required|',
                    'current_password' => 'required',
                ]);
                $auth->update([
                    'name' => $request->new_name,
                ]);
                return back()->with('updated', 'Name has been updated');
            }

            if ($request->new_password !== null) {
                $request->validate([
                    'new_password' => 'required|min:6',
                    'current_password' => 'required',
                ]);
                if($request->new_password != $request->confirm_password) {
                    return back()->with("deleted", "Your confirm password doesn't match");
                }
                $auth->update([
                    'password' => bcrypt($request->new_password),
                ]);
                return back()->with('updated', 'Password has been updated');
            }

        } else {
            return back()->with("deleted", "Your password doesn't match");
        }
        return back();
    }

    public function history()
    {
        $auth = Auth::user();
        // Set your secret key: remember to change this to your live secret key in production
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paypal_subscriptions = PaypalSubscription::where('user_id', $auth->id)->get();
        $customer = Cashier::findBillable($auth->stripe_id);

       // $customer = Invoice::retrieve($auth->stripe_id);
        if($customer){
            $invoices = $customer->invoices();
        }
       
        // $invoices = $auth->subscriptions;
        return view('user.history', compact('invoices', 'paypal_subscriptions'));
    }
    public function cancelSub($plan_id)
    {
        $auth = Auth::user();
        $auth->subscription($plan_id)->cancel();
        return back()->with('deleted', 'Subscription has been cancelled');
    }

    public function resumeSub($plan_id)
    {
        $auth = Auth::user();
        $auth->subscription($plan_id)->resume();
        return back()->with('updated', 'Subscription has been resumed');
    }

    public function PaypalCancel()
    {
        $auth = Auth::user();
        $auth->paypal_subscriptions->last()->status = 0;
        $auth->paypal_subscriptions->last()->save();
        return back()->with('deleted', 'Subscription has been cancelled');
    }

    public function PaypalResume()
    {
        $auth = Auth::user();
        $last = $auth->paypal_subscriptions->last();
        $last->status = 1;
        $last->save();
        return back()->with('updated', 'Subscription has been resumed');
    }
    public function watchhistory()
    {
        return view('search');
    }
}


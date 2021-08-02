<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Session;
use Exception;
use \Stripe\Stripe;
use \Stripe\Customer;
use App\PaypalSubscription;
use App\Config;
use Mail;
use Carbon\Carbon;
use Laravel\Cashier\Cashier;
use Menu;
use DB;
use Auth;
use Kutia\Larafirebase\Facades\Larafirebase;
use App\User;
use Illuminate\Support\Str;
use App\Package;
use App\PricingText;
use Illuminate\Support\Facades\View;
use App\Mail\SendOTPEmail;

class TestController extends Controller
{
    public function newDesign(){
        // dd(123);
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
        
        return view('user.new_design', compact('plans', 'current_subscription', 'method'));
        // return view('user.new_design');
    }
    
    public function newPackageDesign(){
        // $plans = Package::where('status', 1)->where('delete_status', 1)->get();
        // $pricingTexts = PricingText::all();
        $plans = Package::select('packages.id', 'packages.plan_id', 'packages.name', 'packages.currency', 'packages.currency_symbol', 'packages.amount', 'interval', 'packages.interval_count', 'packages.trial_period_days', 'packages.status',  'packages.screens',  'packages.download', 'packages.downloadlimit', 'packages.delete_status','pricing_texts.title1', 'pricing_texts.title2', 'pricing_texts.title3', 'pricing_texts.title4', 'pricing_texts.title5', 'pricing_texts.title6')
                            ->leftJoin('pricing_texts', 'pricing_texts.package_id', '=', 'packages.id')
                            ->where('packages.status', 1)
                            ->where('packages.delete_status', 1)
                            ->get();
        return view('user.new_purchaseplan', compact('plans'));
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
                return back()->with('added', 'OTP Sent Successfully!');
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
    
    public function editManageProfile(Request $request, $id) {

        $updateProfile = User::findOrFail($id);
        $profilePicture = $updateProfile->image;

        
        if ($request->hasFile('image')) {
            $userDestinationPath = public_path('/images/profile_picture/');
            if ($updateProfile->image != '') {
                @unlink(public_path('/images/profile_picture/' . $updateProfile->image));
            }
            $fileName = Str::random(6);
            $fileExt = request()->image->getClientOriginalExtension();
            $pic = $fileName . '.' . $fileExt;
            request()->profile_pic->move($userDestinationPath, $pic);
            $profilePicture = $pic;
        }
        $inputs = $request->only(['name', 'dob', 'mobile']) + ['image' => $profilePicture];
        $updateProfile->update($inputs);
        return response()->json(array('inputs' =>$inputs), 200);
      }
    
    public function getVideo()
    {
        $movies = Movie::all();
        return view('video', compact('movies'));
    }

    public function index()
    {
        return view('subscription.create');
    }

    public function orderPost(Request $request)
    {
            $user = auth()->user();
            $input = $request->all();
            $token =  $request->stripeToken;
            $paymentMethod = $request->paymentMethod;

            
            try {

               Stripe::setApiKey(env('STRIPE_SECRET'));
                
                if (is_null($user->stripe_id)) {
                    $stripeCustomer = $user->createAsStripeCustomer();
                }

                Customer::createSource(
                    $user->stripe_id,
                    ['source' => $token]
                );

                $user->newSubscription('test',$input['plane'])
                    ->create($paymentMethod, [
                    'email' => $user->email,
                ]);

                return back()->with('success','Subscription is completed.');
            } catch (Exception $e) {
                return back()->with('success',$e->getMessage());
            }
            
    }
    public function test(){
        $auth = Auth::user();
        $subscribed = null;
        $withlogin= Config::findOrFail(1)->withlogin;
        $catlog = Config::findOrFail(1)->catlog;   
        Stripe::setApiKey(env('STRIPE_SECRET')); 
      if (isset($auth)) {
     
        $current_date = Carbon::now();
        $paypal=PaypalSubscription::where('user_id',$auth->id)->orderBy('created_at','desc')->first();

        if (isset($paypal)) {
          if (date($current_date) <= date($paypal->subscription_to)) {
            if ($paypal->package_id==0) {
              $nav_menus=Menu::all();
              $subscribed=1;
            }
          }
        }

        $auth = Auth::user();
        if ($auth->is_admin == 1) {
          $subscribed = 1;
          $nav_menus=Menu::orderBy('position','ASC')->get();
        } else{
           
          Stripe::setApiKey(env('STRIPE_SECRET'));
          if ($auth->stripe_id != null) {
          
             $customer = Cashier::findBillable($auth->stripe_id);
            
          }
          if (isset($customer)) {         
              $data = $auth->subscriptions->last(); 
              return $auth->subscription($data->stripe_plan)->endsAt;     
          } 
          if (isset($paypal) && $paypal != null && $paypal->count()>0) {
            $last = $paypal;
          } 
          $stripedate = isset($data) ? $data->created_at : null;
          $paydate = isset($last) ? $last->created_at : null;
          if($stripedate > $paydate){
            if($auth->subscribed($data->name) && date($current_date) <= date($data->subscription_to) && $data->ends_at == null){
              $subscribed = 1;
              $planmenus= DB::table('package_menu')->where('package_id',$data->stripe_plan)->get();
               if(isset($planmenus)){ 
                foreach ($planmenus as $key => $value) {
                  $menus[]=$value->menu_id;
                }
              }
              if(isset($menus)){ 
                $nav_menus=Menu::whereIn('id',$menus)->get();
              }
            }
          }
          elseif($stripedate < $paydate){
            if ((date($current_date) <= date($last->subscription_to)) && $last->status == 1){
              $subscribed = 1;
              $planmenus= DB::table('package_menu')->where('package_id', $last->plan['plan_id'])->get();
              if(isset($planmenus)){ 
                foreach ($planmenus as $key => $value) {
                  $menus[]=$value->menu_id;
                }
              }
              if(isset($menus)){ 
                $nav_menus=Menu::whereIn('id',$menus)->get();
              }
            }
          }
        }
      }
    }

    public function sendNotification()
    {
        $deviceTokens = [
            'fnXn1nH7AJo:APA91bGQ74NqMldyEtpNdx3ZTL39omH_mpO6O1FD3TPNx8kIIa38qI8rlMOcHfHRy3F-Co_ZW7jQ36kRN1fWwENuImkZ4XIUHfBaV1AJCJlFtqtOQrTxo6ktUg5_ujONcVekEGKGOxw2'
        ];
        
        return Larafirebase::withTitle('Nexthour Test Title')
            ->withBody('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ')
            ->withImage('https://miro.medium.com/max/256/1*d69DKqFDwBZn_23mizMWcQ.png')
            ->withClickAction('admin/notifications')
            ->withPriority('high')
            ->sendNotification($deviceTokens);
        
        // Or
        //return Larafirebase::fromArray(['title' => 'Test Title', 'body' => 'Test body'])->sendNotification($deviceTokens);
    }
}

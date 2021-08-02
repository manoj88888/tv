<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use Session;
use Auth;
use App\Mail\verifyEmail;
use Illuminate\Support\Str;
use App\Mail\WelcomeUser;
use App\Config;
use Carbon\Carbon;
use Notification;
use App\Menu;
use App\Notifications\MyNotification;
use App\PaypalSubscription;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->config = Config::first();
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //   if($this->config->captcha == 1){

    //     return Validator::make($data, [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6|confirmed',
    //         'g-recaptcha-response' => 'required|captcha',
    //     ], [
    //         'name.required' => 'Please Choose a name',
    //         'email.required' => 'Email is required !',
    //         'email.email' => 'Email must be in valid format',
    //         'email.unique' => 'This email is already taken, Please choose another',
    //         'password.required' => 'Password cannot be empty',
    //         'password.confirmed' => "Password doesn't match",
    //         'password.min' => 'Password length must be greater than 6'
    //     ]);
    //   }

    //   else{

    //     return Validator::make($data, [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6|confirmed',
    //     ], [
    //         'name.required' => 'Please Choose a name',
    //         'email.required' => 'Email is required !',
    //         'email.email' => 'Email must be in valid format',
    //         'email.unique' => 'This email is already taken, Please choose another',
    //         'password.required' => 'Password cannot be empty',
    //         'password.confirmed' => "Password doesn't match",
    //         'password.min' => 'Password length must be greater than 6'
    //     ]);
    //   }

        
    // }

    public function register(Request $request){

      if($this->config->captcha == 1){

           $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'g-recaptcha-response' => 'required|captcha',
            ], [
                'name.required' => 'Please Choose a name',
                'email.required' => 'Email is required !',
                'email.email' => 'Email must be in valid format',
                'email.unique' => 'This email is already taken, Please choose another',
                'password.required' => 'Password cannot be empty',
                'password.confirmed' => "Password doesn't match",
                'password.min' => 'Password length must be greater than 6'
            ]);
          }

      else{

       $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Please Choose a name',
            'email.required' => 'Email is required !',
            'email.email' => 'Email must be in valid format',
            'email.unique' => 'This email is already taken, Please choose another',
            'password.required' => 'Password cannot be empty',
            'password.confirmed' => "Password doesn't match",
            'password.min' => 'Password length must be greater than 6'
        ]);
      }

      $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'is_admin' => 0,
            'status' => 1,
            'password' => bcrypt($request['password']),
            'verifyToken' => Str::random(40),
        ]);

     

      if($this->config->verify_email == 1){
 
          $user->status = 0;
          $user->save();

          try{

            Mail::to($user['email'])->send(new verifyEmail($user));

            return redirect()->route('login')->with('success','Verification Email has been sent to your email');

          }catch(\Exception $e){

            return redirect()->route('login')->with('success',$e->getMessage());

          }

          

      }else{
            Auth::login($user);
      }

      if($this->config->wel_eml == 1 && $this->config->verify_email == 0 ){
         if($this->config->free_sub == 1){
              $this->freesubscribe($user);
              Auth::login($user);
              if($this->config->remove_landing_page == 1){
              $menu = Menu::all();
                  return redirect()->route('home',$menu[0]->slug);
                }else{
                  return redirect('/');
                }
              //return redirect('/');
          }
        try{
          Mail::to($data['email'])->send(new WelcomeUser($user));
        }catch(\Exception $e){
            \Log::error('Mail can\'t sent to user'.$user->name.' at time of register');
        }

        Auth::login($user);


      }else{
        Auth::login($user);
      }
      if($this->config->wel_eml == 0 && $this->config->verify_email == 0){
          if($this->config->free_sub == 1){
              $this->freesubscribe($user);
            //   Auth::login($user);
            //   return redirect('/');
          }
          Auth::login($user);
          if($this->config->remove_landing_page == 1){
          $menu = Menu::all();
                  return redirect()->route('home',$menu[0]->slug);
                }else{
                  return redirect('/');
                }
        //return redirect('/');
      }
      
     
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */





public function freesubscribe($thisuser){
    $start=Carbon::now();
    $end=$start->addDays($this->config->free_days);
    $payment_id=mt_rand(10000000000000, 99999999999999);
    $created_subscription = PaypalSubscription::create([
        'user_id' => $thisuser->id,
        'payment_id' => $payment_id,
        'user_name' => $thisuser->name,
        'package_id' => 0,
        'price' => 0,
        'status' => 1,
        'method' => 'free',
        'subscription_from' => Carbon::now(),
        'subscription_to' => $end
    ]);

    $ps=PaypalSubscription::where('user_id',$thisuser->id)->first();
    $to= Str::substr($ps->subscription_to,0, 10);
    $from= Str::substr($ps->subscription_from,0, 10);
    $title=$this->config->free_days.' Days '.__('staticwords.freetrial');
    $desc=__('staticwords.freetrialtext').' '.$from.' to '.$to;
    $movie_id=NULL;
    $tvid=NULL;
    $user=$thisuser->id;
    User::find($thisuser->id)->notify(new MyNotification($title,$desc,$movie_id,$tvid,$user));


}


public function sendEmailDone($email, $verifyToken){
     $user = User::where(['email' => $email, 'verifyToken' => $verifyToken])->first();

    if($user){
        User::where(['email' => $email, 'verifyToken' => $verifyToken])->update(['status'=>'1','verifyToken'=>NULL]);
        Session::flash('success', 'Email Verification Successfull');

        Mail::to($user->email)->send(new WelcomeUser($user));
         if($this->config->free_sub == 1){
              $this->freesubscribe($user);
            //   Auth::login($user);
            //   return redirect('/');
          }
        return redirect()->route('login');
    }else{
        return 'user not found';
    }
}

}


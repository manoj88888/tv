<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\PaypalSubscription;
use DateTime;
use App\User;
use Auth;
use App\ReminderMail;
use Mail;
use App\Mail\SendReminderEmail;

class CheckUserPlanValidity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sub:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $all = PaypalSubscription::where('user_id',1888)->get();
        
        // $all = PaypalSubscription::where('id', 18)->get();
        foreach ($all as $key => $value) {
            /*get before*/

            $cur_date = date('Y-m-d');
            $plan_end_date = $value->subscription_to;
            $datetime1 = new DateTime($cur_date);
            $datetime2 = new DateTime($plan_end_date);
            $interval = $datetime1->diff($datetime2);
            $interval2 = $datetime2->diff($datetime1);
            $beforedays = $interval->format('%a');
            
            $afterdays = $interval2->format('%a');
            $url = url('account/purchaseplan');
            
            // if($beforedays == 7 && $value->status == 1){
            //     /*fire a mail*/
                
            //     // $msg = 'Your subscription will expire in 7 days';
            //     $msg = 'Your Alpha Subscription will expire soon. We know you do not want that to happen. Please click here to renew now.';
            //     $exsitRow = ReminderMail::where('user_id',$value->user->id)->where('subscription_id',$value->id)->where('before_7day',1)->first();
            //     if(!isset($exsitRow)){
            //         try{
            //             Mail::to($value->user->email)->send(new SendReminderEmail($msg,$url)); 
                 
            //             if (Mail::failures()) {
            //             // return failed mails
            //                 return new Error(Mail::failures()); 
            //             }else{
            //               //dd($s);
            //                 $reminderRow=ReminderMail::where('user_id',$value->user->id)->where('subscription_id',$value->id)->first();
            //                 if(isset($reminderRow) && $reminderRow != NULL){
            //                      ReminderMail::where('id',$reminderRow->id)->update(['user_id'=>$value->user->id,'before_7day'=>1]);
            //                 }else{
            //                     ReminderMail::create(['subscription_id' => $value->id,'user_id'=>Auth::user()->id,'before_7day'=>1,'today'=>NULL,'after_7day'=>NULL]);
            //                 }
                            
            //             }
            //          }catch(\Swift_TransportException $e){
            //         }
            //     }
            // }
            
            
            //Main Code Start
            if($afterdays == 0 && $value->status == 1){
                /*fire a mail*/

                //  $msg = 'Your subscription is expiring today';
                $msg = 'Your Alpha Subscription will expire soon. We know you do not want that to happen. Please click here to renew now.';
                $exsitRow = ReminderMail::where('user_id',$value->user->id)->where('subscription_id',$value->id)->where('today',1)->first();
                if(!isset($exsitRow)){
                    try{
                        Mail::to($value->user->email)->send(new SendReminderEmail($msg,$url)); 
                 
                        if (Mail::failures()) {
                       /* echo "string";
                        exit();*/
                            return new Error(Mail::failures()); 
                        }else{
                          //dd($s);
                            $reminderRow=ReminderMail::where('user_id',$value->user->id)->where('subscription_id',$value->id)->first();
                            if(isset($reminderRow) && $reminderRow != NULL){
                                ReminderMail::where('id',$reminderRow->id)->update(['user_id'=>$value->user->id,'today'=>1]);
                            }else{
                                ReminderMail::create(['subscription_id' => $value->id,'user_id'=>$value->user->id,'before_7day'=>NULL,'today'=>1,'after_7day'=>NULL]);
                            }
                            
                        }
                     }catch(\Swift_TransportException $e){
                    }
                }
            }
            //Main Code End
            
            
            // if($beforedays == 0 && $value->status == 1){
            //     /*fire a mail*/
              
            //     $msg = 'Your Plan is expire.';
            //     $exsitRow = ReminderMail::where('user_id',$value->user->id)->where('subscription_id',$value->id)->where('after_7day',1)->first();
            //     if(!isset($exsitRow)){
            //         try{
            //             Mail::to($value->user->email)->send(new SendReminderEmail($msg,$url)); 
                 
            //             if (Mail::failures()) {
            //             // return failed mails
            //                 return new Error(Mail::failures()); 
            //             }else{
            //               //dd($s);
            //                 $reminderRow=ReminderMail::where('user_id',$value->user->id)->where('subscription_id',$value->id)->first();
            //                 if(isset($reminderRow) && $reminderRow != NULL){
            //                      ReminderMail::where('id',$reminderRow->id)->update(['user_id'=>$value->user->id,'after_7day'=>1]);
            //                 }else{
            //                     ReminderMail::create(['subscription_id' => $value->id,'user_id'=>Auth::user()->id,'before_7day'=>NULL,'today'=>NULL,'after_7day'=>1]);
            //                 }
                            
            //             }
            //          }catch(\Swift_TransportException $e){
            //         }
            //     }
            // }
        }
    }
}

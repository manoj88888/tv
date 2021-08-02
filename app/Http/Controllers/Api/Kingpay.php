<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Package;
use App\Config;
// use Auth;

class Kingpay extends Controller
{
    public function Kingspay_subscription_api(Request $request)
    {
    	$KINGSPAY_KEY = env('KINGSPAY_KEY');
        $KINGSPAY_SECRET = env('KINGSPAY_SECRET');
        $plan = Package::findOrFail($request->plan_id);
        // if(Session::has('coupon_applied')){
        //     $amount_coupon = $plan->amount - Session::get('coupon_applied')['amount'];
        // }else{
            $amount_coupon = $request->amount;
        // }
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
// print_r($payment_id);
// exit;
if (array_key_exists("payment_id",$payment_id)){
Session::put('kingspay_payment_id', $payment_id['payment_id']);
        Session::put('plan', $plan);
// return redirect('https://kingspay-gs.com/payment?id='.$payment_id['payment_id']);
return print_r('https://kingspay-gs.com/payment?id='.$payment_id['payment_id']);
exit;
}else{
//  return redirect('https://app.alphatv.global/account/purchase/'.$request->plan_id);   
 return print_r('https://app.alphatv.global/account/purchase/'.$request->plan_id);   
}
// print_r(444);
    }
}

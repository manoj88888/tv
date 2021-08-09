<?php

namespace App\Http\Controllers;

use App\Config;
use App\CouponCode;
use App\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Stripe\Coupon;
use \Stripe\Stripe;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = CouponCode::all();
        $planData = [];
        return view('admin.coupon.index', compact('coupons','planData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plans =  Package::where('packages.status', 1)->where('packages.delete_status', 1)->get();
        $planData = [];
        foreach($plans as $plan){
            $planData[$plan->id] = ucfirst($plan->name);
        }
        return view('admin.coupon.create', compact('planData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        
        $stripe_payment = Config::findOrFail(1)->stripe_payment;
            $request->validate([
                'coupon_code' => 'required',
                'duration' => 'required',
                'max_redemptions' => 'required|integer|min:0',
            ]);

            $input = $request->all();
            $redeem_by = Carbon::parse($input['redeem_by']);
            $redeem_by = strtotime($redeem_by->format('Y/m/d H:i'));

            if (!isset($input['percent_check'])) {
                $input['amount_off'] = $input['amount'];
                $input['percent_off'] = null;
            } elseif ($input['percent_check'] == 1) {
                $input['percent_off'] = $input['amount'];
                $input['amount_off'] = null;
            }

            if(isset($input['in_stripe'])){
                $input['in_stripe'] = 1;
            }else{
                $input['in_stripe'] = 0;
            }

            $plans = !empty($input['plans'])?implode(',',$input['plans']) : '';
          
            try {


                if (isset($input['in_stripe']) && $input['in_stripe'] == 1) {
                   
                    $coupon = $coupon_generate = Coupon::create(array(
                        "percent_off" => $input['percent_off'],
                        "duration" => $input['duration'],
                        "duration_in_months" => $input['duration_in_months'],
                        "id" => $input['coupon_code'],
                        "currency" => $input['currency'],
                        "amount_off" => $input['amount_off'],
                        "max_redemptions" => $input['max_redemptions'],
                        "redeem_by" => $redeem_by,
                    ));
                 
                }
    
                    CouponCode::create([
                        "percent_off" => $input['percent_off'],
                        "duration" => $input['duration'],
                        "duration_in_months" => $input['duration_in_months'],
                        "coupon_code" => $input['coupon_code'],
                        "currency" => $input['currency'],
                        "amount_off" => $input['amount_off'],
                        "max_redemptions" => $input['max_redemptions'],
                        "redeem_by" => $redeem_by,
                        "in_stripe" => $input['in_stripe'],
                        "plan_ids" => $plans,
                        "is_free" => isset($input['is_free']) ? $input['is_free'] : 0,
                        "day_for_free" => isset($input['for_days']) ? $input['for_days'] : 0,
                    ]);
               
                return back()->with('added', 'Coupon has been added.');
            } catch (\Exception $e) {
                return back()->with('deleted', $e->getMessage());
            }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        Stripe::setApiKey(config('services.stripe.secret'));
        $coupon = CouponCode::findORFail($id);
        if($coupon->in_stripe == 1){
            try {
                $stripe_coupon = Coupon::retrieve($coupon->coupon_code);
                $stripe_coupon->delete();
            } catch (\Exception $e) {
                return back()->with('deleted', $e->getMessage());
            }
        }
        $coupon->delete();
        return back()->with('deleted', 'Coupon has been deleted');
    }

    public function bulk_delete(Request $request)
    {
         if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        Stripe::setApiKey(config('services.stripe.secret'));
        $validator = Validator::make($request->all(), [
            'checked' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('deleted', 'Please select one of them to delete');
        }

        foreach ($request->checked as $checked) {
            $coupon = CouponCode::findORFail($checked);
             if($coupon->in_stripe == 1){
                try {
                    $stripe_coupon = Coupon::retrieve($coupon->coupon_code);
                    $stripe_coupon->delete();
                } catch (\Exception $e) {
                    return back()->with('deleted', $e->getMessage());
                }
            }
            $coupon->delete();
        }

        return back()->with('deleted', 'Coupons has been deleted');
    }
}

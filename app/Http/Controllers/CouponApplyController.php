<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CouponCode;
use Illuminate\Support\Carbon;
use Session;
use App\Package;
use App\CouponApply;

class CouponApplyController extends Controller
{
   public function get(Request $request)
   {
   	//return $request;
   	//return $request;
   		$coupon = CouponCode::where('coupon_code',$request->coupon_code)->first();
   		
   		$plan = Package::where('id',$request->plan_id)->first();
   			
   		if($request->has('is_remove')) {
   		    $query = $coupon->update(['max_redemptions' => $coupon->max_redemptions + 1 ]); 
   		    $coupon_apply = CouponApply::where('user_id',auth()->user()->id)->where('coupon_id',$coupon->id)->first();
   		    if($coupon_apply) {
   		        $coupon_apply->delete();
   		    }
   		    Session::forget('coupon_applied');  
   		    return back()->with('success','Coupon '.ucfirst($coupon->coupon_code).' is remove successfully !');
   		}
	    if(isset($coupon) && $coupon != NULL){
   		$getPlanIds = explode(',',$coupon->plan_ids);
   		
   		if(!in_array($request->plan_id,$getPlanIds)){
   		     return back()->with('deleted','Coupon Invalid 123!');
   		}
   		
  
	      $current_date = Carbon::now();
	      if($current_date < $coupon->redeem_by){
	          
	        if($coupon->max_redemptions != 0){
	        	if($coupon->duration == 'once'){
	        		$coupon_apply = CouponApply::where('user_id',auth()->user()->id)->where('coupon_id',$coupon->id)->first();
		        	if(!$coupon_apply && $coupon_apply == NULL){
		        	     $apply_coupon = CouponApply::insert([ 'user_id'=>auth()->user()->id, 'coupon_id'=>$coupon->id, 'redeem'=> 1 ]);
		        	}else{
		        		 return back()->with('deleted','Coupon limit reached!');
		        	}
	        	}
	           $query = $coupon->update(['max_redemptions' => $coupon->max_redemptions - 1 ]);
	          
	          if($coupon->amount_off != NULL){
	          	$amount = $coupon->amount_off;
	          }else{
	          	$amount = ($plan->amount * $coupon->percent_off)/100;
	          }
	          
	          
	        
	          if($amount == $plan->amount && $coupon->day_for_free != 0){
	               Session::put('coupon_applied',[
	          	'code' => $coupon->coupon_code,
	          	'amount' => $amount,
	          	'id' => $coupon->id,
				'percent_off' => $coupon->percent_off,
	          	'free_days' =>$coupon->day_for_free
	          	]);
	          	
	             
	          }else{
	              
	             Session::put('coupon_applied',[
	          	'code' => $coupon->coupon_code,
	          	'amount' => $amount,
	          	'id' => $coupon->id,
				'percent_off' => $coupon->percent_off
	          ]);
	          }
	          
	         return back()->with('success','Coupon '.ucfirst($coupon->coupon_code).' is applied successfully !');
	        }
	        else{
	          
	          return back()->with('deleted','Coupon is not available !');
	        }
	      }else{
	          
	         return back()->with('deleted','Coupon Expired !');
	      }
	    }else{
	         Session::pull('coupon_applied');
	        return back()->with('deleted','Coupon Invalid !');
	    }
   }
}

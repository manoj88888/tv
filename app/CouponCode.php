<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponCode extends Model
{
    protected $fillable = [
        'coupon_code',
        'percent_off',
        'currency', 
        'amount_off',
        'duration',
        'max_redemptions',
        'redeem_by',
        'in_stripe',
        'plan_ids',
        'is_free',
        'day_for_free'
        
    ];

    protected $dates = [
        'redeem_by'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaypalSubscription extends Model
{
    protected $fillable = [
    	'user_id',
    	'payment_id',
    	'user_name',
    	'package_id',
    	'price',
    	'coupon',
    	'status',
        'method',
    	'subscription_from',
    	'subscription_to'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function plan()
    {
        return $this->belongsTo('App\Package', 'package_id');
    }
}

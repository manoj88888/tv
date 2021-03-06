@extends('layouts.theme')
@section('title',__('staticwords.subscribe'))
@section('main-wrapper')
<style type="text/css">
    .paypal-button.paypal-button-color-gold
    {
    display: none !important;  
    }
</style>
<section id="main-wrapper" class="main-wrapper user-account-section stripe-content">
    <div class="container-fluid">
        <h3 class="payment-title">{{__('staticwords.paymentinformation')}}</h3>
        <br/>
        <div class="col-md-12">
            <p class="errors_message">
            </p>
        </div>
        <div class="row panel-setting-main-block">
            <div class="col-md-6 col-sm-6 package_information ">
                <div class="panel-default">
                    <div class="panel-heading">{{__('staticwords.purchasepackageinformation')}}</div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>{{__('staticwords.packagename')}}</th>
                                <td>{{$plan->name}}</td>
                            </tr>
                            <tr>
                                <th>{{__('staticwords.amount')}}</th>
                                <td><i class="{{ $plan->currency_symbol }}"></i> {{number_format(($plan->amount) / ($plan->interval_count),2)}}</td>
                            </tr>
                            @if(Session::has('coupon_applied'))
                            <tr>
                                <th>{{__('Coupon')}} - (<b>{{ucfirst(Session::get('coupon_applied')['code'])}}</b>)</th>
                                <td><i class="{{ $plan->currency_symbol }}"></i> {{Session::get('coupon_applied')['amount'] }} OFF</td>
                            </tr>
                            <tr>
                                <th>{{__('Total Amount')}}</th>
                                <td><i class="{{ $plan->currency_symbol }}"></i> {{$plan->amount - Session::get('coupon_applied')['amount'] }} /  {{$plan->interval}}</td>
                                <input type="hidden" value="{{$plan->amount - Session::get('coupon_applied')['amount'] }}" class="final_pay">
                            </tr>
                            @endif
                            @if(!Session::has('coupon_applied'))
                            <tr>
                                <th>{{__('staticwords.duration')}}</th>
                                <td><i class="{{$plan->currency_symbol}}"></i> {{number_format(($plan->amount) / ($plan->interval_count),2)}}/
                                    {{$plan->interval}}
                                </td>
                                <input type="hidden" value="{{$plan->amount}}" class="final_pay">
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
                <h4 class="heading"><a href="{{url('account')}}">{{ __('staticwords.Pay') }} &nbsp;<i class="{{ $currency_symbol }}"></i> {{ $plan->amount }} {{ __('staticwords.pay_method') }}</a></h4>
                <hr/>
                <div class="row">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    @if(Session::has('deleted'))
                    <div class="alert alert-danger">
                        {{Session::get('deleted')}}
                    </div>
                    @endif
                </div>
                <form action="{{route('coupon.apply')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-10 col-xs-10">
                                {{--  <label for="coupon">Apply Coupon</label> --}}
                                @php
                                $coupon_applied = '';
                                $disabled = "";
                                $btn_name = "Apply";
                                if(Session::has('coupon_applied')) {
                                $coupon_applied = ucfirst(Session::get('coupon_applied')['code']);
                                $disabled = "readonly='readonly'";
                                $btn_name = "Remove";
                                }
                                @endphp
                                <input id="coupon" class="form-control" type="text" name="coupon_code" placeholder="Enter Your Coupon Code" value="{{ $coupon_applied }}" {{ $disabled }}>
                                <input id="plan_id" class="form-control" type="hidden" name="plan_id" value="{{$plan->id}}" >
                                <input id="user_id" class="form-control" type="hidden" name="user_id" value="{{Auth::user()->id}}" >
                                @if(Session::has('coupon_applied'))
                                <input id="is_remove" class="form-control" type="hidden" name="is_remove" value="1" >
                                @endif
                            </div>
                            <div class="col-sm-2 col-xs-2">
                                <input type="submit" class="btn btn-md btn-info applybutton" value="{{ $btn_name }}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-sm-6">
                &nbsp;
                <div class="col-md-12 col-xs-12">
                    <!-- required for floating -->
                    <!-- Nav tabs -->
                    &nbsp;
                    <ul class="nav nav-tabs tabs-left sideways">
                        @if($currency_code == "USD")
                        <!-- stripe tab -->
                        @if (isset($stripe_payment) && $stripe_payment == 1)
                        <li class="active"><a href="#stripe" data-toggle="tab">{{ __('staticwords.CheckoutWith') }} Stripe</a></li>
                        @endif
                        <!-- end stripe -->
                        <!-- paypal tree -->
                        @if (isset($paypal_payment) && $paypal_payment == 1)
                        {{--<li><a href="#paypal" data-toggle="tab">{{ __('staticwords.CheckoutWith') }} Paypal !</a></li>--}}
                        <li>
                            <div id="paypal-button-container"></div>
                        </li>
                        @endif
                        <!-- paypal end -->
                        <!-- kingspay tree -->
                        @if (isset($kingspay_payment) && $kingspay_payment == 1)
                        <li><a href="#kingspay" data-toggle="tab">{{ __('staticwords.CheckoutWith') }} Kingspay !</a></li>
                        @endif
                        <!-- kingspay end -->
                        <!-- kingspay tree -->
                        @if (!empty(Session::get('coupon_applied')) && array_key_exists("is_free",Session::get('coupon_applied')) )
                        <li><a href="#subscribe" data-toggle="tab">Subscibe</a></li>
                        @endif
                        <!-- kingspay end -->
                        <!-- braintree tab -->
                        @if(isset($braintree) && $braintree==1)
                        <li><a href="#braintree" data-toggle="tab">{{ __('staticwords.CheckoutWith') }} Braintree</a></li>
                        @endif
                        <!-- end braintree -->
                        <!-- coinpayment tab -->
                        @if(isset($coinpay) && $coinpay==1)
                        <li><a href="#coinpay" data-toggle="tab">{{ __('staticwords.CheckoutWith') }} CoinPayment</a></li>
                        @endif
                        <!-- end coin payment -->
                        @endif
                        <!-- Mollie tab -->
                        @if (isset($mollie_payment) && $mollie_payment == 1)
                        <li><a href="#mollie" data-toggle="tab">{{ __('staticwords.CheckoutWith') }} Mollie</a></li>
                        @endif
                        <!-- end Mollie -->
                        <!-- Cashfree tab -->
                        @if (isset($cashfree_payment) && $cashfree_payment == 1)
                        <li><a href="#cashfree" data-toggle="tab">{{ __('staticwords.CheckoutWith') }} Cashfree</a></li>
                        @endif
                        <!-- end cashfree -->
                        @if($currency_code == "INR")
                        <!-- payu tab -->
                        @if (isset($payu_payment) && $payu_payment == 1)
                        <li><a href="#payu" data-toggle="tab">{{ __('staticwords.CheckoutWith') }} PayUmoney !</a></li>
                        @endif
                        <!-- end payu tab -->
                        <!-- Paytm tab-->
                        @if (isset($paytm_payment) && $paytm_payment == 1)
                        <li><a href="#paytm" data-toggle="tab">{{ __('staticwords.CheckoutWith') }} Paytm</a></li>
                        @endif
                        <!-- end paytm-->
                        <!-- Razorpay tab-->
                        @if (isset($razorpay_payment) && $razorpay_payment == 1)
                        <li><a href="#razorpay" data-toggle="tab">{{ __('staticwords.CheckoutWith') }} Razorpay</a></li>
                        @endif
                        <!-- end razorpay-->
                        <!-- Instamojo tab-->
                        @if (isset($instamojo_payment) && $instamojo_payment == 1)
                        <li><a href="#instamojo" data-toggle="tab">{{ __('staticwords.CheckoutWith') }} Instamojo</a></li>
                        @endif
                        <!-- end instamojo-->
                        @endif
                        @if($currency_code == "NGN" || $currency_code == "GHS")
                        <!-- Paystack Tab -->
                        @if(isset($paystack) && $paystack == 1)
                        <li><a href="#paystack" data-toggle="tab">{{ __('staticwords.CheckoutWith') }} Paystack</a></li>
                        @endif
                        @endif
                        @if (isset($bankdetails) && $bankdetails == 1) 
                        <li><a href="#bankdetails" data-toggle="tab">{{ __('staticwords.CheckoutWith') }} {{ __('staticwords.BankTransfer') }}</a></li>
                        @endif
                        <!-- VIP Subscription tab-->
                        @if(Session::has('coupon_applied') && Session::get('coupon_applied')['percent_off'] == 100)
                        <li><a href="{{ url('user/vip-subscription/'.$plan->id.'/'.Session::get('coupon_applied')['id']) }}">VIP Subscription !</a></li>
                        @endif
                        <!-- VIP Subscription tab-->
                    </ul>
                </div>
                <br/>
                <div class="col-md-7 col-xs-12">
                    <!-- Tab panes -->
                    &nbsp;
                    
                    <div class="tab-content">
                        <!-- Stript tab -->
                        @if (isset($stripe_payment) && $stripe_payment == 1)
                        <div class="tab-pane active" id="stripe">
                            @if(env('STRIPE_KEY') != NULL && env('STRIPE_SECRET') != NULL)
                            {!! Form::open(['method' => 'POST', 'action' => 'UserAccountController@subscribe', 'id' => 'payment-form']) !!}
                            {{csrf_field()}}
                            <div class="form-row">
                                {{-- 
                                <div class="form-group">
                                    <label for="coupon">Apply Coupon</label>
                                    <input id="coupon" class="form-control" type="text" name="coupon" placeholder="Enter Your Coupon Code">
                                </div>
                                --}}
                                <input type="hidden" name="plan" value="{{$plan->id}}">
                                <label for="card-element">
                                Credit or debit card
                                </label>
                                <div id="card-element">
                                    <!-- a Stripe Element will be inserted here. -->
                                </div>
                                <!-- Used to display form errors -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                            <button id="card-button" data-secret="{{ $intent->client_secret }}" class="payment-btn stripe"><i class="fa fa-credit-card"></i> Submit Payment</button>
                            {!! Form::close() !!}
                            @else
                            @component('components.alert')
                            Stripe Payment
                            @endcomponent
                            @endif
                        </div>
                        @endif
                        <!-- end stripe -->
                        <!-- paypal tab -->
                        @if (isset($paypal_payment) && $paypal_payment == 1)
                        <div class="tab-pane" id="paypal">
                            @if(env('PAYPAL_CLIENT_ID') != NULL && env('PAYPAL_SECRET_ID') != NULL && env('PAYPAL_MODE') != NULL)
                            {!! Form::open(['method' => 'POST', 'action' => 'PaypalController@postPaymentWithpaypal']) !!}
                            <input type="hidden" name="plan_id" value="{{$plan->id}}">
                            <input type="hidden" name="amount" value="{{$plan->amount - session()->has('coupon_applied') ? Session::get('coupon_applied')['amount'] : 0}}">
                            <button class="payment-btn paypal-btn"><i class="fa fa-credit-card"></i> {{__('staticwords.payvia')}} Paypal</button>
                            {!! Form::close() !!}
                            @else
                            @component('components.alert')
                            Paypal Payment
                            @endcomponent
                            @endif
                        </div>
                        @endif
                        <!-- end paypal -->
                        <!-- kingspay_payment tab -->
                        @if (isset($kingspay_payment) && $kingspay_payment == 1)
                        <div class="tab-pane" id="kingspay">
                            @if(env('KINGSPAY_KEY') != NULL && env('KINGSPAY_SECRET') != NULL)
                            {!! Form::open(['method' => 'POST', 'action' => 'Kingspaypayment@kingspaypayment']) !!}
                            <input type="hidden" name="plan_id" value="{{$plan->id}}">
                            <input type="hidden" name="amount" value="{{$plan->amount - session()->has('coupon_applied') ? Session::get('coupon_applied')['amount'] : 0}}">
                            <button class="payment-btn paypal-btn"><i class="fa fa-credit-card"></i> {{__('staticwords.payvia')}} kingspay</button>
                            {!! Form::close() !!}
                            @else
                            @component('components.alert')
                            Paypal Payment
                            @endcomponent
                            @endif
                        </div>
                        @endif
                        <!-- end kingspay_payment -->
                        <!-- Braintree tab -->
                        @if(isset($braintree) && $braintree==1)
                        <div class="tab-pane" id="braintree">
                            @if(env('BTREE_ENVIRONMENT') != NULL && env('BTREE_MERCHANT_ID') !=NULL && env('BTREE_PUBLIC_KEY') !=NULL && env('BTREE_PRIVATE_KEY') != NULL && env('BTREE_MERCHANT_ACCOUNT_ID') != NULL)
                            <div id="paypal-errors" role="alert"></div>
                            <a href="javascript:void(0);" class="payment-btn bt-btn"><i class="fa fa-credit-card"></i> {{__('staticwords.payvia')}} Card / Paypal</a>
                            <div class="braintree">
                                <form method="POST" id="bt-form" action="{{ url('payment/braintree') }}">
                                    {{ csrf_field() }} 
                                    <div class="form-group">
                                        <label for="amount">{{__('staticwords.amount')}}</label>                       
                                        <input type="text" class="form-control"name="amount" readonly="" value="{{$plan->amount - session()->has('coupon_applied') ? Session::get('coupon_applied')['amount'] : 0}}">  
                                    </div>
                                    <div class="bt-drop-in-wrapper">
                                        <div id="bt-dropin"></div>
                                    </div>
                                    <input type="hidden" name="plan_id" value="{{$plan->id}}"/>
                                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                                    <div id="pay-errors" role="alert"></div>
                                    <button class="payment-btn" type="submit"><span>{{__('staticwords.paynow')}}</span></button>
                                </form>
                            </div>
                            @else
                            @component('components.alert')
                            Braintree Payment
                            @endcomponent
                            @endif
                        </div>
                        @endif
                        <!-- end braintree -->
                        <!-- Mollie tab -->
                        @if (isset($mollie_payment) && $mollie_payment == 1) 
                        <div class="tab-pane" id="mollie">
                            @if(env('MOLLIE_KEY') != NULL)
                            <div class="paymollie">
                                <form method="POST" action="{{ route('payviamoli_subscription') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="amount" value="{{$plan->amount - session()->has('coupon_applied') ? Session::get('coupon_applied')['amount'] : 0}}"> 
                                    <input type="hidden" name="currency" value="{{$plan->currency}}"> 
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="metadata" value="{{ json_encode($array = ['plan_id' => $plan->id,]) }}" > 
                                    <button class="payment-btn paymollie-btn"><i class="fa fa-credit-card"></i> Pay Via Mollie</button>
                                </form>
                            </div>
                            @endif
                        </div>
                        @endif 
                        <!-- end Mollie -->
                        <!-- cashfree tab -->
                        @if (isset($cashfree_payment) && $cashfree_payment == 1)
                        <div class=" row tab-pane" id="cashfree">
                            @if(env('CASHFREE_APP_ID') != NULL && env('CASHFREE_SECRET_ID') != NULL && env('CASHFREE_API_END_URL') != NULL)
                            @if(isset(Auth::user()->mobile) && Auth::user()->mobile != NULL)
                            <div class="cashfree">
                                {!! Form::open(['method' => 'POST', 'action' => 'PayViaCashFreeController@payment']) !!}
                                <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                <input type="hidden" name="amount" value="{{$plan->amount - session()->has('coupon_applied') ? Session::get('coupon_applied')['amount'] : 0}}">
                                <input type="hidden" name="currency" value="{{$plan->currency}}">
                                <button class="payment-btn cashfree-btn"><i class="fa fa-credit-card"></i> Pay Via Cashfree</button>
                                {!! Form::close() !!}
                            </div>
                            @else
                            <p class="text-danger">Please filled your mobile no. <a href="{{url('/account/profile')}}">{{__('clickhere')}}</a></p>
                            @endif
                            @else
                            @component('components.alert')
                            Cashfree
                            @endcomponent
                            @endif
                        </div>
                        @endif 
                        <!-- end cashfree tab -->
                        <!-- coinpayment tab -->
                        @if(isset($coinpay) && $coinpay==1)
                        <div class="tab-pane" id="coinpay">
                            @if(env('COINPAYMENTS_MERCHANT_ID') != NULL && env('COINPAYMENTS_PUBLIC_KEY') != NULL && env('COINPAYMENTS_PRIVATE_KEY') != NULL)
                            <div class="coinpayment">
                                <form method="POST" id="coinpayment-form" action="{{ url('payment/coinpayment') }}">
                                    {{ csrf_field() }} 
                                    <div class="form-group">
                                        <label for="amount">{{__('staticwords.amount')}}</label>                       
                                        <input type="text" class="form-control"name="amount" readonly="" value="{{$plan->amount - session()->has('coupon_applied') ? Session::get('coupon_applied')['amount'] : 0}}">
                                        <label for="amount">{{__('staticwords.currency')}}</label> 
                                        <select style="padding: 0px; " class="form-control" name="currency">
                                            <option value="BTC">BTC</option>
                                            <option value="LTC">LTC</option>
                                            <option value="ETH">ETH</option>
                                            <option value="LOKI">LOKI</option>
                                            <option value="XZC">XZC</option>
                                        </select>
                                        <input type="hidden" name="plan_id" value="{{$plan->id}}"/>
                                    </div>
                                    <button class="payment-btn" type="submit"><span>{{ __('staticwords.paynow') }}</span></button>
                                </form>
                            </div>
                            @else
                            @component('components.alert')
                            Coin Payment
                            @endcomponent
                            @endif
                        </div>
                        @endif
                        <!-- end coinpayment -->
                        @if($currency_code == "INR")
                        <!-- Payu tab -->
                        @if (isset($payu_payment) && $payu_payment == 1)
                        <div class="tab-pane" id="payu">
                            @if(env('PAYU_METHOD') != NULL && env('PAYU_DEFAULT') != NULL && env('PAYU_MERCHANT_KEY') != NULL && env('PAYU_MERCHANT_SALT') != NULL)
                            {!! Form::open(['method' => 'POST', 'action' => 'PayuController@payment']) !!}
                            <input type="hidden" name="plan_id" value="{{$plan->id}}">
                            <button class="payment-btn payu-btn"><i class="fa fa-credit-card"></i> {{__('staticwords.payvia')}} Payu</button>
                            {!! Form::close() !!}
                            @else
                            @component('components.alert')
                            Payu Payment
                            @endcomponent
                            @endif
                        </div>
                        @endif
                        <!-- end payu -->
                        <!-- patym tab -->
                        @if (isset($paytm_payment) && $paytm_payment == 1)
                        <div class="tab-pane" id="paytm">
                            @if(env('PAYTM_MID') != NULL && env('PAYTM_MERCHANT_KEY') != NULL)
                            <div class="paytm">
                                {!! Form::open(['method' => 'POST', 'action' => 'PaytemController@store']) !!}
                                <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                <button class="payment-btn paytm-btn"><i class="fa fa-credit-card"></i> {{__('staticwords.payvia')}} Paytm</button>
                                {!! Form::close() !!}
                            </div>
                            @else
                            @component('components.alert')
                            Paytm Payment
                            @endcomponent
                            @endif
                        </div>
                        @endif
                        <!-- end paytm -->
                        <!-- razorpay tab -->
                        @if (isset($razorpay_payment) && $razorpay_payment == 1)
                        <div class="tab-pane" id="razorpay">
                            @if(env('RAZOR_PAY_KEY') != NULL && env('RAZOR_PAY_SECRET') != NULL)
                            <form action="{{ route('paysuccess',$plan->id) }}" method="POST">
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="{{ env('RAZOR_PAY_KEY') }}"
                                    data-amount="{{ ($plan->amount - session()->has('coupon_applied') ? Session::get('coupon_applied')['amount'] : 0)*100 }}"
                                    data-buttontext="Pay Via Razorpay"
                                    data-name="{{ config('app.name') }}"
                                    data-description="Payment For Order {{ uniqid() }}"
                                    data-image="{{url('images/logo/'.$logo)}}"
                                    data-prefill.name="{{ Auth::user()->name }}"
                                    data-prefill.email="{{ Auth::user()->email }}"
                                    data-theme.color="#111111"></script>
                                <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                <input type="hidden" custom="Hidden Element" name="hidden">
                            </form>
                            @else
                            @component('components.alert')
                            Razorpay Payment
                            @endcomponent
                            @endif
                        </div>
                        @endif
                        <!-- end razorpay -->
                        <!-- instamojo tab -->
                        @if (isset($instamojo_payment) && $instamojo_payment == 1)
                        <div class="tab-pane" id="instamojo">
                            @if(env('IM_API_KEY') != NULL && env('IM_AUTH_TOKEN') != NULL && env('IM_URL') != NULL)
                            <form action="{{ route('payinstamojo') }}" method="POST">
                                <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <strong>Name</strong>
                                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" placeholder="Enter Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <strong>Mobile Number</strong>
                                            <input type="text" name="mobile_number" value="{{ Auth::user()->mobile ? Auth::user()->mobile:'' }}" class="form-control" placeholder="Enter Mobile Number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <strong>Email Id</strong>
                                            <input type="text" name="email" value="{{Auth::user()->email}}" class="form-control" placeholder="Enter Email id" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <strong>Event Fees</strong>
                                            <input type="text" name="amount" class="form-control" placeholder="" value="{{$plan->amount - session()->has('coupon_applied') ? Session::get('coupon_applied')['amount'] : 0}}" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="payment-btn instamojo-btn">Submit</button>
                                    </div>
                                </div>
                            </form>
                            @else
                            @component('components.alert')
                            Instamojo Payment
                            @endcomponent
                            @endif
                        </div>
                        @endif
                        <!-- end instamojo -->
                        @endif
                        @if($currency_code == "NGN" || $currency_code == "GHS")
                        <!-- Paystack Tab -->
                        @if(isset($paystack) && $paystack == 1)
                        <div class="tab-pane" id="paystack">
                            @if(env('PAYSTACK_PUBLIC_KEY') != NULL && env('PAYSTACK_SECRET_KEY') != NULL && env('PAYSTACK_PAYMENT_URL') != NULL)
                            <div class="paystack">
                                @php
                                $amount = ($plan->amount - session()->has('coupon_applied') ? Session::get('coupon_applied')['amount'] : 0)*100;
                                @endphp
                                <form method="POST" action="{{ url('payment/paystack') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                                    <input type="hidden" name="email" value="{{$auth->email}}"> 
                                    <input type="hidden" name="amount" value="{{$amount}}"> 
                                    <input type="hidden" name="currency" value="{{$plan->currency}}"> 
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="metadata" value="{{ json_encode($array = ['plan_id' => $plan->plan_id,]) }}" > 
                                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
                                    <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> 
                                    {{ csrf_field() }}
                                    <button class="payment-btn paystack-btn"><i class="fa fa-credit-card"></i>{{__('staticwords.payvia')}} Paystack</button>
                                </form>
                            </div>
                            @else
                            @component('components.alert')
                            Paystack Payment
                            @endcomponent
                            @endif
                        </div>
                        @endif
                        <!-- end paystack -->
                        @endif
                        <!-- Bank detail Tab -->
                        @if (isset($bankdetails) && $bankdetails == 1)
                        <div class="tab-pane" id="bankdetails">
                            @if(($account_name != NULL) && ($account_no != NULL) && ($ifsc_code != NULL) && ($bank!= NULL))
                            <button class="payment-btn" id="bankbutton">{{ __('staticwords.DirectBankTransfer') }}</button>
                            <div id="bankdetail" style="display: none;">
                                <br/>
                                <table class="table">
                                    <tr>
                                        <th>{{__('staticwords.AccountName')}}</th>
                                        <td>{{$account_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('staticwords.accountnumber')}}</th>
                                        <td>{{$account_no}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('staticwords.BankName')}}</th>
                                        <td>{{$bank}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('staticwords.IFSCCode')}}</th>
                                        <td>{{$ifsc_code}}</td>
                                    </tr>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p style="color: #d63031;">* {{__('staticwords.BankNote')}} <a href="{{url('contactus')}}" style="color: #00b894;">{{__('ContactHere')}}</a></p>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    {!! Form::open(['method' => 'POST','action'=>['ManualPaymentController@store', $plan->id],'files' => true]) !!}
                                    <div class="form-group{{ $errors->has('recipt') ? ' has-error' : '' }} input-file-block col-md-12">
                                        {!! Form::label('recipt', 'Manual Payment -Slip upload for verification') !!}
                                        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Manual payment - Slip Upload for verification"></i>
                                        {!! Form::file('recipt', ['class' => 'input-file', 'id'=>'recipt']) !!}
                                        <input type="hidden" name="user_id" value="{{$auth->id}}"> 
                                        <input type="hidden" name="user_name" value="{{$auth->name}}">
                                        <input type="hidden" name="price" value="{{$plan->amount - session()->has('coupon_applied') ? Session::get('coupon_applied')['amount'] : 0}}"> 
                                        <input type="hidden" name="status" value="0">
                                        <input type="hidden" name="currency" value="{{$plan->currency}}"> 
                                        <input type="hidden" name="plan_id" value="{{$plan->plan_id}}"> 
                                        <input type="hidden" name="method" value="banktransfer">
                                        <br/>
                                        <button type="submit" class="btn btn-success payment-btn">Proceed</button>
                                        <small class="text-danger">{{ $errors->first('recipt') }}</small>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            @else
                            @component('components.alert')
                            Bank Detail
                            @endcomponent
                            @endif
                        </div>
                        @endif
                        <!--end Bank detail tab -->
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>
@if(env('PAYPAL_MODE') == 'LIVE')
<script src="https://www.paypal.com/sdk/js?client-id=ASMHMeysgLdPBqJZFQ4i3qeo_QJejtbmiQzoioG4DI0Gj_NDyN1A2qIbeFdMfRf24sWullkwmrooSU8_&vault=true" data-namespace="paypal_sdk"></script>
@else
<script src="https://www.paypal.com/sdk/js?client-id=AabeLs7PtctOGhZQio3e11eqwKaKSfB6jDRrvtoXWE8-Lk0TvXY9pGabDcEBEbH4K7MySnANewStN8Q7&vault=true" data-namespace="paypal_sdk"></script>
@endif
@endsection
@section('custom-script')
<script>
var pay = $(document).find('.final_pay').val();
var UserID = "{{ Auth::user()->id }}";
var PlanID = "{{ $plan->id }}";
var route = "{{ route('home','home') }}";

    paypal_sdk.Buttons({
    createOrder : function(data, actions){
      return actions.order.create({
        purchase_units : [{
          amount : {
            value : pay
          }
        }],
        application_context: {
            shipping_preference: "NO_SHIPPING",
        },
        country_code : "USD"
      })
    },
    style: {
          color:  'gold',
          shape:  'rect',
          label:  'buynow',
           size: 'responsive',
           branding: true
    
      },
    onApprove: function (data, actions) {
        console.log(data.handledErrors);
        console.log('fff');
        console.log(data.actions);

        /*console.log(data.status);*/
         
        // 2. Make a request to server
         var actionssucess =  actions.order.capture().then(function(details) {
                
                if(details.status == 'COMPLETED')
                {
                        $.ajax({
                          headers: {
                              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                          },
                          type: "POST",
                          data : {'paypal_details':details,'UserID':UserID,'PlanID': PlanID},
                          url: "{{ route('AjaxgetPaymentStatus') }}",
                          success: function(res) {   
                              /*console.log(res);*/
                              if(res.success == true)
                              {
                                 $(".errors_message").empty();
                                 $(".errors_message").prepend(messages('alert-info', res.message));
                                    window.location.href = route;
                                /*setTimeout(function() {
                                }, 5000);*/

                              }
                              else
                              {
                                 $(".errors_message").empty();
                                 $(".errors_message").prepend(messages('alert-danger', res.message));
                                 setTimeout(function() {
                                    window.location.href = route;
                                }, 5000);                               
                              }

                              return false;
                          },
                        });
                }
         });           
       
     },
    onCancel: function (data, actions) { 
     $(".errors_message").empty(); 
         $(".errors_message").prepend(messages('alert-danger', 'Payment is cancelled'));
         setTimeout(function() 
         {
            location.reload();
        }, 2000);               
          
    },

     onError: function (err) {
            $(".errors_message").empty(); 
            $(".errors_message").prepend(messages('alert-danger', 'Payment error'));
            setTimeout(function() 
            {
                location.reload();
            }, 2000);                   
    }
    
    }).render('#paypal-button-container');

     function messages(classname, msg)
    {
        return '<div class="alert ' + classname + '">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button></div>';
    }
</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    var style = {
        base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };
    
    const stripe = Stripe('{{ env("STRIPE_KEY") }}', { locale: "{{app()->getLocale()}}" }); // Create a Stripe client.
    const elements = stripe.elements(); // Create an instance of Elements.
    const cardElement = elements.create('card', { style: style }); // Create an instance of the card Element.
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;
    
    cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.
    
    // Handle real-time validation errors from the card Element.
    cardElement.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
    });
    // Handle form submission.
    var form = document.getElementById('payment-form');
    
    
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
    
    event.preventDefault();
    
    stripe
        .handleCardSetup(clientSecret, cardElement, {
            payment_method_data: {
                //billing_details: { name: cardHolderName.value }
            }
        })
        .then(function(result) {
            console.log(result);
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                console.log(result);
                // Send the token to your server.
                stripeTokenHandler(result.setupIntent.payment_method);
            }
        });
    });
    
    // Submit the form with the token ID.
    function stripeTokenHandler(paymentMethod) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'paymentMethod');
        hiddenInput.setAttribute('value', paymentMethod);
    
        // hiddenInput.setAttribute('name', 'stripeToken');
        // hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
    
        // Submit the form
        form.submit();
    }
</script>
<script>
    $(function(){
      $('.paypal-btn').on('click', function(){
        $('.paypal-btn').addClass('load');
      });
    
      $('#vip_subscription').on('click', function(){
        $('#vip_subscription_form').submit();
      });
    
      $('.paystack-btn').on('click', function(){
        $('.paystack-btn').addClass('load');
      });  
      $('.payu-btn').on('click', function(){
        $('.payu-btn').addClass('load');
      }); 
      $('.braintree').hide();
    });
</script>
<script src="https://js.braintreegateway.com/web/dropin/1.20.0/js/dropin.min.js"></script>
<script>  
    var client_token = null;   
    $(function(){
      $('.bt-btn').on('click', function(){
        $('.bt-btn').addClass('load');
        $.ajax({
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
          },
          type: "POST",
          
          url: "{{ url('bttoken') }}",
          success: function(t) {   
              if(t.client != null){
                client_token = t.client;
                btform(client_token);
                console.log(client_token);
              }
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
            $('.bt-btn').removeClass('load');
            alert('Payment error. Please try again later.');
          }
        });
      });
    });
    function btform(token){
      var payform = document.querySelector('#bt-form'); 
      braintree.dropin.create({
        authorization: client_token,
        selector: '#bt-dropin',  
        paypal: {
          flow: 'vault'
        },
      }, function (createErr, instance) {
        if (createErr) {
          console.log('Create Error', createErr);
          alert('Payment error. Please try again later.');
          return;
        }
        else{
          $('.bt-btn').hide();
          $('.braintree').show();
        }
        payform.addEventListener('submit', function (event) {
        event.preventDefault();
        instance.requestPaymentMethod(function (err, payload) {
          if (err) {
            console.log('Request Payment Method Error', err);
            alert('Payment error. Please try again later.');
            return;
          }
          // Add the nonce to the form and submit
          document.querySelector('#nonce').value = payload.nonce;
          payform.submit();
        });
      });
    });
    }
    $('#bankbutton').click(function () {$('#bankdetail').toggle();});
</script>
@endsection
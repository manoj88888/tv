@extends('layouts.admin')
@section('title',__('adminstaticwords.CreateCoupon'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="{{url('admin/coupons')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('adminstaticwords.CreateCoupon')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::open(['method' => 'POST', 'action' => 'CouponController@store']) !!}
            <div class="form-group{{ $errors->has('coupon_code') ? ' has-error' : '' }}">
                {!! Form::label('coupon_code', __('adminstaticwords.CouponCode')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterUniqueCouponCode')}}eg: SALE50"></i>
                {!! Form::text('coupon_code', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('adminstaticwords.PleaseEnterUniqueCouponCode') ,'pattern'=>'[A-Za-z0-9]+','title'=>__('adminstaticwords.PleaseDoNotUse')]) !!}
                <small class="text-danger">{{ $errors->first('coupon_code') }}</small>
            </div>
            @if(isset($config->stripe_payment) && $config->stripe_payment == '1')
              @if(env('STRIPE_KEY') != NULL && env('STRIPE_SECRET') != NULL)
                <div class="bootstrap-checkbox {{ $errors->has('in_stripe') ? ' has-error' : '' }}">
                  <div class="row">
                    <div class="col-md-7">
                      <h6>{{__('adminstaticwords.UseForStripe')}} ?</h6>
                    </div>
                    <div class="col-md-5 pad-0">
                      <div class="make-switch">
                        <label class="switch">
                           <input type="checkbox" name="in_stripe" checked="" class="checkbox-switch">
                           <span class="slider round"></span>

                         </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <small class="text-danger">{{ $errors->first('in_stripe') }}</small>
                  </div>
                </div><br/>
              @endif
            @endif
            <div class="bootstrap-checkbox {{ $errors->has('percent_check') ? ' has-error' : '' }}">
              <div class="row">
                <div class="col-md-7">
                  <h6>{{__('adminstaticwords.AmountOffOrPercent')}} (%) {{__('adminstaticwords.Off')}}</h6>
                </div>
                <div class="col-md-5 pad-0">
                  <div class="make-switch">
                    {!! Form::checkbox('percent_check', 1, 1, ['class' => 'bootswitch', "data-on-text"=>__('adminstaticwords.PercentOff'), "data-off-text"=>__('adminstaticwords.AmountOff'), "data-size"=>"small"]) !!}
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <small class="text-danger">{{ $errors->first('percent_check') }}</small>
              </div>
            </div>
            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
  						{!! Form::number('amount', null, ['class' => 'form-control selection-input', 'min' => 0]) !!}
  						<small class="text-danger">{{ $errors->first('amount') }}</small>
            </div>
            {!! Form::hidden('currency', $currency_code) !!}
  					<div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
  							{!! Form::label('duration',__('adminstaticwords.Duration')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseSelectCouponDuration')}}"></i>
  							{!! Form::select('duration', ['once'=>__('adminstaticwords.Once'), 'repeating' =>__('adminstaticwords.Repeating'), 'forever' => __('adminstaticwords.Forever')], null, ['class' => 'form-control select2', 'required' => 'required']) !!}
  							<small class="text-danger">{{ $errors->first('duration') }}</small>
  					</div>
            <div id="coupon_month_duration" class="form-group{{ $errors->has('duration_in_months') ? ' has-error' : '' }}">
                {!! Form::label('duration_in_months', __('adminstaticwords.DurationInMonths')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterCouponDurationForMonths')}}"></i>
                {!! Form::number('duration_in_months', null, ['class' => 'form-control', 'min' => 0]) !!}
                <small class="text-danger">{{ $errors->first('duration_in_months') }}</small>
            </div>
            <div class="form-group{{ $errors->has('max_redemptions') ? ' has-error' : '' }}">
                {!! Form::label('max_redemptions', __('adminstaticwords.MaxRedemptions')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterTotalCouponUseCount')}}"></i>
                {!! Form::number('max_redemptions', null, ['class' => 'form-control', 'min' => 0, 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('max_redemptions') }}</small>
            </div>
            <div class="form-group{{ $errors->has('redeem_by') ? ' has-error' : '' }}">
                {!! Form::label('redeem_by',__('adminstaticwords.RedeemBy')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterCouponValidateUpto')}}"></i>
                {!! Form::date('redeem_by', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                <small class="text-danger">{{ $errors->first('redeem_by') }}</small>
            </div>
          
        	<div class="form-group{{ $errors->has('plans') ? ' has-error' : '' }}">
  				{!! Form::label('duration',__('adminstaticwords.Plans')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseSelectplan')}}"></i>
  				{!! Form::select('plans[]',$planData, null, ['class' => 'form-control select2', 'required' => 'required','multiple']) !!}
  				<small class="text-danger">{{ $errors->first('plans') }}</small>
  			</div>
  			
  			<div class="form-group{{ $errors->has('is_free') ? ' has-error' : '' }} switch-main-block">
              <div class="row">
                <div class="col-xs-4">
                  {!! Form::label('is_free', 'Is Free ?') !!}
                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">								
                    {!! Form::checkbox('is_free', 1, 0, ['class' => 'checkbox-switch', 'id' => 'is_free']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger">{{ $errors->first('is_free') }}</small>
              </div>
            </div>
  			<div class="form-group free-day {{ $errors->has('for_days') ? ' has-error' : '' }}" style="display:none;">
                {!! Form::label('for_days','Days for free') !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter days for free"></i>
                {!! Form::number('for_days', 1, ['class' => 'form-control', 'id' => 'for_days', 'min' => 1]) !!}
                <small class="text-danger">{{ $errors->first('for_days') }}</small>
            </div>
  			
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('adminstaticwords.Reset')}}</button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('adminstaticwords.Create')}}</button>
            </div>
            <div class="clear-both"></div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('custom-script')
  <script>
    // Duration In Repeating (Show Duration In Months)  
    $("input[name='duration_in_months']").parent().hide();
    $("select[name='duration']").on('change',function(){
      if(this.value === 'repeating'){
        $("input[name='duration_in_months']").parent().fadeIn();
      }
      else {
        $("input[name='duration_in_months']").parent().fadeOut();
      }
    });
    
    $('#is_free').change(function(){
       if($(this).prop('checked') == true){
           $('.free-day').show();
           $('#for_days').prop('required',true);
       } else{
           $('.free-day').hide();
           $('#for_days').prop('required',false);
       }
    });
  </script>
@endsection
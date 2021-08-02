
<?php $__env->startSection('title',__('adminstaticwords.CreateCoupon')); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="<?php echo e(url('admin/coupons')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.GoBack')); ?>" class="btn-floating"><i class="material-icons">reply</i></a> <?php echo e(__('adminstaticwords.CreateCoupon')); ?></h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <?php echo Form::open(['method' => 'POST', 'action' => 'CouponController@store']); ?>

            <div class="form-group<?php echo e($errors->has('coupon_code') ? ' has-error' : ''); ?>">
                <?php echo Form::label('coupon_code', __('adminstaticwords.CouponCode')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterUniqueCouponCode')); ?>eg: SALE50"></i>
                <?php echo Form::text('coupon_code', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('adminstaticwords.PleaseEnterUniqueCouponCode') ,'pattern'=>'[A-Za-z0-9]+','title'=>__('adminstaticwords.PleaseDoNotUse')]); ?>

                <small class="text-danger"><?php echo e($errors->first('coupon_code')); ?></small>
            </div>
            <?php if(isset($config->stripe_payment) && $config->stripe_payment == '1'): ?>
              <?php if(env('STRIPE_KEY') != NULL && env('STRIPE_SECRET') != NULL): ?>
                <div class="bootstrap-checkbox <?php echo e($errors->has('in_stripe') ? ' has-error' : ''); ?>">
                  <div class="row">
                    <div class="col-md-7">
                      <h6><?php echo e(__('adminstaticwords.UseForStripe')); ?> ?</h6>
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
                    <small class="text-danger"><?php echo e($errors->first('in_stripe')); ?></small>
                  </div>
                </div><br/>
              <?php endif; ?>
            <?php endif; ?>
            <div class="bootstrap-checkbox <?php echo e($errors->has('percent_check') ? ' has-error' : ''); ?>">
              <div class="row">
                <div class="col-md-7">
                  <h6><?php echo e(__('adminstaticwords.AmountOffOrPercent')); ?> (%) <?php echo e(__('adminstaticwords.Off')); ?></h6>
                </div>
                <div class="col-md-5 pad-0">
                  <div class="make-switch">
                    <?php echo Form::checkbox('percent_check', 1, 1, ['class' => 'bootswitch', "data-on-text"=>__('adminstaticwords.PercentOff'), "data-off-text"=>__('adminstaticwords.AmountOff'), "data-size"=>"small"]); ?>

                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <small class="text-danger"><?php echo e($errors->first('percent_check')); ?></small>
              </div>
            </div>
            <div class="form-group<?php echo e($errors->has('amount') ? ' has-error' : ''); ?>">
  						<?php echo Form::number('amount', null, ['class' => 'form-control selection-input', 'min' => 0]); ?>

  						<small class="text-danger"><?php echo e($errors->first('amount')); ?></small>
            </div>
            <?php echo Form::hidden('currency', $currency_code); ?>

  					<div class="form-group<?php echo e($errors->has('duration') ? ' has-error' : ''); ?>">
  							<?php echo Form::label('duration',__('adminstaticwords.Duration')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseSelectCouponDuration')); ?>"></i>
  							<?php echo Form::select('duration', ['once'=>__('adminstaticwords.Once'), 'repeating' =>__('adminstaticwords.Repeating'), 'forever' => __('adminstaticwords.Forever')], null, ['class' => 'form-control select2', 'required' => 'required']); ?>

  							<small class="text-danger"><?php echo e($errors->first('duration')); ?></small>
  					</div>
            <div id="coupon_month_duration" class="form-group<?php echo e($errors->has('duration_in_months') ? ' has-error' : ''); ?>">
                <?php echo Form::label('duration_in_months', __('adminstaticwords.DurationInMonths')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterCouponDurationForMonths')); ?>"></i>
                <?php echo Form::number('duration_in_months', null, ['class' => 'form-control', 'min' => 0]); ?>

                <small class="text-danger"><?php echo e($errors->first('duration_in_months')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('max_redemptions') ? ' has-error' : ''); ?>">
                <?php echo Form::label('max_redemptions', __('adminstaticwords.MaxRedemptions')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterTotalCouponUseCount')); ?>"></i>
                <?php echo Form::number('max_redemptions', null, ['class' => 'form-control', 'min' => 0, 'required' => 'required']); ?>

                <small class="text-danger"><?php echo e($errors->first('max_redemptions')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('redeem_by') ? ' has-error' : ''); ?>">
                <?php echo Form::label('redeem_by',__('adminstaticwords.RedeemBy')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterCouponValidateUpto')); ?>"></i>
                <?php echo Form::date('redeem_by', null, ['class' => 'form-control', 'placeholder' => '']); ?>

                <small class="text-danger"><?php echo e($errors->first('redeem_by')); ?></small>
            </div>
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> <?php echo e(__('adminstaticwords.Reset')); ?></button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> <?php echo e(__('adminstaticwords.Create')); ?></button>
            </div>
            <div class="clear-both"></div>
          <?php echo Form::close(); ?>

        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
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
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sonaflix/new.sonaflix.com/resources/views/admin/coupon/create.blade.php ENDPATH**/ ?>
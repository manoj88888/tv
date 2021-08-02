
<?php $__env->startSection('title', __('adminstaticwords.AppSettings')); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-form-main-block mrg-t-40">
  <!-- Tab buttons for site settings -->
  

  <!-- update general settings -->
  <?php if($appconfig): ?>
  <?php echo Form::model($appconfig, ['method' => 'PATCH', 'action' => ['AppConfigController@update', $appconfig->id], 'files' => true]); ?>

  <div class="row admin-form-block z-depth-1">
    <h6 class="form-block-heading apipadding"><?php echo e(__('adminstaticwords.AppSettings')); ?></h6><br/>
    <div class="col-md-6">

      <div class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
        <?php echo Form::label('title',__('adminstaticwords.AppTitle')); ?>

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterYourAppTitle')); ?>"></i>
        <?php echo Form::text('title', null, ['class' => 'form-control']); ?>

        <small class="text-danger"><?php echo e($errors->first('title')); ?></small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group<?php echo e($errors->has('logo') ? ' has-error' : ''); ?> input-file-block">
            <?php echo Form::label('logo', __('adminstaticwords.ProjectLogo')); ?> - <p class="inline info"><?php echo e(__('adminstaticwords.Size')); ?>: 200x63</p>
            <?php echo Form::file('logo', ['class' => 'input-file', 'id'=>'logo']); ?>

            <label for="logo" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.ProjectLogo')); ?>">
              <i class="icon fa fa-check"></i>
              <span class="js-fileName"><?php echo e(__('adminstaticwords.ChooseAFile')); ?></span>
            </label>
            <p class="info"><?php echo e(__('adminstaticwords.ChooseALogo')); ?></p>
            <small class="text-danger"><?php echo e($errors->first('logo')); ?></small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="image-block">
            <img src="<?php echo e(asset('images/app/logo/' . $appconfig->logo)); ?>" class="img-responsive" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <br/>
  <div class="row admin-form-block z-depth-1">
    <h6 class="form-block-heading apipadding"><?php echo e(__('adminstaticwords.PaymentGatewaySettings')); ?></h6><br/>
    <div class="col-md-6">
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              <?php echo Form::label('stripe_payment',__('adminstaticwords.STRIPEPAYMENT')); ?>

            </div>
            <?php if(env('STRIPE_KEY') != NULL && env('STRIPE_SECRET') != NULL): ?>
            <div class="col-xs-5 text-right">
              <label class="switch">
                <?php echo Form::checkbox('stripe_payment', 1, $appconfig->stripe_payment, ['class' => 'checkbox-switch']); ?>

                <span class="slider round"></span>
              </label>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              <?php echo Form::label('paypal_payment',__('adminstaticwords.PAYPALPAYMENT')); ?>

            </div>
            <?php if(env('PAYPAL_CLIENT_ID') != NULL && env('PAYPAL_SECRET_ID') != NULL && env('PAYPAL_MODE') != NULL ): ?>
            <div class="col-xs-5 text-right">
              <label class="switch">
                <?php echo Form::checkbox('paypal_payment', 1, $appconfig->paypal_payment, ['class' => 'checkbox-switch']); ?>

                <span class="slider round"></span>
              </label>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              <?php echo Form::label('razorpay_payment', __('adminstaticwords.RAZORPAYPAYMENT')); ?>

            </div>
            <?php if(env('RAZOR_PAY_KEY') != NULL && env('RAZOR_PAY_SECRET') != NULL): ?>
            <div class="col-xs-5 text-right">
              <label class="switch">
                <?php echo Form::checkbox('razorpay_payment', 1, $appconfig->razorpay_payment, ['class' => 'checkbox-switch']); ?>

                <span class="slider round"></span>
              </label>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
     
    <div class="col-md-6">
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              <?php echo Form::label('brainetree_payment',__('adminstaticwords.BRAINTREEPAYMENT')); ?>

            </div>
            <?php if(env('BTREE_ENVIRONMENT') != NULL && env('BTREE_MERCHANT_ID') != NULL && env('BTREE_PUBLIC_KEY') != NULL && env('BTREE_PRIVATE_KEY') != NULL && env('BTREE_MERCHANT_ACCOUNT_ID') != NULL): ?>
            <div class="col-xs-5 text-right">
              <label class="switch">
                <?php echo Form::checkbox('brainetree_payment', 1, $appconfig->brainetree_payment, ['class' => 'checkbox-switch']); ?>

                <span class="slider round"></span>
              </label>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              <?php echo Form::label('paystack_payment',__('adminstaticwords.PAYSTACKPAYMENT')); ?>

            </div>
            <?php if(env('PAYSTACK_PUBLIC_KEY') != NULL && env('PAYSTACK_SECRET_KEY') != NULL && env('PAYSTACK_PAYMENT_URL') != NULL): ?>
            <div class="col-xs-5 text-right">
              <label class="switch">
                <?php echo Form::checkbox('paystack_payment', 1, $appconfig->paystack_payment, ['class' => 'checkbox-switch']); ?>

                <span class="slider round"></span>
              </label>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              <?php echo Form::label('bankdetails',__('adminstaticwords.BANKDETAILS')); ?>

            </div>
            
            <div class="col-xs-5 text-right">
              <label class="switch">
                <?php echo Form::checkbox('bankdetails', 1, $appconfig->bankdetails, ['class' => 'checkbox-switch']); ?>

                <span class="slider round"></span>
              </label>
            </div>
           
          </div>
        </div>
      </div>
    </div>
  </div>
  <br/>
  <div class="row admin-form-block z-depth-1">
    <h6 class="form-block-heading apipadding"><?php echo e(__('adminstaticwords.SocialLoginSettings')); ?></h6><br/>
    <div class="col-md-6">

      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              <?php echo Form::label('fb_check',__('adminstaticwords.EnableFacebookLogin:')); ?>

            </div>
            <?php if(env('FACEBOOK_CLIENT_ID') != NULL && env('FACEBOOK_CLIENT_SECRET') != NULL && env('FACEBOOK_CALLBACK') != NULL): ?>
            <div class="col-xs-5 text-right">
              <label class="switch">
                <?php echo Form::checkbox('fb_check', 1, $appconfig->fb_login, ['class' => 'checkbox-switch']); ?>

                <span class="slider round"></span>
              </label>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              <?php echo Form::label('google_login',__('adminstaticwords.EnableGoogleLogin:')); ?>

            </div>
            <?php if(env('GOOGLE_CLIENT_ID') != NULL && env('GOOGLE_CLIENT_SECRET') != NULL && env('GOOGLE_CALLBACK') != NULL): ?>
            <div class="col-xs-5 text-right">
              <label class="switch">
                <?php echo Form::checkbox('google_login', 1, $appconfig->google_login, ['class' => 'checkbox-switch']); ?>

                <span class="slider round"></span>
              </label>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6" style="opacity:0.5;">

        <div class="payment-gateway-block">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-6">
                <?php echo Form::label('amazon_lab_check',__('adminstaticwords.EnableAmazonLogin:')); ?>

              </div>
              <?php if(env('AMAZON_LOGIN_ID') != NULL && env('AMAZON_LOGIN_SECRET') != NULL && env('AMAZON_LOGIN_REDIRECT') != NULL): ?>
              <div class="col-xs-5 text-right">
                <label class="switch">
                
                  <span class="slider round"></span>
                </label>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="payment-gateway-block">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-6">
                <?php echo Form::label('git_lab_check', __('adminstaticwords.EnableGitLabLogin:')); ?>

              </div>
              <?php if(env('GITLAB_CLIENT_ID') != NULL && env('GITLAB_CLIENT_SECRET') != NULL && env('GITLAB_CALLBACK') != NULL): ?>
              <div class="col-xs-5 text-right">
                <label class="switch">
                 
                  <span class="slider round"></span>
                </label>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
     
    </div>
    <div class="overlay-bg appversion"><?php echo e(__('adminstaticwords.NotAvailableInAPPVersion')); ?></div>
   
  </div>
  <br/>
  <div class="row admin-form-block z-depth-1">
    <h6 class="form-block-heading apipadding"><?php echo e(__('adminstaticwords.AdMobSettings')); ?></h6><br/>
      <div class="payment-gateway-block">
        <div class="row">
          <div class="form-group<?php echo e($errors->has('ADMOB_APP_KEY') ? ' has-error' : ''); ?>">
            <?php echo Form::label('ADMOB_APP_KEY', 'ADMOB APP KEY'); ?>

            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterAdmobAppKey')); ?>"></i>
            <?php echo Form::text('ADMOB_APP_KEY', null, ['class' => 'form-control']); ?>

            <small class="text-danger"><?php echo e($errors->first('ADMOB_APP_KEY')); ?></small>
          </div>
        </div>
      </div>
      <div class="payment-gateway-block">

        <div class="form-group">
         
          <div class="row">

            <div class="col-xs-6">
              <?php echo Form::label('banner_admob', __('adminstaticwords.BANNERADMOB')); ?>

            </div>
            <div class="col-xs-5 text-right">
              <label class="switch">
                <?php echo Form::checkbox('banner_admob', 1, $appconfig->banner_admob, ['class' => 'checkbox-switch']); ?>

                <span class="slider round"></span>
              </label>
            </div>
          </div>
           <small class="text-danger"><?php echo e($errors->first('banner_id')); ?></small>
          <div style="<?php echo e($appconfig->banner_admob==1 ? "" : "display: none"); ?>" id="banner_box" class="row">
            <div class="col-md-12">
              <div class="form-group<?php echo e($errors->has('Banner_id') ? ' has-error' : ''); ?>">
                <?php echo Form::label('banner_id', __('adminstaticwords.BANNERID')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterBannerAdmaobID')); ?>"></i>
                <?php echo Form::text('banner_id', null, ['class' => 'form-control']); ?>

                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              <?php echo Form::label('interstitial_admob', __('adminstaticwords.INTERSTITALADMOB')); ?>

            </div>
            <div class="col-xs-5 text-right">
              <label class="switch">
                <?php echo Form::checkbox('interstitial_admob', 1, $appconfig->interstitial_admob, ['class' => 'checkbox-switch']); ?>

                <span class="slider round"></span>
              </label>
            </div>
          </div>
          <div style="<?php echo e($appconfig->interstitial_admob==1 ? "" : "display: none"); ?>" id="interstitial_box" class="row">
            <div class="col-md-12">
              <div class="form-group<?php echo e($errors->has('interstitial_id') ? ' has-error' : ''); ?>">
                <?php echo Form::label('interstitial_id', __('adminstaticwords.INTERSTITALID')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleasEnterInterstitialAdmobID')); ?>"></i>
                <?php echo Form::text('interstitial_id', null, ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('interstitial_id')); ?></small>
              </div>
            </div>
          </div>
        </div>
      </div>
   
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              <?php echo Form::label('rewarded_admob', __('adminstaticwords.REWARDEDADMOB')); ?>

            </div>
            <div class="col-xs-5 text-right">
              <label class="switch">
                <?php echo Form::checkbox('rewarded_admob', 1, $appconfig->rewarded_admob, ['class' => 'checkbox-switch']); ?>

                <span class="slider round"></span>
              </label>
            </div>
          </div>
          <div style="<?php echo e($appconfig->rewarded ==1 ? "" : "display: none"); ?>" id="rewarded_box" class="row">
            <div class="col-md-12">
              <div class="form-group<?php echo e($errors->has('rewarded_id') ? ' has-error' : ''); ?>">
                <?php echo Form::label('rewarded_id', __('adminstaticwords.REWARDEDID')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterRewardedAdmobID')); ?>"></i>
                <?php echo Form::text('rewarded_id', null, ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('rewarded_id')); ?></small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              <?php echo Form::label('native_admob', __('adminstaticwords.NATIVEADVANCEADMOB')); ?>

            </div>
            <div class="col-xs-5 text-right">
              <label class="switch">
                <?php echo Form::checkbox('native_admob', 1, $appconfig->native_admob, ['class' => 'checkbox-switch']); ?>

                <span class="slider round"></span>
              </label>
            </div>
          </div>
          <div style="<?php echo e($appconfig->native_admob==1 ? "" : "display: none"); ?>" id="native_box" class="row">
            <div class="col-md-12">
              <div class="form-group<?php echo e($errors->has('native_id') ? ' has-error' : ''); ?>">
                <?php echo Form::label('native_id', __('adminstaticwords.NATIVEADVANCEDID')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterNativeAdvanceID')); ?>"></i>
                <?php echo Form::text('native_id', null, ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('native_id')); ?></small>
              </div>
            </div>
          </div>
        </div>
      </div>
    
  </div>
  <br/>

  <br/>

  
  
  <div class="btn-group col-xs-12">
    <button type="submit" class="btn btn-block btn-success"><?php echo e(__('adminstaticwords.SaveSettings')); ?></button>
  </div>
  <div class="clear-both"></div>

<?php echo Form::close(); ?>

<?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
<script type="text/javascript">
  $('#banner_admob').on('change',function(){
      if ($('#banner_admob').is(':checked')){
           $('#banner_box').show('fast');
        }else{
          $('#banner_box').hide('fast');
        }
    });  

  $('#interstitial_admob').on('change',function(){
    if ($('#interstitial_admob').is(':checked')){
         $('#interstitial_box').show('fast');
      }else{
        $('#interstitial_box').hide('fast');
      }
  });  

  $('#rewarded_admob').on('change',function(){
      if ($('#rewarded_admob').is(':checked')){
           $('#rewarded_box').show('fast');
        }else{
          $('#rewarded_box').hide('fast');
        }
    }); 
  $('#native_admob').on('change',function(){
      if ($('#native_admob').is(':checked')){
           $('#native_box').show('fast');
        }else{
          $('#native_box').hide('fast');
        }
    }); 
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/appconfig/appsettings.blade.php ENDPATH**/ ?>
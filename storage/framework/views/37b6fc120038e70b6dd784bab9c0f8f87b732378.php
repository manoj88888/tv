
<?php $__env->startSection('title', __('adminstaticwords.APISettings')); ?>

<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
 <div class="tabsetting">
  <a href="<?php echo e(url('admin/settings')); ?>" style="color: #7f8c8d;" ><button class="tablinks "><?php echo e(__('adminstaticwords.GenralSetting')); ?></button></a>
  <a href="<?php echo e(url('admin/seo')); ?>" style="color: #7f8c8d;" ><button class="tablinks"><?php echo e(__('adminstaticwords.SEOSetting')); ?></button></a>
  <a href="#" style="color: #7f8c8d;"><button class="tablinks active"><?php echo e(__('adminstaticwords.APISetting')); ?></button></a>
  <a href="<?php echo e(route('mail.getset')); ?>" style="color: #7f8c8d;"><button class="tablinks"><?php echo e(__('adminstaticwords.MailSettings')); ?></button></a>

</div>
  
      <?php echo Form::model($env_files, ['method' => 'POST', 'action' => 'ConfigController@changeEnvKeys']); ?>


      <div class="row admin-form-block z-depth-1">
       
            <h6 class="form-block-heading apipadding"><?php echo e(__('adminstaticwords.YouTubeApi')); ?></h6>
                    <br>
              
                <div class="form-group<?php echo e($errors->has('YOUTUBE_API_KEY') ? ' has-error' : ''); ?>">
                    <?php echo Form::label('YOUTUBE_API_KEY', __('adminstaticwords.YouTubeAPIKEY')); ?>

                      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterYoutubeApiKey')); ?>"></i>
                    <?php echo Form::text('YOUTUBE_API_KEY',null, ['class' => 'form-control']); ?>

                      <small class="text-danger"><?php echo e($errors->first('YOUTUBE_API_KEY')); ?></small>
                  </div>
             
          </div>

          <div class="row admin-form-block z-depth-1">
        
            <h6 class="form-block-heading apipadding"><?php echo e(__('adminstaticwords.VimeoApi')); ?></h6>
          
               <br>
                <div class="form-group<?php echo e($errors->has('VIMEO_ACCESS') ? ' has-error' : ''); ?>">
                    <?php echo Form::label('VIMEO_ACCESS', __('adminstaticwords.VimeoAPIKEY')); ?>

                      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterVimeoApiKey')); ?>"></i>
                    <?php echo Form::text('VIMEO_ACCESS',null, ['class' => 'form-control']); ?>

                      <small class="text-danger"><?php echo e($errors->first('VIMEO_ACCESS')); ?></small>
                  </div>
                 
           
          
          </div>
        <div class="row admin-form-block z-depth-1">
          <h6 class="form-block-heading apipadding"><?php echo e(__('adminstaticwords.CaptchaCredentials')); ?> </h6>
          <br>
              
          <div class="payment-gateway-block">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-6">
                    <?php echo Form::label('captcha', __('adminstaticwords.GOOGLECAPTCHA')); ?>

                  </div>
                  <div class="col-xs-5 text-right">
                    <label class="switch">
                      <?php echo Form::checkbox('captcha', 1, $config->captcha, ['class' => 'checkbox-switch']); ?>

                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div style="<?php echo e($config->captcha==1 ? "" : "display: none"); ?>" id="captcha_box" class="row">
                <div class="col-md-6">
                  <div class="form-group<?php echo e($errors->has('NOCAPTCHA_SITEKEY') ? ' has-error' : ''); ?>">
                    <?php echo Form::label('NOCAPTCHA_SITEKEY', __('adminstaticwords.CAPTCHASITEKEY')); ?>

                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterCaptchaSiteKey')); ?>"></i>
                    <?php echo Form::text('NOCAPTCHA_SITEKEY', null, ['class' => 'form-control']); ?>

                    <small class="text-danger"><?php echo e($errors->first('NOCAPTCHA_SITEKEY')); ?></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="search form-group<?php echo e($errors->has('NOCAPTCHA_SECRET') ? ' has-error' : ''); ?>">
                    <?php echo Form::label('NOCAPTCHA_SECRET', __('adminstaticwords.CAPTCHASECRETKEY')); ?>

                      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterCaptchaSecretKey')); ?>"></i>
                      <input type="password" id="captcha-password-field" name="NOCAPTCHA_SECRET" <?php if(isset( $env_files['NOCAPTCHA_SECRET'])): ?> value="<?php echo e($env_files['NOCAPTCHA_SECRET']); ?>" <?php endif; ?>>
                      <span toggle="#captcha-password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                      <small class="text-danger"><?php echo e($errors->first('NOCAPTCHA_SECRET')); ?></small>
                  </div>
                </div>
              </div>
            </div>
             
        </div>
        <div class="row admin-form-block z-depth-1">
          <div class="api-main-block">
            <h5 class="form-block-heading apipadding"><?php echo e(__('adminstaticwords.PaymentGateways')); ?></h5>
            <div class="payment-gateway-block">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-6">
                    <?php echo Form::label('stripe_payment', __('adminstaticwords.STRIPEPAYMENT')); ?>

                  </div>
                  <div class="col-xs-5 text-right">
                    <label class="switch">
                      <?php echo Form::checkbox('stripe_payment', 1, $config->stripe_payment, ['class' => 'checkbox-switch']); ?>

                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div style="<?php echo e($config->stripe_payment==1 ? "" : "display: none"); ?>" id="stripe_box" class="row">
                <div class="col-md-6">
                  <div class="form-group<?php echo e($errors->has('STRIPE_KEY') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('STRIPE_KEY', __('adminstaticwords.STRIPEKEY')); ?>

                      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterStripeKey')); ?>"></i>
                      <?php echo Form::text('STRIPE_KEY', null, ['class' => 'form-control']); ?>


                      <small class="text-danger"><?php echo e($errors->first('STRIPE_KEY')); ?></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="search form-group<?php echo e($errors->has('STRIPE_SECRET') ? ' has-error' : ''); ?>">
                      
                          <?php echo Form::label('STRIPE_SECRET', __('adminstaticwords.STRIPESECRETKEY')); ?>

                          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterStripeSecretKey')); ?>"></i>
                          

                          <input type="password" id="password-field" name="STRIPE_SECRET" value="<?php echo e($env_files['STRIPE_SECRET']); ?>">
                        

                          <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        

                     

                      <small class="text-danger"><?php echo e($errors->first('STRIPE_SECRET')); ?></small>
                  </div>
                </div>
              </div>
            </div>
            <div  class="payment-gateway-block">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-6">
                    <?php echo Form::label('paypal_payment', __('adminstaticwords.PAYPALPAYMENT')); ?>

                  </div>
                  <div class="col-xs-5 text-right">
                    <label class="switch">
                      <?php echo Form::checkbox('paypal_payment', 1, $config->paypal_payment, ['class' => 'checkbox-switch']); ?>

                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
            <div id="paypal_box" style="<?php echo e($config->paypal_payment==1 ? "" : "display: none"); ?>" id="paypal_box">

              <div class="search form-group<?php echo e($errors->has('PAYPAL_CLIENT_ID') ? ' has-error' : ''); ?>">
                
                 
                    <?php echo Form::label('PAYPAL_CLIENT_ID', __('adminstaticwords.PAYPALCLIENTID')); ?>

                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterPaypalClientId')); ?>"></i>
                    <input type="password" name="PAYPAL_CLIENT_ID" id="pclientid" value="<?php echo e($env_files['PAYPAL_CLIENT_ID']); ?>" class="form-control">
                
                  
                    <span toggle="#pclientid" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                  
                

                  <small class="text-danger"><?php echo e($errors->first('PAYPAL_CLIENT_ID')); ?></small>
              



              <div class="search form-group<?php echo e($errors->has('PAYPAL_SECRET_ID') ? ' has-error' : ''); ?>">
                
                  
                    <?php echo Form::label('PAYPAL_SECRET_ID',__('adminstaticwords.PAYPALSECRETID')); ?>

                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterPaypalSecretId')); ?>"></i>
                    <input type="password" name="PAYPAL_SECRET_ID" value="<?php echo e($env_files['PAYPAL_SECRET_ID']); ?>" id="paypal_secret" class="form-control">
                 
                 
                      <span toggle="#paypal_secret" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                    
               

                  <small class="text-danger"><?php echo e($errors->first('PAYPAL_SECRET_ID')); ?></small>
              </div>
              <div class="search form-group<?php echo e($errors->has('PAYPAL_MODE') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('PAYPAL_MODE',__('adminstaticwords.PAYPALMODE')); ?>

                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterPaypalMode')); ?>"></i>
                  <?php echo Form::text('PAYPAL_MODE', null, ['class' => 'form-control']); ?>

                  <small class="text-danger"><?php echo e($errors->first('PAYPAL_MODE')); ?></small>
              </div>

            </div>
            </div>
            
          </div>
          

            <div class="payment-gateway-block">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-6">
                    <?php echo Form::label('razorpay_payment',__('adminstaticwords.RAZORPAYPAYMENT')); ?>

                  </div>
                  <div class="col-xs-5 text-right">
                    <label class="switch">
                      <?php echo Form::checkbox('razorpay_payment', 1, $config->razorpay_payment, ['class' => 'checkbox-switch']); ?>

                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div style="<?php echo e($config->razorpay_payment==1 ? "" : "display: none"); ?>" id="razorpay_box" class="row">
                <div class="col-md-6">
                  <div class="form-group<?php echo e($errors->has('RAZOR_PAY_KEY') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('RAZOR_PAY_KEY',__('adminstaticwords.RAZORPAYKEY')); ?>

                      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterRazorpayKey')); ?>"></i>
                      <?php echo Form::text('RAZOR_PAY_KEY', null , ['class' => 'form-control']); ?>


                      <small class="text-danger"><?php echo e($errors->first('RAZOR_PAY_KEY')); ?></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="search form-group<?php echo e($errors->has('RAZOR_PAY_SECRET') ? ' has-error' : ''); ?>">
                      
                          <?php echo Form::label('RAZOR_PAY_SECRET', __('adminstaticwords.RAZORPAYSECRETKEY')); ?>

                          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterRazorpaySecretKey')); ?>"></i>
                          

                          <input type="password" id="razorpay_secret" name="RAZOR_PAY_SECRET" value="<?php echo e($env_files['RAZOR_PAY_SECRET']); ?>" >
                        

                          <span toggle="#razorpay_secret" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                        

                     

                      <small class="text-danger"><?php echo e($errors->first('RAZOR_PAY_SECRET')); ?></small>
                  </div>
                </div>
              </div>
            </div>

          <div class="payment-gateway-block">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-6">
                    <?php echo Form::label('payu_payment', __('adminstaticwords.PAYUPAYMENT')); ?>

                  </div>
                  <div class="col-xs-5 text-right">
                    <label class="switch">
                      <?php echo Form::checkbox('payu_payment', 1, $config->payu_payment, ['class' => 'checkbox-switch']); ?>

                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div id="payu_box" style="<?php echo e($config->payu_payment==1 ? "" : "display: none"); ?>" class="row">
                <div class="col-md-6">
                  <div class="form-group<?php echo e($errors->has('PAYU_METHOD') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('PAYU_METHOD', __('adminstaticwords.PAYUMETHOD')); ?>

                      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterPayuMethod')); ?>"></i>
                      <?php echo Form::text('PAYU_METHOD', null, ['class' => 'form-control']); ?>

                      <small class="text-danger"><?php echo e($errors->first('PAYU_METHOD')); ?></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group<?php echo e($errors->has('PAYU_DEFAULT') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('PAYU_DEFAULT', __('adminstaticwords.PAYUDEFAULTOPTION')); ?>

                      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterDefaultPayuOption')); ?>"></i>
                      <?php echo Form::text('PAYU_DEFAULT', null, ['class' => 'form-control']); ?>

                      <small class="text-danger"><?php echo e($errors->first('PAYU_DEFAULT')); ?></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="search form-group<?php echo e($errors->has('PAYU_MERCHANT_KEY') ? ' has-error' : ''); ?>">
                   
                        <?php echo Form::label('PAYU_MERCHANT_KEY', __('adminstaticwords.PAYUMERCHANTKEY')); ?>

                        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterPayuMerchantKey')); ?>"></i>
                        <input id="payum" type="password" class="form-control" name="PAYU_MERCHANT_KEY" value="<?php echo e($env_files['PAYU_MERCHANT_KEY']); ?>">
                     

                     
                        <span toggle="#payum" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                     

                    

                      <small class="text-danger"><?php echo e($errors->first('PAYU_MERCHANT_KEY')); ?></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="search form-group<?php echo e($errors->has('PAYU_MERCHANT_SALT') ? ' has-error' : ''); ?>">
                    
                      
                        <?php echo Form::label('PAYU_MERCHANT_SALT', __('adminstaticwords.PAYUMERCHANTSALT')); ?>

                        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterPayuMerchantSalt')); ?>"></i>
                        <input type="password" value="<?php echo e($env_files['PAYU_MERCHANT_SALT']); ?>" name="PAYU_MERCHANT_SALT" id="payusalt" class="form-control">
                     
                        <span toggle="#payusalt" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                     

                      <small class="text-danger"><?php echo e($errors->first('PAYU_MERCHANT_SALT')); ?></small>
                  
                </div>
              </div>
            </div>

          </div>
            
              <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row">
                    <div class="col-xs-6">
                      <?php echo Form::label('braintree', __('adminstaticwords.BRAINTREEPAYMENT')); ?>

                    </div>
                    <div class="col-xs-5 text-right">
                      <label class="switch">
                        <?php echo Form::checkbox('braintree', 1, $config->braintree, ['class' => 'checkbox-switch', 'id' => 'braintree_check']); ?>

                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                </div>

                <div id="braintree_box" style="<?php echo e($config->braintree == 1 ? "" : "display:none"); ?>">
                    <div class="form-group">
                        <label><?php echo e(__('adminstaticwords.BTREEENVIRONMENT')); ?>: </label>
                        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMerchantID')); ?>"></i>
                        <input type="text" name="BTREE_ENVIRONMENT" value="<?php echo e($env_files['BTREE_ENVIRONMENT']); ?>" class="form-control">
                      </div>
      
                      <div class="form-group">
                          <label><?php echo e(__('adminstaticwords.BTREEMERCHANTID')); ?>: </label>
                          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMerchantKey')); ?>"></i>
                          <input type="text" name="BTREE_MERCHANT_ID" value="<?php echo e($env_files['BTREE_MERCHANT_ID']); ?>" class="form-control">
                      </div>
                        <div class="form-group">
                          <label><?php echo e(__('adminstaticwords.BTREEMERCHANTACCOUNTID')); ?>: </label>
                          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter merchant key"></i>
                          <input type="text" name="BTREE_MERCHANT_ACCOUNT_ID" value="<?php echo e($env_files['BTREE_MERCHANT_ACCOUNT_ID']); ?>" class="form-control">
                      </div>

           

                      <div class="form-group">
                          <label><?php echo e(__('adminstaticwords.BTREEPUBLICKEY')); ?>: </label>
                          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMerchantKey')); ?>"></i>
                          <input type="text" name="BTREE_PUBLIC_KEY" value="<?php echo e($env_files['BTREE_PUBLIC_KEY']); ?>" class="form-control">
                      </div>

                      <div class="form-group">
                          <label><?php echo e(__('adminstaticwords.BTREEPRIVATEKEY')); ?>: </label>
                          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMerchantKey')); ?>"></i>
                          <input type="text" name="BTREE_PRIVATE_KEY" value="<?php echo e($env_files['BTREE_PRIVATE_KEY']); ?>" class="form-control">
                      </div>

           
                </div>
               

               
          </div>

          
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row">
                    <div class="col-xs-6">
                      <?php echo Form::label('coinpay',__('adminstaticwords.COINPAYMENT')); ?>

                      <label><a href="https://www.coinpayments.net/">  (<?php echo e(__('adminstaticwords.CoinPaymentSite')); ?>)</a></label>
                    </div>
                    <div class="col-xs-5 text-right">
                      <label class="switch">
                        <?php echo Form::checkbox('coinpay', 1, $config->coinpay, ['class' => 'checkbox-switch', 'id' => 'coinpay_check']); ?>

                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                </div>

                <div id="coinpay_box" style="<?php echo e($config->coinpay == 1 ? "" : "display:none"); ?>">
                    <div class="form-group">
                        <label><?php echo e(__('adminstaticwords.COINPAYMENTSMERCHANTID')); ?>: </label>
                        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMerchantID')); ?>"></i>
                        <input type="text" name="COINPAYMENTS_MERCHANT_ID" value="<?php echo e($env_files['COINPAYMENTS_MERCHANT_ID']); ?>" class="form-control">
                      </div>
      
                    
           

                      <div class="form-group">
                          <label><?php echo e(__('adminstaticwords.COINPAYMENTSPUBLICKEY')); ?>: </label>
                          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMerchantKey')); ?>"></i>
                          <input type="text" name="COINPAYMENTS_PUBLIC_KEY" value="<?php echo e($env_files['COINPAYMENTS_PUBLIC_KEY']); ?>" class="form-control">
                      </div>

                      <div class="form-group">
                          <label><?php echo e(__('adminstaticwords.COINPAYMENTSPRIVATEKEY')); ?>: </label>
                          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMerchantKey')); ?>"></i>
                          <input type="text" name="COINPAYMENTS_PRIVATE_KEY" value="<?php echo e($env_files['COINPAYMENTS_PRIVATE_KEY']); ?>" class="form-control">
                      </div>

           
                </div>
               

               
          </div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row">
                    <div class="col-xs-6">
                      <?php echo Form::label('paystack',__('adminstaticwords.PAYSTACKPAYMENT')); ?>

                      <label> (Only Works on NGN Currency)</label>
                    </div>
                    <div class="col-xs-5 text-right">
                      <label class="switch">
                        <?php echo Form::checkbox('paystack', 1, $config->paystack, ['class' => 'checkbox-switch', 'id' => 'paystack_check']); ?>

                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                </div>

                <div id="paystack_box" style="<?php echo e($config->paystack == 1 ? "" : "display:none"); ?>">
                    <div class="form-group">
                        <label><?php echo e(__('adminstaticwords.PAYSTACKPUBLICKEY')); ?>: </label>
                        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMerchantID')); ?>"></i>
                        <input type="text" name="PAYSTACK_PUBLIC_KEY" value="<?php echo e($env_files['PAYSTACK_PUBLIC_KEY']); ?>" class="form-control">
                      </div>
      
                      <div class="form-group">
                          <label><?php echo e(__('adminstaticwords.PAYSTACKSECRETKEY')); ?>: </label>
                          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter merchant key"></i>
                          <input type="text" name="PAYSTACK_SECRET_KEY" value="<?php echo e($env_files['PAYSTACK_SECRET_KEY']); ?>" class="form-control">
                      </div>
                      <div class="form-group">
                          <label><?php echo e(__('adminstaticwords.MERCHANTEMAIL')); ?>: </label>
                          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMerchantEmail')); ?>"></i>
                          <input type="text" name="MERCHANT_EMAIL" value="<?php echo e($env_files['MERCHANT_EMAIL']); ?>" class="form-control">
                      </div>
                      <div class="form-group">
                          <label><?php echo e(__('adminstaticwords.PAYSTACKPAYMENTURL')); ?>: </label>
                          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterPaystackUrl')); ?>"></i>
                          <input type="text" name="PAYSTACK_PAYMENT_URL" value="<?php echo e($env_files['PAYSTACK_PAYMENT_URL']); ?>" class="form-control">
                      </div>
           
                </div>
               

               
          </div>

          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row">
                    <div class="col-xs-6">
                      <?php echo Form::label('paypal_payment', __('adminstaticwords.PAYTMPAYMENT')); ?>

                    </div>
                    <div class="col-xs-5 text-right">
                      <label class="switch">
                        <?php echo Form::checkbox('paytm_payment', 1, $config->paytm_payment, ['class' => 'checkbox-switch', 'id' => 'paytm_check']); ?>

                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                </div>

                <div id="paytm_box" style="<?php echo e($config->paytm_payment == 1 ? "" : "display:none"); ?>">
                    <div class="form-group">
                        <label><?php echo e(__('adminstaticwords.MerchantID')); ?>: </label>
                        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMerchantID')); ?>"></i>
                        <input type="text" name="PAYTM_MID" value="<?php echo e($env_files['PAYTM_MID']); ?>" class="form-control">
                      </div>
      
                      <div class="form-group">
                          <label><?php echo e(__('adminstaticwords.MerchantKEY')); ?>: </label>
                          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMerchantKey')); ?>"></i>
                          <input type="text" name="PAYTM_MERCHANT_KEY" value="<?php echo e($env_files['PAYTM_MERCHANT_KEY']); ?>" class="form-control">
                      </div>
                      <div class="bootstrap-checkbox form-group<?php echo e($errors->has('paytm_test') ? ' has-error' : ''); ?>">
                        <div class="row">
                          <div class="col-md-7">
                            <h5 class="bootstrap-switch-label"><?php echo e(__('adminstaticwords.PaytmTestingLive')); ?></h5>
                          </div>
                          <div class="col-md-5 pad-0">
                            <div class="make-switch">
                              <?php echo Form::checkbox('paytm_test', 1, ($config->paytm_test == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"Live", "data-off-text"=>"Test", "data-size"=>"small"]); ?>

                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <small class="text-danger"><?php echo e($errors->first('paytm_test')); ?></small>
                        </div>
                      </div>
                </div>
               

               
          </div>
           <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row">
                    <div class="col-xs-6">
                      <?php echo Form::label('instamojo_payment', __('adminstaticwords.INSTAMOJOPAYMENT')); ?>

                      <label> (<?php echo e(__('adminstaticwords.IndianCurrency')); ?>)</label>
                    </div>
                    <div class="col-xs-5 text-right">
                      <label class="switch">
                        <input id="instamojo_check" <?php echo e($config->instamojo_payment == 1 ? "checked" : ""); ?> type="checkbox" class="checkbox-switch" name="instamojo_payment">
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                </div>

                <div id="instamojo_box" style="<?php echo e($config->instamojo_payment == 1 ? "" : "display:none"); ?>">
                    <div class="form-group">
                        <label><?php echo e(__('adminstaticwords.INSTAMOJOAPIKEY')); ?>: </label>
                        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterApiKey')); ?>"></i>
                        <input type="text" name="IM_API_KEY" value="<?php echo e($env_files['IM_API_KEY']); ?>" class="form-control">
                      </div>
      
                      <div class="form-group">
                          <label><?php echo e(__('adminstaticwords.INSTAMOJOAUTHTOKEN')); ?>: </label>
                          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterInstamojoAuthTokenKey')); ?>"></i>
                          <input type="text" name="IM_AUTH_TOKEN" value="<?php echo e($env_files['IM_AUTH_TOKEN']); ?>" class="form-control">
                      </div>
                     
                      <div class="form-group">
                          <label><?php echo e(__('adminstaticwords.INSTAMOJOPAYMENTURL')); ?>: </label>
                          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterInstamojoUrl')); ?>"></i>
                          <input type="text" name="IM_URL" value="<?php echo e($env_files['IM_URL']); ?>" class="form-control">
                      </div>
                      <small class="text-danger">
                        <?php echo e(__('adminstaticwords.Note')); ?> :- <br/>
                        <b>- <?php echo e(__('adminstaticwords.ForTestingModePaymentUrlIs')); ?> https://test.instamojo.com/api/1.1/<br/>
                        - <?php echo e(__('adminstaticwords.ForLiveModePaymentUrlIs')); ?> https://www.instamojo.com/api/1.1/</b>
                      </small>
           
                </div>
               

               
          </div>

          <div class="payment-gateway-block">
            <div class="form-group">
              <div class="row">
                <div class="col-xs-6">
                  <?php echo Form::label('mollie_payment',__('adminstaticwords.MOLLIEPAYMENT')); ?>

                </div>
                <div class="col-xs-5 text-right">
                  <label class="switch">
                    <?php echo Form::checkbox('mollie_payment',1, $config->mollie_payment, ['class' => 'checkbox-switch']); ?>

                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
            </div>
            <div style="<?php echo e($config->mollie_payment==1 ? "" : "display: none"); ?>" id="mollie_box" class="row">
              <div class="col-md-12">
                <div class="form-group<?php echo e($errors->has('MOLLIE_KEY') ? ' has-error' : ''); ?>">
                    <?php echo Form::label('MOLLIE_KEY', __('adminstaticwords.MOLLIEKEY')); ?>

                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMollieKey')); ?>"></i>
                    <input type="text" name="MOLLIE_KEY" class="form-control" value="<?php echo e(env('MOLLIE_KEY') ? env('MOLLIE_KEY') : ''); ?>" placeholder="<?php echo e(__('adminstaticwords.PleaseEnterMollieKey')); ?>" >

                    <small class="text-danger"><?php echo e($errors->first('MOLLIE_KEY')); ?></small>
                </div>
              </div>
            </div>
          </div>

          <div  class="payment-gateway-block">
            <div class="form-group">
              <div class="row">
                <div class="col-xs-6">
                  <?php echo Form::label('cashfree_payment', __('adminstaticwords.CASHFREEPAYMENT')); ?>

                </div>
                <div class="col-xs-5 text-right">
                  <label class="switch">
                    <?php echo Form::checkbox('cashfree_payment', 1, $config->cashfree_payment, ['class' => 'checkbox-switch']); ?>

                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
            </div>
            <div id="cashfree_box" style="<?php echo e($config->cashfree_payment==1 ? "" : "display: none"); ?>" >

                <div class="search form-group<?php echo e($errors->has('CASHFREE_APP_ID') ? ' has-error' : ''); ?>">
                  
                   
                      <?php echo Form::label('CASHFREE_APP_ID',__('adminstaticwords.CASHFREEAPPID')); ?>

                      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterCashFreeAppId')); ?>"></i>
                     <?php echo Form::text('CASHFREE_APP_ID', null, ['class' => 'form-control']); ?>

                  

                    <small class="text-danger"><?php echo e($errors->first('CASHFREE_APP_ID')); ?></small>
                  </div>
                  <div class="search form-group<?php echo e($errors->has('CASHFREE_SECRET_ID') ? ' has-error' : ''); ?>">
                
                  
                    <?php echo Form::label('CASHFREE_SECRET_ID',__('adminstaticwords.CASHFREESECRETID')); ?>

                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterCashfreeSecretId')); ?>"></i>
                    <input type="password" name="CASHFREE_SECRET_ID" value="<?php echo e(env('CASHFREE_SECRET_ID') ? env('CASHFREE_SECRET_ID') :''); ?>" id="cashfree_secret" class="form-control">
                 
                 
                      <span toggle="#cashfree_secret" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                    
               

                    <small class="text-danger"><?php echo e($errors->first('CASHFREE_SECRET_ID')); ?></small>
                  </div>
                  <div class="search form-group<?php echo e($errors->has('CASHFREE_API_END_URL') ? ' has-error' : ''); ?>">
                    <?php echo Form::label('CASHFREE_API_END_URL', __('adminstaticwords.CASHFREEAPIENDURL')); ?>

                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterCashfreeApiEndurl')); ?>"></i>
                   
                   <input type="text" name="CASHFREE_API_END_URL" value="<?php echo e(env('CASHFREE_API_END_URL') ? env('CASHFREE_API_END_URL') : ''); ?>" placeholder="https://test.cashfree.com">
                    <small class="text-danger">
                      <?php echo e(__('adminstaticwords.Note')); ?> :- 
                      <ul>
                        <li>
                          <?php echo e(__('adminstaticwords.ForTestModeUseCASHFREEAPIENDURL')); ?> : <b>https://test.cashfree.com</b>
                        </li>
                        <li>
                          <?php echo e(__('adminstaticwords.ForLiveModeUseCASHFREEAPIENDURL')); ?> : <b>https://cashfree.com</b>
                        </li>
                      </ul>
                    </small>

                    <small class="text-danger"><?php echo e($errors->first('CASHFREE_API_END_URL')); ?></small>
                  </div>
              </div>
            </div>
          </div>

              <div class="payment-gateway-block">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-6">
                    <?php echo Form::label('bankdetails', __('adminstaticwords.BANKDETAILS')); ?>

                  </div>
                  <div class="col-xs-5 text-right">
                    <label class="switch">
                      <?php echo Form::checkbox('bankdetails', 1, $config->bankdetails, ['class' => 'checkbox-switch']); ?>

                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div id="bank_box" style="<?php echo e($config->bankdetails==1 ? "" : "display: none"); ?>" class="row">
                <div class="col-md-6">
                  <div class="form-group<?php echo e($errors->has('account_no') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('account_no', __('adminstaticwords.AccountNumber')); ?>

                      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterYourBankAccountNumber')); ?>"></i>
                      <input id="payum" type="text" class="form-control" value="<?php echo e($config->account_no); ?>" name="account_no">
                     
                      <small class="text-danger"><?php echo e($errors->first('account_no')); ?></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group<?php echo e($errors->has('account_name') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('account_name', __('adminstaticwords.AccountName')); ?>

                      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterYourAccountHolderNames')); ?>"></i>
                      <input id="payum" type="text" class="form-control" value="<?php echo e($config->account_name); ?>" name="account_name">
                     
                      <small class="text-danger"><?php echo e($errors->first('account_name')); ?></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="search form-group<?php echo e($errors->has('ifsc_code') ? ' has-error' : ''); ?>">
                   
                        <?php echo Form::label('ifsc_code',__('adminstaticwords.IFSCCode')); ?>

                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterIFSCCode')); ?>"></i>
                  <input id="payum" type="text" class="form-control" value="<?php echo e($config->ifsc_code); ?>" name="ifsc_code">
                  
                     <small class="text-danger"><?php echo e($errors->first('ifsc_code')); ?></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="search form-group<?php echo e($errors->has('bank_name') ? ' has-error' : ''); ?>">
                    
                        <?php echo Form::label('bank_name',__('adminstaticwords.BankName')); ?>

                        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterBankName')); ?>"></i>
                        <input type="text" name="bank_name" value="<?php echo e($config->bank_name); ?>" id="payusalt" class="form-control">
                     
                      <small class="text-danger"><?php echo e($errors->first('bank_name')); ?></small>
                  
                </div>
              </div>
            </div>

          </div>
          

          <div class="payment-gateway-block">

          <div class="api-main-block">
            <h5 class="form-block-heading apipadding"><?php echo e(__('adminstaticwords.OtherApis')); ?></h5>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-6">
                  <div class="search form-group<?php echo e($errors->has('MAILCHIMP_APIKEY') ? ' has-error' : ''); ?>">
                    
                      
                        <?php echo Form::label('MAILCHIMP_APIKEY', __('adminstaticwords.MAILCHIMPAPIKEY')); ?>

                        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMailchimpApiKey')); ?>"></i>
                        <input type="password" id="mailc" value="<?php echo e($env_files['MAILCHIMP_APIKEY']); ?>" name="MAILCHIMP_APIKEY" class="form-control">
                     

                     
                        <span toggle="#mailc" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                     
                   

                      <small class="text-danger"><?php echo e($errors->first('MAILCHIMP_APIKEY')); ?></small>
                  </div>
                <div class="form-group<?php echo e($errors->has('MAILCHIMP_LIST_ID') ? ' has-error' : ''); ?>">
                    <?php echo Form::label('MAILCHIMP_LIST_ID',__('adminstaticwords.MAILCHIMPLISTID')); ?>

                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMailchimpListId')); ?>"></i>
                    <?php echo Form::text('MAILCHIMP_LIST_ID', null, ['class' => 'form-control']); ?>



                    <small class="text-danger"><?php echo e($errors->first('MAILCHIMP_LIST_ID')); ?></small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="search form-group<?php echo e($errors->has('TMDB_API_KEY') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('TMDB_API_KEY', __('adminstaticwords.TMDBAPIKEY')); ?>

                      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterTmdbApiKey')); ?>"></i>
                      <input type="password" id="tmdb_secret" name="TMDB_API_KEY" value="<?php echo e($env_files['TMDB_API_KEY']); ?>" id="tmdb_secret" class="form-control">
                  
                      <span toggle="#tmdb_secret" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                    <small class="text-danger"><?php echo e($errors->first('TMDB_API_KEY')); ?></small>
                </div>
               </div>
              </div>
            </div>

          </div>
          <div class="btn-group col-xs-12">
            <button type="submit" class="btn btn-block btn-success"><?php echo e(__('adminstaticwords.SaveSettings')); ?></button>
          </div>
          <div class="clear-both"></div>
        </div>
      <?php echo Form::close(); ?>

  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>


  <script>


  $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

$(".toggle-password2").click(function() {

$(this).toggleClass("fa-eye fa-eye-slash");
var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
  input.attr("type", "text");
} else {
  input.attr("type", "password");
}
});

  </script>

  <script>
    $('#stripe_payment').on('change',function(){
      if ($('#stripe_payment').is(':checked')){
           $('#stripe_box').show('fast');
        }else{
          $('#stripe_box').hide('fast');
        }
    });   
     $('#razorpay_payment').on('change',function(){
      if ($('#razorpay_payment').is(':checked')){
           $('#razorpay_box').show('fast');
        }else{
          $('#razorpay_box').hide('fast');
        }
    });   

     $('#paypal_payment').on('change',function(){
      if ($('#paypal_payment').is(':checked')){
           $('#paypal_box').show('fast');
        }else{
          $('#paypal_box').hide('fast');
        }
    });   

      $('#payu_payment').on('change',function(){
      if ($('#payu_payment').is(':checked')){
           $('#payu_box').show('fast');
        }else{
          $('#payu_box').hide('fast');
        }
    }); 

       $('#bankdetails').on('change',function(){
      if ($('#bankdetails').is(':checked')){
           $('#bank_box').show('fast');
        }else{
          $('#bank_box').hide('fast');
        }
    }); 
      

    $('#paytm_check').on('change',function(){
      if ($('#paytm_check').is(':checked')){
           $('#paytm_box').show('fast');
        }else{
          $('#paytm_box').hide('fast');
        }
    });  
     $('#braintree_check').on('change',function(){
      if ($('#braintree_check').is(':checked')){
           $('#braintree_box').show('fast');
        }else{
          $('#braintree_box').hide('fast');
        }
    }); 
     $('#paystack_check').on('change',function(){
      if ($('#paystack_check').is(':checked')){
           $('#paystack_box').show('fast');
        }else{
          $('#paystack_box').hide('fast');
        }
    }); 

    $('#instamojo_check').on('change',function(){
      if ($('#instamojo_check').is(':checked')){
           $('#instamojo_box').show('fast');
        }else{
          $('#instamojo_box').hide('fast');
        }
    });

    $('#mollie_payment').on('change',function(){
      if ($('#mollie_payment').is(':checked')){
           $('#mollie_box').show('fast');
        }else{
          $('#mollie_box').hide('fast');
        }
    });

    $('#cashfree_payment').on('change',function(){
      if ($('#cashfree_payment').is(':checked')){
           $('#cashfree_box').show('fast');
        }else{
          $('#cashfree_box').hide('fast');
        }
    }); 

     $('#coinpay_check').on('change',function(){
      if ($('#coinpay_check').is(':checked')){
           $('#coinpay_box').show('fast');
        }else{
          $('#coinpay_box').hide('fast');
        }
    });    
       $('#aws').on('change',function(){
      if ($('#aws').is(':checked')){
           $('#aws_box').show('fast');
        }else{
          $('#aws_box').hide('fast');
        }
    });  
     $('#captcha').on('change',function(){
      if ($('#captcha').is(':checked')){
           $('#captcha_box').show('fast');
        }else{
          $('#captcha_box').hide('fast');
        }
    });   
  </script>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sonaflix/new.sonaflix.com/resources/views/admin/config/api.blade.php ENDPATH**/ ?>
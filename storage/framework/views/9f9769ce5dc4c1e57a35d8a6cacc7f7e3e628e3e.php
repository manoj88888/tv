<!Doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="<?php echo e(url('installer/css/bootstrap.min.css')); ?>" crossorigin="anonymous">
   
    <link rel="stylesheet" href="<?php echo e(url('installer/css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('installer/css/shards.min.css')); ?>">
   
    
    <title><?php echo e(__('Installing App - Terms and Condition')); ?></title>
    <?php echo notify_css(); ?>
  </head>
  <body class="body">
   	   
      <div class="display-none preL">
        <div class="display-none preloader3"></div>
      </div>

   		<div class="container">
   			<div class="card">
          <div class="card-header">
              <h3 class="m-3 text-center heading">
                  <?php echo e(__('Update Nexthour')); ?>

              </h3>
          </div>
         
   				<div class="card-body" id="stepbox">
                <form action="<?php echo e(route('store.updateeula')); ?>" id="step1form" method="POST" class="needs-validation" novalidate>
                  <?php echo csrf_field(); ?>
                  <h3><?php echo e(__('Terms & Conditions')); ?></h3>
                   <hr>
                  <div class="form-row overflow-auto" style="height:250px;">
                    <br>
                   <div class="col-md-12 ">
                      <p class="text-dark font-weight-bold"><?php echo e(__('Please read this agreement carefully before installing or using this product')); ?>.</p>
                      <p class="text-dark font-weight-normal ">

                      <?php echo e(__('If you agree to all of the terms of this End-User License Agreement, by checking the box or clicking the button to confirm your acceptance when you first install the web application, you are agreeing to all the terms of this agreement. Also, By downloading, installing, using, or copying this web application, you accept and agree to be bound by the terms of this End-User License Agreement, you are agreeing to all the terms of this agreement. If you do not agree to all of these terms, do not check the box or click the button and/or do not use, copy or install the web application, and uninstall the web application from all your server that you own or control')); ?>.</p>
                      
                      <b class="text-danger"><u><?php echo e(__('Note')); ?>:</b></u> <span class="text-dark font-weight-normal">
                        <?php echo e(__("With Nexthour, We are using the official Payment API (Paypal, PayuMoney, Stripe, Razorpay, Paystack, PayTM, Braintree ) which is available on Developer Center. That is a reason why our product depends on Payment API(Paypal, Payu, Stripe). Therefore, We are not responsible if they made too many critical changes in their side. We also don't guarantee that the compatibility of the script with Payment API will be forever. Although we always try to update the lastest version of script as soon as possible. We don't provide any refund for all problems which are originated from Payments API (Paypal, PayuMoney, Stripe, Razorpay, Paystack, PayTM, Braintree)")); ?>.
                      </span> 
                     
                     <hr>
                    
                   </div>
                  </div>
                  <br/>
                  
                      <h3><?php echo e(__('Domain Detail')); ?></h3>
                  <hr/>
                  <div class="row">

                    <div class="eyeCy col-md-6 mb-3">
                      <label for="validationCustom02"><?php echo e(__('Domain Name:')); ?></label>
                      <input name="domain" type="text" class="form-control <?php $__errorArgs = ['domain'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  value="" required>
                     
                      <div class="valid-feedback">
                        <?php echo e(__('Looks good!')); ?>

                      </div>
                      <?php $__errorArgs = ['domain'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <div class="invalid-feedback">
                        <?php echo e($message); ?>

                      </div>                          
                       <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                         
                    </div>           

                    <div class="eyeCy col-md-6 mb-3">
                      <label for="validationCustom02"><?php echo e(__('Purchase Code:')); ?></label>
                      <input name="code" type="password" class="form-control <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="validationCustom02" placeholder="<?php echo e(__('Please enter valid purchase code')); ?>" value="" required>
                      <span toggle="#validationCustom02" class="eye fa fa-fw fa-eye field-icon toggle-password"></span>
                      <div class="valid-feedback">
                        <?php echo e(__('Looks good!')); ?>

                      </div>
                      <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <div class="invalid-feedback">
                        <?php echo e($message); ?>

                      </div> 
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>                         
                        

                        <small class="text-muted font-weight-bold">
                          <i class="fa fa-question-circle"></i> <a title="<?php echo e(__('Click to know')); ?>" class="text-muted" href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code" target="_blank"><?php echo e(__('Where Is My Purchase Code')); ?> ?</a>
                        </small>
                    </div>            
                  </div>
                  <b class="text-danger"><?php echo e(__('You can use this project only in single domain for multiple domain please check License standard')); ?> <a target="_blank" href="https://codecanyon.net/licenses/standard"><?php echo e(__('here')); ?></a>.</b>
                  <br/>
                  <div class="custom-control custom-checkbox">
                      <input required="" type="checkbox" class="custom-control-input form-control <?php $__errorArgs = ['eula'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="customCheck1" name="eula"/>
                      <label class="custom-control-label" for="customCheck1"><b><?php echo e(__('I read the terms and condition carefully and I agree on it')); ?>.</b></label>
                  </div> 
                   <?php $__errorArgs = ['eula'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <div class="invalid-feedback">
                        <?php echo e($message); ?>

                      </div> 
                   <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>    
                <button class="float-right step1btn btn btn-default" type="submit"><?php echo e(__('Update App')); ?>...</button>
              </form>
   				  </div>
          
   			</div>


        
        <p class="text-center m-3 text-white">&copy;<?php echo e(date('Y')); ?> | Next Hour - Movie Tv Show & Video Subscription Portal Cms Web and Mobile App | <a class="text-white" href="http://mediacity.co.in"><?php echo e(__('Media City')); ?></a></p>
   		</div>


      
      
      <div class="corner-ribbon bottom-right sticky green shadow"><?php echo e(__('Update')); ?> </div>
       <?php echo notify_js(); ?>
    <?php echo app('notify')->render(); ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo e(url('installer/js/jquery-3.4.1.min.js')); ?>"></script>
    <script src="<?php echo e(url('installer/js/jquery.validate.min.js')); ?>"></script>
    <!-- jquery -->
    <script type="text/javascript" src="<?php echo e(url('installer/js/bootstrap.min.js')); ?>"></script> <!-- bootstrap js -->
    <script type="text/javascript" src="<?php echo e(url('installer/js/popper.min.js')); ?>"></script> 
    <script src="<?php echo e(url('installer/js/shards.min.js')); ?>"></script>
    <script>var baseUrl= "<?= url('/') ?>";</script>

   
  
   
</body>
</html><?php /**PATH D:\xampp\htdocs\tv\resources\views/install/existeula.blade.php ENDPATH**/ ?>
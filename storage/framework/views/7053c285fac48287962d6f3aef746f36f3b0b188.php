<?php $__env->startSection('title',__('staticwords.welcome')); ?>
<?php $__env->startSection('main-wrapper'); ?>
<style>
div {
  display: block;
  position: relative;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}


.ribbon {
  width: 150px;
  height: 150px;
  overflow: hidden;
  position: absolute;
}

.ribbon::before,
.ribbon::after {
  position: absolute;
  z-index: -1;
  content: '';
  display: block;
  border: 5px solid green;
}

.ribbon span {
  position: absolute;
  display: block;
  width: 225px;
  padding: 7px 0;
  background-color: green;
  box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
  color: #fff;
  font: 0 18px/1 'Lato', sans-serif;
  text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
  text-transform: uppercase;
  text-align: center;
}

.ribbon-top-right {
  top: -10px;
  right: -10px
}

.ribbon-top-right::before,
.ribbon-top-right::after {
  border-top-color: transparent;
  border-right-color: transparent
}

.ribbon-top-right::before {
  top: 0;
  left: 17px
}

.ribbon-top-right::after {
  bottom: 17px;
  right: 0
}

.ribbon-top-right span {
  left: -25px;
  top: 30px;
  transform: rotate(45deg)
}

.container {
  margin-top: 100px;
  margin-bottom: 100px
}

.bbb_deals_featured {
  width: 100%
}

.bbb_deals {
  width: 36%;
  margin-right: 7%;
  padding-top: 85px;
  padding-left: 2px;
  padding-right: 2px;
  padding-bottom: 35px;
  box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
  border-radius: 0px;
  border-top: black 3px solid;
}

.image2 {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 60px;
}

.bbb_deals:hover .image2 {
  width: 65px;
  opacity: 1;
}

.bbb_deals_title {
  position: absolute;
  top: 27px;
  left: 100px;
  font-size: 18px;
  font-weight: 700;
  color: #000000
}

.bbb_deals_slider_container {
  width: 100%
}

.bbb_deals_item {
  width: 100% !important
}

.bbb_deals_image {
  width: 100%
}

.bbb_deals_image img {
  width: 100%
}

.image1 {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 80%;
}

.bbb_deals:hover .image1 {
  width: 82%;
  opacity: 1;
}

.bbb_deals_content {
  margin-top: 33px
}

.bbb_deals_item_category a {
  font-size: 14px;
  font-weight: 400;
  color: rgba(0, 0, 0, 0.5)
}

.bbb_deals_item_price_a {
  font-size: 14px;
  font-weight: 400;
  color: rgba(0, 0, 0, 0.6)
}

.bbb_deals_item_name {
  font-size: 24px;
  font-weight: 400;
  color: #000000;
  left: 45px;
}

.bbb_deals_item_price {
  font-size: 24px;
  font-weight: 500;
  color: #df3b3b
}

.available {
  margin-top: 19px
}

.available_title {
  font-size: 12px;
  color: rgba(0, 0, 0, 0.5);
  font-weight: 400
}

.available_title span {
  font-weight: 700
}

.sold_title {
  font-size: 12px;
  color: rgba(0, 0, 0, 0.5);
  font-weight: 400
}

.sold_title span {
  font-weight: 700
}

@media  only screen and (max-width: 1199px) {
  .bbb_deals_timer_box {
      width: 150px
  }

  .bbb_deals_timer_unit {
      font-size: 20px
  }
}

@media  only screen and (max-width: 991px) {
  .bbb_deals {
      width: 100%;
      margin-right: 0px
  }
}

@media  only screen and (max-width: 575px) {
  .bbb_deals {
      padding-left: 15px;
      padding-right: 15px
  }

  .bbb_deals_title {
      left: 15px;
      font-size: 16px
  }

  .bbb_deals_slider_nav_container {
      right: 5px
  }

  .bbb_deals_item_name,
  .bbb_deals_item_price {
      font-size: 20px
  }

  .bbb_deals_item_category a,
  .bbb_deals_item_price_a {
      font-size: 12px
  }

  .bbb_deals_timer_unit {
      font-size: 16px
  }
}
</style>

<!-- main wrapper -->
  <section id="main-wrapper" class="main-wrapper home-page">
    <?php if(isset($blocks) && count($blocks) > 0): ?>
      <?php $__currentLoopData = $blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- home out section -->
        <div id="home-out-section-1" class="home-out-section" style="min-height: <?php echo e($loop->first ? '100vh' : '65vh'); ?> ; background-image: url('<?php echo e(asset('images/main-home/'.$block->image)); ?>')">
          <div class="overlay-bg <?php echo e($block->left == 1 ? 'gredient-overlay-left' : 'gredient-overlay-right'); ?> "></div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 col-sm-6 <?php echo e($block->left == 1 ? 'col-md-offset-6 col-sm-offset-6 col-sm-6 col-md-6 text-right' : ''); ?>">
                <h2 class="section-heading <?php echo e($block->left == 1 ? 'pad-lt-100' : ''); ?>"><?php echo e($block->heading); ?></h2>
                <p class="section-dtl <?php echo e($block->left == 1 ? 'pad-lt-100' : ''); ?>"><?php echo e($block->detail); ?></p>
                <?php if($block->button == 1): ?>
                  <?php if($block->button_link == 'login'): ?>
                    <?php if(auth()->guard()->guest()): ?>
                      <a href="<?php echo e(url('login')); ?>" class="btn btn-prime"><?php echo e($block->button_text); ?></a>
                    <?php endif; ?>
                  <?php else: ?>
                    <?php if(auth()->guard()->guest()): ?>
                      <a href="<?php echo e(url('register')); ?>" class="btn btn-prime"><?php echo e($block->button_text); ?></a>
                    <?php endif; ?>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <!-- end out section -->
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    
    <!-- Pricing plan main block -->
    

    <?php if(isset($remove_subscription) && $remove_subscription == 0): ?> 
      <?php if(isset($plans) && count($plans) > 0): ?>
        <div class="purchase-plan-main-block main-home-section-plans">
          <div class="panel-setting-main-block panel-subscribe">
            <div class="container">
              <div class="plan-block-dtl">
                <h3 class="plan-dtl-heading"><?php echo e(__('staticwords.membershipplans')); ?></h3>
                <ul>
                  <li><?php echo e(__('staticwords.membershiplines1')); ?>!
                  </li>
                  <li><?php echo e(__('staticwords.membershiplines2')); ?> 
                  <li><?php echo e(__('staticwords.membershiplines3')); ?> 
                    
                    <?php if(Auth::check()): ?>
                      <?php  
                         $id = Auth::user()->id;
                         $getuserplan = App\PaypalSubscription::where('status','=','1')->where('user_id',$id)->first();
                      ?>
                    <?php endif; ?>

                    <?php
                      $today =  date('Y-m-d h:i:s');
                    ?>

      
                  </li>
                </ul>
              </div>
              
              <div class="bbb_deals_featured">
                <div class="container">
                    <div class="row">
                        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($plan->id%2 == 0): ?>
                                <div class="col-md-6 col d-flex flex-lg-row flex-column align-items-center justify-content-center">
                                    <div class="bbb_deals" style="background-color: rgba(219,205,240,255); padding-top: 15px; width: 310px; height: 540px;">
                                        <?php if($plan->interval == 'year'): ?>
                                            <div style="font-size: small;" class="ribbon ribbon-top-right"><span>Recommended</span></div>
                                        <?php endif; ?>
                                        <p style="font-size: large; text-align: center; font-weight: 700;"><?php echo e(ucfirst($plan->name)); ?></p>
                                        <div class="bbb_deals_slider_container">
                                            <div class=" bbb_deals_item">
                                                <div class="bbb_deals_image image1"><img src="<?php echo e(url('images/new_package_design/1.png')); ?>" alt=""></div>
                                                <div class="bbb_deals_content">
                                                    <p style="font-size: large; text-align: center; font-weight: 400; padding-bottom:0px; margin-bottom:0px;"><b>$</b> <?php echo e($plan->amount); ?> / <?php echo e(ucfirst($plan->interval)); ?> </p>
                                                    <?php
                                                        $pricingTexts = App\PricingText::where('package_id',$plan->id)->get();
                                                    ?>
                                                    <?php $__currentLoopData = $pricingTexts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <p style="font-size: small; text-align: center;">
                                                            <b>
                                                                <?php echo e(ucfirst($element->title1)); ?><br>
                                                                <?php echo e(ucfirst($element->title2)); ?><br>
                                                                <?php echo e(ucfirst($element->title3)); ?><br>
                                                                <?php echo e(ucfirst($element->title4)); ?><br>
                                                                <?php echo e(ucfirst($element->title5)); ?><br>
                                                                <?php echo e(ucfirst($element->title6)); ?>

                                                            </b>
                                                        </p>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(auth()->guard()->check()): ?>
                                                        <a href="<?php echo e(route('get_payment', $plan->id)); ?>"><img class="image2" src="<?php echo e(url('images/new_package_design/abutton.png')); ?>" alt="Subscribe"></a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('register')); ?>"><img class="image2" src="<?php echo e(url('images/new_package_design/abutton.png')); ?>" alt="Register"></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($plan->id%2 != 0): ?>
                                <div class="col-md-6 col d-flex flex-lg-row flex-column align-items-center justify-content-center">
                                    <div class="bbb_deals" style="background-color: rgb(53, 53, 53); padding-top: 15px; width: 310px; height: 540px;">
                                        <?php if($plan->interval == 'year'): ?>
                                            <div style="font-size: small;" class="ribbon ribbon-top-right"><span>Recommended</span></div>
                                        <?php endif; ?>
                                        <p style="font-size: large; text-align: center; font-weight: 700; color: white;"><?php echo e(ucfirst($plan->name)); ?></p>
                                        <div class="bbb_deals_slider_container">
                                            <div class=" bbb_deals_item">
                                                <div class="bbb_deals_image image1"><img src="<?php echo e(url('images/new_package_design/2.png')); ?>" alt=""></div>
                                                <div class="bbb_deals_content">
                                                    <p class="onhover" style="font-size: large; text-align: center; font-weight: 400; color: white; padding-bottom:0px; margin-bottom:0px;"><b>$</b><?php echo e($plan->amount); ?> / <?php echo e(ucfirst($plan->interval)); ?></p>
                                                    <?php
                                                        $pricingTexts = App\PricingText::where('package_id',$plan->id)->get();
                                                    ?>
                                                    <?php $__currentLoopData = $pricingTexts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <p style="font-size: small; text-align: center;">
                                                            <b>
                                                                <?php echo e(ucfirst($element->title1)); ?><br>
                                                                <?php echo e(ucfirst($element->title2)); ?><br>
                                                                <?php echo e(ucfirst($element->title3)); ?><br>
                                                                <?php echo e(ucfirst($element->title4)); ?><br>
                                                                <?php echo e(ucfirst($element->title5)); ?><br>
                                                                <?php echo e(ucfirst($element->title6)); ?>

                                                            </b>
                                                        </p>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(auth()->guard()->check()): ?>
                                                        <a href="<?php echo e(route('get_payment', $plan->id)); ?>"><img class="image2" src="<?php echo e(url('images/new_package_design/mbutton.png')); ?>" alt="Subscribe"></a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('register')); ?>"><img class="image2" src="<?php echo e(url('images/new_package_design/mbutton.png')); ?>" alt="Register"></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </div>
                </div>
            </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>



    
    <!-- end featured main block -->
    <!-- end out section -->
  </section>
<!-- end main wrapper -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
        
        <?php if(isset(Auth::user()->multiplescreen)): ?>
        <?php if((Auth::user()->multiplescreen->activescreen!= NULL)): ?>
         $(document).ready(function(){

           $('#showM').hide();

           });
          <?php else: ?>
           $(document).ready(function(){

            $('#showM').modal();

           });
          <?php endif; ?>
          <?php endif; ?>



</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\tv\resources\views/main.blade.php ENDPATH**/ ?>
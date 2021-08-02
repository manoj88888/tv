


<?php $__env->startSection('custom-meta'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title',"$audio->title"); ?>


<?php $__env->startSection('main-wrapper'); ?>
<?php
 
  $withlogin= App\Config::findOrFail(1)->withlogin;
  $catlog= App\Config::findOrFail(1)->catlog;
   $configs= App\Config::findOrFail(1);
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
   
           $auth=Auth::user();
             $subscribed = null;
         
            if (isset($auth)) {

              $current_date = date("d/m/y");
                  
              $auth = Illuminate\Support\Facades\Auth::user();
              if ($auth->is_admin == 1) {
                $subscribed = 1;
              } else if ($auth->stripe_id != null) {
                
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                //dd($invoices);
                 $customer = \Stripe\Customer::retrieve($auth->stripe_id);
                $invoices = $customer->invoices();
                
                if(isset($invoices) && $invoices != null && count($invoices->data) > 0)
                {
                  $user_plan_end_date = date("d/m/y", $invoices->data[0]->period_end);
                
                $plans = App\Package::all();
                foreach ($plans as $key => $plan) {
                  if ($auth->subscriptions($plan->plan_id)) {
                   
                  if($current_date <= $user_plan_end_date)
                  {
                  
                      $subscribed = 1;
                  }
                      
                  }
                } 
                }
                
                
              } else if (isset($auth->paypal_subscriptions)) { 
             
                //Check Paypal Subscription of user
                $last_payment = $auth->paypal_subscriptions->last();
                if (isset($last_payment) && $last_payment->status == 1) {
                  //check last date to current date
                  $current_date = Illuminate\Support\Carbon::now();
                  if (date($current_date) <= date($last_payment->subscription_to)) {
                    $subscribed = 1;
                  }
                }
              }
            }
         
 ?>
<!-- main wrapper -->
<section class="main-wrapper main-wrapper-single-movie-prime">
  <div class="background-main-poster-overlay">

    <!-- Modal -->

    <?php if(isset($audio)): ?>
      <?php if($audio->poster != null): ?>
        <div class="background-main-poster col-md-offset-4 col-md-6" style="background-image: url('<?php echo e(asset('images/audio/posters/'.$audio->poster)); ?>');">
      <?php else: ?>
        <div class="background-main-poster col-md-offset-4 col-md-6" style="background-image: url('<?php echo e(asset('images/default-poster.jpg')); ?>');">
      <?php endif; ?>
     <?php endif; ?>
   </div>
        <div class="overlay-bg gredient-overlay-right"></div>
        <div class="overlay-bg"></div>
  </div>
  <div id="full-movie-dtl-main-block" class="full-movie-dtl-main-block">
    <div class="container-fluid">
      <?php if(isset($audio)): ?>
     
        <div class="row" style="min-height:400px;">
          <div class="col-md-8 small-screen-block">
            <div class="full-movie-dtl-block">
              <h2 class="section-heading"><?php echo e($audio->title); ?></h2></br>
              <div class="">
               
                 <div id="wishlistelement" class="screen-play-btn-block">
                    
                  <?php if(Auth::check() && $subscribed ==1): ?>

                   
                      <?php if(Auth::check() && Auth::user()->is_admin == '1'): ?>
                        <a  href="<?php echo e(route('watchaudio',$audio->id)); ?>" class="btn btn-play play-btn-icon<?php echo e($audio['id']); ?>"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                          </a>
                      <?php else: ?>
                        <a href="<?php echo e(url('/watch/audio/'.$audio->id)); ?>" class=" btn btn-play play-btn-icon<?php echo e($audio['id']); ?>"><span class="play-btn-icon "><i class="fa fa-play" ><span class="play-text"> <?php echo e(__('staticwords.playnow')); ?></span></a>
                      <?php endif; ?>
                   
                  <?php endif; ?>
                          
                  </div>
                  
              </div>
               
              <p class="text-justify">
                <?php echo e($audio->detail); ?>

              </p>
            </div>
          </div>
          <div class="col-md-4 small-screen-block">
            <div class="poster-thumbnail-block">
                <?php if($audio->thumbnail != null || $audio->thumbnail != ''): ?>
                <img src="<?php echo e(asset('images/audio/thumbnails/'.$audio->thumbnail)); ?>" class="img-responsive" alt="genre-image">
                <?php else: ?>
                <img src="<?php echo e(asset('images/default-thumbnail.jpg')); ?>" class="img-responsive" alt="genre-image">
                <?php endif; ?>
              </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
   

<?php $__env->stopSection(); ?>


<?php $__env->startSection('custom-script'); ?>


<script>
  $(document).ready(function(){

    $(".group1").colorbox({rel:'group1'});
    $(".group2").colorbox({rel:'group2', transition:"fade"});
    $(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
    $(".group4").colorbox({rel:'group4', slideshow:true});
    $(".ajax").colorbox();
    $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
    $(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
    $(".iframe").colorbox({iframe:true, width:"100%", height:"100%"});
    $(".inline").colorbox({inline:true, width:"50%"});
    $(".callbacks").colorbox({
      onOpen:function(){ alert('onOpen: colorbox is about to open'); },
      onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
      onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
      onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
      onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
    });

    $('.non-retina').colorbox({rel:'group5', transition:'none'})
    $('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});


    $("#click").click(function(){ 
      $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
      return false;
    });
  });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/audio_detail.blade.php ENDPATH**/ ?>
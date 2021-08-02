
<?php $__env->startSection('title',__('staticwords.watchlist')); ?>
<?php $__env->startSection('main-wrapper'); ?>
  <!-- main wrapper -->
  <?php
 $withlogin= App\Config::findOrFail(1)->withlogin;
 $catlog= App\Config::findOrFail(1)->catlog;
 $auth=Auth::user();
   $subscribed = null;
 

  if (isset($auth)) {

    $current_date = date("d/m/y");
        
    $auth = Illuminate\Support\Facades\Auth::user();
    if ($auth->is_admin == 1) {
      $subscribed = 1;
    } else if ($auth->stripe_id != null) {
      Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      if(isset($invoices) && $invoices != null && count($invoices->data) > 0)
      
      {
      $user_plan_end_date = date("d/m/y", $invoice->lines->data[0]->period->end);
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
  <section class="main-wrapper">
    <div class="container-fluid">
      <div class="watchlist-section">
        <h5 class="watchlist-heading"><?php echo e(__('staticwords.watchlist')); ?></h5>
        <div class="watchlist-btn-block">
          <div class="btn-group">
            <?php
               $auth=Auth::user();
               if(isset($auth) || $auth->is_admin){
               $nav=App\Menu::orderBy('position','ASC')->get();
             }
            ?>
              <?php if(isset($nav)): ?>
                 
                  <?php $__currentLoopData = $nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 
                    <a class="<?php echo e(isset($menu) ? 'active' : ''); ?>" href="<?php echo e(url('account/watchlist', $menu->slug)); ?>"  title="<?php echo e($menu->name); ?>"><?php echo e($menu->name); ?></a>
                    
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
              <?php endif; ?>
            
          </div>
        </div>
      <!-- Modal -->
  <?php echo $__env->make('modal.agemodal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- Modal -->
  <?php echo $__env->make('modal.agewarning', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php if(isset($movies)): ?>
          <div class="watchlist-main-block">
            <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($item->type=='S'): ?>
              <?php if($item->tvseries->status == 1): ?>
              <div class="watchlist-block">
                <div class="watchlist-img-block protip" data-pt-placement="outside" data-pt-title="#prime-show-description-block<?php echo e($item->id); ?>">
                  <a href="<?php echo e(url('show/detail',$item->season_slug)); ?>">
                    <?php if($item->thumbnail != null): ?>
                      <img data-src="<?php echo e(url('images/tvseries/thumbnails/'.$item->thumbnail)); ?>" class="img-responsive lazy watchlist-img" alt="genre-image">
                    <?php elseif($item->tvseries['thumbnail'] != null): ?>
                      <img data-src="<?php echo e(url('images/tvseries/thumbnails/'.$item->tvseries->thumbnail)); ?>" class="img-responsive lazy watchlist-img" alt="genre-image">
                    <?php else: ?>
                      <img data-src="<?php echo e(url('images/default-thumbnail.jpg')); ?>" class="img-responsive lazy watchlist-img" alt="genre-image">
                    <?php endif; ?>
                  </a>
                </div>
                <?php echo Form::open(['method' => 'DELETE', 'action' => ['WishListController@showdestroy', $item->id]]); ?>

                 
                 <button type="submit" class="watchhistory_remove"><i class="fa fa-close" aria-hidden="true"></i></button><br/>
                <?php echo Form::close(); ?>

                <?php if(isset($protip) && $protip == 1): ?>
                <div id="prime-show-description-block<?php echo e($item->id); ?>" class="prime-description-block">
                  <h5 class="description-heading"><?php echo e($item->tvseries['title']); ?></h5>
                  <div class="movie-rating"><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->tvseries['rating']); ?></div>
                  <ul class="description-list">
                    <li><?php echo e(__('staticwords.season')); ?> <?php echo e($item->season_no); ?></li>
                    <li><?php echo e($item->publish_year); ?></li>
                    <li><?php echo e($item->tvseries['age_req']); ?></li>
                    <?php if($item->subtitle == 1): ?>
                      <li>
                       <?php echo e(__('staticwords.subtitles')); ?>

                      </li>
                    <?php endif; ?>
                  </ul>
                  <div class="main-des">
                    <?php if($item->detail != null || $item->detail != ''): ?>
                      <p><?php echo e($item->detail); ?></p>
                    <?php else: ?>
                      <p><?php echo e($item->tvseries['detail']); ?></p>
                    <?php endif; ?>
                    <a href="#"></a>
                  </div>
                  <div class="des-btn-block">
                    <?php if($auth && $subscribed ==1): ?>
                      <?php if(isset($item->episodes[0])): ?>
                        <?php if($item->tvseries['age_req'] == 'all age' || $age>=str_replace('+', '', $item->tvseries['age_req']) ): ?>
                          <?php if($item->episodes[0]->video_link['iframeurl'] !=""): ?>

                            <a href="#" onclick="playoniframe('<?php echo e($item->episodes[0]->video_link['iframeurl']); ?>','<?php echo e($item->tvseries['id']); ?>','tv')" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                           </a>

                          <?php else: ?>
                            <a href="<?php echo e(route('watchTvShow',$item->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                          <?php endif; ?>
                        <?php else: ?>

                          <a onclick="myage(<?php echo e($age); ?>)" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                         </a>
                        <?php endif; ?>
                      <?php endif; ?>
                      <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                        <a href="<?php echo e(route('watchtvTrailer',$item->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                      <?php endif; ?>
                    <?php else: ?>
                       <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                        <a href="<?php echo e(route('guestwatchtvtrailer',$item->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                      <?php endif; ?>
                    <?php endif; ?>
                    
                  </div>
                </div>
                <?php endif; ?>
              </div>
              <?php endif; ?>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        <?php endif; ?>
      
        
        <?php if(isset($movies)): ?>
          <div class="watchlist-main-block">
            <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php if($movie->type=="M"): ?>
             <?php if($movie->status == 1): ?>
              <div class="watchlist-block">
                <div class="watchlist-img-block protip" data-pt-placement="outside" data-pt-title="#prime-description-block<?php echo e($movie->id); ?>">
                  <?php if($auth && $subscribed == 1): ?>
                  <a href="<?php echo e(url('movie/detail',$movie->slug)); ?>">
                    <?php if($movie->thumbnail != null || $movie->thumbnail != ''): ?>
                      <img data-src="<?php echo e(url('images/movies/thumbnails/'.$movie->thumbnail)); ?>" class="img-responsive lazy watchlist-img" alt="genre-image">
                    <?php else: ?>
                      <img data-src="<?php echo e(url('images/default-thumbnail.jpg')); ?>" class="img-responsive lazy watchlist-img" alt="genre-image">
                    <?php endif; ?>
                  </a>
                  <?php else: ?>
                    <a href="<?php echo e(url('movie/guest/detail',$movie->slug)); ?>">
                    <?php if($movie->thumbnail != null || $movie->thumbnail != ''): ?>
                      <img data-src="<?php echo e(url('images/movies/thumbnails/'.$movie->thumbnail)); ?>" class="img-responsive lazy watchlist-img" alt="genre-image">
                    <?php else: ?>
                      <img data-src="<?php echo e(url('images/default-thumbnail.jpg')); ?>" class="img-responsive lazy watchlist-img" alt="genre-image">
                    <?php endif; ?>
                  </a>
                  <?php endif; ?>
                </div>
                <?php echo Form::open(['method' => 'DELETE', 'action' => ['WishListController@moviedestroy', $movie->id]]); ?>

                    
                    <button type="submit" class="watchhistory_remove"><i class="fa fa-close" aria-hidden="true"></i></button><br/>
                <?php echo Form::close(); ?>

                <?php if(isset($protip) && $protip == 1): ?>
                <div id="prime-description-block<?php echo e($movie->id); ?>" class="prime-description-block">
                  <div class="prime-description-under-block">
                    <h5 class="description-heading"><?php echo e($movie->title); ?></h5>
                    <div class="movie-rating"><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($movie->rating); ?></div>
                    <ul class="description-list">
                      <li><?php echo e($movie->duration); ?> <?php echo e(__('staticwords.mins')); ?></li>
                      <li><?php echo e($movie->publish_year); ?></li>
                      <li><?php echo e($movie->maturity_rating); ?></li>
                      <?php if($movie->subtitle == 1): ?>
                        <li>
                         <?php echo e(__('staticwords.subtitles')); ?>

                        </li>
                      <?php endif; ?>
                    </ul>
                    <div class="main-des">
                      <p><?php echo e($movie->detail); ?></p>
                      <a href="#"></a>
                    </div>
                    <div class="des-btn-block">
                      <?php if($auth && $subscribed ==1): ?>
                        <?php if($movie->maturity_rating == 'all age' || $age>=str_replace('+', '', $movie->maturity_rating)): ?>
                          <?php if($movie->video_link['iframeurl'] != null): ?>
                            <a href="<?php echo e(route('watchmovieiframe',$item->id)); ?>"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                            </a>

                          <?php else: ?> 
                            <a href="<?php echo e(route('watchmovie',$movie->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                          <?php endif; ?>
                        <?php else: ?>
                          <a onclick="myage(<?php echo e($age); ?>)" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                          </a>
                        <?php endif; ?>
                        <?php if($movie->trailer_url != null || $movie->trailer_url != ''): ?>
                          <a href="<?php echo e(route('watchTrailer',$movie->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                        <?php endif; ?>
                      <?php else: ?>
                        <?php if($movie->trailer_url != null || $movie->trailer_url != ''): ?>
                          <a href="<?php echo e(route('guestwatchtrailer',$movie->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                        <?php endif; ?>
                      <?php endif; ?>
                     
                      
                    </div>
                  </div>
                </div>
                <?php endif; ?>
              </div>
              <?php endif; ?>
               <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        <?php endif; ?>
        
      </div>
      
    </div>
      <!-- google adsense code -->
        <div class="container-fluid">
         <?php
          if (isset($ad)) {
           if ($ad->iswishlist==1 && $ad->status==1) {
              $code=  $ad->code;
              echo html_entity_decode($code);
           }
          }
?>
      </div>
  </section>


  <!--End-->
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>


  

    <script>

      function playoniframe(url,id,type){
          
 
   $(document).ready(function(){
    var SITEURL = '<?php echo e(URL::to('')); ?>';
       $.ajax({
            type: "get",
            url: SITEURL + "/user/watchhistory/"+id+'/'+type,
            success: function (data) {
             console.log(data);
            },
            error: function (data) {
               console.log(data)
            }
        });
       
   
         
  
  });       
        $.colorbox({ href: url, width: '100%', height: '100%', iframe: true });
      }
      
    </script>
   <script>

      function myage(age){
        if (age==0) {
        $('#ageModal').modal('show'); 
      }else{
          $('#ageWarningModal').modal('show');
      }
    }
      
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/watchlists.blade.php ENDPATH**/ ?>
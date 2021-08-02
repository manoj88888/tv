


<?php $__env->startSection('custom-meta'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title',"$liveevent->title"); ?>


<?php $__env->startSection('main-wrapper'); ?>
<!-- main wrapper -->
<section class="main-wrapper main-wrapper-single-movie-prime">
  <div class="background-main-poster-overlay">

    <!-- Modal -->


    <?php if(isset($liveevent)): ?>
      <?php if($liveevent->poster != null): ?>
        <div class="background-main-poster col-md-offset-4 col-md-6" style="background-image: url('<?php echo e(asset('images/event/posters/'.$liveevent->poster)); ?>');">
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
      <?php if(isset($liveevent)): ?>
     
        <div class="row" style="min-height:400px;">
          <div class="col-md-8 small-screen-block">
            <div class="full-movie-dtl-block">
              <h2 class="section-heading"><?php echo e($liveevent->title); ?></h2></br>
              <div class="">
                <ul class="casting-headers">
                   <li><?php echo e(__('staticwords.StartTime')); ?> -
                      <span class="events-count">
                        <?php if(isset($liveevent->start_time)): ?>
                        <?php echo e(date('M jS Y | h:i:s a',strtotime($liveevent->start_time))); ?> 

                      <?php else: ?>
                        -
                      <?php endif; ?>
                      </span>
                    </li><br/>
                    <li><?php echo e(__('staticwords.EndTime')); ?> -
                      <span class="events-count">
                        <?php if(isset($liveevent->end_time)): ?>
                        <?php echo e(date('M jS Y | h:i:s a',strtotime($liveevent->end_time))); ?> 

                      <?php else: ?>
                        -
                      <?php endif; ?>
                      </span>
                    </li></br>
                    <li><?php echo e(__('staticwords.organizedby')); ?> -
                      <span class="events-count">
                        <?php if(isset($liveevent->organized_by)): ?>
                        <?php echo e($liveevent->organized_by); ?> 

                      <?php else: ?>
                        -
                      <?php endif; ?>
                      </span>
                    </li>
                
                </ul>

                  <div id="wishlistelement" class="screen-play-btn-block">
                    <?php
                    date_default_timezone_set('Asia/Calcutta');
                    $today_date = date('d jS Y | h:i:s');
                    //$today_time = date('g:i:sa');

                    //dd($today_date);
                     $start_date = date('d jS Y | h:i a',strtotime($liveevent->start_time));

                     $end_date = date('d jS Y | h:i a',strtotime($liveevent->end_time));
                    
                    ?>
                  <?php if($today_date >= $start_date && $today_date <= $end_date): ?>

                    <?php if($liveevent->video_link['iframeurl'] != null): ?>
                      <?php if(Auth::check() && Auth::user()->is_admin == '1'): ?>
                        <a onclick="playoniframe('<?php echo e($liveevent['iframeurl']); ?>','<?php echo e($liveevent->id); ?>','event')" class="btn btn-play play-btn-icon<?php echo e($liveevent['id']); ?>"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                         </a>
                      <?php else: ?>

                         <a onclick="playoniframe('<?php echo e($liveevent['iframeurl']); ?>','<?php echo e($liveevent->id); ?>','event')" class="btn btn-play play-btn-icon<?php echo e($liveevent['id']); ?>"><span class="play-btn-icon "><i class="fa fa-play"></i></span><span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                          </a>
                      <?php endif; ?>

                    <?php else: ?>
                      <?php if(Auth::check() && Auth::user()->is_admin == '1'): ?>
                        <a  href="<?php echo e(route('watchevent',$liveevent->id)); ?>" class="iframe btn btn-play play-btn-icon<?php echo e($liveevent['id']); ?>"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                          </a>
                      <?php else: ?>
                        <a href="<?php echo e(url('/watch/event/'.$liveevent->id)); ?>" class="iframe btn btn-play play-btn-icon<?php echo e($liveevent['id']); ?>"><span class="play-btn-icon "><i class="fa fa-play" ><span class="play-text"> <?php echo e(__('staticwords.playnow')); ?></span></a>
                      <?php endif; ?>
                    <?php endif; ?>
                  
                  <?php endif; ?>
                          
                  </div>
              </div>
               
              <p class="text-justify">
                <?php echo e($liveevent->detail); ?>

              </p>
            </div>
          </div>
          <div class="col-md-4 small-screen-block">
            <div class="poster-thumbnail-block">
                <?php if($liveevent->thumbnail != null || $liveevent->thumbnail != ''): ?>
                <img src="<?php echo e(asset('images/events/thumbnails/'.$liveevent->thumbnail)); ?>" class="img-responsive" alt="genre-image">
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
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/event_detail.blade.php ENDPATH**/ ?>
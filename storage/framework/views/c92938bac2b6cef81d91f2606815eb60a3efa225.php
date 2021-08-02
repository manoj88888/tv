<link href="<?php echo e(url('css/owl.carousel.min.css')); ?>" rel="stylesheet" type="text/css"/> <!-- owl carousel css -->
  <link href="<?php echo e(url('css/owl.theme.default.min.css')); ?>" rel="stylesheet" type="text/css"/> <!-- owl carousel css -->
<?php echo $__env->make('lang2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              
      <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      
                    
                <?php
                    $moviegenreitems = NULL;
                    $moviegenreitems = array();

                    foreach ($menu_data as $key => $item) {
                       
                        $gmovie =  \DB::table('movies')
                                 ->select('movies.id as id','movies.title as title','movies.type as type','movies.status as status','movies.genre_id as genre_id','movies.thumbnail as thumbnail','movies.slug as slug')
                                 ->where('movies.genre_id', 'LIKE', '%' . $genre->id . '%')->where('movies.id',$item->movie_id)->first();

                       
                        if(isset($gmovie)){
                          
                           $moviegenreitems[] = $gmovie;
                                  
                        }

                         if($section->order == 1){
                            arsort($moviegenreitems);
                          }

                        if(count($moviegenreitems) == $section->item_limit){
                            break;
                            exit(1);
                        }


                    }

                    $moviegenreitems = array_values(array_filter($moviegenreitems));

                   

                      foreach ($menu_data as $key => $item) {

                           $gtvs =  \DB::table('tv_series')
                                  ->join('seasons','seasons.tv_series_id','=','tv_series.id')
                                  ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.title as title','tv_series.thumbnail as thumbnail','seasons.season_slug as season_slug')->where('tv_series.genre_id', 'LIKE', '%' . $genre->id . '%')
                                  ->where('tv_series.id',$item->tv_series_id)->first();
                                  
                         
                          
                          if(isset($gtvs)){
                            
                             array_push($moviegenreitems, $gtvs);
                                   
                          }
                            
                          if($section->order == 1){
                            arsort($moviegenreitems);
                          }

                          if(count($moviegenreitems) == $section->item_limit*2){
                              break;
                              exit(1);
                          }

                      }
                    
                    $moviegenreitems = array_values(array_filter($moviegenreitems));

                    
                ?>
                <?php if($moviegenreitems != NULL && count($moviegenreitems)>0): ?>
                  <div class="genre-main-block">
                  <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                          <div class="genre-dtl-block">
                         <h5 class="section-heading"><?php echo e($genre->name); ?> in <?php echo e($menu->name); ?></h5>
                         <p class="section-dtl"><?php echo e(__('staticwords.atthebigscreenathome')); ?></p>
                          
                          <?php if($auth && $subscribed==1): ?>
                          
                            <a href="<?php echo e(route('show.in.genre',$genre->id)); ?>" class="see-more"> <b><?php echo e(__('staticwords.viewall')); ?></b></a>
                         
                          <?php else: ?>
                          
                            <a href="<?php echo e(route('show.in.guest.genre',$genre->id)); ?>" class="see-more"> <b><?php echo e(__('staticwords.viewall')); ?></b></a>
                           
                          <?php endif; ?>
                       
                      </div>
                    </div>
                     <?php if($section->view == 1): ?>
                      <!-- List view movies in genre -->
                        <div class="col-md-9">
                          <div class="genre-main-slider owl-carousel">
                            <?php $__currentLoopData = $moviegenreitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          
                           <!-- List view genre movies and tv shows -->
                               
                                   <?php if($item->status == 1): ?>
                                      <?php if($item->type == 'M'): ?>
                                       <?php
                                             $image = 'images/movies/thumbnails/'.$item->thumbnail;
                                            // Read image path, convert to base64 encoding
                                            
                                            $imageData = base64_encode(@file_get_contents($image));
                                            if($imageData){
                                            // Format the image SRC:  data:{mime};base64,{data};
                                            $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                            }else{
                                                $src = url('images/default-thumbnail.jpg');
                                            }
                                        ?>
                                          <div class="genre-slide ">
                                            <div class="genre-slide-image genre-image">
                                              <?php if($auth && $subscribed==1): ?>
                                              <a href="<?php echo e(url('movie/detail',$item->slug)); ?>">
                                                <?php if($src): ?>
                                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                                <?php else: ?>
                                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                                <?php endif; ?>
                                              </a>
                                              <?php else: ?>
                                                <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>">
                                                <?php if($src): ?>
                                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                                <?php else: ?>
                                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                                <?php endif; ?>
                                              </a>
                                              <?php endif; ?>
                                            </div>
                                            <div class="genre-slide-dtl">
                                              <h5 class="genre-dtl-heading">
                                              <?php if($auth && $subscribed==1): ?>
                                              <a href="<?php echo e(url('movie/detail/'.$item->slug)); ?>"><?php echo e($item->title); ?></a>
                                              <?php else: ?>
                                              <a href="<?php echo e(url('movie/guest/detail/'.$item->slug)); ?>"><?php echo e($item->title); ?></a>
                                                <?php endif; ?>
                                              </h5>
                                            </div>
                                          </div>
                                      <?php endif; ?>

                                      <?php if($item->type == 'T'): ?>
                                        <?php
                                             $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                            // Read image path, convert to base64 encoding
                                            
                                            $imageData = base64_encode(@file_get_contents($image));
                                            if($imageData){
                                            // Format the image SRC:  data:{mime};base64,{data};
                                            $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                            }else{
                                                $src = url('images/default-thumbnail.jpg');
                                            }
                                        ?>
                                       <div class="genre-slide">
                                          <div class="genre-slide-image genre-image">
                                              <?php if($auth && $subscribed==1): ?>
                                              <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/detail',$item->season_slug)); ?>" <?php endif; ?>>
                                                <?php if($item->thumbnail != null): ?>
                                                  
                                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                                
                                                <?php else: ?>
                                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                                <?php endif; ?>
                                              </a>
                                              <?php else: ?>
                                               <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/guest/detail',$item->season_slug)); ?>" <?php endif; ?>>
                                                <?php if($item->thumbnail != null): ?>
                                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                              
                                                <?php else: ?>
                                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                                <?php endif; ?>
                                              </a>
                                              <?php endif; ?> 
                                          </div>
                                          
                                          <div class="genre-slide-dtl">
                                             <?php if($auth && $subscribed==1): ?>
                                              <h5 class="genre-dtl-heading"><a href="<?php echo e(url('show/detail/'.$item->season_slug)); ?>"><?php echo e($item->title); ?></a></h5>
                                              <?php else: ?>
                                               <h5 class="genre-dtl-heading"><a href="<?php echo e(url('show/guest/detail/'.$item->season_slug)); ?>"><?php echo e($item->title); ?></a></h5>
                                              <?php endif; ?>
                                          </div>  
                                       </div>
                                      <?php endif; ?>
                                   <?php endif; ?>
                              
                              <!-- end -->

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </div>
                        </div>
                     <!-- List view movies in genre END -->
                     <?php endif; ?>
                     

                
                      <?php if($section->view == 0): ?>

                      <!-- Grid view genre movies -->
                          <div class="col-md-9">
                              <div class="cus_img">
                                
                                  <?php $__currentLoopData = $moviegenreitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <?php
                                       

                                       if(isset($auth)){
                                          if ($item->type == 'M') {
                                            $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                              ['user_id', '=', $auth->id],
                                                                                              ['movie_id', '=', $item->id],
                                                                                            ])->first();
                                          }
                                        }

                         

                                        $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                                        if (isset($gets1)) {


                                          $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                      ['user_id', '=', $auth->id],
                                                                                      ['season_id', '=', $gets1->id],
                                            ])->first();


                                          }

                            
                  
                                         
                                      ?>
                                      <?php if($item->status == 1): ?>
                                        <?php if($item->type == 'M'): ?>
                                        
                                          <?php
                                             $image = 'images/movies/thumbnails/'.$item->thumbnail;
                                            // Read image path, convert to base64 encoding
                                            
                                            $imageData = base64_encode(@file_get_contents($image));
                                            if($imageData){
                                            // Format the image SRC:  data:{mime};base64,{data};
                                            $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                            }else{
                                                $src = url('images/default-thumbnail.jpg');
                                            }
                                          ?>
                                          
                                          <div class="col-lg-4 col-md-9 col-xs-6 col-sm-6">
                                              <div class="genre-slide-image genre-grid">
                                                  <?php if($auth && $subscribed==1): ?>
                                                    <a href="<?php echo e(url('movie/detail',$item->slug)); ?>">
                                                    <?php if($src): ?>
                                                      <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                                    <?php else: ?>
                                                      <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                                    <?php endif; ?>
                                                   </a>
                                                  <?php else: ?>
                                                     <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>">
                                                      <?php if($src): ?>
                                                        <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                                      <?php else: ?>
                                                        <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                                      <?php endif; ?>
                                                    </a>

                                                    <?php endif; ?>
                                              
                                               </div>
                                                <div class="genre-slide-dtl">
                                                  <h5 class="genre-dtl-heading">
                                                     <?php if($auth && $subscribed==1): ?>
                                                    <a href="<?php echo e(url('movie/detail/'.$item->slug)); ?>"><?php echo e($item->title); ?></a>
                                                    <?php else: ?>
                                                    <a href="<?php echo e(url('movie/guest/detail/'.$item->slug)); ?>"><?php echo e($item->title); ?></a>

                                                    <?php endif; ?>
                                                  </h5>
                                                </div>
                                          </div>
                                        <?php endif; ?>

                                        <?php if($item->type == 'T'): ?>
                                            <?php
                                               $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                              // Read image path, convert to base64 encoding
                                              
                                              $imageData = base64_encode(@file_get_contents($image));
                                              if($imageData){
                                              // Format the image SRC:  data:{mime};base64,{data};
                                              $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                              }else{
                                                  $src = url('images/default-thumbnail.jpg');
                                              }
                                            ?>
                                          <div class="col-lg-4 col-md-9 col-xs-6 col-sm-6">
                                            <div class="genre-slide-image genre-grid">
                                               <?php if($auth && $subscribed==1): ?>
                                                <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/detail',$item->season_slug)); ?>" <?php endif; ?>>
                                                  <?php if($src): ?>
                                                    
                                                    <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                                  
                                                  <?php else: ?>
                                                    <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                                  <?php endif; ?>
                                                </a>
                                                <?php else: ?>
                                                 <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/guest/detail',$item->season_slug)); ?>" <?php endif; ?>>
                                                  <?php if($src): ?>
                                                    <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                                  
                                                  <?php else: ?>
                                                    <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                                  <?php endif; ?>
                                                </a>
                                                <?php endif; ?>
                                           
                                            </div>
                                            <div class="genre-slide-dtl">
                                                <?php if($auth && $subscribed==1): ?>
                                                <h5 class="genre-dtl-heading"><a href="<?php echo e(url('show/detail/'.$item->season_slug)); ?>"><?php echo e($item->title); ?></a></h5>
                                                <?php else: ?>
                                                 <h5 class="genre-dtl-heading"><a href="<?php echo e(url('show/guest/detail/'.$item->season_slug)); ?>"><?php echo e($item->title); ?></a></h5>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                      <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                  
                               </div>
                          </div>
                     
                    <!--end grid view for genre-->
                    <?php endif; ?>

                 
                           </div>
                  </div>    
                </div>
                <br/>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                   
 <?php $__env->startSection('custom-script'); ?>
  <script type="text/javascript">


    var app = new Vue({
      el: '.des-btn-block',
      data: {
        result: {
          id: '',
          type: '',
        },
      },
      methods: {
        addToWishList(id, type) {
          this.result.id = id;
          this.result.type = type;
          this.$http.post('<?php echo e(route('addtowishlist')); ?>', this.result).then((response) => {
          }).catch((e) => {
            console.log(e);
          });
          this.result.item_id = '';
          this.result.item_type = '';
        }
      }
    });

    function addWish(id, type) {
      app.addToWishList(id, type);
      setTimeout(function() {
        $('.addwishlistbtn'+id+type).text(function(i, text){
          return text == "<?php echo e(__('staticwords.addtowatchlist')); ?>" ? "<?php echo e(__('staticwords.removefromwatchlist')); ?>" : "<?php echo e(__('staticwords.addtowatchlist')); ?>";
        });
      }, 100);
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
                   


<script type="text/javascript" src="<?php echo e(url('js/jquery.popover.js')); ?>"></script> <!-- bootstrap popover js -->
<script type="text/javascript" src="<?php echo e(url('js/menumaker.js')); ?>"></script> <!-- menumaker js -->
<script type="text/javascript" src="<?php echo e(url('js/jquery.curtail.min.js')); ?>"></script> <!-- menumaker js -->
<script type="text/javascript" src="<?php echo e(url('js/owl.carousel.min.js')); ?>"></script> <!-- owl carousel js -->
<script type="text/javascript" src="<?php echo e(url('js/slider.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('js/jquery.scrollSpeed.js')); ?>"></script> <!-- owl carousel js -->
<script type="text/javascript" src="<?php echo e(url('js/TweenMax.min.js')); ?>"></script> <!-- animation gsap js -->
<script type="text/javascript" src="<?php echo e(url('js/ScrollMagic.min.js')); ?>"></script> <!-- custom js -->
<script type="text/javascript" src="<?php echo e(url('js/animation.gsap.min.js')); ?>"></script> <!-- animation gsap js -->
<script type="text/javascript" src="<?php echo e(url('js/modernizr-custom.js')); ?>"></script> <!-- debug addIndicators js -->
<script type="text/javascript" src="<?php echo e(url('js/theme.js')); ?>"></script> <!-- custom js -->
<script type="text/javascript" src="<?php echo e(url('js/custom-js.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('js/colorbox.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('js/checkit.js')); ?>"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
<?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/data2.blade.php ENDPATH**/ ?>
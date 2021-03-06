
<?php $__env->startSection('title',__('adminstaticwords.CreateAppSlider')); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="<?php echo e(url('admin/appslider')); ?>" data-toggle="tooltip" data-original-title="Go back" class="btn-floating"><i class="material-icons">reply</i></a> <?php echo e(__('adminstaticwords.CreateAppSlider')); ?></h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <?php echo Form::open(['method' => 'POST', 'action' => 'AppSliderController@store', 'files' => true]); ?>

            <div class="bootstrap-checkbox slide-option-switch form-group<?php echo e($errors->has('prime_main_slider') ? ' has-error' : ''); ?>">
              <div class="row">
                <div class="col-md-7">
                  <h5 class="bootstrap-switch-label"><?php echo e(__('adminstaticwords.AppSlideFor')); ?></h5>
                </div>
                <div class="col-md-5 pad-0">
                  <div class="make-switch">
                    <?php echo Form::checkbox('', 1, 1, ['class' => 'bootswitch', 'id' => 'TheCheckBox', "data-on-text"=>"Movies", "data-off-text"=>"Tv Series", "data-size"=>"small"]); ?>

                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <small class="text-danger"><?php echo e($errors->first('prime_main_slider')); ?></small>
              </div>
            </div>
          
            <div id="movie_id_block" class="form-group<?php echo e($errors->has('movie_id') ? ' has-error' : ''); ?>">
              <?php echo Form::label('movie_id', __('adminstaticwords.SelectAppSlideForMovie')); ?>

              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseSelectAppSlideForMovie')); ?>"></i>
              <?php echo Form::select('movie_id', $movie_list, null, ['class' => 'form-control select2', 'placeholder' => '']); ?>

              <small class="text-danger"><?php echo e($errors->first('movie_id')); ?></small>
            </div>
            <div id="tv_series_id_block" class="form-group<?php echo e($errors->has('tv_series_id') ? ' has-error' : ''); ?>">
              <?php echo Form::label('tv_series_id', __('adminstaticwords.SelectAppSlideForTvShow')); ?>

              <?php echo Form::select('tv_series_id', $tv_series_list, null, ['class' => 'form-control select2', 'placeholder' => '']); ?>

              <small class="text-danger"><?php echo e($errors->first('tv_series_id')); ?></small>
            </div>
          
            <div class="form-group<?php echo e($errors->has('slide_image') ? ' has-error' : ''); ?> input-file-block" id="slider_image" >
              <?php echo Form::label('slide_image', __('adminstaticwords.AppSlideImage')); ?>

              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.UploadAppSlideImage')); ?>"></i>
              <?php echo Form::file('slide_image', ['class' => 'input-file', 'id'=>'slide_image']); ?>

              <label for="slide_image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.UploadAppSlideImage')); ?>">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName"><?php echo e(__('adminstaticwords.ChooseAFile')); ?></span>
              </label>
              <p class="info"><?php echo e(__('adminstaticwords.ChooseAppSlideImage')); ?></p>
              <small class="text-danger"><?php echo e($errors->first('slide_image')); ?></small>
            </div>

            

            <div class="form-group<?php echo e($errors->has('active') ? ' has-error' : ''); ?>">
              <div class="row">
                <div class="col-xs-3">
                  <?php echo Form::label('active', __('adminstaticwords.Active')); ?>

                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">
                    <?php echo Form::checkbox('active', 1, 1, ['class' => 'checkbox-switch']); ?>

                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger"><?php echo e($errors->first('series')); ?></small>
              </div>
            </div>
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> <?php echo e(__('adminstaticwords.Reset')); ?></button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i><?php echo e(__('adminstaticwords.Create')); ?></button>
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
    $(document).ready(function(){

      $('#tv_series_id_block').hide();

      $('#TheCheckBox').on('switchChange.bootstrapSwitch', function (event, state) {

          if (state == true) {

            $('#tv_series_id_block').hide();
            $('#movie_id_block').show();

          } else if (state == false) {

            $('#tv_series_id_block').show();
            $('#movie_id_block').hide(); 

          };

      });

     
      
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/appslider/create.blade.php ENDPATH**/ ?>

<?php $__env->startSection('title',__('adminstaticwords.SplashScreen')); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><?php echo e(__('adminstaticwords.SplashScreen')); ?></h4>
    <div class="row">
      <div class="col-md-12">
        <div class="admin-form-block z-depth-1">
          <?php echo Form::model($splashscreen, ['method' => 'POST', 'action' => 'SplashScreenController@store', 'files' => true]); ?>

            <div class="row">
              <div class="col-md-6">
                 <div class="col-xs-4">
                  <?php echo Form::label('logo_enable', __('adminstaticwords.LogoEnable:')); ?>

                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">                
                    <?php echo Form::checkbox('logo_enable', 1, $splashscreen->logo_enable, ['class' => 'checkbox-switch', 'id'=>'logo_enable']); ?>

                    <span class="slider round"></span>
                  </label>
                </div>
                <div class="col-xs-12">
                  <small class="text-danger"><?php echo e($errors->first('logo_enable')); ?></small>
                </div>
              </div>
              
               
               <div class="col-md-6 " id="logobox" style="<?php echo e($splashscreen->logo != '' ? ""  : "display:none"); ?>">
                  <div class="logobox form-group<?php echo e($errors->has('logo') ? ' has-error' : ''); ?> input-file-block">
                   <?php echo Form::label('logo',__('adminstaticwords.Logo'),['class'=>"col-xs-3"]); ?>

                    <?php echo Form::file('logo', ['class' => 'input-file col-xs-9', 'id'=>'logo']); ?>

                    <label for="logo" class="btn btn-danger  col-xs-9 js-labelFile" data-toggle="tooltip" data-original-title="logo">
                      <i class="icon fa fa-check"></i>
                      <span class="js-fileName"><?php echo e(__('adminstaticwords.ChooseALogo')); ?></span>
                    </label>
                    <small class="text-danger"><?php echo e($errors->first('logo')); ?></small>
                  </div>
                </div>
           
            </div>
            <div class="row">
              <div class="col-md-6 form-group">
                    <?php if($auth_customize->image != null): ?>
                      <img src="<?php echo e(asset('images/splashscreen/'.$splashscreen->image)); ?>" class="img-responsive">
                    <?php else: ?>
                      <div class="image-block"></div>                    
                    <?php endif; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group<?php echo e($errors->has('image') ? ' has-error' : ''); ?> input-file-block">
                    <?php echo Form::label('image', __('adminstaticwords.SelectAImage')); ?>  <p class="inline info"></p>
                    <?php echo Form::file('image', ['class' => 'input-file', 'id'=>'image']); ?>

                    <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.ProjectImage')); ?>">
                      <i class="icon fa fa-check"></i>
                      <span class="js-fileName"><?php echo e(__('adminstaticwords.ChooseAFile')); ?></span>
                    </label>
                    <p class="info"><?php echo e(__('adminstaticwords.ChooseAImage')); ?></p>
                    <small class="text-danger"><?php echo e($errors->first('image')); ?></small>
                </div>
              </div>
               
            </div>
            <div class="">
                <button type="submit" class="btn btn-success btn-block"><?php echo e(__('adminstaticwords.Save')); ?></button>
            </div>
            <div class="clear-both"></div>
            <?php echo Form::close(); ?>

          </div>
        </div>
        
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
<script>
$('#logo_enable').on('change',function(){
  if($('#logo_enable').is(':checked')){
    //show
    $('#logobox').show();
  }else{
    //hide
     $('#logobox').hide();
  }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/splashscreen/index.blade.php ENDPATH**/ ?>
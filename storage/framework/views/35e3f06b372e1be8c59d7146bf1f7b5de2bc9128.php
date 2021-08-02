
<?php $__env->startSection('title',__('adminstaticwords.SigninAndSignUpCustomization')); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><?php echo e(__('adminstaticwords.SigninAndSignUpCustomization')); ?></h4>
    <div class="row">
      <div class="col-md-12">
        <div class="admin-form-block z-depth-1">
          <?php echo Form::model($auth_customize, ['method' => 'POST', 'action' => 'AuthCustomizeController@store', 'files' => true]); ?>

            <div class="form-group<?php echo e($errors->has('detail') ? ' has-error' : ''); ?>">
              <?php echo Form::label('detail',__('adminstaticwords.HeadingText')); ?>

              <?php echo Form::textarea('detail', null, ['id' => 'editor1', 'class' => 'form-control']); ?>

              <small class="text-danger"><?php echo e($errors->first('detail')); ?></small>
            </div>
            <div class="row">
              <div class="col-md-6 form-group">
                <?php if($auth_customize->image != null): ?>
                  <img src="<?php echo e(asset('images/login/'.$auth_customize->image)); ?>" class="img-responsive">
                <?php else: ?>
                  <div class="image-block"></div>                    
                <?php endif; ?>
              </div>
            </div>
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
            <div class="">
              <button type="submit" class="btn btn-success btn-block"><?php echo e(__('adminstaticwords.Save')); ?></button>
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
    $(function () {
      CKEDITOR.replace('editor1');
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/auth_customize/index.blade.php ENDPATH**/ ?>
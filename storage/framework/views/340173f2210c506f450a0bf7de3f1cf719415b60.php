
<?php $__env->startSection('title',__('adminstaticwords.CreateFAQ')); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="<?php echo e(url('admin/faqs')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.GoBack')); ?>" class="btn-floating"><i class="material-icons">reply</i></a> <?php echo e(__('adminstaticwords.CreateFaq')); ?></h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <?php echo Form::open(['method' => 'POST', 'action' => 'FaqController@store']); ?>

            <div class="form-group<?php echo e($errors->has('question') ? ' has-error' : ''); ?>">
                <?php echo Form::label('question', __('adminstaticwords.FaqQuestion')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterYourFaqQuestion')); ?>"></i>
                <?php echo Form::text('question', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('adminstaticwords.PleaseEnterYourFaqQuestion')]); ?>

                <small class="text-danger"><?php echo e($errors->first('question')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('answer') ? ' has-error' : ''); ?>">
                <?php echo Form::label('answer', __('adminstaticwords.FaqAnswer')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterYourFaqAnswer')); ?>"></i>
                <?php echo Form::textarea('answer', null, ['class' => 'form-control materialize-textarea', 'rows' => '5', 'placeholder' => __('adminstaticwords.PleaseEnterYourFaqAnswer')]); ?>

                <small class="text-danger"><?php echo e($errors->first('answer')); ?></small>
            </div>
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> <?php echo e(__('adminstaticwords.Reset')); ?></button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> <?php echo e(__('adminstaticwords.Create')); ?></button>
            </div>
            <div class="clear-both"></div>
          <?php echo Form::close(); ?>

        </div>  
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/faq/create.blade.php ENDPATH**/ ?>
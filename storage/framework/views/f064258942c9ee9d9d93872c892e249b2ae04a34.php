
<?php $__env->startSection('title',__('adminstaticwords.EditFAQ')); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="<?php echo e(url('admin/faqs')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.GoBack')); ?>" class="btn-floating"><i class="material-icons">reply</i></a> <?php echo e(__('adminstaticwords.EditFaq')); ?></h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <?php echo Form::model($faq, ['method' => 'PATCH', 'action' => ['FaqController@update', $faq->id]]); ?>

            <div class="form-group<?php echo e($errors->has('question') ? ' has-error' : ''); ?>">
                <?php echo Form::label('question', __('adminstaticwords.FaqQuestion')); ?>

                <p class="inline info"> - <?php echo e(__('adminstaticwords.PleaseEnterYourFaqQuestion')); ?></p>
                <?php echo Form::text('question', null, ['class' => 'form-control', 'required' => 'required']); ?>

                <small class="text-danger"><?php echo e($errors->first('question')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('answer') ? ' has-error' : ''); ?>">
                <?php echo Form::label('answer', __('adminstaticwords.FaqAnswer')); ?>

                <p class="inline info"> - <?php echo e(__('adminstaticwords.PleaseEnterYourFaqAnswer')); ?></p>
                <?php echo Form::textarea('answer', null, ['class' => 'form-control materialize-textarea', 'rows' => '5']); ?>

                <small class="text-danger"><?php echo e($errors->first('answer')); ?></small>
            </div>
            <div class="btn-group pull-right">
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> <?php echo e(__('adminstaticwords.Update')); ?></button>
            </div>
            <div class="clear-both"></div>
          <?php echo Form::close(); ?>

        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', [
  'page_header' => 'Edit Faq'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/faq/edit.blade.php ENDPATH**/ ?>
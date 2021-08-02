
<?php $__env->startSection('title',__('adminstaticwords.RefundPolicy')); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><?php echo e(__('adminstaticwords.RefundPolicyText')); ?></h4>
    <?php if($config): ?>
      <div class="admin-form-block z-depth-1">
        <?php echo Form::model($config, ['method' => 'PATCH', 'route' => 'refund_pol']); ?>

        <div class="form-group<?php echo e($errors->has('refund_pol') ? ' has-error' : ''); ?>">
          <?php echo Form::label('refund_pol', __('adminstaticwords.RefundPolicyText')); ?>

          <?php echo Form::textarea('refund_pol', null, ['id' => 'editor1', 'class' => 'form-control']); ?>

          <small class="text-danger"><?php echo e($errors->first('refund_pol')); ?></small>
        </div>
        <div class="btn-group pull-right">
          <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> <?php echo e(__('adminstaticwords.Save')); ?></button>
        </div>
        <div class="clear-both"></div>
        <?php echo Form::close(); ?>

      </div>
    <?php endif; ?>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
  <script>
    $(function () {
      CKEDITOR.replace('editor1');
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/refund_pol.blade.php ENDPATH**/ ?>
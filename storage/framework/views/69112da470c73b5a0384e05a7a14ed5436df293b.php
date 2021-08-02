
<?php $__env->startSection('title',__('adminstaticwords.Copyright')); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><?php echo e(__('adminstaticwords.CopyrightText')); ?></h4>
    <?php if($config): ?>
      <?php echo Form::model($config, ['method' => 'PATCH', 'route' => 'copyright']); ?>

        <div class="form-group<?php echo e($errors->has('copyright') ? ' has-error' : ''); ?>">
          <?php echo Form::label('copyright', __('adminstaticwords.CopyrightText')); ?>

          <?php echo Form::textarea('copyright', null, ['id' => 'editor1', 'class' => 'form-control']); ?>

          <small class="text-danger"><?php echo e($errors->first('copyright')); ?></small>
        </div>
        <div class="btn-group pull-right">
          <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> <?php echo e(__('adminstaticwords.Save')); ?></button>
        </div>
        <div class="clear-both"></div>
      <?php echo Form::close(); ?>

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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/copyright.blade.php ENDPATH**/ ?>
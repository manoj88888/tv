
<?php $__env->startSection('title',__('adminstaticwords.CustomStyleSettings')); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><?php echo e(__('adminstaticwords.CustomStyleSettings')); ?></h4>
    <div class="form-group<?php echo e($errors->has('css') ? ' has-error' : ''); ?>">
    <form action="<?php echo e(route('css.store')); ?>" method="POST">
      <?php echo e(csrf_field()); ?>

    <label for="css"><?php echo e(__('adminstaticwords.CustomCSS:')); ?></label>
    <small class="text-danger"><?php echo e($errors->first('css','CSS Cannot be blank !')); ?></small>
    <textarea placeholder="a {
      color:red;
    }" id="he" class="form-control" name="css" rows="10" cols="30"><?php echo e($css); ?></textarea>

    <input type="submit" value="<?php echo e(__('adminstaticwords.ADDCss')); ?>" class="btn btn-md btn-primary">
    </form>
    </div>
    <br>
    <div class="form-group<?php echo e($errors->has('js') ? ' has-error' : ''); ?>">
    <form action="<?php echo e(route('js.store')); ?>" method="POST">
      <?php echo e(csrf_field()); ?>

    <label for="js"><?php echo e(__('adminstaticwords.CustomJS:')); ?></label>
    <small class="text-danger"><?php echo e($errors->first('js','Javascript Cannot be blank !')); ?></small>
    <textarea placeholder="$(document).ready(function{
      //code
  });" class="form-control" name="js" rows="10" cols="30"><?php echo e($js); ?></textarea>

    <input type="submit" value="<?php echo e(__('adminstaticwords.ADDJS')); ?>" class="btn btn-md btn-primary">
    </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/customstyle/add.blade.php ENDPATH**/ ?>

<?php $__env->startSection('title',__('adminstaticwords.EditLanguage') . ''." - $language->name"); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="<?php echo e(url('admin/languages')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.GoBack')); ?>" class="btn-floating"><i class="material-icons">reply</i></a> <?php echo e(__('adminstaticwords.EditLanguage')); ?></h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <?php echo Form::model($language, ['method' => 'PATCH', 'action' => ['LanguageController@update', $language->id]]); ?>

            <div class="form-group<?php echo e($errors->has('local') ? ' has-error' : ''); ?>">
                <?php echo Form::label('local', __('adminstaticwords.local')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterLanguageLocalName')); ?> eg:en"></i>
                <?php echo Form::text('local', null, ['class' => 'form-control', 'required' => 'required']); ?>

                <small class="text-danger"><?php echo e($errors->first('local')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                <?php echo Form::label('name', __('adminstaticwords.Name')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterLanguageLocalName')); ?> eg:English"></i>
                <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => 'required']); ?>

                <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
            </div>

            <div class="form-group">
              <label for=""><?php echo e(__('adminstaticwords.SetDefault')); ?></label>
              <br>
              <label class="switch">
                     <input name="def" <?php echo e($language->def==1 ? "checked" : ""); ?> type="checkbox" class="checkbox-switch" id="logo_chk">
                    <span class="slider round"></span>
                </label>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/language/edit.blade.php ENDPATH**/ ?>
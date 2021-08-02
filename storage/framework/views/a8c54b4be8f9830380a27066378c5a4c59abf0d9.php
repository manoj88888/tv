
<?php $__env->startSection('title',__('adminstaticwords.Edit')." "." - $actor->name"); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="<?php echo e(url('admin/actors')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.GoBack')); ?>" class="btn-floating"><i class="material-icons">reply</i></a> <?php echo e(__('adminstaticwords.EditActor')); ?></h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <?php echo Form::model($actor, ['method' => 'PATCH', 'action' => ['ActorController@update', $actor->id], 'files' => true]); ?>

            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                <?php echo Form::label('name', __('adminstaticwords.Name')); ?>

                 <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterActorName')); ?> eg:Tom Hardy"></i>
                <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => 'required']); ?>

                <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
            </div>
               <div class="form-group<?php echo e($errors->has('biography') ? ' has-error' : ''); ?>">
                <?php echo Form::label('biography', __('adminstaticwords.Biography')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterActorBiography')); ?> "></i>
                <?php echo Form::textarea('biography', null, ['class' => 'form-control','row'=>'3', 'placeholder' => __('adminstaticwords.PleaseEnterActorBiography')]); ?>

                <small class="text-danger"><?php echo e($errors->first('biography')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('image') ? ' has-error' : ''); ?> input-file-block">
              <?php echo Form::label('image',__('adminstaticwords.ActorImage')); ?>

               <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.UploadActorImage')); ?>"></i>
              <?php echo Form::file('image', ['class' => 'input-file', 'id'=>'image']); ?>

              <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.ActorImage')); ?>">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName"><?php echo e(__('adminstaticwords.ChooseAFile')); ?></span>
              </label>
              <p class="info"><?php echo e(__('adminstaticwords.ChooseCustomImage')); ?></p>
              <small class="text-danger"><?php echo e($errors->first('image')); ?></small>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/actor/edit.blade.php ENDPATH**/ ?>
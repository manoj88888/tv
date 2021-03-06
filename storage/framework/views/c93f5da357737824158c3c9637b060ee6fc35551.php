
<?php $__env->startSection('title',__('adminstaticwords.EditBlock')); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="<?php echo e(url('admin/customize/landing-page')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.GoBack')); ?>" class="btn-floating"><i class="material-icons">reply</i></a> <?php echo e(__('adminstaticwords.EditBlock')); ?></h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <?php echo Form::model($landing_page, ['method' => 'PATCH', 'action' => ['LandingPageController@update', $landing_page->id], 'files' => true]); ?>

            <div class="form-group<?php echo e($errors->has('heading') ? ' has-error' : ''); ?>">
                <?php echo Form::label('heading', __('adminstaticwords.Heading')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterHeading')); ?>"></i>
                <?php echo Form::text('heading', null, ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('heading')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('detail') ? ' has-error' : ''); ?>">
                <?php echo Form::label('detail', __('adminstaticwords.Detail')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterDetail')); ?>"></i>
                <?php echo Form::textarea('detail', null, ['class' => 'form-control materialize-textarea']); ?>

                <small class="text-danger"><?php echo e($errors->first('detail')); ?></small>
            </div>
            <div class="pad_plus_border">
              <div class="form-group<?php echo e($errors->has('button') ? ' has-error' : ''); ?>">
                <div class="row">
                  <div class="col-xs-6">
                    <?php echo Form::label('button', __('adminstaticwords.Button')); ?>

                  </div>
                  <div class="col-xs-5 text-right">
                    <label class="switch">
                      <?php echo Form::checkbox('button', 1, $landing_page->button, ['class' => 'checkbox-switch']); ?>

                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
                <div class="col-xs-12">
                  <small class="text-danger"><?php echo e($errors->first('button')); ?></small>
                </div>
              </div>
              <div class="bootstrap-checkbox form-group<?php echo e($errors->has('button_link') ? ' has-error' : ''); ?>">
                <div class="row">
                  <div class="col-md-7">
                    <?php echo Form::label('button_link', __('adminstaticwords.ButtonLink')); ?>

                  </div>
                  <div class="col-md-5 pad-0">
                    <div class="make-switch">
                      <?php echo Form::checkbox('button_link', 1, ($landing_page->button_link == 'login' ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"Login", "data-off-text"=>"Register", "data-size"=>"small"]); ?>

                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <small class="text-danger"><?php echo e($errors->first('button_link')); ?></small>
                </div>
              </div>
              <div class="form-group<?php echo e($errors->has('button_text') ? ' has-error' : ''); ?> button_text">
                <?php echo Form::label('button_text', __('adminstaticwords.ButtonText')); ?>

                <?php echo Form::text('button_text', null, ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('button_text')); ?></small>
              </div>
            </div>
            <div class="bootstrap-checkbox form-group<?php echo e($errors->has('left') ? ' has-error' : ''); ?>">
              <div class="row">
                <div class="col-md-7">
                  <h5 class="bootstrap-switch-label"><?php echo e(__('adminstaticwords.ImagePosition')); ?></h5>
                </div>
                <div class="col-md-5 pad-0">
                  <div class="make-switch">
                    <?php echo Form::checkbox('left', 1, $landing_page->left, ['class' => 'bootswitch', "data-on-text"=>"Left", "data-off-text"=>"Right", "data-size"=>"small"]); ?>

                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <small class="text-danger"><?php echo e($errors->first('left')); ?></small>
              </div>
            </div>
            <div class="form-group<?php echo e($errors->has('image') ? ' has-error' : ''); ?> input-file-block">
              <?php echo Form::label('image', 'Image'); ?> <p class="inline info"></p>
              <?php echo Form::file('image', ['class' => 'input-file', 'id'=>'image']); ?>

              <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.ProjectImage')); ?>">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName"><?php echo e(__('adminstaticwords.ChooseAFile')); ?></span>
              </label>
              <p class="info"><?php echo e(__('adminstaticwords.ChooseAImage')); ?></p>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/landing-page/edit.blade.php ENDPATH**/ ?>
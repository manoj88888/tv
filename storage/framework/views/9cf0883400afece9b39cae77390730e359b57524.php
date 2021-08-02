
<?php $__env->startSection('title', __('adminstaticwords.Seo')); ?>

<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
  <div class="tabsetting">
  <a href="<?php echo e(url('admin/settings')); ?>" style="color: #7f8c8d;" ><button class="tablinks"><?php echo e(__('adminstaticwords.GenralSetting')); ?></button></a>
  <a href="#" style="color: #7f8c8d;" ><button class="tablinks active"><?php echo e(__('adminstaticwords.SEOSetting')); ?></button></a>
  <a href="<?php echo e(url('admin/api-settings')); ?>" style="color: #7f8c8d;"><button class="tablinks"><?php echo e(__('adminstaticwords.APISetting')); ?></button></a>
  <a href="<?php echo e(route('mail.getset')); ?>" style="color: #7f8c8d;"><button class="tablinks"><?php echo e(__('adminstaticwords.MailSettings')); ?></button></a>
  
</div>
    <div class="row admin-form-block z-depth-1">
      <?php if($seo): ?>
         <?php echo Form::model($seo, ['method' => 'PATCH', 'action' => ['SeoController@update', $seo->id], 'files' => true]); ?>


          <div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
              <?php echo Form::label('author',__('adminstaticwords.AuthorName')); ?>

              <?php echo Form::text('author', null, ['placeholder' => __('adminstaticwords.EnterAuthorName'),'id' => 'textbox', 'class' => 'form-control']); ?>

              <small class="text-danger"><?php echo e($errors->first('author')); ?></small>
           </div>
        
          <div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
              <?php echo Form::label('description', __('adminstaticwords.MetadataDescription')); ?>

              <?php echo Form::textarea('description', null, ['id' => 'textbox', 'class' => 'form-control']); ?>

              <small class="text-danger"><?php echo e($errors->first('description')); ?></small>
           </div>
          <div class="form-group<?php echo e($errors->has('keyword') ? ' has-error' : ''); ?>">
              <?php echo Form::label('keyword', __('adminstaticwords.MetadataKeyword')); ?>

              <?php echo Form::textarea('keyword', null, ['placeholder' => __('adminstaticwords.KeywordPlaceholder'),'id' => 'textbox', 'class' => 'form-control']); ?>

              <small class="text-danger"><?php echo e($errors->first('keyword')); ?></small>
          </div>
    
          <div class="form-group<?php echo e($errors->has('google') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('google',__('adminstaticwords.GoogleAnalytics')); ?>

                  <?php echo Form::text('google', null, ['class' => 'form-control']); ?>

                  <small class="text-danger"><?php echo e($errors->first('google')); ?></small>
              </div>
          <div class="form-group<?php echo e($errors->has('fb') ? ' has-error' : ''); ?>">
              <?php echo Form::label('fb', __('adminstaticwords.FacebookPixcal')); ?>

              <?php echo Form::text('fb', null, ['id' => 'textbox1', 'class' => 'form-control']); ?>

              <small class="text-danger"><?php echo e($errors->first('fb')); ?></small>
          </div>
          <div class="btn-group pull-right">
            <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> <?php echo e(__('adminstaticwords.Save')); ?></button>
          </div>
          <div class="clear-both"></div>
        <?php echo Form::close(); ?>

      <?php endif; ?>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/seo.blade.php ENDPATH**/ ?>
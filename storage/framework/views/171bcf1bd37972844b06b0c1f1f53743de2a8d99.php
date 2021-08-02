
<?php $__env->startSection('title', __('adminstaticwords.MailSettings')); ?>

<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
  <div class="tabsetting">
  <a href="<?php echo e(url('admin/settings')); ?>" style="color: #7f8c8d;" ><button class="tablinks "><?php echo e(__('adminstaticwords.GenralSetting')); ?></button></a>
  <a href="<?php echo e(url('admin/seo')); ?>" style="color: #7f8c8d;" ><button class="tablinks"><?php echo e(__('adminstaticwords.SEOSetting')); ?></button></a>
  <a href="<?php echo e(url('admin/api-settings')); ?>" style="color: #7f8c8d;"><button class="tablinks"><?php echo e(__('adminstaticwords.APISetting')); ?></button></a>
  <a href="#" style="color: #7f8c8d;"><button class="tablinks active"><?php echo e(__('adminstaticwords.MailSettings')); ?></button></a>
 
</div>
      <?php echo Form::model($env_files, ['method' => 'POST', 'action' => 'ConfigController@changeMailEnvKeys']); ?>

        <div class="row admin-form-block z-depth-1">
          <div class="api-main-block">
            <h5 class="form-block-heading"><?php echo e(__('adminstaticwords.MailSettings')); ?></h5>

            <div class="payment-gateway-block">

              <div class="form-group<?php echo e($errors->has('MAIL FROM NAME') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('MAIL_FROM_NAME',__('adminstaticwords.SenderName')); ?>

                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterSenderName')); ?>"></i>
                  <input class="form-control" type="text" name="MAIL_FROM_NAME" value="<?php echo e($env_files['MAIL_FROM_NAME']); ?>">
                  <small class="text-danger"><?php echo e($errors->first('MAIL_FROM_NAME')); ?></small>
              </div>

              <div class="form-group<?php echo e($errors->has('MAIL HOST') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('MAIL_DRIVER', __('adminstaticwords.MAILDRIVER')); ?>

                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMailDriver')); ?> (ex. : sendmail, smtp, mail)"></i>
                  <?php echo Form::text('MAIL_DRIVER', null, ['class' => 'form-control']); ?>

                  <small class="text-danger"><?php echo e($errors->first('MAIL_DRIVER')); ?></small>
              </div>
              <div class="form-group<?php echo e($errors->has('MAIL_FROM_ADDRESS') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('MAIL_DRIVER', __('adminstaticwords.MAILFROMADDRESS')); ?>

                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMailFromAddress')); ?> (ex. : yourmail@gmail.com)"></i>
                  <?php echo Form::email('MAIL_FROM_ADDRESS', null, ['class' => 'form-control']); ?>

                  <small class="text-danger"><?php echo e($errors->first('MAIL_FROM_ADDRESS')); ?></small>
              </div>
              <div class="form-group<?php echo e($errors->has('MAIL HOST') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('MAIL_HOST', __('adminstaticwords.MAILHOST')); ?>

                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMailHost')); ?> (ex. : smtp.gmail.com)"></i>
                  <?php echo Form::text('MAIL_HOST', null, ['class' => 'form-control']); ?>

                  <small class="text-danger"><?php echo e($errors->first('MAIL_HOST')); ?></small>
              </div>

               <div class="form-group<?php echo e($errors->has('MAIL_PORT') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('MAIL_PORT', __('adminstaticwords.MAILPORT')); ?>

                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMailPort')); ?> (ex. : 587, 487)"></i>
                  <?php echo Form::text('MAIL_PORT', null, ['class' => 'form-control']); ?>

                  <small class="text-danger"><?php echo e($errors->first('MAIL_PORT')); ?></small>
              </div>

               <div class="form-group<?php echo e($errors->has('MAIL_USERNAME') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('MAIL_USERNAME', __('adminstaticwords.MAILUSERNAME')); ?>

                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMailUsername')); ?> (ex. : yourmail@gmail.com)"></i>
                  <?php echo Form::text('MAIL_USERNAME', null, ['class' => 'form-control']); ?>

                  <small class="text-danger"><?php echo e($errors->first('MAIL_USERNAME')); ?></small>
              </div>

              <div class="search form-group<?php echo e($errors->has('MAIL_PASSWORD') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('MAIL_PASSWORD', __('adminstaticwords.MAILPASSWORD')); ?>

                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMailPassword')); ?>"></i>
                  <input type="password" name="MAIL_PASSWORD" id="mailpass" value="<?php echo e($env_files['MAIL_PASSWORD']); ?>" class="form-control">
                  <span toggle="#mailpass" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                  <small class="text-danger"><?php echo e($errors->first('MAIL_PASSWORD')); ?></small>
              </div>

               <div class="form-group<?php echo e($errors->has('MAIL_ENCRYPTION') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('MAIL_ENCRYPTION', __('adminstaticwords.MAILENCRYPTION')); ?>

                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMailEncryption')); ?> (ex. : SSL, TLS)"></i>
                  <?php echo Form::text('MAIL_ENCRYPTION', null, ['class' => 'form-control']); ?>

                  <small class="text-danger"><?php echo e($errors->first('MAIL_ENCRYPTION')); ?></small>
              </div>

            </div>

          </div>

          <div class="btn-group col-xs-12">
            <button type="submit" class="btn btn-block btn-success"><?php echo e(__('adminstaticwords.SaveSettings')); ?></button>
          </div>
          <div class="clear-both"></div>
        </div>
      <?php echo Form::close(); ?>

  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
  <script>

  $(".toggle-password2").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
  });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/mailsetting/mailset.blade.php ENDPATH**/ ?>
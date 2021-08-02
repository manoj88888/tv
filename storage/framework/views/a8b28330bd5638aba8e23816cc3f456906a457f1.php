
<?php $__env->startSection('title', 'Account Setting'); ?>
<?php $__env->startSection('main-wrapper'); ?>
<!-- main wrapper -->
<section id="main-wrapper" class="main-wrapper home-page user-account-section">
  <div class="container-fluid">
    <h4 class="heading"><?php echo e(__('staticwords.accountandsettings')); ?></h4>
    <ul class="bradcump">
      <li><a href="<?php echo e(url('account')); ?>"><?php echo e(__('staticwords.dashboard')); ?></a></li>
      <li>/</li>
      <li><?php echo e(__('staticwords.accountandsettings')); ?></li>
    </ul>
    <div class="panel-setting-main-block">
      <div class="edit-profile-main-block">

        <div class="row">
            <div class="col-md-6">
                <div class="edit-profile-block">
                    <h4 class="panel-setting-heading"><?php echo e(__('staticwords.changenameandgender')); ?></h4>
                    <div class="info"><?php echo e(__('staticwords.wanttochangeagenameandgender')); ?></div>
                    <?php echo Form::open(['method' => 'POST', 'action' => 'UsersController@update_name_gender']); ?>

                    <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                        <input type="text" class="form-control"  name="name"  <?php if(isset(Auth::user()->name)): ?> value="<?php echo e(Auth::user()->name); ?>" <?php endif; ?>/>
                        <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
                    </div>
                    <div class="form-group<?php echo e($errors->has('change_gender') ? ' has-error' : ''); ?>">
                        <?php echo Form::label('gender', __('staticwords.changegender')); ?>

                    <select name="gender">

                    <?php if(auth()->user()->gender == 'Male'): ?>
                        <option selected value="Male">Male</option>
                        <option value="Female">Female</option>
                    <?php else: ?>
                        <option value="Male">Male</option>
                        <option selected value="Female">Female</option>
                    <?php endif; ?>
                    
                    </select>
                        <small class="text-danger"><?php echo e($errors->first('change_gender')); ?></small>
                    </div>
                    <div class="btn-group pull-right">
                        <?php echo Form::submit(__('staticwords.update'), ['class' => 'btn btn-success']); ?>

                    </div>
                    <?php echo Form::close(); ?>

            </div>
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="edit-profile-block">
              <h4 class="panel-setting-heading"><?php echo e(__('staticwords.changemail')); ?></h4>
              <div class="info"><?php echo e(__('staticwords.currentemail')); ?>: <?php echo e(auth()->user()->email); ?></div>
              <?php echo Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile']); ?>

              <div class="form-group<?php echo e($errors->has('new_email') ? ' has-error' : ''); ?>">
                <?php echo Form::label('new_email',__('staticwords.newemail')); ?>

                <?php echo Form::text('new_email', null, ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('new_email')); ?></small>
              </div>
              <div class="form-group<?php echo e($errors->has('current_password') ? ' has-error' : ''); ?>">
                <?php echo Form::label('current_password', __('staticwords.currentpassword')); ?>

                <?php echo Form::password('current_password', ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('current_password')); ?></small>
              </div>
              <div class="btn-group pull-right">
                <?php echo Form::submit(__('staticwords.update'), ['class' => 'btn btn-success']); ?>

              </div>
              <?php echo Form::close(); ?>

            </div>
          </div>
          
          <div class="col-md-6">
            <div class="edit-profile-block">
              <h4 class="panel-setting-heading"><?php echo e(__('staticwords.updateageandmobile')); ?></h4>
              <div class="info"><?php echo e(__('staticwords.wanttochangeageandmobile')); ?></div>
              <?php echo Form::open(['method' => 'POST', 'action' => 'UsersController@update_age']); ?>

              
              <div class="search form-group<?php echo e($errors->has('dob') ? ' has-error' : ''); ?>">
                <?php echo Form::label('dob',__('staticwords.dateofbirth')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('staticwords.enterdateofbirthuser')); ?>"></i>

                <input type="date" class="form-control"  name="dob"  <?php if(isset(Auth::user()->dob)): ?> value="<?php echo e(Auth::user()->dob); ?>" <?php endif; ?>/>
                <small class="text-danger"><?php echo e($errors->first('dob')); ?></small>
              </div>
              <div class="search form-group<?php echo e($errors->has('mobile') ? ' has-error' : ''); ?>">
                <?php echo Form::label('mobile', __('staticwords.mobileno')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('staticwords.enteryourmobileno')); ?>"></i>
                <input type="number" class="form-control"  name="mobile" <?php if(isset(Auth::user()->mobile)): ?> value="<?php echo e(Auth::user()->mobile); ?>"<?php endif; ?>/>   
                <small class="text-danger"><?php echo e($errors->first('mobile')); ?></small>
              </div>

              <div class="btn-group pull-right">
                <?php echo Form::submit(__('staticwords.update'), ['class' => 'btn btn-success']); ?>

              </div>

              <?php echo Form::close(); ?>

            </div>
          </div>
          
          <div class="col-md-6">
            <div class="edit-profile-block">
              <h4 class="panel-setting-heading"><?php echo e(__('staticwords.changepassword')); ?></h4>
              <div class="info"><?php echo e(__('staticwords.wanttochangeyourpassword')); ?></div>
              <?php echo Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile']); ?>

              <div class="form-group<?php echo e($errors->has('current_password') ? ' has-error' : ''); ?>">
                <?php echo Form::label('current_password', __('staticwords.currentpassword')); ?>

                <?php echo Form::password('current_password', ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('current_password')); ?></small>
              </div>
              <div class="form-group<?php echo e($errors->has('new_password') ? ' has-error' : ''); ?>">
                <?php echo Form::label('new_password', __('staticwords.newpassword')); ?>

                <?php echo Form::password('new_password', ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('new_password')); ?></small>
              </div>
              <div class="btn-group pull-right">
                <?php echo Form::submit(__('staticwords.update'), ['class' => 'btn btn-success']); ?>

              </div>
              <?php echo Form::close(); ?>

            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end main wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/user/edit_profile.blade.php ENDPATH**/ ?>
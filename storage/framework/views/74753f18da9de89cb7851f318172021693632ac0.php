<?php $__env->startSection('title','User Dashboard'); ?>
<?php $__env->startSection('main-wrapper'); ?>
<!-- main wrapper -->
<section id="main-wrapper" class="main-wrapper home-page user-account-section">
    <div class="container-fluid">
    <h4 class="heading"><?php echo e(__('staticwords.dashboard')); ?></h4>
    <div class="panel-setting-main-block">
        
    <div class="panel-setting">
        <div class="row">
            <div class="col-md-6">
                <h4 class="panel-setting-heading"><?php echo e(__('staticwords.yourdetails')); ?></h4>
                <p><?php echo e(__('staticwords.updateyourprofiledetails')); ?></p>
            </div>
            
            <div class="col-md-3">
                <p class="info"><?php echo e(__('staticwords.youremail')); ?>: <?php echo e($auth->email); ?></p>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="edit-profile-block">
                    
                    <?php echo Form::open(['method' => 'POST', 'action' => 'UsersController@update_age']); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                                <?php echo Form::label('name',__('staticwords.username')); ?>

                                <input type="text" required class="form-control"  name="name"  <?php if(isset(Auth::user()->name)): ?> value="<?php echo e(Auth::user()->name); ?>" <?php endif; ?>/>
                                <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
                            </div>
                            <div class="form-group<?php echo e($errors->has('change_gender') ? ' has-error' : ''); ?>">
                                <?php echo Form::label('gender', __('staticwords.changegender')); ?>

                                <select name="gender" required>
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
                        </div>
                        <div class="col-md-6">
                            <div class="search form-group<?php echo e($errors->has('dob') ? ' has-error' : ''); ?>">
                                
                                <?php echo Form::label('dob',__('staticwords.dateofbirth')); ?>

                                <input type="date" required class="form-control"  name="dob"  <?php if(isset(Auth::user()->dob)): ?> value="<?php echo e(\Carbon\Carbon::parse(Auth::user()->dob)->format('m/d/Y')); ?>" <?php endif; ?>/>
                                <small class="text-danger"><?php echo e($errors->first('dob')); ?></small>
                            </div>
                            <div class="search form-group<?php echo e($errors->has('mobile') ? ' has-error' : ''); ?>">
                                <?php echo Form::label('mobile', __('staticwords.mobileno')); ?>

                                <input type="number" class="form-control"  name="mobile" <?php if(isset(Auth::user()->mobile)): ?> value="<?php echo e(Auth::user()->mobile); ?>"<?php endif; ?>/>   
                                <small class="text-danger"><?php echo e($errors->first('mobile')); ?></small>
                            </div>
                            <div class="btn-group pull-right">
                                <?php echo Form::submit(__('staticwords.update'), ['class' => 'btn btn-success']); ?>

                            </div>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="edit-profile-block">
                        <h4 class="panel-setting-heading"><?php echo e(__('staticwords.changemail')); ?></h4> 
                        
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
                        <h4 class="panel-setting-heading"><?php echo e(__('staticwords.changepassword')); ?></h4>
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
            <div class="panel-setting">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="panel-setting-heading"><?php echo e(__('staticwords.yourmembership')); ?></h4>
                        <p><?php echo e(__('staticwords.wanttochangemembership')); ?></p>
                    </div>
                    <div class="col-md-3">
                        <?php
                            $bfree = null;
                            $config=App\Config::first();
                            $auth=Auth::user();
                            if ($auth->is_admin==1) {
                                $bfree=1;
                            }else{
                                $ps=App\PaypalSubscription::where('user_id',$auth->id)->first();
                                    if (isset($ps)) {
                                   $current_date = Illuminate\Support\Carbon::now();
                                    if (date($current_date) <= date($ps->subscription_to)) {
                                      
                                      if ($ps->package_id==100 || $ps->package_id == 0) {
                                          $bfree=1;
                                      }else{
                                        $bfree=0;
                                      }
                                    }
                                }
                             }
                        ?>
                        
                        <?php if($auth->is_admin==1): ?>
                            <p class="info"><?php echo e(__('staticwords.currentsubscriptionfree')); ?></p>
                        <?php else: ?>
                            <?php if($bfree==1): ?>
                                <p class="info"><?php echo e(__('staticwords.currentsubscritptionfreetill')); ?>

                                    <strong><?php echo e(date('F j, Y  g:i:a',strtotime($ps->subscription_to))); ?> </strong>
                                </p>
                            <?php elseif($bfree==0): ?>
                            <?php if(isset($ps)): ?>
                                <?php
                                $psn=App\Package::where('id',$ps->package_id)->first();
                                ?>
                                <p class="info"><?php echo e(__('staticwords.currentsubscription')); ?>: <?php echo e(ucfirst($psn['name'])); ?></p>
                            <?php endif; ?>
                            <?php else: ?>
                            <?php if($current_subscription != null): ?>
                                <p class="info"><?php echo e(__('staticwords.currentsubscription')); ?>: <?php echo e($method == 'stripe' ? ucfirst($current_subscription->name) : ucfirst($current_subscription->plan->name)); ?></p>
                            <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3">
                        <div class="panel-setting-btn-block text-right">
                            <?php if($current_subscription != null && $method == 'stripe'): ?> 
                                <?php if($auth->subscription($current_subscription->name)->cancelled()): ?>
                                    <a href="<?php echo e(route('resumeSub', $current_subscription->stripe_plan)); ?>" class="btn btn-setting"><i class="fa fa-edit"></i><?php echo e(__('staticwords.resumesubscription')); ?></a>
                                <?php else: ?>
                                    
                                    <a href="<?php echo e(url('account/purchaseplan')); ?>" class="btn btn-setting"><i class="fa fa-edit"></i><?php echo e(__('staticwords.upgradechangesubscription')); ?></a>
                                <?php endif; ?>
                                <?php elseif($current_subscription != null && $method == 'paypal'): ?>
                                <?php if($current_subscription->status == 0): ?>
                                    <a href="<?php echo e(route('resumeSubPaypal')); ?>" class="btn btn-setting"><i class="fa fa-edit"></i><?php echo e(__('staticwords.resumesubscription')); ?></a>
                                <?php elseif($current_subscription->status == 1): ?>
                                    
                                    <a href="<?php echo e(url('account/purchaseplan')); ?>" class="btn btn-setting"><i class="fa fa-edit"></i><?php echo e(__('staticwords.upgradechangesubscription')); ?></a>
                                <?php endif; ?>
                                <?php else: ?> 
                                <?php if($auth->is_admin == 1): ?>
                                <?php else: ?>              
                                    <a href="<?php echo e(url('account/purchaseplan')); ?>" class="btn btn-setting"><?php echo e(__('staticwords.subscribenow')); ?></a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-setting">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="panel-setting-heading"><?php echo e(__('staticwords.yourpaymenthistory')); ?></h4>
                        <p><?php echo e(__('staticwords.viewyourpaymenthistory')); ?>.</p>
                    </div>
                    <div class="col-md-offset-3 col-md-3">
                        <div class="panel-setting-btn-block text-right">
                            <a href="<?php echo e(url('account/billing_history')); ?>" class="btn btn-setting"><?php echo e(__('staticwords.viewdetails')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- end main wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/user/index.blade.php ENDPATH**/ ?>
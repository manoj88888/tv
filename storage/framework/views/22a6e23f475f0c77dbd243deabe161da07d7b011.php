
<?php $__env->startSection('title',__('staticwords.contactus')); ?>
<?php $__env->startSection('main-wrapper'); ?>

 <div class="container" style="background-color: #333333;">
 	<br>
 		<?php if(Session::has('success')): ?>
 		<div class="alert alert-success">
 			<?php echo e(__('staticwords.success')); ?> : <?php echo e(Session::get('success')); ?>

 		</div>
 		<?php endif; ?>
 	<h3 class="text-center"><?php echo e(__('staticwords.contact')); ?> <span class="us_text"><?php echo e(__('staticwords.us')); ?></span></h3>
 	<br>
 	<h5 class="text-center"><?php echo e(__('staticwords.contactdetail')); ?></h5>
 	<form action="<?php echo e(route('send.contactus')); ?>" method="post">
 		<?php echo e(csrf_field()); ?>

    <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
 	<label style="color: #fff;" for=""><?php echo e(__('staticwords.name')); ?>:</label>
 	<input type="text" class="form-control custom-field-contact" name="name">
 	<?php if($errors->has('name')): ?>
                <span class="help-block">
                  <strong><?php echo e($errors->first('name')); ?></strong>
                </span>
    <?php endif; ?>
 	</div>

 	<div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
 	<label style="color: #fff;" for=""><?php echo e(__('staticwords.email')); ?>:</label>
 	<input type="email" class="search-input form-control custom-field-contact" name="email">
 	<?php if($errors->has('email')): ?>
                <span class="help-block">
                  <strong><?php echo e($errors->first('email')); ?></strong>
                </span>
    <?php endif; ?>
 	</div>

 	<div class="form-group<?php echo e($errors->has('subj') ? ' has-error' : ''); ?>">
 	<label style="color: #fff;" for=""><?php echo e(__('staticwords.subject')); ?>:</label>
 	<select name="subj" id="" class="form-control custom-field-contact">
 		<option value="Billing Issue"><?php echo e(__('staticwords.billingissue')); ?></option>
 		<option value="Streaming Issue"><?php echo e(__('staticwords.streamingissue')); ?></option>
 		<option value="Application Issue"><?php echo e(__('staticwords.applicationissue')); ?></option>
 		<option value="Advertising"><?php echo e(__('staticwords.advertising')); ?></option>
 		<option value="Partnership"><?php echo e(__('staticwords.partnership')); ?></option>
 		<option value="Other"><?php echo e(__('staticwords.other')); ?></option>
 	</select>
 	<?php if($errors->has('subj')): ?>
                <span class="help-block">
                  <strong><?php echo e($errors->first('subj')); ?></strong>
                </span>
    <?php endif; ?>
 	</div>

 	<div class="form-group<?php echo e($errors->has('msg') ? ' has-error' : ''); ?>">
 	<label style="color: #fff;" for=""><?php echo e(__('staticwords.message')); ?>:</label>
 	<textarea name="msg" class="form-control custom-field-contact" rows="5" cols="50"></textarea>
 	<?php if($errors->has('msg')): ?>
                <span class="help-block">
                  <strong><?php echo e($errors->first('msg')); ?></strong>
                </span>
    <?php endif; ?>
 	</div>

 	<input type="submit" class="btn btn-primary" value="<?php echo e(__('staticwords.send')); ?>"> 
 	</form>
 	
 	<br>
 </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/contact.blade.php ENDPATH**/ ?>

<?php $__env->startSection('title',__('adminstaticwords.StaticTranslation')); ?>
<?php $__env->startSection('content'); ?>
<div class="box admin-form-main-block mrg-t-40">
	<div class="box-header with-border">
		<a title="Cancel and go back" href="<?php echo e(url()->previous()); ?>" class=" btn-floating">
			<i class="material-icons">reply</i></a>
		</a>
		<div class="box-title"><?php echo e(__('adminstaticwords.StaticWordTranslationsForLanguage')); ?>: <?php echo e($findlang->name); ?>

		</div>
	</div>

	<ul class="nav nav-tabs">
	   <li class="active"><a data-toggle="tab" href="#home"><?php echo e(__('adminstaticwords.FrontEndTranslation')); ?></a></li>
	   <li><a data-toggle="tab" href="#menu1"><?php echo e(__('adminstaticwords.BackEndTranslation')); ?></a></li>
	</ul>
	<br/> 
	<div class="callout callout-info">
		<i class="fa fa-info-circle"></i> <?php echo e(__('adminstaticwords.LanguageInstruction')); ?>

	</div>
	<div class="tab-content">
	    <div id="home" class="tab-pane fade in active">
		   	<form action="<?php echo e(route('static.trans.update',$findlang->local)); ?>" method="POST">
		   	<?php echo csrf_field(); ?>
				<div class="box-body">
						
					<textarea name="transfile" class="form-control" name="" id="" cols="100" rows="20"><?php echo e($file); ?></textarea>
				</div>
				<div class="box-footer">

					 <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> <?php echo e(__('adminstaticwords.Reset')); ?></button>
					
					<button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> <?php echo e(__('adminstaticwords.Update')); ?></button>

				</div>
			</form>
	    </div>
	   <div id="menu1" class="tab-pane fade">
		    <div id="home" class="tab-pane fade in active">
			   	<form action="<?php echo e(route('static.admin.trans.update',$findlang->local)); ?>" method="POST">
			   	<?php echo csrf_field(); ?>
					<div class="box-body">
						<textarea name="admintransfile" class="form-control" id="" cols="100" rows="20"><?php echo e($adminfile); ?></textarea>
					</div>
					<div class="box-footer">

						 <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> <?php echo e(__('adminstaticwords.Reset')); ?></button>
						
						<button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> <?php echo e(__('adminstaticwords.Update')); ?></button>

					</div>
				</form>
		    </div>
	   </div>
	
	</div>


		
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/language/staticword.blade.php ENDPATH**/ ?>
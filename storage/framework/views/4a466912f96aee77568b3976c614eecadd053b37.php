
<?php $__env->startSection('title',__('staticwords.manageprofile')); ?>
<?php $__env->startSection('main-wrapper'); ?>

	<div class="container">
		<div class="manage-profile">
		<br>
		<div align="left">
				<h4><?php echo e(__('staticwords.hey')); ?> <?php echo e(Auth::user()->name); ?> <?php echo e(__('staticwords.selectpersonalprofile')); ?> <?php echo e(config('app.name')); ?>:</h4>	
		</div>
		<hr>
		<div class="row">
				<?php if(!isset($result)): ?>
				 <p><?php echo e(__('staticwords.noprofileavailable')); ?></p>
				<?php endif; ?>
				<div align="center"><p id="msg"></p></div>

			<form action="<?php echo e(route('mus.pro.update',Auth::user()->id)); ?>" method="POST">
				<?php echo e(csrf_field()); ?>

			
			<?php if(isset($result->screen1)): ?>
			<div class="col-md-3  col-sm-4  col-xs-6">
				<div class="btm-20 manage-profile-block">

				<img class="imageprofile <?php if(Session::has('nickname')): ?> <?php echo e(Session::get('nickname') == $result->screen1 ? "imgactive" : ""); ?> <?php endif; ?>" <?php if($result->screen_1_used == 'NO'): ?> onclick="changescreen('<?php echo e($result->screen1); ?>','<?php echo e(1); ?>')" <?php endif; ?> title="<?php echo e($result->screen1); ?>" src="<?php echo e(Avatar::create($result->screen1)->toBase64()); ?>" alt="">
				
				<?php if($result->device_mac_1 != '' && $_SERVER['REMOTE_ADDR'] == $result->device_mac_1): ?>
				<br><br>
					<input class="screen2 form-control" name="screen1" type="text" value="<?php echo e($result->screen1); ?>">
					<div class="text-center">
						<br>
						<span class="label label-success"><?php echo e(__('staticwords.currentlyactive')); ?></span>
					</div>
				<?php elseif($result->device_mac_1 == ''): ?>
				<br><br>
					<input class="screen2 form-control" name="screen1" type="text" value="<?php echo e($result->screen1); ?>">
				<?php else: ?>
					
					<div class="text-center">
						<br>
						<span class="label label-success"><?php echo e(__('staticwords.inuse')); ?></span>
					</div>
				
				<?php endif; ?>
				</div>

			</div>
			<?php endif; ?>

			<?php if(isset($result->screen2)): ?>
			<div class="col-md-3 col-sm-4 col-xs-6">
				<div class="btm-20 manage-profile-block">
			<img class="img-fluid imageprofile <?php if(Session::has('nickname')): ?> <?php echo e(Session::get('nickname') == $result->screen2 ? "imgactive" : ""); ?> <?php endif; ?>" <?php if($result->screen_2_used == 'NO'): ?> onclick="changescreen('<?php echo e($result->screen2); ?>','<?php echo e(2); ?>')" <?php endif; ?> title="<?php echo e($result->screen2); ?>" src="<?php echo e(Avatar::create($result->screen2)->toBase64()); ?>" alt="<?php echo e($result->screen2); ?>" >
				
				<?php if($result->device_mac_2 != '' && $_SERVER['REMOTE_ADDR'] == $result->device_mac_2): ?>
				<br><br>
					<input class="screen2 form-control" name="screen2" type="text" value="<?php echo e($result->screen2); ?>">
					<div class="text-center">
						<br>
						<span class="label label-success"><?php echo e(__('staticwords.currentlyactive')); ?></span>
					</div>
				<?php elseif($result->device_mac_2 == ''): ?>
				<br><br>
					<input class="screen2 form-control" name="screen2" type="text" value="<?php echo e($result->screen2); ?>">
				<?php else: ?>
					<div class="text-center">
						<br>
						<span class="label label-success"><?php echo e(__('staticwords.inuse')); ?></span>
					</div>
				<?php endif; ?>
				
			</div>
				</div>
			<?php endif; ?>


			<?php if(isset($result->screen3)): ?>
			<div class="col-md-3  col-sm-4  col-xs-6">
				<div class="btm-20 manage-profile-block">
				<img class="imageprofile <?php if(Session::has('nickname')): ?> <?php echo e(Session::get('nickname') == $result->screen3 ? "imgactive" : ""); ?> <?php endif; ?>" <?php if($result->screen_3_used == 'NO'): ?> onclick="changescreen('<?php echo e($result->screen3); ?>','<?php echo e(3); ?>')" <?php endif; ?> title="<?php echo e($result->screen3); ?>" src="<?php echo e(Avatar::create($result->screen3)->toBase64()); ?>" alt="<?php echo e($result->screen3); ?>">
				
				<?php if($result->device_mac_3 != '' && $_SERVER['REMOTE_ADDR'] == $result->device_mac_3): ?>
				<br><br>
					<input class="screen2 form-control" name="screen3" type="text" value="<?php echo e($result->screen3); ?>">
					<div class="text-center">
						<br>
						<span class="label label-success"><?php echo e(__('staticwords.currentlyactive')); ?></span>
					</div>
				<?php elseif($result->device_mac_3 == ''): ?>
				<br><br>
					<input class="screen2 form-control" name="screen3" type="text" value="<?php echo e($result->screen3); ?>">
				<?php else: ?>
					<div class="text-center">
						<br>
						<span class="label label-success"><?php echo e(__('staticwords.inuse')); ?></span>
					</div>
				<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>

			<?php if(isset($result->screen4)): ?>
			<div class="col-md-3  col-sm-4  col-xs-6">
				<div class="btm-20 manage-profile-block">
				<img class="imageprofile <?php if(Session::has('nickname')): ?> <?php echo e(Session::get('nickname') == $result->screen4 ? "imgactive" : ""); ?> <?php endif; ?>" <?php if($result->screen_4_used == 'NO'): ?> onclick="changescreen('<?php echo e($result->screen4); ?>','<?php echo e(4); ?>')" <?php endif; ?> title="<?php echo e($result->screen4); ?>" src="<?php echo e(Avatar::create($result->screen4)->toBase64()); ?>" alt="<?php echo e($result->screen4); ?>">
				
				<?php if($result->device_mac_4 != '' && $_SERVER['REMOTE_ADDR'] == $result->device_mac_4): ?>
				<br><br>
					<input class="screen2 form-control" name="screen4" type="text" value="<?php echo e($result->screen4); ?>">
					<div class="text-center">
						<br>
						<span class="label label-success"><?php echo e(__('staticwords.currentlyactive')); ?></span>
					</div>
				<?php elseif($result->device_mac_4 == ''): ?>
				<br><br>
					<input class="screen2 form-control" name="screen4" type="text" value="<?php echo e($result->screen4); ?>">
				<?php else: ?>
					<div class="text-center">
						<br>
						<span class="label label-success"><?php echo e(__('staticwords.inuse')); ?></span>
					</div>
				<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
 
            
			
		  <?php if(isset($result)): ?>

			<div class="mg15 col-md-12  col-sm-12 col-xs-12 col-md-offset-5">
 
				<div class="manage-profile-btn">
				<button type="submit" class="btn btn-lg btn-primary" value="Done"><i class="fa fa-check"></i> <?php echo e(__('staticwords.done')); ?></button>

				</div>
			</div>
			<?php endif; ?>
				
			</form>
		</div>
	</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
	<script>
		function changescreen(screen,count){

			$.ajax({
				type : 'GET',
				data : {screen : screen, count : count},
				url  : '<?php echo e(url('/changescreen/'.Auth::user()->id)); ?>',
				success : function(data){
					console.log(data);
					
					$('#msg').html(data);

					

					setTimeout(function(){ 
						location.reload();
					}, 700);


				}
			});
		}
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/manageprofile.blade.php ENDPATH**/ ?>
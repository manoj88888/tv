
<?php $__env->startSection('title',__('staticwords.protectedpassword')); ?>
<?php $__env->startSection('main-wrapper'); ?>
<section class="main-wrapper">
    <div class="container-fluid">
        <div class="watchlist-section">
	       <div class="container">
	       	
			  <h3><?php echo e(__('staticwords.protectedvideopassword')); ?></h3>
			  <p>All items which are password protected listed here:</p>
			  
			   <div class="tab-content table-responsive">
			     	<table class="table table-bordered protected">
		       			<thead>
		       				<th>#</th>
		           			<th><?php echo e(__('staticwords.thumbnail')); ?></th>
		           			
		           			<th colspan='2'><?php echo e(__('staticwords.password')); ?></th>
		       			</thead>
		       			<tbody>

		       				<?php if(isset($pusheditems) && count($pusheditems) > 0): ?>
			       				<?php $__currentLoopData = $pusheditems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			       				<tr>
			       					<td><?php echo e($key+1); ?></td>
			       					<?php if($item->type =='M'): ?>
			       					<td>
			       						<?php if(isset($item->thumbnail)): ?>
			       						<span><img src="<?php echo e(url('/images/movies/thumbnails',$item->thumbnail)); ?>" width="100" height="100" class="img img-fluid img-responsive"></span>
			       						<?php else: ?>
			       						<span><img src="<?php echo e(url('/images/default-thumbnail.jpg')); ?>" width="100" height="100" class="img img-fluid img-responsive"></span>
			       						<?php endif; ?>
			       						<p><?php echo e($item->title); ?></p></td>
			       					<?php if(isset($item->password)): ?>
			       					<td>
			       						<input type="password" name="password" id="<?php echo e($item->title); ?>" value="<?php echo e($item->password); ?>" class="password protected-feild" disabled="disabled">
			       					</td>
			       					<td>
			       						<span toggle="#<?php echo e($item->title); ?>" data-value="<?php echo e($item->title); ?>" class="fa fa-fw fa-eye field-icon toggle-password" onclick="show(<?php echo e($item->title); ?>)" id="toggle-password-<?php echo e($item->title); ?>"></span>&emsp;

			       						<span><a href="<?php echo e(url('movie/detail/'.$item->slug)); ?>" target="_blank" class="btn btn-primary"><?php echo e(__('staticwords.view')); ?></a></span>

			       					</td>
			       					<?php else: ?>
			       						<td><?php echo e(__('staticwords.thismoviehasnotpasswordprotected')); ?></td>
			       					<?php endif; ?>
			       					<?php elseif($item->type == 'S'): ?>
			       					<td>
			       					<?php if(isset($item->thumbnail)): ?>
			       						<img src="<?php echo e(url('/images/tvseries/thumbnails',$item->thumbnail)); ?>" width="100" height="100" class="img img-fluid img-responsive">
			       					<?php else: ?>
			       						<img src="<?php echo e(url('/images/default-thumbnail.jpg')); ?>" width="50" height="50" class="img img-fluid img-responsive">
			       					<?php endif; ?>
			       					<?php echo e(__('Season')); ?> <?php echo e($item->season_no); ?></td>
			       					<?php if(isset($item->password)): ?>
			       					<td>

			       						<input type="password" name="password" id="<?php echo e($item->title); ?>" value="<?php echo e($item->password); ?>" class="password protected-feild" disabled="disabled">
			       					</td>
			       					<td>
			       						<span toggle="#<?php echo e($item->title); ?>" class="fa fa-fw fa-eye field-icon toggle-password" ></span>&emsp;
			       						<span><a href="<?php echo e(url('show/detail/'.$item->season_slug)); ?>" target="_blank" class="btn btn-primary"><?php echo e(__('staticwords.view')); ?></a></span>

			       					</td>
			       					<?php else: ?>
			       						<td><?php echo e(__('staticwords.thismoviehasnotpasswordprotected')); ?></td>
			       					<?php endif; ?>
			       					<?php endif; ?>
			       				</tr>
		       					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		       				<?php else: ?>
		       					<tr>
		       						<td colspan=4 class="text-center">No data available</td>
		       					</tr>
		       				<?php endif; ?>
		       			</tbody>
		       		</table>
			 	 </div>
			</div>
			<div class="col-md-12">
                <div align="center">
                   <?php echo $pusheditems->links(); ?>

                </div>
            </div>
       </div>
   </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
	$(".toggle-password").on('click',function() {
   
  $(this).toggleClass("fa-eye fa-eye-slash");

  var row = $(this).closest("tr");

  var x = row.find("input.password");

  if (x.attr("type") == "password") {
    x.attr("type", "text");
  } else {
    x.attr("type", "password");
  }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/protectedPassword.blade.php ENDPATH**/ ?>
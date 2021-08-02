
<?php $__env->startSection('title',__('adminstaticwords.Advertise')); ?>
<?php $__env->startSection('stylesheet'); ?>
<style>
  .fl::first-letter {text-transform:uppercase}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<br>
<div class="box-header">
  <h5><?php echo e(__('adminstaticwords.Advertise')); ?></h5>
</div>

		<?php
         $ads = App\Ads::all();
    ?>

        <a href="<?php echo e(route('ad.create')); ?>" class="btn btn-md btn-danger">+ <?php echo e(__('adminstaticwords.CreateAD')); ?></a>

          <!-- Delete Modal -->
      <a type="button" class="btn btn-danger btn-md z-depth-0" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> <?php echo e(__('adminstaticwords.DeleteSelected')); ?></a> 


      <!-- Modal -->
      <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="delete-icon"></div>
            </div>
            <div class="modal-body text-center">
              <h4 class="modal-heading"><?php echo e(__('adminstaticwords.AreYouSure')); ?></h4>
              <p><?php echo e(__('adminstaticwords.DeleteWarrning')); ?></p>
            </div>
            <div class="modal-footer">
              <?php echo Form::open(['method' => 'POST', 'action' => 'AdsController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('adminstaticwords.No')); ?></button>
                <button type="submit" class="btn btn-danger"><?php echo e(__('adminstaticwords.Yes')); ?></button>
              <?php echo Form::close(); ?>

            </div>
          </div>
        </div>
      </div>

		<br>
        <div class="content-block box-body">

        <table id="full_detail_table" class="table table-hover">
            <thead>
            	<th><div class="inline">
                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                <label for="checkboxAll" class="material-checkbox"></label>
              </div></th>
                <th>#</th>
                <th><?php echo e(__('adminstaticwords.AdType')); ?></th>
                <th><?php echo e(__('adminstaticwords.AdLocation')); ?></th>
                <th><?php echo e(__('adminstaticwords.Edit')); ?></th>
                <th><?php echo e(__('adminstaticwords.Actions')); ?></th>
            </thead>

            <tbody>
                <tr>
                <?php $i=0; ?>
                <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $i++ ?>

                <td>
                	<div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="<?php echo e($ad->id); ?>" id="checkbox<?php echo e($ad->id); ?>">
                    <label for="checkbox<?php echo e($ad->id); ?>" class="material-checkbox"></label>
                  </div>
                </td>

                 <td><?php echo e($i); ?></td>
                 <td class="fl"><?php echo e($ad->ad_type); ?></td>
                 <td class="fl"><?php echo e($ad->ad_location); ?></td>
                 <td><a href="<?php echo e(route('ad.edit',$ad->id)); ?>" class="btn btn-sm btn-success"><?php echo e(__('adminstaticwords.Edit')); ?></a></td>
                 <td>
                     <form action="<?php echo e(route('ad.delete',$ad->id)); ?>" method="POST">
                        <?php echo e(csrf_field()); ?> 
                        <?php echo e(method_field('DELETE')); ?>

                        <input type="submit" value="<?php echo e(__('adminstaticwords.Delete')); ?>" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger"/>
                        
                     </form>
                 </td>
                 </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

       </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
  <script>
    $(function(){
      $('#checkboxAll').on('change', function(){
        if($(this).prop("checked") == true){
          $('.material-checkbox-input').attr('checked', true);
        }
        else if($(this).prop("checked") == false){
          $('.material-checkbox-input').attr('checked', false);
        }
      });
    });
  </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/advertise/index.blade.php ENDPATH**/ ?>
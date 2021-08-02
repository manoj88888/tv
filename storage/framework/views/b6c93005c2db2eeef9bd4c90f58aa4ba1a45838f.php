
<?php $__env->startSection('title',__('adminstaticwords.AllPackages')); ?>
<?php $__env->startSection('content'); ?>
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="<?php echo e(route('packages.create')); ?>" class="btn btn-danger btn-md"><i class="material-icons left">add</i> <?php echo e(__('adminstaticwords.CreatePackage')); ?></a>
      <!-- Delete Modal -->
      <a type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> <?php echo e(__('adminstaticwords.DeleteSelected')); ?></a>
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
              <?php echo Form::open(['method' => 'POST', 'action' => 'PackageController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('adminstaticwords.No')); ?></button>
                <button type="submit" class="btn btn-danger"><?php echo e(__('adminstaticwords.Yes')); ?></button>
              <?php echo Form::close(); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body">
      <table id="full_detail_table" class="table table-hover">
        <thead>
          <tr class="table-heading-row">
            <th>
              <div class="inline">
                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                <label for="checkboxAll" class="material-checkbox"></label>
              </div>
              #
            </th>
            <th><?php echo e(__('adminstaticwords.PackageName')); ?></th>
            <th><?php echo e(__('adminstaticwords.Amount')); ?></th>
            <th><?php echo e(__('adminstaticwords.Interval')); ?></th>
            <th><?php echo e(__('adminstaticwords.IntervalCount')); ?></th>
            <th><?php echo e(__('adminstaticwords.TrailPeriod')); ?></th>
            <th><?php echo e(__('adminstaticwords.Status')); ?></th>
           
            <th><?php echo e(__('adminstaticwords.Actions')); ?></th>
          </tr>
        </thead>
        <?php if($packages): ?>
          <tbody>
            <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           

              <tr>
                <td>
                  <div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="<?php echo e($package->id); ?>" id="checkbox<?php echo e($package->id); ?>">
                    <label for="checkbox<?php echo e($package->id); ?>" class="material-checkbox"></label>
                  </div>
                  <?php echo e($key+1); ?>

                </td>
                <td><?php echo e($package->name); ?></td>
                <td><i class="<?php echo e($package->currency_symbol); ?>"></i><?php echo e($package->amount); ?></td>
                <td><?php echo e($package->interval); ?></td>
                <td><?php echo e($package->interval_count); ?></td>
                <td><?php echo e($package->trial_period_days); ?></td>
                <td>
                    <form action="<?php echo e(route('pkgstatus',$package->id)); ?>" method="POST">
                      <?php echo e(csrf_field()); ?>

                    <?php if($package->status == 1): ?>
                    <input type="hidden" value="0" name="status">
                    <button type="submit" class="btn btn-sm btn-danger"><?php echo e(__('adminstaticwords.Deactive')); ?></button>
                    <?php else: ?>
                    <input type="hidden" value="1" name="status">
                    <button type="submit" class="btn btn-sm btn-success"><?php echo e(__('adminstaticwords.Active')); ?></button>
                    <?php endif; ?>
                    </form>
                </td>
                <td>
                  <div class="admin-table-action-block">
                    <?php if($package->delete_status == 1): ?>
                      <a href="<?php echo e(route('packages.edit', $package->id)); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.Edit')); ?>" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                      <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#<?php echo e($package->id); ?>deleteModal"><i class="material-icons">delete</i> </button>
                    <?php else: ?>
                      <a  data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.RestorePackage')); ?>" style="cursor: not-allowed" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                      
                    <?php endif; ?>
                  </div>
                </td>
              </tr>
              
              <!-- Delete Modal -->
              <div id="<?php echo e($package->id); ?>deleteModal" class="delete-modal modal fade" role="dialog">
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
                      <?php echo Form::open(['method' => 'DELETE', 'action' => ['PackageController@softDelete', $package->id]]); ?>

                          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('adminstaticwords.No')); ?></button>
                          <input type="submit" class="btn btn-danger" value="<?php echo e(__('adminstaticwords.Yes')); ?>">
                      <?php echo Form::close(); ?>

                    </div>
                  </div>
                </div>
              </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        <?php endif; ?>
      </table>
    </div>
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

  <script>
    $(function() {
      $('#cb3').change(function() {
        $('#status').val(+ $(this).prop('checked'))
      })
    })
  </script>

  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sonaflix/new.sonaflix.com/resources/views/admin/package/index.blade.php ENDPATH**/ ?>
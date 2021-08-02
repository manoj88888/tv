
<?php $__env->startSection('title',__('adminstaticwords.AllFAQs')); ?>
<?php $__env->startSection('content'); ?>
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="<?php echo e(route('faqs.create')); ?>" class="btn btn-danger btn-md"><i class="material-icons left">add</i> <?php echo e(__('adminstaticwords.CreateFaq')); ?></a>
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
              <?php echo Form::open(['method' => 'POST', 'action' => 'FaqController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('adminstaticwords.No')); ?></button>
                <button type="submit" class="btn btn-danger"><?php echo e(__('adminstaticwords.Yes')); ?></button>
              <?php echo Form::close(); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body table-responsive">
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
            <th><?php echo e(__('adminstaticwords.FaqQuestion')); ?></th>
            <th><?php echo e(__('adminstaticwords.FaqAnswer')); ?></th>
            <th><?php echo e(__('adminstaticwords.CreatedAt')); ?></th>
            <th><?php echo e(__('adminstaticwords.UpdatedAt')); ?></th>
            <th><?php echo e(__('adminstaticwords.Actions')); ?></th>
          </tr>
        </thead>
        <?php if($faqs): ?>
          <tbody>
            <?php ($no = 1); ?>
            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td>
                  <div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="<?php echo e($faq->id); ?>" id="checkbox<?php echo e($faq->id); ?>">
                    <label for="checkbox<?php echo e($faq->id); ?>" class="material-checkbox"></label>
                  </div>
                  <?php echo e($no); ?>

                  <?php ($no++); ?>
                </td>
                <td><?php echo $faq->question; ?></td>
                <td><?php echo $faq->answer; ?></td>
                <td><?php echo e(date('F d, Y',strtotime($faq->created_at))); ?></td>
                <td><?php echo e(date('F d, Y',strtotime($faq->updated_at))); ?></td>
                <td>
                  <div class="admin-table-action-block">
                    <a href="<?php echo e(route('faqs.edit', $faq->id)); ?>" data-toggle="tooltip" data-original-title="Edit" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                    <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#<?php echo e($faq->id); ?>deleteModal"><i class="material-icons">delete</i> </button>
                  </div>
                </td>
              </tr>
              <!-- Delete Modal -->
              <div id="<?php echo e($faq->id); ?>deleteModal" class="delete-modal modal fade" role="dialog">
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
                      <?php echo Form::open(['method' => 'DELETE', 'action' => ['FaqController@destroy', $faq->id]]); ?>

                          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('adminstaticwords.No')); ?></button>
                          <button type="submit" class="btn btn-danger"><?php echo e(__('adminstaticwords.Yes')); ?></button>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/faq/index.blade.php ENDPATH**/ ?>
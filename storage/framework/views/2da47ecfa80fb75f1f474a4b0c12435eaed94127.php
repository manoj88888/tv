
<?php $__env->startSection('title',__('adminstaticwords.AllPromotionSettings')); ?>
<?php $__env->startSection('content'); ?>
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="<?php echo e(route('home-block.create')); ?>" class="btn btn-danger btn-md"><i class="material-icons left">add</i> <?php echo e(__('adminstaticwords.AddPromotionSettingsBlock')); ?></a>
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
              <?php echo Form::open(['method' => 'POST', 'action' => 'HomeBlockController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('adminstaticwords.No')); ?></button>
                <button type="submit" class="btn btn-danger"><?php echo e(__('adminstaticwords.Yes')); ?></button>
              <?php echo Form::close(); ?>

            </div>
          </div>
        </div>
      </div>
     
    </div>
   
    <div class="content-block box-body">
      <table id="full_detail_table" class="table table-hover db">
        <thead>
          <tr class="table-heading-row">
          <th>
            <div class="inline">
              <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
              <label for="checkboxAll" class="material-checkbox"></label>
            </div>
            #
          </th>
          <th><?php echo e(__('adminstaticwords.Movie')); ?></th>
          <th><?php echo e(__('adminstaticwords.TvSeries')); ?></th>
          <th><?php echo e(__('adminstaticwords.Active')); ?></th>
          <th><?php echo e(__('adminstaticwords.Actions')); ?></th>
        </tr>
        </thead>
        <?php if($home_blocks): ?>
          <tbody>
          <?php $__currentLoopData = $home_blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $home_block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr id="item-<?php echo e($home_block->id); ?>">
              <td>
                <div class="inline">
                  <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="<?php echo e($home_block->id); ?>" id="checkbox<?php echo e($home_block->id); ?>">
                  <label for="checkbox<?php echo e($home_block->id); ?>" class="material-checkbox"></label>
                </div>
                <a class="handle"><i class="fa fa-unsorted" style="opacity: 0.3"></i></a>
                <?php echo e($key+1); ?>

              </td>
              <td><?php echo e($home_block->movie ? $home_block->movie->title : '-'); ?></td>
              <td><?php echo e($home_block->tvseries ? $home_block->tvseries->title : '-'); ?></td>
             
              <td><?php echo e($home_block->is_active == 1 ? __('adminstaticwords.Active') : __('adminstaticwords.Deactive')); ?></td>
              <td>
                <div class="admin-table-action-block">
                  <a href="<?php echo e(route('home-block.edit', $home_block->id)); ?>" data-toggle="tooltip" data-original-title="Edit" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                  <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#<?php echo e($home_block->id); ?>deleteModal"><i class="material-icons">delete</i> </button>
                </div>
              </td>
            </tr>
            <!-- Delete Modal -->
            <div id="<?php echo e($home_block->id); ?>deleteModal" class="delete-modal modal fade" role="dialog">
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
                    <?php echo Form::open(['method' => 'DELETE', 'action' => ['HomeBlockController@destroy', $home_block->id]]); ?>

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
  var app = new Vue({});
  $('table.db tbody').sortable({
    cursor: "move",
    revert: true,
    placeholder: 'sort-highlight',
    connectWith: '.connectedSortable',
    forcePlaceholderSize: true,
    zIndex: 999999,
    axis: 'y',
    update: function(event, ui) {
      var data = $(this).sortable('serialize');
      app.$http.post('<?php echo e(route('slide_reposition')); ?>', {item: data}).then((response) => {
        console.log(data);
        console.log('re');
        console.log(response);
      }).catch((e) => {
        console.log($(this).sortable('serialize'));
        console.log(e);
        console.log('err');
      });
    }
  });
  $(window).resize(function() {
    $('table.db tr').css('min-width', $('table.db').width());
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/home-block/index.blade.php ENDPATH**/ ?>

<?php $__env->startSection('title',__('adminstaticwords.AllActors')); ?>
<?php $__env->startSection('content'); ?>
<div class="content-main-block mrg-t-40">
  <div class="admin-create-btn-block">
    <a href="<?php echo e(route('actors.create')); ?>" class="btn btn-danger btn-md"><i class="material-icons left">add</i> <?php echo e(__('adminstaticwords.CreateActor')); ?></a>
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
            <?php echo Form::open(['method' => 'POST', 'action' => 'ActorController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

            <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('adminstaticwords.No')); ?></button>
            <button type="submit" class="btn btn-danger"><?php echo e(__('adminstaticwords.Yes')); ?></button>
            <?php echo Form::close(); ?>

          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="content-block box-body table-responsive">
    <table id="actorTable" class="table table-hover">
      <thead>
        <tr class="table-heading-row">
          <th>
            <div class="inline">
              <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
              <label for="checkboxAll" class="material-checkbox"></label>
            </div>
            #
          </th>
            <th><?php echo e(__('adminstaticwords.Image')); ?></th>
            <th><?php echo e(__('adminstaticwords.Name')); ?></th>
            <th><?php echo e(__('adminstaticwords.Biography')); ?></th>
            <th><?php echo e(__('adminstaticwords.BirthPlace')); ?></th>
      
            <th><?php echo e(__('adminstaticwords.Actions')); ?></th>
        </tr>
      </thead>
      <?php if($actors): ?>
      <tbody>
       
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
  $(function () {

    var table = $('#actorTable').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: false,
      scrollCollapse: true,


      ajax: "<?php echo e(route('actors.index')); ?>",
      columns: [

      {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
      {data: 'image', name: 'image'},
      {data: 'name', name: 'name'},
      {data: 'biography', name: 'biography'},
      {data: 'place_of_birth', name: 'place_of_birth'},

      {data: 'action', name: 'action',searchable: false}

      ],
      dom : 'lBfrtip',
      buttons : [
      'csv','excel','pdf','print'
      ],
      order : [[0,'desc']]
    });

  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/actor/index.blade.php ENDPATH**/ ?>

<?php $__env->startSection('title',__('adminstaticwords.ChangeSubscription')); ?>
<?php $__env->startSection('content'); ?>
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
    </div>
    <div class="content-block box-body">
      <table id="plan_table" class="table table-hover">
        <thead>
          <tr class="table-heading-row">
            
            <th><?php echo e(__('adminstaticwords.ID')); ?></th>
            <th><?php echo e(__('adminstaticwords.Name')); ?></th>
            <th><?php echo e(__('adminstaticwords.Email')); ?></th>
            <th><?php echo e(__('adminstaticwords.Plans')); ?></th>
            <th><?php echo e(__('adminstaticwords.Sub.Expire')); ?></th>
            <th><?php echo e(__('adminstaticwords.Actions')); ?></th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
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
      
      var table = $('#plan_table').DataTable({
          processing: true,
          serverSide: true,
           responsive: true,
         autoWidth: false,
         scrollCollapse: true,
       
          ajax: "<?php echo e(route('plan.index')); ?>",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'username', name: 'username'},
              {data : 'useremail', name: 'useremail'},
              {data : 'planname', name: 'planname'},
              {data : 'subscription_to', name : 'subscription_to'},
              {data : 'action', name: 'action'}
      
          ],
          dom : 'lBfrtip',
          buttons : [
            'csv','excel','pdf','print'
          ],
          order : [[0,'DESC']]
      });
      
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/plan/index.blade.php ENDPATH**/ ?>
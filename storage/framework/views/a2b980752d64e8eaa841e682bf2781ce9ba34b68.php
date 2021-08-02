
<?php $__env->startSection('title',__('adminstaticwords.AllManualPaymentTransacation')); ?>
<?php $__env->startSection('content'); ?>
  <div class="content-main-block mrg-t-40">
   <h4><?php echo e(__('adminstaticwords.ManualPaymentTransaction')); ?></h4><br/>
    <div class="content-block box-body">
       
      <table id="moviesTable" class="table table-hover">
        <thead>
          <tr class="table-heading-row">
            <th>
              <div class="inline">
                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                <label for="checkboxAll" class="material-checkbox"></label>
              </div>
              #
            </th>
            <th><?php echo e(__('adminstaticwords.UserName')); ?></th>
            <th><?php echo e(__('adminstaticwords.Package')); ?></th>
            <th><?php echo e(__('adminstaticwords.Amount')); ?></th>
            <th><?php echo e(__('adminstaticwords.SubscriptionFrom')); ?></th>
            <th><?php echo e(__('adminstaticwords.SubscriptionTo')); ?></th>
            <th><?php echo e(__('adminstaticwords.Status')); ?></th>
            <th><?php echo e(__('adminstaticwords.Actions')); ?></th>
          </tr>
        </thead>
          <?php if($manual_payment): ?>
          <tbody>
            <?php $__currentLoopData = $manual_payment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($key+1); ?></td>
                <td><?php echo e($payment->user->name); ?></td>
                <td><?php echo e($payment->plan->name); ?></td>
                <td><?php echo e($payment->plan->amount); ?></td>
                <td><?php echo e(date('F j, Y  g:i:a',strtotime($payment->subscription_from))); ?></td>
                <td><?php echo e(date('F j, Y  g:i:a',strtotime($payment->subscription_to))); ?></td>
                <td>
                  <?php if($payment->status == 1): ?>
                    <a href="<?php echo e(url('manualpayment',$payment->id)); ?>" class='btn btn-sm btn-success'>Active</a>
                  <?php else: ?>
                    <a href="<?php echo e(url('manualpayment',$payment->id)); ?>" class='btn btn-sm btn-danger'>Deactive</a> 
                  <?php endif; ?>
                </td>
                <td>
                  <a href="<?php echo e(url('/images/recipt/'.$payment->file)); ?>" data-toggle="tooltip" data-original-title="Download file" class="btn-success btn-floating" download><i class="material-icons">cloud_download</i></a></td>
              </tr>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sonaflix/new.sonaflix.com/resources/views/admin/manual_payment/index.blade.php ENDPATH**/ ?>
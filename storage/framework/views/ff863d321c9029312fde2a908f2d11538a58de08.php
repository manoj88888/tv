
<?php $__env->startSection('title',__('adminstaticwords.Reports')); ?>
<?php $__env->startSection('content'); ?>
  <div class="content-main-block mrg-t-40">
    <h4 class="admin-form-text"><?php echo e(__('adminstaticwords.AllReports')); ?></h4>
    <div class="content-block box-body">
      <table id="full_detail_table" class="table table-hover">
        <thead>
        <tr class="table-heading-row">
          <th>#</th>
          <th><?php echo e(__('adminstaticwords.Date')); ?></th>
          <th><?php echo e(__('adminstaticwords.SubscribedPackage')); ?></th>
          <th><?php echo e(__('adminstaticwords.PaidAmount')); ?></th>
          <th><?php echo e(__('adminstaticwords.Method')); ?></th>
          <th><?php echo e(__('adminstaticwords.User')); ?></th>
        </tr>
        </thead>
        <tbody>
          <?php if(isset($all_reports) && count($all_reports->data) > 0): ?>
            <?php
              $sell = null;
            ?>
            <?php $__currentLoopData = $all_reports->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
               
                $customer_id = \Stripe\Customer::retrieve($report->customer);
                $user = Illuminate\Support\Facades\DB::table('users')->where('email', '=', $customer_id->email)->first();
                $sell = $sell + (($report->plan->amount/100));
              ?>
              <tr>
                <td>
                  <?php echo e($key+1); ?>

                </td>
                <td>
                  <?php echo e(date('d/m/Y',$report->items->data[0]->created)); ?>

                </td>
                <td>
                  <?php echo e($report->items->data[0]->plan->id); ?>

                </td>
                <td>
                  <i class="<?php echo e($currency_symbol); ?>"></i> <?php echo e($report->plan->amount/100); ?>

                </td>
                <td>
                  Stripe
                </td>
                <td>
                  <?php if(isset($user)): ?>
                    <?php echo e($user->name ? $user->name : ''); ?>

                  <?php else: ?>
                   <?php echo e(__('adminstaticwords. UserRemoved')); ?>

                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
          <?php if(isset($paypal_subscriptions) && count($paypal_subscriptions) > 0): ?>
            <?php $__currentLoopData = $paypal_subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $sell = 0;
                $date = $item->created_at->toDateString();
                //$sells = $sell + $item->price; 

              ?>
              <tr>
                <td>
                  <?php echo e($key+1); ?>

                </td>
                <td>
                  <?php echo e($date); ?>

                </td>
                <td>
                  <?php echo e($item->plan ? $item->plan->name : 'N/A'); ?>

                </td>
                <td>
                  <i class="<?php echo e($currency_symbol); ?>"></i> <?php echo e($item->price); ?>

                </td>
                <td>
                  Paypal
                </td>
                <td>
                  <?php echo e($item->user ? $item->user->name : 'N/A'); ?>

                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        </tbody>
      </table>
      <br/>
      <br/>
      <div class="total-sell" style="margin-top: 20px">
        <h5><?php echo e(__('adminstaticwords.TotalSells')); ?> <i class="<?php echo e($currency_symbol); ?>"></i><?php echo e(isset($sells) ? $sells : ''); ?></h5>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/report/index.blade.php ENDPATH**/ ?>
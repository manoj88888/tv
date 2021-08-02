<?php $__env->startSection('main-wrapper'); ?>
  <!-- main wrapper -->
  <section id="main-wrapper" class="main-wrapper home-page user-account-section">
    <div class="container-fluid">
      <h4 class="heading"><?php echo e(__('staticwords.invoicedetails')); ?></h4>
      <ul class="bradcump">
        <li><a href="<?php echo e(url('account')); ?>"><?php echo e(__('staticwords.dashboard')); ?></a></li>
        <li>/</li>
        <li><?php echo e(__('staticwords.invoicedetails')); ?></li>
      </ul>
      <div class="panel-setting-main-block billing-history-main-block">
        <?php if(isset($invoices) && $invoices != null): ?>
          <div class="container">
            <h4 class="plan-dtl-heading"><?php echo e(__('staticwords.stripebillinghistory')); ?></h4>
            <div class="billing-history-block table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th><?php echo e(__('staticwords.date')); ?></th>
                    <th><?php echo e(__('staticwords.package')); ?></th>
                    <th><?php echo e(__('staticwords.serviceperiod')); ?></th>
                    <th><?php echo e(__('staticwords.paymentmethod')); ?></th>
                    <th><?php echo e(__('staticwords.total')); ?></th>
                  </tr>
                </thead>
                <tbody>
                 
                  <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              
                    <?php
                      $from = Carbon\Carbon::parse($invoice->subscription_from);
                      $from = $from->toDateString();
                      $to = Carbon\Carbon::parse($invoice->subscription_to);
                      $to = $to->toDateString();
                       $created = Carbon\Carbon::parse($invoice->created);
                      $created = $created->toDateString();

                      $plan = App\Package::where('plan_id',$invoice->lines->data[0]->plan->id)->first();
                    ?>
                    <tr>
                      <td><?php echo e($created); ?></td>
                      <td><?php echo e($plan->name); ?></td>
                      <td><?php echo e($from); ?> to <?php echo e($to); ?></td>
                      <td>Stripe</td>
                      <td><i class="<?php echo e($currency_symbol); ?>"></i> <?php echo e($invoice->lines->data[0]->plan->amount/100); ?></td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
          </div>
        <?php endif; ?>
        <?php if(isset($paypal_subscriptions) && $paypal_subscriptions != null && count($paypal_subscriptions) > 0): ?>
          <div class="container">
            <h4 class="plan-dtl-heading"><?php echo e(__('staticwords.billinghistory')); ?></h4>
            <div class="billing-history-block table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th><?php echo e(__('staticwords.date')); ?></th>
                    <th><?php echo e(__('staticwords.package')); ?></th>
                    <th><?php echo e(__('staticwords.serviceperiod')); ?></th>
                    <th><?php echo e(__('staticwords.paymentmethod')); ?></th>
                    <th><?php echo e(__('staticwords.total')); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $paypal_subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                      $from = Carbon\Carbon::parse($item->subscription_from);
                      $from = $from->toDateString();
                      $to = Carbon\Carbon::parse($item->subscription_to);
                      $to = $to->toDateString();
                    ?>
                    <tr>
                      <td><?php echo e($item->created_at->toDateString()); ?></td>
                      <td><?php echo e($item->plan ? $item->plan->name : 'N/A'); ?></td>
                      <td><?php echo e($from); ?> to <?php echo e($to); ?></td>
                      <td><?php echo e(ucfirst($item->method)); ?></td>
                      <td><i class="<?php echo e($currency_symbol); ?>"></i> <?php echo e($item->price); ?></td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <!-- end main wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/user/history.blade.php ENDPATH**/ ?>
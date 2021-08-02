
<?php $__env->startSection('title',"FAQ's"); ?>
<?php $__env->startSection('main-wrapper'); ?>
  <!-- main wrapper -->
  <section id="main-wrapper" class="main-wrapper home-page user-account-section">
    <div class="container-fluid faq-main-block">
      <h4 class="heading"><?php echo e(__('staticwords.frequentlyaskedquestions')); ?></h4>
      <ul class="bradcump">
        <li><a href="<?php echo e(url('account')); ?>"><?php echo e(__('staticwords.dashboard')); ?></a></li>
        <li>/</li>
        <li><?php echo e(__('staticwords.faq')); ?></li>
      </ul>
      <div class="panel-setting-main-block">
        <?php if(isset($faqs)): ?>
          <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="panel-setting">
              <div class="row">
                <div class="col-md-1 col-sm-2 col-xs-3">
                  <i class="fa fa-question-circle-o"></i>
                </div>
                <div class="col-md-9 col-xs-9">
                  <h4 class="panel-setting-heading"><?php echo e($faq->question); ?></h4>
                  <p class="info"><?php echo e($faq->answer); ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <!-- end main wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/faq.blade.php ENDPATH**/ ?>
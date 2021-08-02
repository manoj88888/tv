<div id="<?php echo e($chart->id); ?>" <?php echo $chart->formatContainerOptions('css'); ?>>
    <?php echo $__env->make('charts::loader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php /**PATH /home/sonaflix/new.sonaflix.com/resources/views/vendor/charts/highcharts/container.blade.php ENDPATH**/ ?>
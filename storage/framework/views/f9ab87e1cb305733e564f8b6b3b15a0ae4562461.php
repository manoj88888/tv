
<?php $__env->startSection('title',__('adminstaticwords.EditPackage')); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="<?php echo e(url('admin/packages')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.GoBack')); ?>" class="btn-floating"><i class="material-icons">reply</i></a> <?php echo e(__('adminstaticwords.EditPackage')); ?></h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <?php echo Form::model($package, ['method' => 'PATCH', 'action' => ['PackageController@update', $package->id]]); ?>

            <div class="form-group<?php echo e($errors->has('plan_id') ? ' has-error' : ''); ?>">
                <?php echo Form::label('plan_id',  __('adminstaticwords.PlanID')); ?>

                <p class="inline info"> - <?php echo e(__('adminstaticwords.UniquePackage')); ?></p>
                <?php echo Form::text('plan_id', null, ['class' => 'form-control', 'required' => 'required', 'data-toggle' => 'popover','data-content' => 'Create Your Unique Plan ID ex. basic10', 'data-placement' => 'bottom']); ?>

                <small class="text-danger"><?php echo e($errors->first('plan_id')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                <?php echo Form::label('name', __('adminstaticwords.PlanName')); ?>

                <p class="inline info"> - <?php echo e(__('adminstaticwords.PleaseEnterYourPlanName')); ?></p>
                <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => 'required']); ?>

                <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
            </div>
            <?php echo Form::hidden('currency', $currency_code); ?>

    
            <div class="form-group<?php echo e($errors->has('amount') ? ' has-error' : ''); ?>">
                <?php echo Form::label('amount', __('adminstaticwords.YourPlanAmount')); ?>

                <p class="inline info"> -<?php echo e(__('adminstaticwords.PlanAmountMinMax')); ?></p>
                <div class="input-group">
                  <span class="input-group-addon simple-input"><i class="<?php echo e($currency_symbol); ?>"></i></span>
                  <?php echo Form::number('amount', null, ['min' => 1,'step'=>'0.01', 'class' => 'form-control', 'required' => 'required']); ?>  
                </div>
                <?php if($package->currency_symbol==''): ?>
                 <input type="text" name="currency_symbol" id="currency_symbol" value="<?php echo e($currency_symbol); ?>" hidden="true">
                 <?php else: ?>
                   <input type="text" name="currency_symbol" id="currency_symbol" value="<?php echo e($package->currency_symbol); ?>" hidden="true">
                 <?php endif; ?>
                <small class="text-danger"><?php echo e($errors->first('amount')); ?></small>
            </div>
             
            <div class="menu-block">
              <h6 class="menu-block-heading"><?php echo e(__('adminstaticwords.PleaseSelectMenu')); ?></h6>
              <?php if(isset($menus) && count($menus) > 0): ?>
                <ul>
                     <li>
                      <div class="inline">
                        <input type="checkbox" class="filled-in material-checkbox-input all" name="menu[]" value="100" id="checkbox<?php echo e(100); ?>" >
                        <label for="checkbox<?php echo e(100); ?>" class="material-checkbox"></label>
                      </div>
                      <?php echo e(__('adminstaticwords.AllMenus')); ?>

                    </li>
                  <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 
                    <li>
                      <div class="inline">
                        <input <?php $__currentLoopData = $menu->getpackage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pkg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($pkg->menu_id == $menu->id && $package->id == $pkg->pkg_id? "checked" : ""); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> type="checkbox" class="filled-in material-checkbox-input one" name="menu[]" value="<?php echo e($menu->id); ?>" id="checkbox<?php echo e($menu->id); ?>">
                        <label for="checkbox<?php echo e($menu->id); ?>" class="material-checkbox"></label>
                      </div>
                      <?php echo e($menu->name); ?>

                    </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              <?php endif; ?>
            </div>
            <div class="form-group<?php echo e($errors->has('screens') ? ' has-error' : ''); ?>">
                <?php echo Form::label('screens', __('adminstaticwords.Screens')); ?>

                <p class="inline info"> - <?php echo e(__('adminstaticwords.ScreensDescription')); ?></p>
                <?php echo Form::number('screens', null, ['class' => 'form-control', 'min' => '1', 'max' => '4' ,'disabled="disabled']); ?>

                <small class="text-danger"><?php echo e($errors->first('screens')); ?></small>
            </div>

            <!-----------  for download limit ------------------>

            <div class="form-group<?php echo e($errors->has('download') ? ' has-error' : ''); ?>">
              <div class="row">
                <div class="col-xs-6">
                  <?php echo Form::label('download', __('adminstaticwords.DoYouWantDownloadLimit')); ?>

                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">
                    <?php echo Form::checkbox('download', 1, $package->download, ['class' => 'checkbox-switch seriescheck','id'=>'download_enable']); ?>

                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger"><?php echo e($errors->first('download')); ?></small>
              </div>
            </div>
            <small class="text-danger"><?php echo e($errors->first('downloadlimit')); ?></small>
            <div id="downloadlimit" class="form-group<?php echo e($errors->has('downloadlimit') ? ' has-error' : ''); ?>" style="<?php echo e($package->download != '' ? ""  : "display:none"); ?>">
                <?php echo Form::label('downloadlimit', __('adminstaticwords.DownloadLimit')); ?>

                <p class="inline info"> - <?php echo e(__('adminstaticwords.DoYouWantDownloadLimitDescription')); ?></p>
                <?php echo Form::number('downloadlimit', null, ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e(__('adminstaticwords.Note')); ?> :- <?php echo e(__('adminstaticwords.DownloadNote')); ?></small>
                
            </div>

            <!--------------- end download limit ------------------->
           
            <div class="form-group<?php echo e($errors->has('status') ? ' has-error' : ''); ?>">
                <?php echo Form::label('status', __('adminstaticwords.Status')); ?>

                <p class="inline info"> - <?php echo e(__('adminstaticwords.PleaseSelectStatus')); ?></p>
                <?php echo Form::select('status', array('0' => 'Inactive', '1' => 'Active'), null, ['class' => 'form-control select2', 'placeholde' => '']); ?>

                <small class="text-danger"><?php echo e($errors->first('status')); ?></small>
            </div>
            <div class="btn-group pull-right">
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> <?php echo e(__('adminstaticwords.Update')); ?></button>
            </div>
            <div class="clear-both"></div>
          <?php echo Form::close(); ?>

        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
 <script type="text/javascript">
    $(document).ready(function(){
      var check = [];
    
    $('.one').each(function(index){

      if($(this).is(':checked')){
        check.push(1);
      }else{
        check.push(0);
      }

    });
   console.log(check);
    var flag = 1;

    if (jQuery.inArray(0, check) == -1) {
            flag = 1;

        } else {
            flag = 0;
        }

     if(flag == 0){
      $('.all').prop('checked',false);
     }else{
       $('.all').prop('checked',true);
     }

  });

    // if one checkbox is unchecked remove checked on all menu option

    $(".one").click(function(){
      if($(this).is(':checked'))
      {
       
        var checked = [];
       $('.one').each(function(){
        if($(this).is(':checked')){
          checked.push(1);
        }else{
          checked.push(0);
        }
       })
       
       var flag = 1;

    if (jQuery.inArray(0, checked) == -1) {
            flag = 1;

        } else {
            flag = 0;
        }

       if(flag == 0){
        $('.all').prop('checked',false);
       }else{
         $('.all').prop('checked',true);
       }
      }
      else{
        
        $('.all').prop('checked',false);
      }
    });

// when click all menu  option all checkbox are checked

    $(".all").click(function(){
      if($(this).is(':checked')){
        $('.one').prop('checked',true);
      }
      else{
        $('.one').prop('checked',false);
      }
    })

  </script>
  <script>
    $('#download_enable').on('change',function(){
      if($('#download_enable').is(':checked')){
        //show
        $('#downloadlimit').show();
      }else{
        //hide
         $('#downloadlimit').hide();
      }
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/package/edit.blade.php ENDPATH**/ ?>
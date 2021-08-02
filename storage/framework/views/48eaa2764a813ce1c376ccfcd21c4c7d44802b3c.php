
<?php $__env->startSection('title',__('adminstaticwords.Edit')." "." - $liveevent->title"); ?>
<style type="text/css">
    body{
            background-color: #efefef;
        }
        .container-4 input#hyv-search {
            width: 500px;
            height: 30px;
            border: 1px solid #c6c6c6;
            font-size: 10pt;
            float: left;
            padding-left: 15px;
            -webkit-border-top-left-radius: 5px;
            -webkit-border-bottom-left-radius: 5px;
            -moz-border-top-left-radius: 5px;
            -moz-border-bottom-left-radius: 5px;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }
         .container-4 input#vimeo-search {
            width: 500px;
            height: 30px;
            border: 1px solid #c6c6c6;
            font-size: 10pt;
            float: left;
            padding-left: 15px;
            -webkit-border-top-left-radius: 5px;
            -webkit-border-bottom-left-radius: 5px;
            -moz-border-top-left-radius: 5px;
            -moz-border-bottom-left-radius: 5px;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }
        .container-4 button.icon {
            height: 30px;
            background: #f0f0f0 url('images/searchicon.png') 10px 1px no-repeat;
            background-size: 24px;
            -webkit-border-top-right-radius: 5px;
            -webkit-border-bottom-right-radius: 5px;
            -moz-border-radius-topright: 5px;
            -moz-border-radius-bottomright: 5px;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
            border: 1px solid #c6c6c6;
            width: 50px;
            margin-left: -44px;
            color: #4f5b66;
            font-size: 10pt;
        }
    
</style>
<?php $__env->startSection('content'); ?>
<div class="admin-form-main-block">
  <h4 class="admin-form-text"><a href="<?php echo e(url('admin/liveevent')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.GoBack')); ?>" class="btn-floating"><i class="material-icons">reply</i></a> <?php echo e(__('adminstaticwords.EditLiveEvent')); ?></h4>
  <div class="row">
    <div class="col-md-6">
     <div class="admin-form-block z-depth-1">
      
      <!--vimeo API Modal -->

       <?php echo Form::model($liveevent, ['method' => 'PATCH', 'action' => ['LiveEventController@update',$liveevent->id], 'files' => true]); ?>


   

       <div id="movie_title" class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
        <?php echo Form::label('title', __('adminstaticwords.EventTitle')); ?>

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterLiveEventTitle')); ?>"></i>
        <input id="mv_t" type="text" class="form-control" name="title" value="<?php echo e($liveevent->title); ?>">
        <small class="text-danger"><?php echo e($errors->first('title')); ?></small>
      </div>

       

      
      <div class="form-group<?php echo e($errors->has('selecturl') ? ' has-error' : ''); ?>">
        <?php echo Form::label('selecturls',__('adminstaticwords.AddVideo')); ?>

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseSelectOneOfTheOptionsToAddVideo')); ?>"></i>
        <select class="form-control select2" id="selecturl" name="selecturl">
          <option></option>
          <?php if($liveevent['iframeurl']!=''): ?>
          <option value="iframeurl" selected=""><?php echo e(__('adminstaticwords.IFrameURL')); ?></option>
          <?php else: ?>
            <option value="iframeurl"><?php echo e(__('adminstaticwords.IFrameURL')); ?></option>
          <?php endif; ?>
          
      
           <?php if($liveevent['ready_url']!=''): ?>
           <option value="customurl" selected=""><?php echo e(__('adminstaticwords.CustomURLYoutubeURLVimeoURL')); ?></option>
            <?php else: ?>
             <option value="customurl"><?php echo e(__('adminstaticwords.CustomURLYoutubeURLVimeoURL')); ?></option>
          <?php endif; ?>
       
        </select>
       
        <small class="text-danger"><?php echo e($errors->first('selecturl')); ?></small>
      </div>      
      <div id="ifbox"  style="<?php echo e($liveevent['iframeurl']!='' ? '' : "display: none"); ?>" class="form-group">
        <label for="iframeurl"><?php echo e(__('adminstaticwords.IFRAMEURL')); ?>: </label> <a data-toggle="modal" data-target="#embdedexamp"><i class="fa fa-question-circle-o"> </i></a>
        <input  type="text" value="<?php echo e($liveevent['iframeurl']); ?>" class="form-control" name="iframeurl" placeholder="<?php echo e(__('adminstaticwords.IframeURL')); ?>">
      </div>

   

      
      <div id="ready_url" style="<?php echo e($liveevent['ready_url']!='' ? '' : "display: none"); ?>" class="form-group<?php echo e($errors->has('ready_url') ? ' has-error' : ''); ?>">
       <label id="ready_url_text"></label>
       <p class="inline info"> <?php echo e(__('adminstaticwords.PleaseEnterYourVideoUrl')); ?></p>
       <?php echo Form::text('ready_url',$liveevent['ready_url'], ['class' => 'form-control','id'=>'apiUrl']); ?>

       <small class="text-danger"><?php echo e($errors->first('ready_url')); ?></small>
     </div>
    

    

  
      <div class="form-group" style="display: none">
        <div class="row">
          <div class="col-xs-6">
            <?php echo Form::label('', 'Choose custom thumbnail & poster'); ?>

          </div>
          <div class="col-xs-5 pad-0">
            <label class="switch for-custom-image">
              <?php echo Form::checkbox('', 1, 1, ['class' => 'checkbox-switch']); ?>

              <span class="slider round"></span>
            </label>
          </div>
        </div>
      </div>
      <div class="upload-image-main-block">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group<?php echo e($errors->has('thumbnail') ? ' has-error' : ''); ?> input-file-block">
              <?php echo Form::label('thumbnail',__('adminstaticwords.Thumbnail')); ?> - <p class="info"><?php echo e(__('adminstaticwords.HelpBlockText')); ?></p>
              <?php echo Form::file('thumbnail', ['class' => 'input-file', 'id'=>'thumbnail']); ?>

              <label for="thumbnail" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.Thumbnail')); ?>">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName"><?php echo e(__('adminstaticwords.ChooseAFile')); ?></span>
              </label>
              <p class="info"><?php echo e(__('adminstaticwords.ChooseCustomThumbnail')); ?></p>
              <small class="text-danger"><?php echo e($errors->first('thumbnail')); ?></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group<?php echo e($errors->has('poster') ? ' has-error' : ''); ?> input-file-block">
              <?php echo Form::label('poster', __('adminstaticwords.Poster')); ?> - <p class="info"><?php echo e(__('adminstaticwords.HelpBlockText')); ?></p>
              <?php echo Form::file('poster', ['class' => 'input-file', 'id'=>'poster']); ?>

              <label for="poster" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.Poster')); ?>">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName"><?php echo e(__('adminstaticwords.ChooseAFile')); ?></span>
              </label>
              <p class="info"><?php echo e(__('adminstaticwords.ChooseCustomPoster')); ?></p>
              <small class="text-danger"><?php echo e($errors->first('poster')); ?></small>
            </div>
          </div>
        </div>
      </div>
           
      <div class="menu-block">
        <h6 class="menu-block-heading"><?php echo e(__('adminstaticwords.PleaseSelectMenu')); ?></h6>
        <?php if(isset($menus) && count($menus) > 0): ?>
        <ul>
          <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li>
            <div class="inline">
              <?php
              $checked = null;
              if (isset($menu->menu_data) && count($menu->menu_data) > 0) {
                if ($menu->menu_data->where('movie_id', $liveevent->id)->where('menu_id', $menu->id)->first() != null) {
                  $checked = 1;
                }
              }
              ?>
              <?php if($checked == 1): ?>
              <input type="checkbox" class="filled-in material-checkbox-input" name="menu[]" value="<?php echo e($menu->id); ?>" id="checkbox<?php echo e($menu->id); ?>" checked>
              <label for="checkbox<?php echo e($menu->id); ?>" class="material-checkbox"></label>
              <?php else: ?>
              <input type="checkbox" class="filled-in material-checkbox-input" name="menu[]" value="<?php echo e($menu->id); ?>" id="checkbox<?php echo e($menu->id); ?>">
              <label for="checkbox<?php echo e($menu->id); ?>" class="material-checkbox"></label>
              <?php endif; ?>
            </div>
            <?php echo e($menu->name); ?>

          </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <?php endif; ?>
      </div>
            
      <div class="form-group<?php echo e($errors->has('start_time') ? ' has-error' : ''); ?>">
        <?php echo Form::label('start_time',__('adminstaticwords.EventStartTime')); ?>

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseSelectStartTime')); ?>"></i>
         <input type="datetime-local" name="start_time" class="form-contrrol" value="<?php echo e(date('Y:m:d H:i:s',strtotime($liveevent->start_time))); ?>" >
        <small class="text-danger"><?php echo e($errors->first('start_time')); ?></small>
      </div>
       <div class="form-group<?php echo e($errors->has('end_time') ? ' has-error' : ''); ?>">
        <?php echo Form::label('end_time', __('adminstaticwords.EventEndTime')); ?>

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseSelectEndTime')); ?>"></i>
         <input type="datetime-local" name="end_time" class="form-contrrol" value="<?php echo e($liveevent->end_time); ?>" >
        <small class="text-danger"><?php echo e($errors->first('end_time')); ?></small>
      </div>  
 
       <div class="form-group<?php echo e($errors->has('organized_by') ? ' has-error' : ''); ?>">
        <?php echo Form::label('organized_by', __('adminstaticwords.EventOrganizedBy')); ?>

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterOrganizedBy')); ?> "></i>
        <?php echo Form::text('organized_by',  $liveevent->organized_by, ['class' => 'form-control', ]); ?>

        <small class="text-danger"><?php echo e($errors->first('organized_by')); ?></small>
      </div>
      
       
       <div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
         <?php echo Form::label('description',__('adminstaticwords.Description')); ?>

         <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterLiveEventDescription')); ?>"></i>
         <?php echo Form::textarea('description', null, ['class' => 'form-control materialize-textarea', 'rows' => '5']); ?>

         <small class="text-danger"><?php echo e($errors->first('description')); ?></small>
       </div>

        <div class="form-group<?php echo e($errors->has('status') ? ' has-error' : ''); ?>">
          <div class="row">
            <div class="col-xs-6">
              <?php echo Form::label('status',__('adminstaticwords.Status')); ?>

            </div>
            <div class="col-xs-5 pad-0">
              <label class="switch">                
                <?php echo Form::checkbox('status', 1, $liveevent->status, ['class' => 'checkbox-switch']); ?>

                <span class="slider round"></span>
              </label>
            </div>
          </div>
          <div class="col-xs-12">
            <small class="text-danger"><?php echo e($errors->first('status')); ?></small>
          </div>
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


</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
<script>
  $(document).ready(function(){
     $('#ifbox').show();
    $('#selecturl').change(function(){  
     selecturl = document.getElementById("selecturl").value;
     if (selecturl == 'iframeurl') {
        $('#ifbox').show();
        $('#ready_url').hide();

      }else if(selecturl=='customurl'){
       $('#ifbox').hide();
       $('#ready_url').show();
       $('#ready_url_text').text('Enter Custom URL orm M3U8 URL');
   }
   
});
    
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/liveevent/edit.blade.php ENDPATH**/ ?>
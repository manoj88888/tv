
<?php $__env->startSection('title',__('adminstaticwords.Edit')." "." - $audio->title"); ?>
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
  <h4 class="admin-form-text"><a href="<?php echo e(url('admin/audio')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.GoBack')); ?>" class="btn-floating"><i class="material-icons">reply</i></a> <?php echo e(__('adminstaticwords.EditAudio')); ?></h4>
  <div class="row">
    <div class="col-md-6">
     <div class="admin-form-block z-depth-1">
       <?php echo Form::model($audio, ['method' => 'PATCH', 'action' => ['AudioController@update',$audio->id], 'files' => true]); ?>


      <div id="movie_title" class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
        <?php echo Form::label('title', __('adminstaticwords.AudioTitle')); ?>

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.EnterAudioTitle')); ?>"></i>
        <input  type="text" class="form-control" name="title" value="<?php echo e($audio->title); ?>">
        <small class="text-danger"><?php echo e($errors->first('title')); ?></small>
      </div>
         <div class="form-group<?php echo e($errors->has('selecturl') ? ' has-error' : ''); ?>">
          <?php echo Form::label('selecturls', __('adminstaticwords.AddAudio')); ?>

          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseSelectOneOfTheOptionsToAddAudio')); ?>"></i>
           <select class="form-control select2" id="selecturl" name="selecturl">
         
            <?php if($audio['audiourl']!=''): ?>
            <option value="audiourl" selected=""><?php echo e(__('adminstaticwords.AudioURL')); ?></option>
            <?php else: ?>
              <option value="audiourl"><?php echo e(__('adminstaticwords.AudioURL')); ?></option>
            <?php endif; ?>
            
           
             <?php if($audio['upload_audio']!=''): ?>
             <option value="upload_audio" selected=""><?php echo e(__('adminstaticwords.UploadAudio')); ?></option>
              <?php else: ?>
               <option value="upload_audio"><?php echo e(__('adminstaticwords.UploadAudio')); ?></option>
            <?php endif; ?>
            

           
          </select>
           <small class="text-danger"><?php echo e($errors->first('selecturl')); ?></small>
         </div>


         <div id="ifbox" style="<?php echo e($audio['audiourl']!='' ? '' : "display: none"); ?>" class="form-group">
          <label for="audiourl"><?php echo e(__('adminstaticwords.AudioURL:')); ?> </label> <a data-toggle="modal" data-target="#embdedexamp"><i class="fa fa-question-circle-o"> </i></a>
          <input  type="text" class="form-control" name="audiourl" placeholder="" value="<?php echo e($audio['audiourl']); ?>">
        </div>

         

       
      <div style="<?php echo e($audio['upload_audio']!='' ? '' : "display: none"); ?>"class="form-group<?php echo e($errors->has('upload_audio') ? ' has-error' : ''); ?> input-file-block" id="uploadaudio" >
        <?php echo Form::label('upload_audio',__('adminstaticwords.UploadAudio')); ?> - <p class="info"><?php echo e(__('adminstaticwords.HelpBlockText')); ?></p>
        <?php echo Form::file('upload_audio', ['class' => 'input-file', 'id'=>'upload_audio']); ?>

        <label for="upload_audio" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.UploadAudio')); ?>">
          <i class="icon fa fa-check"></i>
          <span class="js-fileName"><?php echo e(__('adminstaticwords.ChooseAFile')); ?></span>
        </label>
        <p class="info"><?php echo e(__('adminstaticwords.ChooseCustomUploadAudio')); ?></p>
        <small class="text-danger"><?php echo e($errors->first('upload_audio')); ?></small>
      </div>
     

     <div class="form-group<?php echo e($errors->has('a_language') ? ' has-error' : ''); ?>">
      <?php echo Form::label('a_language', __('adminstaticwords.AudioLanguages')); ?>

      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseSelectAudioLanguage')); ?>"></i>
      <div class="input-group">
        <?php echo Form::select('a_language[]', $a_lans, null, ['class' => 'form-control select2', 'multiple']); ?>

        <a href="#" data-toggle="modal" data-target="#AddLangModal" class="input-group-addon"><i class="material-icons left">add</i></a>
      </div>
      <small class="text-danger"><?php echo e($errors->first('a_language')); ?></small>
    </div>
    <div class="form-group<?php echo e($errors->has('maturity_rating') ? ' has-error' : ''); ?>">
      <?php echo Form::label('maturity_rating', __('adminstaticwords.MaturityRating')); ?>

      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseSelectMaturityRating')); ?>"></i>
      <?php echo Form::select('maturity_rating', array('all age' => __('adminstaticwords.AllAge'), '13+' =>'13+', '16+' => '16+', '18+'=>'18+'), null, ['class' => 'form-control select2']); ?>

      <small class="text-danger"><?php echo e($errors->first('maturity_rating')); ?></small>
    </div>
    <div class="form-group" style="display: none">
      <div class="row">
        <div class="col-xs-6">
          <?php echo Form::label('', __('adminstaticwords.ChooseCustomThumbnailAndPoster')); ?>

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
            <?php echo Form::label('thumbnail', __('adminstaticwords.Thumbnail')); ?> - <p class="info"><?php echo e(__('adminstaticwords.HelpBlockText')); ?></p>
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

            <label for="poster" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title=<?php echo e(__('adminstaticwords.Poster')); ?>>
              <i class="icon fa fa-check"></i>
              <span class="js-fileName"><?php echo e(__('adminstaticwords.ChooseAFile')); ?></span>
            </label>
            <p class="info"><?php echo e(__('adminstaticwords.ChooseCustomPoster')); ?></p>
            <small class="text-danger"><?php echo e($errors->first('poster')); ?></small>
          </div>
        </div>
      </div>
    </div>

    
    
    <div class="form-group<?php echo e($errors->has('featured') ? ' has-error' : ''); ?>">
      <div class="row">
        <div class="col-xs-6">
          <?php echo Form::label('featured',__('adminstaticwords.Featured')); ?>

        </div>
        <div class="col-xs-5 pad-0">
          <label class="switch">
            <?php echo Form::checkbox('featured', 1, 0, ['class' => 'checkbox-switch']); ?>

            <span class="slider round"></span>
          </label>
        </div>
      </div>
      <div class="col-xs-12">
        <small class="text-danger"><?php echo e($errors->first('featured')); ?></small>
      </div>
    </div>

    <div class="form-group<?php echo e($errors->has('is_protect') ? ' has-error' : ''); ?>">
      <div class="row">
        <div class="col-xs-6">
          <?php echo Form::label('is_protect', __('adminstaticwords.ProtectedVideo?')); ?>

        </div>
        <div class="col-xs-5 pad-0">
          <label class="switch">
            <input type="checkbox" name="is_protect" class="checkbox-switch" id="is_protect">
            <span class="slider round"></span>
          </label>
        </div>
      </div>
      <div class="col-xs-12">
        <small class="text-danger"><?php echo e($errors->first('is_protect')); ?></small>
      </div>
    </div>
    <div class="search form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?> is_protect" style="display: none;">
      <?php echo Form::label('password', __('adminstaticwords.ProtectedPasswordForVideo')); ?>

      <?php echo Form::password('password', null, ['class' => 'form-control','id'=>'password']); ?>

      <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
      <small class="text-danger"><?php echo e($errors->first('password')); ?></small>
    </div>



      <div class="form-group">
        <label for=""><?php echo e(__('adminstaticwords.MetaKeyword:')); ?> </label>
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.EnterMetaKeyword')); ?>"></i>
        <input name="keyword" type="text" class="form-control" data-role="tagsinput"/>
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
                if ($menu->menu_data->where('audio_id', $audio->id)->where('menu_id', $menu->id)->first() != null) {
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
  
      <div class="form-group<?php echo e($errors->has('rating') ? ' has-error' : ''); ?>">
        <?php echo Form::label('rating', __('adminstaticwords.Ratings')); ?>

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterRatings')); ?> eg:8"></i>
        <?php echo Form::text('rating',  null, ['class' => 'form-control', ]); ?>

        <small class="text-danger"><?php echo e($errors->first('rating')); ?></small>
      </div>
          
      <div class="form-group<?php echo e($errors->has('genre_id') ? ' has-error' : ''); ?>">
       <?php echo Form::label('genre_id', __('adminstaticwords.Genre')); ?>

       <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseSelectGenres')); ?>"></i>
       <div class="input-group">
          <select name="genre_id[]" id="genre_id" class="form-control select2" multiple="multiple">
            <?php if(isset($old_genre) && count($old_genre) > 0): ?>
            <?php $__currentLoopData = $old_genre; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $old): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($old->id); ?>" selected="selected"><?php echo e($old->name); ?></option> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php if(isset($genre_ls)): ?>
            <?php $__currentLoopData = $genre_ls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($rest->id); ?>"><?php echo e($rest->name); ?></option> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </select>  
          <a href="#" data-toggle="modal" data-target="#AddGenreModal" class="input-group-addon"><i class="material-icons left">add</i></a>
        </div>
        <small class="text-danger"><?php echo e($errors->first('genre_id')); ?></small>
      </div>
      <div class="form-group<?php echo e($errors->has('detail') ? ' has-error' : ''); ?>">
         <?php echo Form::label('detail', __('adminstaticwords.Description')); ?>

         <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterAudioDescription')); ?>"></i>
         <?php echo Form::textarea('detail', null, ['class' => 'form-control materialize-textarea', 'rows' => '5']); ?>

         <small class="text-danger"><?php echo e($errors->first('detail')); ?></small>
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



<!-- Add Language Modal -->
<div id="AddLangModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><?php echo e(__('adminstaticwords.AddLanguage')); ?></h5>
      </div>
      <?php echo Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@store']); ?>

      <div class="modal-body">
        <div class="form-group<?php echo e($errors->has('language') ? ' has-error' : ''); ?>">
          <?php echo Form::label('language', __('adminstaticwords.Language')); ?>

          <?php echo Form::text('language', null, ['class' => 'form-control', 'required' => 'required']); ?>

          <small class="text-danger"><?php echo e($errors->first('language')); ?></small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group pull-right">
          <button type="reset" class="btn btn-info"><?php echo e(__('adminstaticwords.Reset')); ?></button>
          <button type="submit" class="btn btn-success"><?php echo e(__('adminstaticwords.Create')); ?></button>
        </div>
      </div>
      <?php echo Form::close(); ?>

    </div>
  </div>
</div>


<!-- Add Genre Modal -->
<div id="AddGenreModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><?php echo e(__('adminstaticwords.AddGenre')); ?></h5>
      </div>
      <?php echo Form::open(['method' => 'POST', 'action' => 'GenreController@store']); ?>

      <div class="modal-body admin-form-block">
        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
          <?php echo Form::label('name', __('adminstaticwords.Name')); ?>

          <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => 'required']); ?>

          <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group pull-right">
          <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> <?php echo e(__('adminstaticwords.Reset')); ?></button>
          <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> <?php echo e(__('adminstaticwords.Create')); ?></button>
        </div>
      </div>
      <div class="clear-both"></div>
      <?php echo Form::close(); ?>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
<script>
  $(document).ready(function(){
   
    $('#selecturl').change(function(){  
     selecturl = document.getElementById("selecturl").value;
     if (selecturl == 'audiourl') {
    $('#ifbox').show();
    $('#uploadaudio').hide();
    


  }else if (selecturl == 'upload_audio') {
   $('#uploadaudio').show();
   $('#ifbox').hide();
   

 }

});
 
  $('input[name="is_protect"]').click(function(){
    if($(this).prop("checked") == true){
      $('.is_protect').fadeIn();
    }
    else if($(this).prop("checked") == false){
      $('.is_protect').fadeOut();
    }
  });
   
  });
</script>



<script type="text/javascript">
    $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/audio/edit.blade.php ENDPATH**/ ?>
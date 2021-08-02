
<?php $__env->startSection('title',__('adminstaticwords.AllMultipleLinks')); ?>
<?php $__env->startSection('content'); ?>

<div class="modal fade" id="multiplelinkadd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('adminstaticwords.AddMultipleLinks')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <?php echo Form::open(['method' => 'POST', 'action' => ['MovieController@storelink',$id]]); ?>

          <div class="form-group<?php echo e($errors->has('download') ? ' has-error' : ''); ?> switch-main-block">
            <div class="row">
              <div class="col-xs-5">
                <?php echo Form::label('download', __('adminstaticwords.DoYouWantToDownloadLink?')); ?>

              </div>
              <div class="col-xs-5 pad-0">
                <label class="switch">                
                  <?php echo Form::checkbox('download', 1, 1, ['class' => 'checkbox-switch']); ?>

                  <span class="slider round"></span>
                </label>
              </div>
            </div>
            <div class="col-xs-12">
              <small class="text-danger"><?php echo e($errors->first('download')); ?></small>
            </div>
          </div>
          <div class="form-group<?php echo e($errors->has('quality') ? ' has-error' : ''); ?>">
                <?php echo Form::label('quality', __('adminstaticwords.Quality')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.EnterQuality')); ?> eg:HD"></i>
                <?php echo Form::text('quality', null, ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('adminstaticwords.EnterQuality')]); ?>

                <small class="text-danger"><?php echo e($errors->first('quality')); ?></small>
          </div>
           <div class="form-group<?php echo e($errors->has('size') ? ' has-error' : ''); ?>">
                <?php echo Form::label('size', __('adminstaticwords.Size')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.EnterSizeOfLink')); ?> eg:10 MB"></i>
                <?php echo Form::text('size', null, ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('adminstaticwords.EnterSizeOfLink')]); ?>

                <small class="text-danger"><?php echo e($errors->first('size')); ?></small>
          </div>
           <div class="form-group<?php echo e($errors->has('language') ? ' has-error' : ''); ?>">
              <?php echo Form::label('language', __('adminstaticwords.Languages')); ?>

              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseSelectLanguage')); ?>"></i>
              <div class="input-group cd-md-12" style="width:100%">
                
                <select name="language[]" id="" class="select2" multiple="multiple">
                  <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($lang->id); ?>"><?php echo e($lang->language); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
               
              </div>
              <small class="text-danger"><?php echo e($errors->first('language')); ?></small>
            </div>
          <div class="form-group<?php echo e($errors->has('url') ? ' has-error' : ''); ?>">
                <?php echo Form::label('url', __('UrlAndLinks')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" <?php echo e(__('adminstaticwords.PleaseEnterYourDownlodLink')); ?>eg:Arrow"></i>
                <?php echo Form::url('url', null, ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('adminstaticwords.PleaseEnterYourDownlodLink')]); ?>

                <small class="text-danger"><?php echo e($errors->first('url')); ?></small>
          </div>
          
              
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> <?php echo e(__('adminstaticwords.Reset')); ?></button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> <?php echo e(__('adminstaticwords.AddLinks')); ?> </button>
            </div>
            <div class="clear-both"></div>
          <?php echo Form::close(); ?>

      </div>
    
    </div>
  </div>
</div>

  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="#" class="btn btn-danger btn-md" data-toggle="modal" data-target="#multiplelinkadd"><i class="material-icons left">add</i> <?php echo e(__('adminstaticwords.CreateMultipleLinks')); ?></a>
    </div>
    <div class="content-block box-body table-responsive">
      <table id="audio_languageTable" class="table table-hover">
        <thead>
          <tr class="table-heading-row">
          <th>
            <div class="inline">
              <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
              <label for="checkboxAll" class="material-checkbox"></label>
            </div>
            
          </th>
          <th><?php echo e(__('adminstaticwords.Movie')); ?></th>
          <th><?php echo e(__('adminstaticwords.UrlAndLinks')); ?></th>
          <th><?php echo e(__('adminstaticwords.Quality')); ?></th>
          <th><?php echo e(__('adminstaticwords.Size')); ?></th>
          <th><?php echo e(__('adminstaticwords.Language')); ?></th>
          <th><?php echo e(__('adminstaticwords.Visits')); ?></th>
          <th><?php echo e(__('adminstaticwords.Downlodable')); ?></th>
          <th><?php echo e(__('adminstaticwords.User')); ?></th>
          <th><?php echo e(__('adminstaticwords.Added')); ?></th>
          <th><?php echo e(__('adminstaticwords.Action')); ?></th>

        </tr>
        </thead>
       <?php if(isset($links)): ?>
          <tbody>
            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
             
              $lang = App\AudioLanguage::where('id',$link->language)->first();
            ?>
            <tr>
              <td><?php echo e($key+1); ?></td>
              <td><?php echo e($link->movie['title']); ?></td>
              <td><?php echo e($link->url); ?></td>
              <td><?php echo e($link->quality); ?></td>
              <td><?php echo e($link->size); ?></td>
            <td><?php if(isset($lang)): ?><?php echo e($lang->language); ?> <?php else: ?> - <?php endif; ?></td>
              <td><?php echo e($link->clicks); ?></td>
              <td><?php echo e($link->download == 1 ? "YES" : "NO"); ?></td>
              <td><?php echo e($link->movie->user->name); ?></td>
              <td><?php echo e($link->created_at); ?></td>
              <td>  <a data-original-title="Edit" class="btn-info btn-floating" data-toggle="modal" data-target="#multiplelinkedit"><i class="material-icons">mode_edit</i></a>
                <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal<?php echo e($link->id); ?>"><i class="material-icons">delete</i> </button>
              </td>

              <div id="deleteModal<?php echo e($link->id); ?>"  class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading"><?php echo e(__('adminstaticwords.AreYouSure')); ?></h4>
                      <p><?php echo e(__('adminstaticwords.DeleteWarrnig')); ?></p>
                      </div>
                      <div class="modal-footer">
                      <form method="POST" action=<?php echo e(route("movies.deletelink", $link->id)); ?>>
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('DELETE')); ?>

                      <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal"><?php echo e(__('adminstaticwords.No')); ?></button>
                      <button type="submit" class="btn btn-danger"><?php echo e(__('adminstaticwords.Yes')); ?></button>
                      </form>
                      </div>
                    </div>
                  </div>
              </div>

            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        <?php endif; ?>
      </table>
    </div>
  </div>
 <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<div class="modal fade" id="multiplelinkedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('adminstaticwords.EditMultipleLinks')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <?php echo Form::model($link,['method' => 'PATCH', 'action' => ['MovieController@editlink',$link->id]]); ?>

          <div class="form-group<?php echo e($errors->has('download') ? ' has-error' : ''); ?> switch-main-block">
            <div class="row">
              <div class="col-xs-4">
                <?php echo Form::label('download', __('adminstaticwords.DoYouWantToDownloadLink')); ?>

              </div>
              <div class="col-xs-5 pad-0">
                <label class="switch">                
                  <?php echo Form::checkbox('download', 0,1, ['class' => 'checkbox-switch']); ?>

                  <span class="slider round"></span>
                </label>
              </div>
            </div>
            <div class="col-xs-12">
              <small class="text-danger"><?php echo e($errors->first('download')); ?></small>
            </div>
          </div>
          <div class="form-group<?php echo e($errors->has('quality') ? ' has-error' : ''); ?>">
                <?php echo Form::label('quality',__('adminstaticwords.Quality')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.EnterQuality')); ?>  eg:HD"></i>
                <?php echo Form::text('quality',null, ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('adminstaticwords.EnterQuality')]); ?>

                <small class="text-danger"><?php echo e($errors->first('quality')); ?></small>
          </div>
           <div class="form-group<?php echo e($errors->has('size') ? ' has-error' : ''); ?>">
                <?php echo Form::label('size', __('adminstaticwords.Size')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.EnterSizeOfLink ')); ?>eg:10 MB"></i>
                <?php echo Form::text('size', null,['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('adminstaticwords.EnterSizeOfLink ')]); ?>

                <small class="text-danger"><?php echo e($errors->first('size')); ?></small>
          </div>
          <div class="form-group<?php echo e($errors->has('language') ? ' has-error' : ''); ?>">
              <?php echo Form::label('language', __('adminstaticwords.Languages')); ?>

              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseSelectLanguage')); ?>"></i>
              <div class="input-group cd-md-12" style="width:100%">
                
                <select name="language[]" id="" class="select2" multiple="multiple">
                  <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  
                      <option <?php if(!empty($link->language)): ?> <?php $__currentLoopData = $link->language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($a == $lang->id ? "selected" : ""); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?> value="<?php echo e($lang->id); ?>"><?php echo e($lang->language); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
               
              </div>
              <small class="text-danger"><?php echo e($errors->first('language')); ?></small>
            </div>
          <div class="form-group<?php echo e($errors->has('url') ? ' has-error' : ''); ?>">
                <?php echo Form::label('url', __('adminstaticwords.UrlAndLinks')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.EnterDownloadLink')); ?> eg:Arrow"></i>
                <?php echo Form::url('url',null, ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required']); ?>

                <small class="text-danger"><?php echo e($errors->first('url')); ?></small>
          </div>
          
              
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> <?php echo e(__('adminstaticwords.Reset')); ?></button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i><?php echo e(__('adminstaticwords.Update')); ?></button>
            </div>
            <div class="clear-both"></div>
          <?php echo Form::close(); ?>

      </div>
      
    </div>
  </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/movie/link.blade.php ENDPATH**/ ?>
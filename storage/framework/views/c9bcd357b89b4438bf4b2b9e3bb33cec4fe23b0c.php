
<?php $__env->startSection('title',"Edit $tvseries->title"); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
  	<h4 class="admin-form-text"><a href="<?php echo e(url('admin/tvseries')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.GoBack')); ?>" class="btn-floating"><i class="material-icons">reply</i></a> <?php echo e(__('adminstaticwords.EditTvSeries')); ?></h4>
    <div class="row">
      <div class="col-md-6">
      	<div class="admin-form-block z-depth-1">
	        <?php echo Form::model($tvseries, ['method' => 'PATCH', 'action' => ['TvSeriesController@update',$tvseries->id], 'files' => true]); ?>

						<div class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
							<?php echo Form::label('title', __('adminstaticwords.SeriesTitle')); ?>

              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.EnterTvseriesTitle')); ?> eg:Arrow"></i>
							<?php echo Form::text('title', null, ['class' => 'form-control']); ?>

							<small class="text-danger"><?php echo e($errors->first('title')); ?></small>
						</div>
            
             <div class="form-group">
              
              <label for=""><?php echo e(__('adminstaticwords.MetaKeyword')); ?>: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMetaKeyword')); ?>"></i>
              <input name="keyword" value="<?php echo e($tvseries->keyword); ?>" type="text" class="form-control" data-role="tagsinput"/>

               
             </div>

            <div class="form-group">
              <label for=""><?php echo e(__('adminstaticwords.MetaDescription')); ?>: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMetaDescription')); ?>"></i>
              <textarea name="description" id="" cols="30" rows="10" class="form-control"><?php echo e($tvseries->description); ?></textarea>
            </div>

            <div class="form-group<?php echo e($errors->has('maturity_rating') ? ' has-error' : ''); ?>">
              <?php echo Form::label('maturity_rating', __('adminstaticwords.MaturityRating')); ?>

              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseSelectMaturityRating')); ?>"></i>
              <?php echo Form::select('maturity_rating', array('all age' => __('adminstaticwords.AllAge'), '13+' =>'13+', '16+' => '16+', '18+'=>'18+'), null, ['class' => 'form-control select2']); ?>

              <small class="text-danger"><?php echo e($errors->first('maturity_rating')); ?></small>
            </div>
						<div class="form-group<?php echo e($errors->has('subtitle') ? ' has-error' : ''); ?>">
							<div class="row">
								<div class="col-xs-6">
									<?php echo Form::label('', __('adminstaticwords.ChooseCustomThumbnailAndPoster')); ?>

								</div>
								<div class="col-xs-5 pad-0">
									<label class="switch for-custom-image">
										<?php echo Form::checkbox('', 1, 0, ['class' => 'checkbox-switch']); ?>

										<span class="slider round"></span>
									</label>
								</div>
							</div>
							<div class="col-xs-12">
								<small class="text-danger"><?php echo e($errors->first('subtitle')); ?></small>
							</div>
						</div>
						<div class="upload-image-main-block">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group<?php echo e($errors->has('thumbnail') ? ' has-error' : ''); ?> input-file-block">
                    <?php echo Form::label('thumbnail',__('adminstaticwords.Thumbnail')); ?> - <p class="inline info"><?php echo e(__('adminstaticwords.HelpBlockText')); ?></p>
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
                    <?php echo Form::label('poster',__('adminstaticwords.Poster')); ?> - <p class="inline info"><?php echo e(__('adminstaticwords.HelpBlockText')); ?></p>
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
						<div class="form-group<?php echo e($errors->has('featured') ? ' has-error' : ''); ?>">
							<div class="row">
								<div class="col-xs-6">
									<?php echo Form::label('featured', __('adminstaticwords.Featured')); ?>

								</div>
								<div class="col-xs-5 pad-0">
									<label class="switch">
										<?php echo Form::checkbox('featured', 1, ($tvseries->featured == 1 ? 1 : 0), ['class' => 'checkbox-switch']); ?>

										<span class="slider round"></span>
									</label>
								</div>
							</div>
							<div class="col-xs-12">
								<small class="text-danger"><?php echo e($errors->first('featured')); ?></small>
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
                            if ($menu->menu_data->where('tv_series_id', $tvseries->id)->where('menu_id', $menu->id)->first() != null) {
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
						<div class="switch-field">
							<div class="switch-title"><?php echo e(__('adminstaticwords.WantTMDBRatingsAndMoreOrCustom')); ?>?</div>
							<input type="radio" id="switch_left" class="imdb_btn" name="tmdb" value="Y" <?php echo e($tvseries->tmdb == 'Y' ? 'checked' : ''); ?>/>
							<label for="switch_left"><?php echo e(__('adminstaticwords.TMDB')); ?></label>
							<input type="radio" id="switch_right" class="custom_btn" name="tmdb" value="N" <?php echo e($tvseries->tmdb != 'Y' ? 'checked' : ''); ?>/>
							<label for="switch_right"><?php echo e(__('adminstaticwords.Custom')); ?></label>
						</div>
						<div id="custom_dtl" class="custom-dtl">
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
							<div class="form-group<?php echo e($errors->has('rating') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('rating', __('adminstaticwords.Ratings')); ?>

                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseSelectRating')); ?> eg:5.8"></i>
                  <?php echo Form::text('rating', null, ['class' => 'form-control']); ?>

                  <small class="text-danger"><?php echo e($errors->first('rating')); ?></small>
              </div>
							<div class="form-group<?php echo e($errors->has('detail') ? ' has-error' : ''); ?>">
								<?php echo Form::label('detail', __('adminstaticwords.Description')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterTvseriesDescription')); ?>"></i>
								<?php echo Form::textarea('detail', null, ['class' => 'form-control materialize-textarea', 'rows' => '5']); ?>

								<small class="text-danger"><?php echo e($errors->first('detail')); ?></small>
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
  <!-- Add Actor Modal -->
  <div id="AddActorModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title">Add Actor</h5>
        </div>
        <?php echo Form::open(['method' => 'POST', 'action' => 'ActorController@store', 'files' => true]); ?>

          <div class="modal-body admin-form-block">
            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                <?php echo Form::label('name', 'Name'); ?>

                <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => 'required']); ?>

                <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('detail') ? ' has-error' : ''); ?>">
                <?php echo Form::label('detail', 'Description'); ?>

                <?php echo Form::textarea('detail', null, ['class' => 'form-control materialize-textarea', 'rows' => '5']); ?>

                <small class="text-danger"><?php echo e($errors->first('detail')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('image') ? ' has-error' : ''); ?> input-file-block">
              <?php echo Form::label('image', 'Director Image'); ?> - <p class="inline info">Help block text</p>
              <?php echo Form::file('image', ['class' => 'input-file', 'id'=>'image']); ?>

              <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Director pic">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName">Choose a File</span>
              </label>
              <p class="info">Choose custom image</p>
              <small class="text-danger"><?php echo e($errors->first('image')); ?></small>
            </div>
          </div>
          <div class="modal-footer">
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> Reset</button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Create</button>
            </div>
          </div>  
          <div class="clear-both"></div>
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
      if ($('.custom_btn').is(':checked')) {
        $('#custom_dtl').show();
      }
      $('.upload-image-main-block').hide();
      $('.for-custom-image input').click(function(){
        if($(this).prop("checked") == true){
          $('.upload-image-main-block').fadeIn();
        }
        else if($(this).prop("checked") == false){
          $('.upload-image-main-block').fadeOut();
        }
      });
    });
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/tvseries/edit.blade.php ENDPATH**/ ?>
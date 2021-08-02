
<?php $__env->startSection('title',__('adminstaticwords.Edit')." ". $menu->name); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="<?php echo e(url('admin/menu')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('adminstaticwords.GoBack')); ?>" class="btn-floating"><i class="material-icons">reply</i></a> <?php echo e(__('adminstaticwords.EditMenu')); ?></h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <?php echo Form::model($menu, ['method' => 'PATCH', 'action' => ['MenuController@update', $menu->id]]); ?>

            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                <?php echo Form::label('name', __('adminstaticwords.Name')); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterMenuName')); ?>eg:Home"></i>
                <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => 'required']); ?>

                <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
            </div>
            <?php if(count($menu->menusections)>0): ?>
             <div class="form-group" class="form-group<?php echo e($errors->has('section') ? ' has-error' : ''); ?>">
              <label><?php echo e(__('adminstaticwords.ChooseSection')); ?>: <span class="text-danger">*</span></label>
              <br>
              <small class="text-muted"> <i class="fa fa-question-circle"></i> <?php echo e(__('adminstaticwords.MenuWillContainFollowingSection')); ?></small>
              <br>
               <small class="text-muted"> <i class="fa fa-question-circle"></i> <?php echo e(__('adminstaticwords.AtleaseOneSectionIsRequired')); ?></small>


              <br><br>

              <label>
                <div class="inline">
                  <input <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 1): ?>  checked="checked" <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="1" id="recent_added" type="checkbox" class="filled-in" name="section[1]">
                  <label for="recent_added" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.RecentlyAdded')); ?> 
              </label>
              <br>

              <div style="<?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 1): ?> display:block <?php else: ?> display:none <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> " class="section1">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 1): ?> value="<?php echo e($section->item_limit); ?>" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> id="limit1" type="number" min="1" name="limit[1]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[1]" id="select1" class="form-control">
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 1 && $section->view == 1): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 1 && $section->view == 0): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[1]" id="select1" class="form-control">
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 1 && $section->order== 1): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 1 && $section->order == 0): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>

              <label>
                <div class="inline">
                  <input <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 2): ?>  checked="checked" <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="2" id="genre_added" type="checkbox" class="filled-in" name="section[2]">
                  <label for="genre_added" class="material-checkbox"></label>
                </div>
                Genre 
              </label>

               <div style="<?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 2): ?> display:block <?php else: ?> display:none <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> " class="section2">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 2): ?> value="<?php echo e($section->item_limit); ?>" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> id="limit2" type="number" min="1" name="limit[2]" class="form-control">
                  </div>

                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[2]" id="select2" class="form-control">
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 2 && $section->view == 1): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 2 && $section->view == 0): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[2]" id="select2" class="form-control">
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 2 && $section->order== 1): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 2 && $section->order == 0): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>
              <br>
              <label>
                <div class="inline">
                  <input <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 3): ?>  checked="checked" <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="3" id="featured" type="checkbox" class="filled-in" name="section[3]">
                  <label for="featured" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.Featured')); ?>

              </label>
               <div style="<?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 3): ?> display:block <?php else: ?> display:none <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> " class="section3">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 3): ?> value="<?php echo e($section->item_limit); ?>" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> id="limit3" type="number" min="1" name="limit[3]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[3]" id="select3" class="form-control">
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 3 && $section->view == 1): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 3 && $section->view == 0): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[3]" id="select3" class="form-control">
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 3 && $section->order== 1): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 3 && $section->order == 0): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>
                <br>
                
               <label>
                <div class="inline">
                  <input <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 4): ?>  checked="checked" <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="4" id="intrest" type="checkbox" class="filled-in" name="section[4]">
                  <label for="intrest" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.BestOnIntrest')); ?>

              </label>
               <div style="<?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 4): ?> display:block <?php else: ?> display:none <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> " class="section4">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 4): ?> value="<?php echo e($section->item_limit); ?>" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> id="limit4" type="number" min="1" name="limit[4]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[4]" id="select4" class="form-control">
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 4 && $section->view == 1): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 4 && $section->view == 0): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[4]" id="select4" class="form-control">
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 4 && $section->order== 1): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 4 && $section->order == 0): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>

              <br/>

                  <label>
                <div class="inline">
                  <input <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 5): ?>  checked="checked" <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="5" id="history" type="checkbox" class="filled-in" name="section[5]">
                  <label for="history" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.ContinueWatch')); ?>

              </label>
               <div style="<?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 5): ?> display:block <?php else: ?> display:none <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> " class="section5">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 5): ?> value="<?php echo e($section->item_limit); ?>" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> id="limit5" type="number" min="1" name="limit[5]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[5]" id="select5" class="form-control">
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 5 && $section->view == 1): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 5 && $section->view == 0): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[5]" id="select5" class="form-control">
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 5 && $section->order== 1): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 5 && $section->order == 0): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>
              <br/>

              <label>
                <div class="inline">
                  <input <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 6): ?>  checked="checked" <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="6" id="language" type="checkbox" class="filled-in" name="section[6]">
                  <label for="language" class="material-checkbox"></label>
                </div>
               <?php echo e(__('adminstaticwords.Languages')); ?>

              </label>
               <div style="<?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 6): ?> display:block <?php else: ?> display:none <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> " class="section6">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 6): ?> value="<?php echo e($section->item_limit); ?>" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> id="limit6" type="number" min="1" name="limit[6]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[6]" id="select6" class="form-control">
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 6 && $section->view == 1): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 6 && $section->view == 0): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[6]" id="select6" class="form-control">
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 6 && $section->order== 1): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 6 && $section->order == 0): ?> selected="selected" <?php else: ?>  <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>
              <br/>

              <label>
                <div class="inline">
                  <input <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 7): ?>  checked="checked" <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="7" id="parmotion" type="checkbox" class="filled-in" name="section[7]">
                  <label for="parmotion" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.MovieTvseriesPramotion')); ?>

              </label>
              <br/>
              <label>
                <div class="inline">
                  <input <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($section->section_id == 8): ?>  checked="checked" <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> value="8" id="blog" type="checkbox" class="filled-in" name="section[8]">
                  <label for="blog" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.Blog')); ?>

              </label>            
           
                <small class="text-danger"><?php echo e($errors->first('section')); ?></small>
            </div>
            <?php else: ?>
               <div class="form-group" class="form-group<?php echo e($errors->has('section') ? ' has-error' : ''); ?>">
              <label><?php echo e(__('adminstaticwords.ChooseSection')); ?>: <span class="text-danger">*</span></label>
              <br>
               <small class="text-muted"> <i class="fa fa-question-circle"></i> <?php echo e(__('adminstaticwords.MenuWillContainFollowingSection')); ?></small>
              <br>
               <small class="text-muted"> <i class="fa fa-question-circle"></i> <?php echo e(__('adminstaticwords.AtleaseOneSectionIsRequired')); ?></small>

              <br><br>

              <label>
                <div class="inline">
                  <input value="1" id="recent_added" type="checkbox" class="filled-in" name="section[1]">
                  <label for="recent_added" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.RecentlyAdded')); ?> 
              </label>
              <br>

              <div style="display: none" class="section1">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input id="limit1" type="number" min="1" name="limit[1]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[1]" id="select1" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[1]" id="select1" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>

              <label>
                <div class="inline">
                  <input value="2" id="genre_added" type="checkbox" class="filled-in" name="section[2]">
                  <label for="genre_added" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.Genre')); ?> 
              </label>
               <div style="display: none" class="section2">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input id="limit2" type="number" min="1" name="limit[2]" class="form-control">
                  </div>

                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[2]" id="select2" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[2]" id="select2" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>
              <br>
              <label>
                <div class="inline">
                  <input value="3" id="featured" type="checkbox" class="filled-in" name="section[3]">
                  <label for="featured" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.Featured')); ?>

              </label>
               <div style="display: none" class="section3">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input id="limit3" type="number" min="1" name="limit[3]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[3]" id="select3" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[3]" id="select3" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>
                <br>
               <label>
                <div class="inline">
                  <input value="4" id="intrest" type="checkbox" class="filled-in" name="section[4]">
                  <label for="intrest" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.BestOnIntrest')); ?>

              </label>
               <div style="display: none" class="section3">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input id="limit4" type="number" min="1" name="limit[4]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[4]" id="select4" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[4]" id="select4" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>
              <br/>

               <label>
                <div class="inline">
                  <input value="5" id="history" type="checkbox" class="filled-in" name="section[5]">
                  <label for="history" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.ContinueWatch')); ?>

              </label>
               <div style="display: none" class="section5">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input id="limit5" type="number" min="1" name="limit[5]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[5]" id="select5" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[5]" id="select5" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>
              <br/>

               <label>
                <div class="inline">
                  <input value="6" id="language" type="checkbox" class="filled-in" name="section[6]">
                  <label for="language" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.Languages')); ?>

              </label>
               <div style="display: none" class="section6">
                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.Limit')); ?>:</label>
                    <input id="limit6" type="number" min="1" name="limit[6]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.ViewIn')); ?>:</label>
                    <select name="view[6]" id="select6" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.SliderView')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.GridView')); ?></option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label><?php echo e(__('adminstaticwords.OrderIn')); ?>:</label>
                    <select name="order[6]" id="select6" class="form-control">
                      <option value="1"><?php echo e(__('adminstaticwords.DESCOrder')); ?></option>
                      <option value="0"><?php echo e(__('adminstaticwords.ASCOrder')); ?></option>
                    </select>
                  </div>
              </div>
              <br/>  

              <label>
                <div class="inline">
                  <input value="7" id="parmotion" type="checkbox" class="filled-in" name="section[7]">
                  <label for="parmotion" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.MovieTvseriesPramotion')); ?>

              </label>

              <label>
                <div class="inline">
                  <input value="8" id="blog" type="checkbox" class="filled-in" name="section[8]">
                  <label for="blog" class="material-checkbox"></label>
                </div>
                <?php echo e(__('adminstaticwords.Blog')); ?>

              </label>
          
                <small class="text-danger"><?php echo e($errors->first('section')); ?></small>
            </div>
            <?php endif; ?>
             
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
  <script>
    
      $('#recent_added').on('change',function(){
          if($(this).is(':checked')){
              $('.section1').show('fast');
              $('#limit1').attr('required','required');
              $('#order1').attr('required','required');
              $('#select1').attr('required','required');
          }else{
            $('.section1').hide('fast');
            $('#limit1').removeAttr('required');
            $('#order1').removeAttr('required','required');
            $('#select1').removeAttr('required');
          }
      });

      $('#genre_added').on('change',function(){
          if($(this).is(':checked')){
            $('.section2').show('fast');
            $('#limit2').attr('required','required');
            $('#order2').attr('required','required');
            $('#select2').attr('required','required');
          }else{
            $('.section2').hide('fast');
            $('#limit2').removeAttr('required');
            $('#order2').removeAttr('required','required');
            $('#select2').removeAttr('required');
          }
      });

      $('#featured').on('change',function(){
          if($(this).is(':checked')){
            $('.section3').show('fast');
            $('#limit3').attr('required','required');
            $('#order3').attr('required','required');
            $('#select3').attr('required','required');
          }else{
            $('.section3').hide('fast');
            $('#limit3').removeAttr('required');
            $('#order3').removeAttr('required','required');
            $('#select3').removeAttr('required');
          }
      });

      $('#intrest').on('change',function(){
          if($(this).is(':checked')){
            $('.section4').show('fast');
            $('#limit4').attr('required','required');
            $('#order4').attr('required','required');
            $('#select4').attr('required','required');
          }else{
            $('.section4').hide('fast');
            $('#limit4').removeAttr('required');
            $('#order4').removeAttr('required','required');
            $('#select4').removeAttr('required');
          }
      });

      $('#history').on('change',function(){
          if($(this).is(':checked')){
            $('.section5').show('fast');
            $('#limit5').attr('required','required');
            $('#order5').attr('required','required');
            $('#select5').attr('required','required');
          }else{
            $('.section5').hide('fast');
            $('#limit5').removeAttr('required');
            $('#order5').removeAttr('required','required');
            $('#select5').removeAttr('required');
          }
      });

      $('#language').on('change',function(){
          if($(this).is(':checked')){
            $('.section6').show('fast');
            $('#limit6').attr('required','required');
            $('#order6').attr('required','required');
            $('#select6').attr('required','required');
          }else{
            $('.section6').hide('fast');
            $('#limit6').removeAttr('required');
            $('#order6').removeAttr('required','required');
            $('#select6').removeAttr('required');
          }
      });

     
   
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sonaflix/new.sonaflix.com/resources/views/admin/menu/edit.blade.php ENDPATH**/ ?>
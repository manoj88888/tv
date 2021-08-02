
<?php $__env->startSection('title','Progressive Web App Setting | '); ?>
<?php $__env->startSection('content'); ?>
	<div class="box admin-form-main-block">
		<div class="box-header with-border">
			<div class="box-title">
				<?php echo e(__('adminstaticwords.ProgressiveWebAppSetting')); ?>

			</div>		
		</div>

		<div class="box-body">
			<div class="nav-tabs-custom">

				  <!-- Nav tabs -->
				  <ul id="myTabs" class="nav nav-tabs" role="tablist">
				    
				    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php echo e(__('adminstaticwords.AppSetting')); ?></a></li>
				    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?php echo e(__('adminstaticwords.UpdateIcons')); ?></a></li>
				    
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="home">

				    	<div class="callout callout-success">
				    		<i class="fa fa-info-circle"></i>
				    		 <?php echo e(__('adminstaticwords.ProgessiveWebAppRequirements')); ?>

				    		 <ul>
				    		 	<li><b><?php echo e(__('adminstaticwords.Https')); ?></b> <?php echo e(__('adminstaticwords.HttpsNote')); ?></li>
				    		 	<li><b><?php echo e(__('adminstaticwords.StartURL')); ?></b> <?php echo e(__('adminstaticwords.StartURLNote')); ?></li>
				    		 	<li><b><?php echo e(__('adminstaticwords.AllIconsSize')); ?></b> <?php echo e(__('adminstaticwords.AllIconsSizeNote')); ?></li>
				    		 </ul>
				    	</div>

				    	<div class="callout callout-info">
				    		<p><i class="fa fa-info-circle"></i>
				    		 <?php echo e(__('adminstaticwords.SettingsNote')); ?> (,)<?php echo e(__('adminstaticwords.SettingsNoteRemaining')); ?></p>
				    		 <p><?php echo e(__('adminstaticwords.ReadMoreAbout')); ?> <a target="_blank" href="https://developers.google.com/web/progressive-web-apps" title="Click to open"><?php echo e(__('adminstaticwords.ProgressiveWebApp')); ?></a> <?php echo e(__('adminstaticwords.Here')); ?>...</p>
				    	</div>

				    	<div class="callout callout-danger">
				    		<p><i class="fa fa-info-circle"></i> <?php echo e(__('adminstaticwords.ImportantNotes')); ?>

				    		<ul>
				    			<li><?php echo e(__('adminstaticwords.ImportantNotesOne')); ?> <u><?php echo e(__('adminstaticwords.start_url')); ?></u> <?php echo e(__('adminstaticwords.ShouldBe ')); ?><b>https://yourdomain.com/public/?launcher=true</b> </li>
				    			<li><?php echo e(__('adminstaticwords.ImportantNotesTwo')); ?>  <u><?php echo e(__('adminstaticwords.start_url')); ?></u> <?php echo e(__('adminstaticwords.ShouldBe ')); ?> <b>/?launcher=true</b> </li>
				    			<li><?php echo e(__('adminstaticwords.ImportantNotesThree')); ?> <u><?php echo e(__('adminstaticwords.Subdomain')); ?></u> <?php echo e(__('adminstaticwords.ImportantNotesThree
				    			Remaining')); ?>  <u><?php echo e(__('adminstaticwords.start_url')); ?></u> <?php echo e(__('adminstaticwords.ShouldBe ')); ?>:
									<ol type="i">
										<li><b>https://test.yourdomain.com/public/?launcher=true</b></li>
									</ol>
								<?php echo e(__('adminstaticwords.UrlContentsNotPublic')); ?>  <u><?php echo e(__('adminstaticwords.start_url')); ?></u> <?php echo e(__('adminstaticwords.ShouldBe ')); ?>:
									<ol type="i">
										<li><b>https://test.yourdomain.com/?launcher=true</b></li>
									</ol>
				    			</li>
				    		</ul>
				    	</div>

				    	<form action="<?php echo e(route('pwa.setting.update')); ?>" method="POST">
				    		<?php echo csrf_field(); ?>
				    		<div class="form-group">
				    			<button type="submit" class="pull-right btn btn-danger btn-md">
					    		<i class="fa fa-save"></i> <?php echo e(__('adminstaticwords.SaveChanges')); ?>

					    	</button>
				    		</div>
				    		<br><br>
				    		<div class="form-group">
				    			<label><?php echo e(__('adminstaticwords.ManifestSetting')); ?>:</label>
				    			<textarea name="app_setting" class="form-control" id="" cols="30" rows="20"><?php echo e($setting); ?></textarea>
				    		</div>
				    		<div class="form-group">
				    			<label><?php echo e(__('adminstaticwords.ServiceWorkerSetting')); ?>:</label>
				    			<textarea name="sw_setting" class="form-control" id="" cols="30" rows="20"><?php echo e($sw); ?></textarea>
				    		</div>
					    	<button type="submit" class="btn btn-danger btn-md">
					    		<i class="fa fa-save"></i> <?php echo e(__('adminstaticwords.SaveChanges')); ?>

					    	</button>
				    	</form>
				    </div>
				    <div role="tabpanel" class="tab-pane" id="profile">
				    
				    	<form action="<?php echo e(route('pwa.icons.update')); ?>" method="POST" enctype="multipart/form-data">
				    		<?php echo csrf_field(); ?>
					    	<button type="submit" class="pull-right btn btn-danger btn-md">
					    			<i class="fa fa-save"></i><?php echo e(__('adminstaticwords.UpdateIcons')); ?>

					    	</button>
					    	<br><br>
				    		<div class="well">
				    			<div class="row">
				    				<div class="col-md-6">
				    					<div class="form-group">
						    				<label><?php echo e(__('adminstaticwords.Icon')); ?> (36x36)</label>
						    				<input id="icon1" type="file" class="form-control" name="icon36">
						    			</div>
				    				</div>

				    				<div class="col-md-6">
				    					<img id="preview1" alt="preview" src="<?php echo e(url('/images/icons/icon36x36.png')); ?>">
				    				</div>
				    			</div>
				    		</div>

				    		<div class="well">
				    			<div class="row">
				    				<div class="col-md-6">
				    					<div class="form-group">
						    				<label><?php echo e(__('adminstaticwords.Icon')); ?> (48x48)</label>
						    				<input id="icon2" type="file" class="form-control" name="icon48">
						    			</div>
				    				</div>

				    				<div class="col-md-6">
				    					<img id="preview2" alt="preview" src="<?php echo e(url('/images/icons/icon48x48.png')); ?>">
				    				</div>
				    			</div>
				    		</div>

				    		<div class="well">
				    			<div class="row">
				    				<div class="col-md-6">
				    					<div class="form-group">
						    				<label><?php echo e(__('adminstaticwords.Icon')); ?> (72x72)</label>
						    				<input id="icon3" type="file" class="form-control" name="icon72">
						    			</div>
				    				</div>

				    				<div class="col-md-6">
				    					<img id="preview3" alt="preview" src="<?php echo e(url('/images/icons/icon72x72.png')); ?>">
				    				</div>
				    			</div>
				    		</div>

				    		<div class="well">
				    			<div class="row">
				    				<div class="col-md-6">
				    					<div class="form-group">
						    				<label><?php echo e(__('adminstaticwords.Icon')); ?> (96x96)</label>
						    				<input id="icon4" type="file" class="form-control" name="icon96">
						    			</div>
				    				</div>

				    				<div class="col-md-6">
				    					<img id="preview4" alt="preview" src="<?php echo e(url('/images/icons/icon96x96.png')); ?>">
				    				</div>
				    			</div>
				    		</div>

				    		<div class="well">
				    			<div class="row">
				    				<div class="col-md-6">
				    					<div class="form-group">
						    				<label><?php echo e(__('adminstaticwords.Icon')); ?> (144x144)</label>
						    				<input id="icon5" type="file" class="form-control" name="icon144">
						    			</div>
				    				</div>

				    				<div class="col-md-6">
				    					<img id="preview5" alt="preview" src="<?php echo e(url('/images/icons/icon144x144.png')); ?>">
				    				</div>
				    			</div>
				    		</div>

				    		<div class="well">
				    			<div class="row">
				    				<div class="col-md-6">
				    					<div class="form-group">
						    				<label><?php echo e(__('adminstaticwords.Icon')); ?> (168x168)</label>
						    				<input id="icon6" type="file" class="form-control" name="icon168">
						    			</div>
				    				</div>

				    				<div class="col-md-6">
				    					<img id="preview6" alt="preview" src="<?php echo e(url('/images/icons/icon168x168.png')); ?>">
				    				</div>
				    			</div>
				    		</div>

				    		<div class="well">
				    			<div class="row">
				    				<div class="col-md-6">
				    					<div class="form-group">
						    				<label><?php echo e(__('adminstaticwords.Icon')); ?> (192x192)</label>
						    				<input id="icon7" type="file" class="form-control" name="icon192">
						    			</div>
				    				</div>

				    				<div class="col-md-6">
				    					<img id="preview7" alt="preview" src="<?php echo e(url('/images/icons/icon192x192.png')); ?>">
				    				</div>
				    			</div>
				    		</div>

				    		<div class="well">
				    			<div class="row">
				    				<div class="col-md-6">
				    					<div class="form-group">
						    				<label><?php echo e(__('adminstaticwords.Icon')); ?> (256x256)</label>
						    				<input id="icon8" type="file" class="form-control" name="icon256">
						    			</div>
				    				</div>

				    				<div class="col-md-6">
				    					<img id="preview8" alt="preview" src="<?php echo e(url('/images/icons/icon256x256.png')); ?>">
				    				</div>
				    			</div>
				    		</div>
				    		<p></p>
							<div class="form-group">
								<button type="submit" class="pull-left btn btn-danger btn-md">
					    			<i class="fa fa-save"></i> <?php echo e(__('adminstaticwords.UpdateIcons')); ?>

					    		</button>
					    		<br>
							</div>
				    	</form>
				    </div>
				  </div>

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
  <script src="<?php echo e(url('js/pwasetting.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/pwa/index.blade.php ENDPATH**/ ?>

<?php $__env->startSection('title',__('adminstaticwords.BackupManager')); ?>
<?php $__env->startSection('content'); ?>

<div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><?php echo e(__('adminstaticwords.BackupManagerSettinges')); ?></h4><br/>
    <div class="admin-form-block z-depth-1">
        <form action="<?php echo e(route('admin.backup.path')); ?>" method="POST" class="form-group">
            <?php echo e(csrf_field()); ?>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="BINARY_PATH"><?php echo e(__('adminstaticwords.MysqlDumpPath')); ?></label>
                         <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('adminstaticwords.PleaseEnterYourMysqlBinaryPath')); ?> eg: /usr/bin/mysql/mysql-5.7.24-winx64/bin"></i>
                        <input type="text" name="BINARY_PATH" value="<?php echo e(env('BINARY_PATH') ? env('BINARY_PATH') : ''); ?>" placeholder="/usr/bin/mysql/mysql-5.7.24-winx64/bin">

                        <small class="text-danger">
                            <b><?php echo e(__('adminstaticwords.Note')); ?>:-</b><br/>
                            •<?php echo e(__('adminstaticwords.Note1Mysql')); ?><br/>
                            • <?php echo e(__('adminstaticwords.Note2Mysql')); ?><br/>
                            • <?php echo e(__('adminstaticwords.Note3Mysql')); ?><br/>
                        </small>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success btn-md"><?php echo e(__('adminstaticwords.Update')); ?></button>
                </div>
            </div>
            

        </form>
        
        <div class="row">
            <div class="col-md-8">
                <ul>
                    <li>
                        <?php echo e(__('adminstaticwords.GenerateBackupText')); ?>

                    </li>

                    <li>
                        <b><?php echo e(__('adminstaticwords.DownloadSqlList')); ?></b>
                    </li>

                    <li>
                       <?php echo e(__('adminstaticwords.MakeSure')); ?> <b><?php echo e(__('adminstaticwords.MysqlEnable')); ?></b> <?php echo e(__('adminstaticwords.MysqlNoteDescription')); ?>

                        <b><?php echo e(__('adminstaticwords.MysqlNoteFileName')); ?></b>.
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <br>
                <?php if(env('BINARY_PATH') != NULL): ?>
                <a href="<?php echo e(url('admin/backups/process?type=onlydb')); ?>" class="btn btn-md btn-success">
                    <i class="fa fa-refresh"></i> <?php echo e(__('adminstaticwords.GenerateDatabaseBackup')); ?>

                </a>
                <?php endif; ?>
            </div>
        </div>
         <div class="row">
            <div class="text-center col-md-8">
                <?php echo $html; ?>

            </div>
            <?php if(env('BINARY_PATH') != NULL): ?>
            <div class="col-md-4">
                <div class="well">
                    <p class="text-muted"> <b><?php echo e(__('adminstaticwords.DownloadTheLatestBackup')); ?></b> </p>
                    
                    <?php

                        $dir17 = storage_path() . '/app/'.config('app.name');
                    ?>
                       
                        <ul>

                            <?php $__currentLoopData = array_reverse(glob("$dir17/*")); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        
                                <?php if($loop->first): ?>
                                    <li><a href="<?php echo e(URL::temporarySignedRoute('admin.backup.download', now()->addMinutes(1), ['filename' => basename($file)])); ?>"><b><?php echo e(basename($file)); ?> (<?php echo e(__('adminstaticwords.Latest')); ?>)</b></a></li> 
                                <?php else: ?>
                                    <li><a href="<?php echo e(URL::temporarySignedRoute('admin.backup.download', now()->addMinutes(1), ['filename' => basename($file)])); ?>"><?php echo e(basename($file)); ?></a></li> 
                                <?php endif; ?>
                         
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

                        </ul>
                        
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/backup/index.blade.php ENDPATH**/ ?>
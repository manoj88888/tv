<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="<?php echo e(url('installer/css/bootstrap.min.css')); ?>" crossorigin="anonymous">
   <link rel="stylesheet" href="<?php echo e(url('css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('installer/css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('installer/css/shards.min.css')); ?>">
    <title><?php echo e(__('Installing App - Server Requirement')); ?></title>
    <?php echo notify_css(); ?>
  </head>
  <body>
   	   <?php echo $__env->make('notify::messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="display-none preL">
        <div class="display-none preloader3"></div>
      </div>

   		<div class="container">
   			<div class="card">
          <div class="card-header">
              <h3 class="m-3 text-center heading">
                  <?php echo e(__('Server Requirement')); ?>

              </h3>
          </div>
   				<div class="card-body" id="stepbox">
               <form autocomplete="off" action="<?php echo e(route('store.server')); ?>" id="step1form" method="POST" class="needs-validation" novalidate>
                  <?php echo csrf_field(); ?>
                  <?php
                    $servercheck= array();
                  ?>
                  <div class="form-row">
                      <br>
                     <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th><?php echo e(__('php extension')); ?></th>
                              <th><?php echo e(__('Status')); ?></th>
                            </tr>
                          </thead>

                          <tbody>

                            <tr>
                                <?php
                                  $v = phpversion();
                                ?>
                              <td>
                                <?php echo e(__('php version')); ?> (<b><?php echo e($v); ?></b>)
                                  <br>
                                 <small class="text-muted">php version required less than 7.3 and greater than 7.0</small>
                              </td>
                              <td>
                               <?php if($v = 7.0 && $v < 7.3): ?>
                                 <i class="text-success fa fa-check-circle"></i>
                                 <?php
                                   array_push($servercheck, 1);
                                 ?>
                               <?php else: ?>
                                <i class="text-danger fa fa-times-circle"></i>
                                <br> 
                                 <small>
                                   Your php version is <b><?php echo e($v); ?></b> which is not supported
                                 </small>
                                 <?php
                                   array_push($servercheck, 0);
                                 ?>
                               <?php endif; ?>
                              </td>
                            </tr>

                             <tr>
                              <td><?php echo e(__('pdo')); ?></td>
                              <td>
                               
                                  <?php if(extension_loaded('pdo')): ?>
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                    <?php
                                      array_push($servercheck, 1);
                                    ?>
                                  <?php else: ?>
                                     <i class="text-danger fa fa-times-circle"></i>
                                     <?php
                                      array_push($servercheck, 0);
                                     ?>
                                  <?php endif; ?>
                              </td>
                            </tr>

                            <tr>
                              <td><?php echo e(__('cURL')); ?></td>
                              <td>
                                  <?php if(extension_loaded('cURL')): ?>
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                    <?php
                                      array_push($servercheck, 1);
                                    ?>
                                  <?php else: ?>
                                     <i class="text-danger fa fa-times-circle"></i>
                                     <?php
                                      array_push($servercheck, 0);
                                     ?>
                                  <?php endif; ?>
                              </td>
                            </tr>

                             <tr>
                              <td><?php echo e(__('BCMath')); ?></td>
                              <td>
                               
                                  <?php if(extension_loaded('BCMath')): ?>
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                    <?php
                                      array_push($servercheck, 1);
                                    ?>
                                  <?php else: ?>
                                     <i class="text-danger fa fa-times-circle"></i>
                                     <?php
                                      array_push($servercheck, 0);
                                     ?>
                                  <?php endif; ?>
                              </td>
                            </tr>

                            <tr>
                              <td><?php echo e(__('openssl')); ?></td>
                              <td>
                               
                                  <?php if(extension_loaded('openssl')): ?>
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     <?php
                                      array_push($servercheck, 1);
                                    ?>
                                  <?php else: ?>
                                     <i class="text-danger fa fa-times-circle"></i>
                                     <?php
                                      array_push($servercheck, 0);
                                     ?>
                                  <?php endif; ?>
                              </td>
                            </tr>

                              <tr>
                              <td><?php echo e(__('fileinfo')); ?></td>
                              <td>
                               
                                  <?php if(extension_loaded('fileinfo')): ?>
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     <?php
                                      array_push($servercheck, 1);
                                    ?>
                                  <?php else: ?>
                                     <i class="text-danger fa fa-times-circle"></i>
                                     <?php
                                      array_push($servercheck, 0);
                                     ?>
                                  <?php endif; ?>
                              </td>
                            </tr>

                            <tr>
                              <td><?php echo e(__('json')); ?></td>
                              <td>
                               
                                  <?php if(extension_loaded('json')): ?>
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                    <?php
                                      array_push($servercheck, 1);
                                    ?>
                                  <?php else: ?>
                                     <i class="text-danger fa fa-times-circle"></i>
                                     <?php
                                      array_push($servercheck, 0);
                                     ?>
                                  <?php endif; ?>
                              </td>
                            </tr>

                            <tr>
                              <td><?php echo e(__('session')); ?></td>
                              <td>
                               
                                  <?php if(extension_loaded('session')): ?>
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     <?php
                                      array_push($servercheck, 1);
                                    ?>
                                  <?php else: ?>
                                     <i class="text-danger fa fa-times-circle"></i>
                                     <?php
                                      array_push($servercheck, 0);
                                    ?>
                                  <?php endif; ?>
                              </td>
                            </tr>

                             <tr>
                              <td><?php echo e(__('gd')); ?></td>
                              <td>
                               
                                  <?php if(extension_loaded('gd')): ?>
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                    <?php
                                      array_push($servercheck, 1);
                                    ?>
                                  <?php else: ?>
                                     <i class="text-danger fa fa-times-circle"></i>
                                     <?php
                                      array_push($servercheck, 0);
                                     ?>
                                  <?php endif; ?>
                              </td>
                            </tr>


                            
                            <tr>
                              <td><?php echo e(__('allow_url_fopen')); ?></td>
                              <td>
                               
                                  <?php if(ini_get('allow_url_fopen')): ?>
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     <?php
                                      array_push($servercheck, 1);
                                    ?>
                                  <?php else: ?>
                                     <i class="text-danger fa fa-times-circle"></i>
                                      <?php
                                      array_push($servercheck, 0);
                                     ?>
                                  <?php endif; ?>
                              </td>
                            </tr>

                             

                            

                             <tr>
                              <td><?php echo e(__('xml')); ?></td>
                              <td>
                               
                                  <?php if(extension_loaded('xml')): ?>
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     <?php
                                      array_push($servercheck, 1);
                                    ?>
                                  <?php else: ?>
                                     <i class="text-danger fa fa-times-circle"></i>
                                     <?php
                                      array_push($servercheck, 0);
                                     ?>
                                  <?php endif; ?>
                              </td>
                            </tr>

                             <tr>
                              <td><?php echo e(__('tokenizer')); ?></td>
                              <td>
                               
                                  <?php if(extension_loaded('tokenizer')): ?>
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     <?php
                                      array_push($servercheck, 1);
                                    ?>
                                  <?php else: ?>
                                     <i class="text-danger fa fa-times-circle"></i>
                                     <?php
                                      array_push($servercheck, 0);
                                    ?>
                                  <?php endif; ?>
                              </td>
                            </tr>
                             <tr>
                              <td><?php echo e(__('standard')); ?></td>
                              <td>
                               
                                  <?php if(extension_loaded('standard')): ?>
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     <?php
                                      array_push($servercheck, 1);
                                    ?>
                                  <?php else: ?>
                                     <i class="text-danger fa fa-times-circle"></i>
                                     <?php
                                      array_push($servercheck, 0);
                                    ?>
                                  <?php endif; ?>
                              </td>
                            </tr>

                              <tr>
                              <td><?php echo e(__('mysqli')); ?></td>
                              <td>
                               
                                  <?php if(extension_loaded('mysqli')): ?>
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     <?php
                                      array_push($servercheck, 1);
                                    ?>
                                  <?php else: ?>
                                     <i class="text-danger fa fa-times-circle"></i>
                                     <?php
                                      array_push($servercheck, 0);
                                    ?>
                                  <?php endif; ?>
                              </td>
                            </tr>

                            <tr>
                              <td><?php echo e(__('mbstring')); ?></td>
                              <td>
                               
                                  <?php if(extension_loaded('mbstring')): ?>
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     <?php
                                      array_push($servercheck, 1);
                                    ?>
                                  <?php else: ?>
                                     <i class="text-danger fa fa-times-circle"></i>
                                     <?php
                                      array_push($servercheck, 0);
                                    ?>
                                  <?php endif; ?>
                              </td>
                            </tr>

                             <tr>
                              <td><?php echo e(__('ctype')); ?></td>
                              <td>
                               
                                  <?php if(extension_loaded('ctype')): ?>
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     <?php
                                      array_push($servercheck, 1);
                                    ?>
                                  <?php else: ?>
                                     <i class="text-danger fa fa-times-circle"></i>
                                     <?php
                                      array_push($servercheck, 0);
                                    ?>
                                  <?php endif; ?>
                              </td>
                            </tr>

                            <tr>
                              <td><?php echo e(__('exif')); ?></td>
                              <td>
                                
                                  <?php if(extension_loaded('exif')): ?>
                                      
                                    <i class="text-success fa fa-check-circle"></i> 
                                     <?php
                                      array_push($servercheck, 1);
                                      ?>
                                  <?php else: ?>
                                     <i class="text-danger fa fa-times-circle"></i>
                                     <?php
                                      array_push($servercheck, 0);
                                    ?>
                                  <?php endif; ?>
                              </td>
                            </tr>

                            <tr>
                  <td><b><?php echo e(storage_path()); ?></b> <?php echo e(__('is writable')); ?>?</td>
                  <td>
                    <?php
                      $path = storage_path();
                    ?>
                    <?php if(is_writable($path)): ?>
                     <i class="text-success fa fa-check-circle"></i> 
                    <?php else: ?>
                      <i class="text-danger fa fa-times-circle"></i>
                    <?php endif; ?>
                  </td>
                </tr>

                <tr>
                  <td><b><?php echo e(base_path('bootstrap/cache')); ?></b> <?php echo e(__('is writable')); ?>?</td>
                  <td>
                    <?php
                      $path = base_path('bootstrap/cache');
                    ?>
                    <?php if(is_writable($path)): ?>
                      <i class="text-success fa fa-check-circle"></i> 
                    <?php else: ?>
                      <i class="text-danger fa fa-times-circle"></i>
                    <?php endif; ?>
                  </td>
                </tr>
                
                <tr>
                  <td><b><?php echo e(storage_path('framework/sessions')); ?></b> <?php echo e(__('is writable')); ?>?</td>
                  <td>
                    <?php
                      $path = storage_path('framework/sessions');
                    ?>
                    <?php if(is_writable($path)): ?>
                      <i class="text-success fa fa-check-circle"></i> 
                    <?php else: ?>
                      <i class="text-danger fa fa-times-circle"></i>
                    <?php endif; ?>
                  </td>
                </tr>


                          </tbody>
                        </table>
                        </div>
                     </div>
                     
                  </div>
                  <?php if(!in_array(0, $servercheck)): ?>
                    <button class="float-right step1btn btn btn-default" type="submit"><?php echo e(__('Continue to Installation')); ?>...</button>
                  <?php else: ?>
                    <p class="pull-right text-danger"><b><?php echo e(__('Some extension are missing. Contact your host provider for enable it.')); ?></b></p>
                  <?php endif; ?>
              </form>
   				</div>
   			</div>
       <p class="text-center m-3 text-white">&copy;<?php echo e(date('Y')); ?> | Next Hour - Movie Tv Show & Video Subscription Portal Cms Web and Mobile App | <a class="text-white" href="http://mediacity.co.in"><?php echo e(__('Media City')); ?></a></p>
   		</div>
      
      <div class="corner-ribbon bottom-right sticky green shadow"><?php echo e(__('Server Check')); ?> </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="<?php echo e(url('installer/js/jquery-3.4.1.min.js')); ?>"></script>
    <script src="<?php echo e(url('installer/js/jquery.validate.min.js')); ?>"></script>
    <!-- jquery -->
    <script type="text/javascript" src="<?php echo e(url('installer/js/bootstrap.min.js')); ?>"></script> <!-- bootstrap js -->
    <script type="text/javascript" src="<?php echo e(url('installer/js/popper.min.js')); ?>"></script> 
    <script src="<?php echo e(url('installer/js/shards.min.js')); ?>"></script>
    <script>var baseUrl= "<?= url('/') ?>";</script>
    <?php echo notify_js(); ?>
    <?php echo app('notify')->render(); ?>
</body>
</html><?php /**PATH D:\xampp\htdocs\tv\resources\views/install/servercheck.blade.php ENDPATH**/ ?>
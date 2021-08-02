<?php $__env->startSection('title','User Dashboard'); ?>
<?php $__env->startSection('main-wrapper'); ?>
<style>
    .activeScreen {
        background-color: #2eb82e !important;
        cursor: pointer;
    }
    
    .column-container {
      cursor:pointer !important;
    }
</style>


    <div class="container" style="padding:0;background-color:white;width:100%;">
        <!-- Content -->
        <h1 style="font-size:large;" class="title"><b>MANAGE YOUR PROFILE</b></h1>
        
        <ul class="menu" style="padding-left:28px;">
            <li><a href="<?php echo e(url('account')); ?>">Overview</a></li>
            <li><a href="<?php echo e(url('/manageprofile/mus/'.Auth::user()->id)); ?> " class="menu-item-active">Profiles</a></li>
        </ul>
        
        <?php if(!isset($result)): ?>
		    <h4 style="color:black;padding-left:28px;"><?php echo e(__('staticwords.noprofileavailable')); ?></h4>
        <?php else: ?>
            <h4> Hey <?php echo e(Auth::user()->name); ?> select your personal profile and start browsing AlphaTV: </h4>
        <?php endif; ?>
    </div>
    
    <div class="jumbotron flex-bx" style="background-color:white;">
        <?php if(isset($result->screen1)): ?>
            <?php if($result->screen1 == $result->activescreen): ?>
                <div class="container activeScreen column-container" style="height: 60px;">
            <?php else: ?>
                <div class="container background-white column-container" style="height: 60px;" onclick="changescreen('<?php echo e($result->screen1); ?>','<?php echo e(1); ?>')">
            <?php endif; ?>
                <div class="column">
                    <b class="icon-avatar">1</b><span><?php echo e($result->screen1); ?></span>
                    <span data-toggle="modal" data-target="#EditScreen1Modal" class="glyphicon glyphicon-pencil icon-edit"></span>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if(isset($result->screen2)): ?>
            <?php if($result->screen2 == $result->activescreen): ?>
                <div class="container activeScreen column-container" style="height: 60px;">
            <?php else: ?>
                <div class="container background-white column-container" style="height: 60px;" onclick="changescreen('<?php echo e($result->screen2); ?>','<?php echo e(2); ?>')">
            <?php endif; ?>
                <div class="column">
                    <b class="icon-avatar">2</b><span><?php echo e($result->screen2); ?></span>
                    <span data-toggle="modal" data-target="#EditScreen2Modal" class="glyphicon glyphicon-pencil icon-edit"></span>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if(isset($result->screen3)): ?>
            <?php if($result->screen3 == $result->activescreen): ?>
                <div class="container activeScreen column-container" style="height: 60px;">
            <?php else: ?>
                <div class="container background-white column-container" style="height: 60px;" onclick="changescreen('<?php echo e($result->screen3); ?>','<?php echo e(3); ?>')">
            <?php endif; ?>
                <div class="column">
                    <b class="icon-avatar">3</b><span><?php echo e($result->screen3); ?></span>
                    <span data-toggle="modal" data-target="#EditScreen3Modal" class="glyphicon glyphicon-pencil icon-edit"></span>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if(isset($result->screen4)): ?>
            <?php if($result->screen4 == $result->activescreen): ?>
                <div class="container activeScreen column-container" style="height: 60px;">
            <?php else: ?>
                <div class="container background-white column-container" style="height: 60px;" onclick="changescreen('<?php echo e($result->screen4); ?>','<?php echo e(4); ?>')">
            <?php endif; ?>
                <div class="column">
                    <b class="icon-avatar">4</b><span><?php echo e($result->screen4); ?></span>
                    <span data-toggle="modal" data-target="#EditScreen4Modal" class="glyphicon glyphicon-pencil icon-edit"></span>
                </div>
            </div>
        <?php endif; ?>
    </div>

<!--------------------- Edit Screen1 Modal Start ------------------------->
    <div class="modal fade" id="EditScreen1Modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                    &times;
                    </button>
                    <h4 class="modal-title"><b>Edit Screen 1</b></h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('mus.pro.update', Auth::user()->id)); ?>" method="POST"> 
                    <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label for="usr" class="text-gray">Screen 1 Name</label>
                            <?php if(isset($result->screen1)): ?>
                                <input type="text" class="form-control screenName" id="usr1" name="screen1" value="<?php echo e($result->screen1); ?>" />
                            <?php else: ?>
                                <input type="text" class="form-control screenName" id="usr1" name="screen1" value="" />
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn full-btn background-gray" style="background-color: #050076;" value="Update Me">
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--------------------- Edit Screen1 Modal End ------------------------->

<!--------------------- Edit Screen2 Modal Start ------------------------->
    <div class="modal fade" id="EditScreen2Modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                    &times;
                    </button>
                    <h4 class="modal-title"><b>Edit Screen 2</b></h4>
                </div>
                <form action="<?php echo e(route('mus.pro.update',Auth::user()->id)); ?>" method="POST">
				<?php echo e(csrf_field()); ?>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr" class="text-gray">Screen 2 Name</label>
                            <?php if(isset($result->screen2)): ?>
                                <input type="text" class="form-control screenName" id="usr2" name="screen2" value="<?php echo e($result->screen2); ?>" />
                            <?php else: ?>
                                <input type="text" class="form-control screenName" id="usr2" name="screen2" value="" />
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn full-btn background-gray" style="background-color: #050076;"> Update </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--------------------- Edit Screen2 Modal End ------------------------->

<!--------------------- Edit Screen3 Modal Start ------------------------->
    <div class="modal fade" id="EditScreen3Modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                    &times;
                    </button>
                    <h4 class="modal-title"><b>Edit Screen 3</b></h4>
                </div>
                <form action="<?php echo e(route('mus.pro.update',Auth::user()->id)); ?>" method="POST">
				<?php echo e(csrf_field()); ?>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr" class="text-gray">Screen 3 Name</label>
                            <?php if(isset($result->screen3)): ?>
                                <input type="text" class="form-control screenName" id="usr2" name="screen3" value="<?php echo e($result->screen3); ?>" />
                            <?php else: ?>
                                <input type="text" class="form-control screenName" id="usr2" name="screen3" value="" />
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn full-btn background-gray" style="background-color: #050076;"> Update </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--------------------- Edit Screen3 Modal End ------------------------->

<!--------------------- Edit Screen4 Modal Start ------------------------->
    <div class="modal fade" id="EditScreen4Modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                    &times;
                    </button>
                    <h4 class="modal-title"><b>Edit Screen 4</b></h4>
                </div>
                <form action="<?php echo e(route('mus.pro.update',Auth::user()->id)); ?>" method="POST">
				<?php echo e(csrf_field()); ?>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr" class="text-gray">Screen 4 Name</label>
                            <?php if(isset($result->screen4)): ?>
                                <input type="text" class="form-control screenName" id="usr4" name="screen4" value="<?php echo e($result->screen4); ?>" />
                            <?php else: ?>
                                <input type="text" class="form-control screenName" id="usr4" name="screen4" value="" />
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn full-btn background-gray" style="background-color: #050076;"> Update </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--------------------- Edit Screen4 Modal End ------------------------->
<?php $__env->stopSection(); ?>



<?php $__env->startSection('custom-script'); ?>
<script>
	function changescreen(screen,count){
    console.log(screen, count);
    
		$.ajax({
			type : 'GET',
			data : {screen : screen, count : count},
			url  : '<?php echo e(url('/changescreen/'.Auth::user()->id)); ?>',
			success : function(data){
				console.log(data);
				location.reload(); 
			}
		});
	}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/newmanageprofile.blade.php ENDPATH**/ ?>
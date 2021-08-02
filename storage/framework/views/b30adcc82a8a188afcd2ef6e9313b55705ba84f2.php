<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<style>
		@import  url('https://fonts.googleapis.com/css?family=Open+Sans');
		body{
			background: #000;
			font-family: 'Open Sans', sans-serif;
		}

		h1{
			font-family: 'Open Sans', sans-serif;
			color: #fff;
			text-transform: uppercase;
		}

		.box
		{
			max-width: 50%;
		}

		.wel{
			width: 200px;
			border-radius: 0.5em;
			padding: 10px;
			background-image: linear-gradient(to right top, #44a1c5, #537196, #4b465e, #2e242d, #000000);
			border:none;
			color: #fff;
			font-weight: 600;
			font-size: 18px;
			font-family: 'Open Sans', sans-serif;
		}
	</style>
</head>
<body>
	<center>
	<div style="padding:50px;background: url(<?php echo e(url('images/email-bg.jpg')); ?>);background-color:#111;background-size: cover;width: 100%;height: 100%;" class="box">
		<div align="center" class="logo">
			<img src="<?php echo e(asset('images/logo/'.$logo)); ?>" alt="logo">

			<h1>Welcome, <?php echo e($user['name']); ?> !</h1>

			<p style="font-size:18px;font-family: 'Open Sans', sans-serif;text-align: left;color: #fff;">
				Dear Subscriber,
				<br><br>
				Congratulations on your subscription to Alpha!  You’ve joined a worldwide community of individuals who are looking beyond the ordinary for inspiration, direction and motivation to experience the Higher Life. 
				<br>
				<br>
				You’re on your way!
				<br>
				<br>
				You can access Alpha at anytime from anywhere on the device of your choice:  TV, computer, tablet or phone.
			</p>

			<div align="center">
				<p style="font-size:18px;font-family: 'Open Sans', sans-serif;text-align: justify;color: #fff;">Login now at
				    <a style="cursor: pointer;" href="<?php echo e(config('app.url')); ?>"><button style="cursor: pointer;" class="wel">app.alphatv.global</button></a>
				    <br>
				    <br>
				    Alpha!  It’s new.  It’s exceptional. It’s amazing.  And it’s here!
				</p>
			</div>

			<p style="font-size:18px;font-family: 'Open Sans', sans-serif;text-align: left;color: #fff;">
				Your Higher Life begins now!
				<br>
			
			</p>

			<div style="width:100%; height:2px;background:linear-gradient(to right top, #44a1c5, #537196, #4b465e, #2e242d, #000000);">
				
			</div>
				<?php
					$url= \DB::table('social_icons')->where('id',1)->first();
				?>
			<div align="left" class="social">
				<p style="color: #fff;font-family: 'Open Sans', sans-serif;">	Question? email us at: <a style="cursor: pointer;" href="mailto:<?php echo e($w_email); ?>"><?php echo e($w_email); ?></a></p>

				<a href="<?php echo e($url->url1); ?>"><img src="<?php echo e(url('images/fb.png')); ?>" alt=""></a>
				<a href="<?php echo e($url->url2); ?>"><img style="margin-left: 15px;" src="<?php echo e(url('images/tw.png')); ?>" alt=""></a>
				<a href="<?php echo e($url->url3); ?>"><img style="margin-left: 15px;" src="<?php echo e(url('images/yt.png')); ?>" alt=""></a>
			</div>
		</div>
	</div>
</center>
</body>
</html><?php /**PATH /home/alphatvcpanel/app.alphatv.global/resources/views/admin/email/welcome-email.blade.php ENDPATH**/ ?>
<!doctype html>
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<title><?php echo $title_for_layout; ?> : Admin Panel</title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="<?= $this->Html->webroot.'img/site/'.$setting['site']['site_icon'];?>" type="image/x-icon" rel="shortcut icon" />
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	
	<!-- CSS Styles -->
	<?php echo $this->Html->css('admin/style.css');?>
	<?php echo $this->Html->css('admin/colors.css');?>
	<?php echo $this->Html->css('admin/jquery.tipsy.css');?>

	
	<!-- Google WebFonts -->
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>
	<?php echo $this->Html->script('admin/libs/modernizr-1.7.min.js'); ?>


</head>
<body class="login">
	<section role="main">
	
		
       <?php if(isset($setting['site']['site_logo']))echo $this->Html->image('site/'.$setting['site']['site_logo'],array('style'=>''));  ?>
        
	
		<!-- Login box -->
		<article id="login-box">
		
			<div class="article-container">				
				
				              
				<h1>Reset Password</h1>
				<?php echo $this->element('admin/message');?>
				
				<?=$this->Form->create('User',array('name'=>'user','url'=>array('controller'=>'admin','action'=>'resetpassword') ))?>
					<fieldset>
						<dl>
							<dt>
								<label>E-Mail</label>
							</dt>
							<dd>
								<?php echo $this->Form->text('email', array('class' => 'fullwidth','size'=>'30')); ?>
							</dd>
							
						</dl>
					</fieldset>
					<button type="submit" class="right">Submit</button>
					<?php echo $this->Form->end(); ?>			
			</div>
		
		</article>
		<!-- /Login box -->
		<ul class="login-links">
			<li>
            <?php echo $this->Html->link('Return to site Home Page', array('plugin'=>'content_manager','controller'=>'pages','action'=>'home'), array('class'=>'leftnav','target'=>'_blank'));?>
            </li>
			<li><?php echo $this->Html->link('Login', array('controller'=>'admin','action'=>'index'), array('class'=>'leftnav'));?>
</li>
		</ul>
		
	</section>

	<!-- JS Libs at the end for faster loading -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="js/jquery/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
	<?php echo $this->Html->script('admin/libs/selectivizr.js'); ?>
	<?php echo $this->Html->script('admin/jquery/jquery.tipsy.js'); ?>
	<?php echo $this->Html->script('admin/login.js'); ?>
	<script>
		var _gaq=[['_setAccount','UA-XXXXXX'],['_trackPageview']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
		g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
	</script>
</body>
</html>

<!doctype html>
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<title><?=$title_for_layout; ?> | Admin Panel</title>
	<link href="<?php echo Configure::read('Site.fav_icon'); ?>" type="image/x-icon" rel="shortcut icon" />
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	<?php echo $this->Html->script('ckeditor/ckeditor.js');?>
	<?php echo $this->Html->script('ckfinder/ckfinder.js'); ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.m
	in.js'></script>
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base
	/jquery-ui.css" />
	<?php echo $this->Html->script('fancybox/jquery.fancybox-1.3.4.pack.js'); ?>
	
	<!-- CSS Styles -->
	<?php echo $this->Html->css('admin/style.css');?>
	<?php echo $this->Html->css('admin/colors.css');?>
	
	<?php echo $this->Html->css('admin/jquery.fileinput.css');?>
	<?php echo $this->Html->css('admin/jquery.fullcalendar.css');?>
	
	<?php echo $this->Html->css('fancybox/jquery.fancybox-1.3.4.css');?>

	<!-- Google WebFonts -->
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>
	<?php //echo $this->Html->script('admin/libs/modernizr-1.7.min.js'); ?>
    <script type="text/javascript">
		$(document).ready(function(){
			$('.fancybox').fancybox();
			});
	</script>
</head>

<!-- Add class .fixed for fixed layout. You would need also edit CSS file for width -->
<body>
	<div class="fixed-wraper">
	<!-- Aside Block -->
	<section role="navigation">
		<!-- Header with logo and headline -->
		<header>
			<img src="<?=Configure::read('Site.admin_logo');?>" width="239px" />
		</header>
		<!-- User Info -->
		<section id="user-info">				
			<?=$this->Html->image('admin/sample_user.png');?>
			<div>
				<a href="#" title="Account Settings and Profile Page"><?php if(isset($loggedIn)): ?><? echo ucfirst($ADMIN_DETAIL['adminname']); ?><?php endif; ?></a>
				<em>Administrator Hello</em>                
				<ul>
					<li><?php echo $this->Html->link('view website', '/',array('class'=>'button-link','rel'=>'tooltip','title'=>'view website','target'=>'_blank')); ?></li>
					<li><?php echo $this->Html->link('Logout', '/admin/logout', array('class'=>'button-link','rel'=>'tooltip','title'=>'Logout'));?></li>
				</ul>
			</div>
		</section>
		<!-- /User Info -->
		<!-- Main Navigation -->
		<nav id="main-nav">
			<ul>
				<li class="<?php if($this->params['controller']=="users" && $this->params['action']=="admin_welcome") echo "current"; ?>">
				<?php echo $this->Html->link('Dashboard','/admin/home' ,array('class'=>'dashboard no-submenu'));?>
				</li>
				<?php if((isset($ADMIN_PERMISSIONS['PagesController']) && $ADMIN_PERMISSIONS['PagesController']) || $ADMIN_USERS['User']['role']=='admin'){ ?>
				<li class="<?php if(($this->params['plugin']=="content_manager" or $this->params['controller']=="menus" or $this->params['controller']=="links"))echo "current"; ?>">
					<a href="" title="" class="contents">Content Manager</a>
					<ul>
						<li <?php if($this->params['controller']=="pages" ) echo "class=\"current\""; ?> ><?php echo $this->Html->link('Manage Content','/admin/content_manager/pages/index' );?></li>

						<li <?php if($this->params['controller']=="menus" or $this->params['controller']=="links") echo "class=\"current\""; ?> ><?php echo $this->Html->link('Manage Menu','/admin/menus/index' );?></li>

					</ul>
				</li>
				<?php }?>
				
				<?php if((isset($ADMIN_PERMISSIONS['SlidesController']) && $ADMIN_PERMISSIONS['SlidesController']) || $ADMIN_USERS['User']['role']=='admin'){ ?>
				<li class="<?php if(($this->params['plugin']=="slide_manager"))echo "current"; ?>">
					<a href="" title="" class="slides">Slide Manager</a>
					<ul>
						<li <?php if($this->params['controller']=="slides") echo "class=\"current\""; ?> ><?php echo $this->Html->link('Manage Slide','/admin/slide_manager/slides/index' );?></li>
					</ul>
				</li>
				<?php }?>
				
				<?php if($ADMIN_USERS['User']['role']=='admin'){ ?>
				<li class="<?php if($this->params['plugin']=="subadmin_manager")echo "current"; ?>">
					<a href="" title="" class="sub_admin">Sub Admin Manager</a>
					<ul>
						<li <?php if($this->params['action']=="admin_add") echo "class=\"current\""; ?> ><?php echo $this->Html->link('Add Sub Admin','/admin/subadmin_manager/users/add' );?></li>
						<li <?php if(($this->params['action']=="admin_index") || ($this->params['action']=="admin_permission")) echo "class=\"current\""; ?> ><?php echo $this->Html->link('Manage Sub Admin','/admin/subadmin_manager/users/index' );?></li>
					</ul>
				</li>
				<?php } ?>
				<!--
				<li class="<?php if($this->params['controller']=="messages") echo "current"; ?> ">
				<?php echo $this->Html->link('Message Manager', array('controller'=>'messages', 'action' => 'index'),array('class'=>'massage no-submenu'));?>
				</li>
				-->
				<?php if((isset($ADMIN_PERMISSIONS['MailsController']) && $ADMIN_PERMISSIONS['MailsController']) || $ADMIN_USERS['User']['role']=='admin'){ ?>
<!--
				<li class="<?php if(($this->params['plugin']=="mail_manager"))echo "current"; ?>">
					<a href="" title="" class="mail">Mail Format Manager</a>
					<ul>
						<li <?php if($this->params['controller']=="mails") echo "class=\"current\""; ?> ><?php echo $this->Html->link('Manage Mail Manger','/admin/mail_manager/mails/index' );?></li>
					</ul>
				</li>
-->
				<?php }?>
				
				<li class="<?php if(($this->params['controller']=="settings") ||($this->params['action']=="adminprofile"))echo "current"; ?>">
					<a href="" title="" class="settings">Settings</a>
					<ul>
						<li <?php if($this->params['action']=="admin_site") echo "class=\"current\""; ?> ><?php echo $this->Html->link('Site Configuration','/admin/settings/site' );?></li>
						<li class="<?php if($this->params['action']=="admin_changepassword") echo "current"; ?>"><?php echo $this->Html->link('Change Password', '/admin/settings/changepassword' );?></li>
						<li class="<?php if($this->params['action']=="adminprofile") echo "current"; ?>"><?php echo $this->Html->link('Change Profile', '/admin/adminprofile' );?></li>
						<li class="<?php if($this->params['action']=="admin_social") echo "current"; ?>"><?php echo $this->Html->link('Social Media Link', '/admin/settings/social' );?></li>
					</ul>
				</li>
				
			</ul>
		</nav>
		<!-- /Main Navigation -->
	</section>
	<!-- /Aside Block -->
	<!-- Main Content -->
	<section role="main">
		<?php echo $this->element('admin/breadcrumbs'); ?>
		<?php echo $content_for_layout; ?>
	</section> 
	<!-- /Fixed Layout Wrapper -->
	<!-- JS Libs at the end for faster loading -->
	<!--
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	-->
	<?php echo $this->Html->script('admin/libs/selectivizr.js'); ?>
	<?php //echo $this->Html->script('admin/jquery/jquery.nyromodal.js'); ?>
	<?php echo $this->Html->script('admin/jquery/jquery.tipsy.js'); ?>
	<?php //echo $this->Html->script('admin/jquery/jquery.wysiwyg.js'); ?>
	<?php //echo $this->Html->script('admin/jquery/jquery.datatables.js'); ?>
	<?php //echo $this->Html->script('admin/jquery/jquery.datepicker.js'); ?>
	<?php echo $this->Html->script('admin/jquery/jquery.fileinput.js'); ?>
	<?php echo $this->Html->script('admin/jquery/jquery.fullcalendar.min.js'); ?>
	<?php echo $this->Html->script('admin/jquery/excanvas.js'); ?>
	<?php //echo $this->Html->script('admin/jquery/jquery.visualize.js'); ?>
	<?php //echo $this->Html->script('admin/jquery/jquery.visualize.tooltip.js'); ?>
	<?php echo $this->Html->script('admin/script.js'); ?>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>

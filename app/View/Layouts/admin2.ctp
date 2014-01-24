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
	
	<link href="<?php echo Configure::read('Site.fav_icon'); ?>" type="image/x-icon" rel="shortcut icon" />
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	
	<!-- CSS Styles -->
	<?php echo $this->Html->css('admin/style.css');?>
	<?php echo $this->Html->css('admin/colors.css');?>
	<?php echo $this->Html->css('admin/jquery.tipsy.css');?>

	<script src= 
	"//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" 
	></script>
	
	 <script type='text/javascript' src= 
	'https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.m
	in.js'></script> 
	
	<link rel="stylesheet" type="text/css" href= 
	"http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base
	/jquery-ui.css" />
	<!-- Google WebFonts -->
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>
	<?php echo $this->Html->script('admin/libs/modernizr-1.7.min.js'); ?>
	

</head>
   <body class="login">
	<!-- /Aside Block -->
	
	<!-- Main Content -->
	<section role="main">
		
		<?php echo $content_for_layout; ?>
        
     </section> 
	

	
	<?php echo $this->Html->script('admin/libs/selectivizr.js'); ?>
	<?php echo $this->Html->script('admin/jquery/jquery.tipsy.js'); ?>
	<?php echo $this->Html->script('admin/jquery/jquery.fileinput.js'); ?>
	<?php echo $this->Html->script('admin/jquery/jquery.fullcalendar.min.js'); ?>
	<?php echo $this->Html->script('admin/jquery/excanvas.js'); ?>
	<?php echo $this->Html->script('admin/script.js'); ?>
	
</body>
</html>
<?php //echo $this->element('sql_dump'); ?>

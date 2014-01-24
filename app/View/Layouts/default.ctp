<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<meta name="keywords" content="<?=$metakeyword;?>">
<meta name="description" content="<?=$metadescription;?>">
<script><?php echo $setting['site']['site_google_analytic_code']; ?></script>
<title><?=$title_for_layout;?></title>
<link href="<?php echo Configure::read('Site.fav_icon'); ?>" type="image/x-icon" rel="shortcut icon" />
<!--<link rel="stylesheet" href="css/anythingslider.css">-->
<!--Js-->
<!--<script src="js/jquery-1.10.1.min.js"></script>-->


<?=$this->Html->css($css_for_layout); ?>  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>   
<?=$this->Html->script($script_for_layout); ?>
<!--end of script and css-->
<script>
$(document).ready(function(){
	$('ul.slimmenu').slimmenu(
	{
		resizeWidth: '800',
		collapserTitle: 'Menu',
		easingEffect:'easeInOutQuint',
		animSpeed:'medium',
		indentChildren: true,
		childrenIndenter: '&raquo;'
	});	
});
</script> 
<?php foreach($scriptBlocks as $scriptBlock){ ?>
    <?=$this->Html->scriptBlock($scriptBlock);?>
<?php } ?>

<?php foreach($cssBlocks as $cssBlock){ ?>
    <?=$this->Html->cssBlock($cssBlock);  ?>
<?php } ?>
<!--Banner CSS and JS-->

    
</head>
<body>
<div class="header-bg">
   <div class="wrapper">
       <div class="logo"><?php echo $this->Html->link($this->Html->image(Configure::read('Site.admin_logo')),'/',array('escape' => false)); ?>
      
       </div>  
       
		<div class="top-navigation">
             
             <?php echo  $this->Menu->menus(1); ?>
		   
		
        
    
		</div><!--end top-navigation-->
                                                
   </div><!--end wrapper-->
<div class="clear"></div>
</div><!--end header-bg-->

<div class="rev blank fullwidth">				
  
		<?php foreach($header_modules as $module){?>
		<?=$module?>
		<?php } ?>
		
</div> 

<div class="content">
     <div class="wrapper">
     
     <?=$content_for_layout ?>
           
     </div><!--end wrapper-->
</div><!--end content-->
<div class="upper-footer-bg">
<?php foreach($footer_modules as $footer){?>
		<?=$footer?>
		<?php } ?>
</div>
<div class="footer-bg">
  <?=$this->element('footer');?>
<div class="clear"></div>   
</div><!--end footer-bg-->

</body>

</html>

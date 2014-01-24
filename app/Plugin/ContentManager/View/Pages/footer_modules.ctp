

 <div class="upper-footer">
   <div class="wrapper">
        <div class="upper-footer-content">
          <h1>Welcome  to Datanomers!</h1>
          <?php echo $page['Page']['page_longdescription']; ?>
        </div><!--end upper-footer-content-->
        
        <div class="upper-footer-right">
			<?php echo $this->Html->link($this->Html->image('know-more.png'),array('controller'=>'pages','action'=>'view',3),array('escape' => false)); ?>
            
        </div><!--end upper-footer-right-->
   </div><!--end wrapper-->
 </div>  <!--end upper-footer-->


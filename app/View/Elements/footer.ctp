<div class="wrapper">
       <div class="footer-sections first-section">
          
           <?php echo $this->Html->link($this->Html->image('big-value.png',array('class'=>'big-value-button')),array('controller'=>'pages','action'=>'view',28),array('escape' => false)); ?>
       </div><!--end footer-sections-->
       
       <div class="footer-sections">
            <h3>Quick Links</h3>
            <?php echo  $this->Menu->menus(2); ?>
       </div><!--end footer-sections-->
       
      <div class="footer-sections">
            <h3>Connect with us</h3>
          <ul>   
				 <li><a href="<?=$setting['social']['facebook']?>" target="_blank"><?=$this->Html->image('Facebook.png');?></a></li>
				<li><a href="<?=$setting['social']['twitter']?>" target="_blank"><?=$this->Html->image('twitter.png');?></a></li>
				<li><a href="<?=$setting['social']['linkedin']?>" target="_blank"><?=$this->Html->image('linkedin.png');?></a></li>
				<li><a href="<?=$setting['social']['youtube']?>" target="_blank"><?=$this->Html->image('you-tube.png');?></a></li>
               
           </ul>    
       </div><!--end footer-sections-->
       
       <div class="footer-sections last-section">
            <h3>Contact Us</h3>
            <div class="loaction">Datanomers <br />4400 Rt. 9, <br />South Suite # 1000,<br /> Freehold, <br />New Jersey 07728</div>
            <div class="mail"><a href="mailto:sales@datanomers.com">sales@datanomers.com</a></div>
            <div class="phone">Tel: 732-863-1803</div>
       </div><!--end footer-sections-->
       
       <div class="copyright">Copyright &copy; 2014 DATANOMERS. All rights reserved. <?php echo $this->Html->link('Privacy Policy',array('controller'=>'pages','action'=>'view',29)); ?> | <?php echo $this->Html->link('Terms & Conditions',array('controller'=>'pages','action'=>'view',30)); ?></div><!--end copyright-->
       
   </div><!--end wrapper-->

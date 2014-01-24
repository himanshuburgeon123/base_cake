<?php foreach($pages as $pages){ ?>
<div class="solutions">
	
    <h3 class="heading-main"><?=$pages['Page']['name'];?></h3>
    <?=$pages['Page']['page_shortdescription'];?>
    <?php echo $this->Html->link('Learn More',array('controller'=>'pages','action'=>'view',$pages['Page']['id']),array('class'=>'solution-btn')) ?>
   
</div>
<?php } ?>   
   

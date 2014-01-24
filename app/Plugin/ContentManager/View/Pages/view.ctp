<?php if($page['Page']['id']!=17){?>
<h2><?=$page['Page']['name'];?>- View CTP</h2>
<?php } ?>
<?php echo $this->ShortLink->show($page['Page']['page_longdescription']);?>

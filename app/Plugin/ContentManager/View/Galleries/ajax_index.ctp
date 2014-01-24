 <?php $i = $this->paginator->counter('{:start}'); ?>
		<?php foreach($galleries as $gallery){?>
		<?php if(isset($gallery['Gallery']['image'])) {
					$frontImage = array('source_path'=>Configure::read('Path.Gallery'),'img_name'=>$gallery['Gallery']['image'],'width'=>Configure::read('image_front_width'),'height'=>Configure::read('image_front_height'),'noimg'=>Configure::read('Path.NoImage'));
					$resizedImg = $this->ImageResize->ResizeImage($frontImage);
					
				}?>
			<?php $img = 'img/gallery/'.$gallery['Gallery']['image'] ; ?>
			<a href='<?php echo $this->webroot.$img; ?>' class='lightview' data-lightview-group='example' data-lightview-title="" data-lightview-caption="">
				<div class="block"><?=$this->Html->image($resizedImg);?>
					<div class="gallery-hover-effect"><?=$this->Html->image('gallery-hover.png');?></div>
				<!--end gallery-hover-effect--> 
				</div><!--end block--> 
			</a>
<?php } ?>	

	 <?php
	$i = $this->paginator->counter('{:start}');
	//$i = 0;
	foreach ($galleries as $gallery) {
	?>
	<li id="sort_<?= $gallery['Gallery']['id'] ?>"  style="cursor:move" >
		<table width="100%">
			<tr>
				<td width="5%"><?php echo $this->Form->checkbox('Gallery.id.'.$i, array('value' => $gallery['Gallery']['id'])); ?></td>
				<td width="5%"><?php echo $i++; ?></td>
				
				
				<td width="20%"><?php echo $gallery['Gallery']['name']; ?></td>
				
				<td width="40%">
			 <?php 
				/* Resize Image */ 
				if(isset($gallery['Gallery']['image'])) {
					$imgArr = array('source_path'=>Configure::read('Path.Gallery'),'img_name'=>$gallery['Gallery']['image'],'width'=>Configure::read('image_list_width'),'height'=>Configure::read('image_list_height'),'noimg'=>Configure::read('Path.NoImage'));
					$resizedImg = $this->ImageResize->ResizeImage($imgArr);
					echo $this->Html->image($resizedImg);
				}
				?>

				</td>
				
				<td width="10%">
				<?php
				if ($gallery['Gallery']['status'] == '1')
					echo $this->Html->image('admin/icons/icon_success.png', array());
				else
					echo $this->Html->image('admin/icons/icon_error.png', array());
				?>
				</td>
				<td width="50%">
					<ul class="actions">
						<li><?php echo $this->Html->link('edit', array('controller' => 'galleries', 'action' => 'add',$gallery['Gallery']['page_id'], $gallery['Gallery']['id']), array('escape' => false, 'class' => 'edit', 'title' => 'Edit Gallery', 'rel' => 'tooltip')); ?></li>
						<li>
						<?=$this->Html->link('view', array('controller' => 'galleries', 'action' => 'view', $gallery['Gallery']['id']), array('escape' => false,'class'=>'view fancybox','title'=> __('View'),'rel'=>'tooltip'))?>
						
						</li>
						
														
					</ul >


				</td> 
			</tr>
		</table>
	</li>
	<?php } ?>

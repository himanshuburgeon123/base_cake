<?php
$i = $this->paginator->counter('{:start}');
	//$i = 0;
	foreach ($pages as $page) {
?>
	<li id="sort_<?= $page['Page']['id'] ?>"  style="cursor:move" >
		<table width="100%">
			<tr>
				<td width="5%"><?php echo $this->Form->checkbox('Page.id.'.$i, array('value' => $page['Page']['id'])); ?></td>
				<td width="6%"><?php echo $i++; ?></td>
				<td width="50%"><?php echo $page['Page']['name']; ?></td>
				<td width="10%">
				<?php
				if ($page['Page']['status'] == '1')
					echo $this->Html->image('admin/icons/icon_success.png', array());
				else
					echo $this->Html->image('admin/icons/icon_error.png', array());
				?>
				</td>
				<td width="65%">
					<ul class="actions">
						<li><?php echo $this->Html->link('edit', array('controller' => 'pages', 'action' => 'add', $page['Page']['parent_id'], $page['Page']['id']), array('escape' => false, 'class' => 'edit', 'title' => 'Edit Page', 'rel' => 'tooltip')); ?></li>
						<li>
						<?=$this->Html->link('view', array('controller' => 'pages', 'action' => 'view', $page['Page']['id']), array('escape' => false,'class'=>'view fancybox','title'=> __('View'),'rel'=>'tooltip'))?>
						
						</li>
						<li><?php if (!empty($page['Page']['sub_page'])) { ?><?php echo $this->Html->link('Manage Sub Content', array('controller' => 'pages', 'action' => 'index', $page['Page']['id']), array('escape' => false, 'class' => 'subcontent', 'title' => 'Manage Sub Content', 'rel' => 'tooltip')); ?>
							<?php } ?></li>	
							
						<?php if (!empty($page['Page']['gallery'])) {?>
						<li><?php echo $this->Html->link('Manage Gallery', array('controller'=>'galleries','action' =>'index',$page['Page']['id']), array('escape' => false,'class'=>'manageimage','title'=>'Manage Gallery','rel'=>'tooltip'));?></li>
						<?php } ?>									
					</ul >


				</td> 
			</tr>
		</table>
	</li>
	<?php } ?>

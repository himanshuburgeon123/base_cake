<?php
        $i = $this->paginator->counter('{:start}');
        foreach ($links as $link) {
         ?>
		<li id="sort_<?= $link['Link']['id'] ?>"  style="cursor:move" >
			<table width="100%">
				<tr>
					<td width="5%"><?php echo $this->Form->checkbox('Link.id.'.$i, array('value' => $link['Link']['id'])); ?></td>
					<td width="6%"><?php echo $i++; ?></td>
					<td width="65%"><?php echo $link['Link']['name']; ?></td>
					<td width="60%">
						<ul class="actions">
							<li><?php echo $this->Html->link('edit', array('controller' => 'links', 'action' => 'add', $link['Link']['menu_id'], $link['Link']['id']), array('escape' => false, 'class' => 'edit', 'title' => 'Edit Link', 'rel' => 'tooltip')); ?></li>
							<li>
							<?=$this->Html->link('view', array('controller' => 'links', 'action' => 'view', $link['Link']['id']), array('escape' => false,'class'=>'view fancybox','title'=> __('View'),'rel'=>'tooltip'))?>
							</li>
						</ul >
					</td> 
				</tr>
			</table>
		</li>
<?php } ?>

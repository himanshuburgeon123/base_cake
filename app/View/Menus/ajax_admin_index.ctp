<?php
 $i = $this->paginator->counter('{:start}');
	//$i = 0;
	foreach ($menus as $menu) {
	?>
	<li id="sort_<?= $menu['Menu']['id'] ?>"  style="cursor:move" >
		<table width="100%">
			<tr>
				<td width="12%"><?php echo $i++; ?></td>
				<td width="70%"><?php echo $menu['Menu']['name']; ?></td>
			  
				<?php
				//if ($page['Page']['status'] == '1')
					//echo $this->Html->image('admin/icons/icon_success.png', array());
				//else
					//echo $this->Html->image('admin/icons/icon_error.png', array());
				//?>
				</td>
				<td width="60%">
					<ul class="actions">
						<li><?php echo $this->Html->link('edit', array('controller' => 'menus', 'action' => 'add', $menu['Menu']['id']), array('escape' => false, 'class' => 'edit', 'title' => 'Edit Menu', 'rel' => 'tooltip')); ?></li>
						<li>
						<?=$this->Html->link('link', array('controller' => 'links', 'action' => 'index', $menu['Menu']['id']), array('escape' => false,'class'=>'editlink', 'title'=>'View Links','rel'=>'tooltip'))?>
						
						</li>
					</ul >
				</td> 
			</tr>
		</table>
	</li>
<?php } ?>

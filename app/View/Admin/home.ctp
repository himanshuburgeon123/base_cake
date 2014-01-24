<article>
	<header>
		<h2 style="cursor: s-resize;">Dashboard</h2>                        
        </header>
</article>
<?=$this->element('admin/message'); ?>

<article style="float:left;" class="half-block nested clearrm">
		<div  class="article-container">
				<header><h2 style="cursor: s-resize;">Content </h2></header>
				<section>
				<div class="table-form">					
				<div>
						<table cellspacing="0" cellpadding="0" border="1" style="border-collapse:collapse;" id="grdrecipe" rules="all">
						<tbody><tr>
								<th scope="col"></th>
								<th>SNo</th>
								<th> Title</th>                                			                        
								<th>Actions</th>	                                                      
						</tr>
				<?php  $i=1;  foreach($pages as $Page){?>		
						<tr>		
								<td></td>
								<td><?php echo $i;?></td>
								<td><?php echo $Page['Page']['name'];?></td>
								<td>
									<ul class="actions">
									<li><?php echo $this->Html->link('edit', array('plugin'=>'admin/content_manager','controller'=>'pages', 'action' => 'add/0',$Page['Page']['id']), array('escape' => false,'class'=>'edit','title'=>'Edit Page','rel'=>'tooltip'));?></li>                                                                                                                     
									</ul>
								</td>
						</tr>
				<?php  $i++; }  ?>
						</tbody>
						</table>
				</div>
				</div>
				</section>
				<footer>
				<p><?php echo $this->Html->link('View all', array('plugin'=>'admin/content_manager','controller'=>'pages', 'action' => 'index'), array('escape' => false));?></p>
				</footer>
		</div>		
</article>


<!--
<article style="float:right;" class="half-block nested clearrm">
		<div  class="article-container">
			<header><h2 style="cursor: s-resize;">Gallery </h2></header>
				<section>
				<div class="table-form">					
				<div>
					<table cellspacing="0" cellpadding="0" border="1" style="border-collapse:collapse;" id="grdcontent" rules="all">
					<tbody>
						<tr>
							<th scope="col"></th>
							<th>SNo</th>
							<th>Title</th>
							<th>Image</th>
							<th>Actions</th>
						</tr>
		<?php   //$i=1; foreach($gallerys as $gallery){ 
			//echo "<pre>";print_r($slide);die;?>
			<tr>
				<td></td>
				<td><?//ph//p echo $i;?></td>
				<td><?php// echo $gallery['name'];?></td>
				<td><?php //echo $this->Html->image($gallery['image'],array('width'=>80,'height'=>40)); ?></td> 
				<td>
					<ul class="actions">
						<li><?php //echo $this->Html->link('edit', array('plugin'=>'admin/gallery_manager','controller'=>'galleries', 'action' => 'add',$gallery['id']), array('escape' => false,'class'=>'edit','title'=>'Edit Item','rel'=>'tooltip'));?></li>
					</ul>
				</td>					
			</tr>
			<?php  //  $i++; } ?>
		</tbody>
	</table>
	</div>
	</div>					
	</section>
	<footer>
		<p><?php// echo $this->Html->link('View all', array('plugin'=>'admin/gallery_manager','controller'=>'galleries', 'action' => 'index'), array('escape' => false));?></p>
	</footer>
	</div>
</article>
-->

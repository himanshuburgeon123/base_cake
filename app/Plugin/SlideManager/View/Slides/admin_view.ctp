<div style="background:#f6f6f6; padding:8PX; max-height:550px; overflow-y:auto;" id="view2">
	<div style="padding:10px 0;">
		<div style="float:left; width:110px;"><b>Slide Name</b></div>
		<div align="justify;" style="float:left; width:400px;"><?=$slide['Slide']['name']?></div>
		<div style="clear:both;"></div>
	</div>
	
	<div style="padding:10px 0;">
		<div style="float:left; width:110px;"><b>Image</b></div>
		<div align="justify;" style="float:left; width:400px;">
	<?php 
		/* Resize Image */
		if(isset($slide['Slide']['image'])) {
			$imgArr = array('source_path'=>Configure::read('Path.Slide'),'img_name'=>$slide['Slide']['image'],'width'=>Configure::read('image_edit_width'),'height'=>Configure::read('image_edit_height'),'noimg'=>Configure::read('Path.Noimage'));
			$resizedImg = $this->ImageResize->ResizeImage($imgArr);
			echo $this->Html->image($resizedImg,array('border'=>'0'));
		}
		?>
	</div>
	<div style="padding:10px 0;">
		<div style="float:left; width:110px;"><b>Title</b></div>
		<div align="justify;" style="float:left; width:400px;"><?=$slide['Slide']['title']?></div>
		<div style="clear:both;"></div>
	</div>	
	<div style="padding:10px 0;">
		<div style="float:left; width:110px;"><b>Description</b></div>
		<div align="justify;" style="float:left; width:400px;"><?=$slide['Slide']['description']?></div>
		<div style="clear:both;"></div>
	</div>
	
	
	
	</div>

<div style="background:#f6f6f6; padding:8PX; max-height:550px; overflow-y:auto;" id="view2">
	<div style="padding:10px 0;">
		<div style="float:left; width:110px;"><b>Gallery Title</b></div>
		<div align="justify;" style="float:left; width:400px;"><?=$gallery['Gallery']['name']?></div>
		<div style="clear:both;"></div>
	</div>
	
	
	<div style="padding:10px 0;">
		<div style="float:left; width:110px;"><b>Gallery image</b></div>
		<div align="justify" style="float:left; width:400px;"><?php 
		/* Resize Image */
		if(isset($gallery['Gallery']['image'])) {
			$imgArr = array('source_path'=>Configure::read('Path.Gallery'),'img_name'=>$gallery['Gallery']['image'],'width'=>Configure::read('image_edit_width'),'height'=>Configure::read('image_edit_height'),'noimg'=>Configure::read('Path.Noimage'));
			$resizedImg = $this->ImageResize->ResizeImage($imgArr);
			echo $this->Html->image($resizedImg,array('border'=>'0'));
		}
		?></div>
		<div style="clear:both;"></div>
	</div>
	
	

</div>

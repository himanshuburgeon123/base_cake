<?php
class ImageResizeComponent extends Component {
	public $image;
	public $image_type;
	public $filter = 0;


public function test(){
	echo "sdfsfsd";
}
public function load($filename) {
	$this->filter = 0;
$image_info=array();
$image_info = getimagesize($filename);
$this->image_type = $image_info[2];
if( $this->image_type == IMAGETYPE_JPEG ) {
$this->image = imagecreatefromjpeg($filename);
} elseif( $this->image_type == IMAGETYPE_GIF ) {
$this->image = imagecreatefromgif($filename);
} elseif( $this->image_type == IMAGETYPE_PNG ) {
$this->image = imagecreatefrompng($filename);
}
}
public function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
if( $image_type == IMAGETYPE_JPEG ) {
imagejpeg($this->image,$filename,$compression);
} elseif( $image_type == IMAGETYPE_GIF ) {
imagegif($this->image,$filename);
} elseif( $image_type == IMAGETYPE_PNG ) {
	
imagepng($this->image,$filename);
}
if( $permissions != null) {
chmod($filename,$permissions);
}
}
public function output($image_type=IMAGETYPE_JPEG) {
if( $image_type == IMAGETYPE_JPEG ) {
imagejpeg($this->image);
} elseif( $image_type == IMAGETYPE_GIF ) {
imagegif($this->image);
} elseif( $image_type == IMAGETYPE_PNG ) {
imagepng($this->image);
}
}
public function getWidth() {
return imagesx($this->image);
}
public function getHeight() {
return imagesy($this->image);
}
public function resizeToHeight($height) {
$ratio = $height / $this->getHeight();
$width = $this->getWidth() * $ratio;
$this->resize($width,$height);
}
public function resizeToWidth($width) {
$ratio = $width / $this->getWidth();
$height = $this->getheight() * $ratio;
$this->resize($width,$height);
}
public function scale($scale) {
$width = $this->getWidth() * $scale/100;
$height = $this->getheight() * $scale/100;
$this->resize($width,$height);
}
public function resize($width,$height) {
	
	if($this->filter==0){
		if($this->getWidth() == $this->getHeight()){
			$this->filter=1;
				
		}
		else if($this->getWidth() > $this->getHeight()){
				$this->filter=1;
				if($this->getWidth() < $width){
					$width = $this->getWidth(); 
				}
				 $this->resizeToWidth($width);
				 return;
		}else if($this->getWidth() < $this->getHeight()){
			
			$this->filter=1;
			if($this->getHeight() < $height){
					$height = $this->getHeight();  
				}
			$this->resizeToHeight($height);
			return;
		}
	}
	
	
	
$new_image = imagecreatetruecolor($width, $height);






if( $this->image_type == IMAGETYPE_PNG ) {
	imagealphablending($new_image, false);
	imagesavealpha($new_image, true);
	$background = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
	imagecolortransparent($new_image, $background);
}else{
	$background = imagecolorallocate($new_image, 255, 255, 255);
}
imagefilledrectangle($new_image, 0, 0, $width, $height, $background);

imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
$this->image = $new_image;

}

public function getThumbImage($source_path,$dest_path,$img_name,$width,$height,$no_image = ''){
	$slice_image_name = explode('.',$img_name);
	$ext = array_pop($slice_image_name);
	$thumb_name = implode('.',$slice_image_name).'_thumb_'.$width.'_'.$height.'.'.$ext;
	
	if(!file_exists($dest_path.$thumb_name)){
		
		$this->load($source_path.$img_name);
		$this->resize($width,$height);
		$this->save($dest_path.$thumb_name,$this->image_type);
	}
	
	
	return ltrim(strstr($dest_path.$thumb_name,'img/'),'img/');
	
}

}
?>

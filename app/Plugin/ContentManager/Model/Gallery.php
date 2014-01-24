<?php
class Gallery extends AppModel {
     public $name = 'Gallery';
     
     
      public $validate = array(
	       'name'=>
		       array(
			       'rule1'=> 
				       array(
					       'rule'    => array('maxLength', 30),
					       'message' => 'Title should be less than 30 character(s)'
				       ),
				       array(
					       'rule' =>'notEmpty',
					       'message'=>'Please enter title'
				       ),
				       
		       ),
			'image' =>
				array(
					'rule1'=>
					array(
						'rule' =>'validate_image',
						'message' => 'Please upload a valid image.'
						//'on' => 'create'
				),
				'size' => array(
						'rule'    => array('check_size'),
						'message' => 'Please upload a valid image having dimension more than 50x50.'			
				)	  
			),	
				
		    );
     
	function validate_image() {
		if((!empty($this->data['Gallery']['id'])) && $this->data['Gallery']['image']['name']=='') {
			return true;
		}else{
			if(!empty($this->data['Gallery']['image']['name'])) {
				$file_part = explode('.',$this->data['Gallery']['image']['name']);
				$ext = array_pop($file_part);		
				if(!in_array(strtolower($ext),array('gif', 'jpeg', 'png', 'jpg'))) {
					return false;
				}
			}
		return true;
		}
	}
	
	public function check_size(){
		if((!empty($this->data['Gallery']['id'])) && $this->data['Gallery']['image']['tmp_name']=='') {
			return true;
		}else {
			if($this->data['Gallery']['image']['error'] < 1){
				$imgSize = @getImageSize($this->data['Gallery']['image']['tmp_name']);
				if($imgSize[0]>=50 && $imgSize[1]>=50)
				{
					return true;
				}
			}
			return false;
		}
	}
}
?>

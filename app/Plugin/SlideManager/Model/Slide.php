<?php
Class Slide extends SlideManagerAppModel {
	public $name = "Slide";
	
	public $validate = array(
	
	'name' =>
        array(
            'rule1' =>
            array(
                'rule' => array('maxLength', 255),
                'message' => 'Slide name should be less than 255 charcter(s).'
            ),
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter slide name.'
            ) 
        ),

        'title' =>
        array(
            'rule1' =>
            array(
                'rule' => array('maxLength', 500),
                'message' => 'Title should be less than 500 charcter(s).'
            ),
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter slide title.'
            ) 
        ),
        'description' =>
        array(
            'rule1' =>
            array(
                'rule' => array('maxLength', 255),
                'message' => 'Description should be less than 500 charcter(s).'
            ),
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter description.'
            ) 
        ),
		//'image' =>
        //array(
            //'rule1'=>
            //array(	
					//'rule' =>'validate_image',
					//'message' => 'Please upload a valid image.',
					////'on' => 'create'
					//'notEmpty'=>true
			//)
        //),   
         'image' =>
			array(
				'rule1'=>
				array(
						'rule' =>'validate_image',
						'message' => 'Please upload a valid logo image.'
						//'on' => 'create'
					 ),
					'size' => array(
						'rule'    => array('check_size_image'),
						'message' => 'Please upload a valid image having dimension 1400x515 pixels.'			
					)	  
                      
        ),   
        /*'logo' =>
        array(
            'rule1'=>
            array(	
					'rule' =>'validate_logo',
					'message' => '<br/>Please upload a valid logo image',
			),
			'size' => array(
					'rule'    => array('check_size_logo'),
					'message' => 'Please upload a valid logo image having dimension between 150x50 pixels or 285x60 pixels.'			
			)	 
		)*/
		
		//'logo' =>
			//array(
				//'rule2' =>
					//array(
						//'rule' =>array('extension', array('gif', 'jpeg', 'png', 'jpg')),
						//'message' => 'Please upload a valid logo image',
						//'on' => 'create',
						//'on'=>'update'
					//)
            
		//), 		
         
    );
    
    function validate_image() {
		if((!empty($this->data['Slide']['id'])) && $this->data['Slide']['image']['name']=='') {
			return true;
		}else{
			if(!empty($this->data['Slide']['image']['name'])) {
				$file_part = explode('.',$this->data['Slide']['image']['name']);
				$ext = array_pop($file_part);		
				if(!in_array(strtolower($ext),array('gif', 'jpeg', 'png', 'jpg'))) {
					return false;
				}
			}
		return true;
		}
	}
	
	public function check_size_image(){
		if((!empty($this->data['Slide']['id'])) && $this->data['Slide']['image']['tmp_name']=='') {
			return true;
		}else {
			if($this->data['Slide']['image']['error'] < 1){
				$imgSize = @getImageSize($this->data['Slide']['image']['tmp_name']);
				if(($imgSize[0]==1400 ) && ($imgSize[1]==515 ))
				{
					return true;
				}
			}
			return false;
		}
	}
	public function check_size_logo(){
		if((!empty($this->data['Slide']['id'])) && $this->data['Slide']['logo']['tmp_name']=='') {
			return true;
		}else {
			if($this->data['Slide']['logo']['error'] < 1){
				$imgSize = @getImageSize($this->data['Slide']['logo']['tmp_name']);
				if(($imgSize[0]>=120 && $imgSize[0]<=285) && ($imgSize[1]>=50 && $imgSize[1]<=62))
				{
					return true;
				}
			}
			return false;
		}
	}
	function validate_logo() {
		if((!empty($this->data['Slide']['id'])) && $this->data['Slide']['logo']['name']=='') {
			return true;
		}else{
			if(!empty($this->data['Slide']['logo']['name'])) {
				$file_part = explode('.',$this->data['Slide']['logo']['name']);
				$ext = array_pop($file_part);		
				if(!in_array(strtolower($ext),array('gif', 'jpeg', 'png', 'jpg'))) {
					return false;
				}
			}
		return true;
		}
	}
   
}
?>

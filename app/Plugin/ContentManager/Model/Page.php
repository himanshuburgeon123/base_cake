<?php
Class Page extends ContentManagerAppModel {
	public $name = "Page";
	public $page_action = "";
	public $validate = array(
	
	'name' =>
        array(
            'rule1' =>
            array(
                'rule' => array('maxLength', 255),
                'message' => 'Name should be less than 255 charcter(s).'
            ),
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter name.'
            ) 
        ),
        
        'page_title' =>
        array(
            'rule1' =>
            array(
                'rule' => array('maxLength', 255),
                'message' => 'Seo title should be less than 255 charcter(s).'
            ),
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter seo title.'
            ) 
        ),
		'banner_image' =>
			array(
				'rule1'=>
				array(
					'rule' =>'validate_image',
					'message' => 'Please upload a valid banner image.'
					//'on' => 'create'
			),
			'size' => array(
					'rule'    => array('check_size'),
					'message' => 'Please upload a valid banner image having dimensions  1400x350  in pixel.'			
			)	  
		),	
        
		'url_key' =>array(
			array(
					'rule' =>'notEmpty',
					'message'=>'Please enter slug url key.'
				),
			array(
                'rule' => array('maxLength', 125),
                'message' => 'name should be less than 125 character(s).'
				),
				'isUnique'=>array(
							'rule'=>array('isUnique'),
							'message'=>'This page url already been taken.',
							 
				),
				'pattern'=>array(
					'rule'      => 'urlkeycheck',
					'message'   => 'Only letters are allowed.',
				)
			),
			
		 'message' =>
        array(
            'rule1' =>
            array(
                'rule' => array('maxLength', 1000),
                'message' => 'Message should be less than 1000 charcter(s).'
            ),
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter your message.'
            ) 
        ),
        
        'email' =>
        array(
            'rule1' =>
            array(
                'rule' => array('email', true),
                'message' => 'Please enter valid email address.'
            ),
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter email address.'
            ) 
        ),
        
		'city' =>
        array(
            'rule1' =>
            array(
				'rule' => array('maxLength', 100),
                'message' => 'City name can\'t be more than 100 character.'
            ),
            array(
                'rule' => 'notEmpty',
                'message' => 'Please enter city.'
            ) 
        ),
        
        'phone' => array(
			'notEmpty'=>array(
					'rule' =>array('notEmpty'),
					'message'=> 'Please enter phone no.'
					),
				'valid'=>array(
					'rule'=>array('isValidUSPhoneFormat'),
					'message'=>'Please enter valid phone number.'
					),
				'between' => array(
					'rule' => array('between', 8,15 ),
					'message' => 'Phone number must be between 8 to 15 digits.'
					)		
					
		),	
          
    );
    public function afterSave($created , $options = array()) {
		App::import('model','ShortLink');
		$ShortLink = new ShortLink();
		if(!$ShortLink->find('count',array('conditions'=>array('ShortLink.object_id'=>$this->id,'ShortLink.module'=>'Page')))){
			$shortlink['ShortLink']['short_code'] = "{".$this->data['Page']['url_key']."}";
			$shortlink['ShortLink']['object_id'] = $this->id;
			$shortlink['ShortLink']['module'] = "Page";
			$ShortLink->save($shortlink);
		}
		Cache::delete('cake_page_routing');
	}
	
	public function afterDelete(){
		App::import('model','ShortLink');
		$ShortLink = new ShortLink();
		$ShortLink->deleteAll(array('ShortLink.object_id'=>$this->id,'ShortLink.module'=>'Page'),false);
		Cache::delete('cake_page_routing');
	}
	
    
    public function urlkeycheck($check){
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];
        return preg_match('|^[a-zA-Z-_]+$|', $value);
    }
    
	function isValidUSPhoneFormat($phone){
		$phone=$this->data['Page']['phone'];
		$errors = array();
			if(empty($phone)) {
			   $errors [] = "Please enter phone number";
			}
			else if (!preg_match('/^\+?[0-9 \-]+$/', $phone)) {
				$errors [] = "Please enter valid phone number.";
			} 
		   
			if (!empty($errors))
			return false;//implode("\n", $errors);
			return true;
	}
	
	function validate_image(){
		if((!empty($this->data['Page']['id'])) && $this->data['Page']['banner_image']['name']=='') {
			return true;
		}else{
			if(!empty($this->data['Page']['banner_image']['name'])) {
				$file_part = explode('.',$this->data['Page']['banner_image']['name']);
				$ext = array_pop($file_part);		
				if(!in_array(strtolower($ext),array('gif', 'jpeg', 'png', 'jpg'))) {
					return false;
				}
			}
		return true;
		}
	}
	
	public function check_size(){
		if((!empty($this->data['Page']['id'])) && $this->data['Page']['banner_image']['tmp_name']=='') {
			return true;
		}else{
			if($this->data['Page']['banner_image']['error'] < 1){
				$imgSize = @getImageSize($this->data['Page']['banner_image']['tmp_name']);
				if(($imgSize[0]==1400 ) && ($imgSize[1]==350 ))
				{
					return true;
				}
			}
			return false;
		}
	}
   
}
?>

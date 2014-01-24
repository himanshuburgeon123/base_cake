<?php

class Account extends AssociationManagerAppModel {
	public $name = 'Account';

	var $hasOne = array('Profile' =>
			array('className'    => 'Profile',
				  'conditions'   => '',
				  'order'        => '',
				  'dependent'    =>  true,
				  'foreignKey'   => 'account_id'
			)
	);
	
	var $hasMany = array(
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'account_id',
            'conditions' => '',
            'order' => 'Post.id DESC',
            //'limit' => '5',
            'dependent' => true
        )
    );
	
		  
	public $validate = array(
	   'name'=>
		   array(
			   'rule1'=> 
				   array(
					   'rule'    => array('maxLength', 50),
					   'message' => 'Name should be less than 50 character(s)'
				   ),
				   array(
					   'rule' =>'notEmpty',
					   'message'=>'Please enter name'
				   ),
				   
		   ),
		'age' =>
			array(
				'rule1' =>
				 array(
				   'rule' =>'notEmpty',
				   'message'=>'Please enter age'
			   ),
				array(
					 'rule' => 'numeric',
					 'message' => 'Age must be numeric.'
				),
				'between' => array(
					'rule' => array('between',1,3 ),
					'message' => 'Age should be between 2 and 3 digit.'
				)	
		),

	);          
}

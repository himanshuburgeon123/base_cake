<?php
Class Profile extends AssociationManagerAppModel {
	public $name = 'Profile';
	var $belongsTo = array('Account' =>
                       array('className'  => 'Account',
                             'conditions' => '',
                             'order'      => '',
                             'foreignKey' => 'account_id'
                       )
                 );
                 
                 
		public $validate = array(
	     
			'company'=>
		       array(
			       'rule1'=> 
				       array(
					       'rule'    => array('maxLength', 50),
					       'message' => 'Company should be less than 50 character(s)'
				       ),
				       array(
					       'rule' =>'notEmpty',
					       'message'=>'Please enter company'
				       ),
				       
		       ),    
			'position'=>
		       array(
			       'rule1'=> 
				       array(
					       'rule'    => array('maxLength', 50),
					       'message' => 'Position should be less than 50 character(s)'
				       ),
				       array(
					       'rule' =>'notEmpty',
					       'message'=>'Please enter position'
				       ),
				       
		       ),    
		
		    );           


}
?>

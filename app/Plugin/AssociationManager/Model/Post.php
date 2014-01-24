<?php
Class Post extends AssociationManagerAppModel {
	public $name = 'Post';
	var $belongsTo = array('Account' =>
                       array('className'  => 'Account',
                             'conditions' => '',
                             'order'      => '',
                             'foreignKey' => 'account_id'
                       )
                 );

		public $validate = array(
	     
			'message'=>
		       array(
			       'rule1'=> 
				       array(
					       'rule'    => array('maxLength', 1500),
					       'message' => 'Message should be less than 1500 character(s)'
				       ),
				       array(
					       'rule' =>'notEmpty',
					       'message'=>'Please enter message'
				       ),
				       
		       ),    

		    );           


}
?>

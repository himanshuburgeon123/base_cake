<?php

Class ContentManagerAppController extends AppController{
		
		function beforeFilter() {
			parent::beforeFilter();	
		Configure::load('ContentManager.config');
		 
		}
	
	}


?>

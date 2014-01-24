<?php
class SettingsController extends AppController {
	public $uses = array('Setting');
	public $paginate = array();
    public $id = null;    
	
	
	
	
	 function admin_social(){
			
		$this->loadModel('Setting');
		if(!empty($this->request->data) && self::_validate_social_media(1)){
			//echo '<pre>';print_r($this->request->data);die;
			foreach($this->request->data['Setting'] as $key => $value){
				if(is_array($value)){
					if($value['error']==0){
						$ext = explode(".",$value['name']);
						$name = explode("_",$key);
						
					}else{
						continue;
						////	$value;
					}
				}
				
				if($this->Setting->find('count',array('conditions'=>array('Setting.key'=>$key,'Setting.module'=>'social')))){
					
					$this->Setting->query("UPDATE `settings` SET `values`=\"$value\" , module=\"social\" WHERE `key`=\"$key\"");
				
				} else{
					$this->Setting->query("INSERT `settings` SET `values`=\"$value\"  , `key`=\"$key\" , module=\"social\"");
				}
				
				$this->Session->setFlash(__('links has been Saved Successfully'));
				//$this->Session->setFlash('Setting has been Saved Successfully');
				
				//$this->Session->setFlash(__('Setting has been Saved Successfully'), 'default', array(), 'error');
			}
			Cache::delete('social');
			$this->redirect(array('action'=>'social'));
			//echo '<pre>';print_r($this->request->data);die;
		}
		if(empty($this->request->data)){
			$this->request->data['Setting'] = $this->Setting->find('list',array('fields'=>array('Setting.key','Setting.values')));
		}else{
			$data = $this->Setting->find('list',array('fields'=>array('Setting.key','Setting.values')));
			$this->request->data['Setting']['facebook'] = $data['facebook'];
			$this->request->data['Setting']['linkedin'] = $data['linkedin'];
			
			
		}

		//Cache::write('site', $this->request->data);
		
		
		$this->breadcrumbs[] = array(
			'url'=>Router::url('/admin/home'),
			'name'=>'Home'
		);
		$this->breadcrumbs[] = array(
			'url'=>Router::url('/admin/settings/site'),
			'name'=>'Site Setting'
		);
		
		
		
	}
       
	
    public function admin_site(){
		$this->loadModel('Setting');
		if(!empty($this->request->data) && self::_validate(1)){
			if($this->request->data['Setting']['site_google_analytic_code']!=''){
				$this->request->data['Setting']['site_google_analytic_code']=strip_tags($this->request->data['Setting']['site_google_analytic_code']);
			}
			foreach($this->request->data['Setting'] as $key => $value){
				if(is_array($value)){
					if($value['error']==0){
						$ext = explode(".",$value['name']);
						$name = explode("_",$key);
						if(!file_exists(Configure::read('Path.site'))) {
							App::uses('Folder', 'Utility');
							mkdir(Configure::read('Path.site'), 0777);
							$dir = new Folder();
							$dir->chmod(Configure::read('Path.site'), 0777, true, array());	
						}
						
						
						$img_name = array_pop($name).".".array_pop($ext);
						move_uploaded_file($value['tmp_name'],Configure::read('Path.site').$img_name);
						$value = $img_name;
					}else{
						continue;
						//	$value;
					}
				}
				
				if($this->Setting->find('count',array('conditions'=>array('Setting.key'=>$key,'Setting.module'=>'site')))){
					
					$this->Setting->query("UPDATE `settings` SET `values`=\"$value\" , module=\"site\" WHERE `key`=\"$key\"");
				
				} else{
					$this->Setting->query("INSERT `settings` SET `values`=\"$value\"  , `key`=\"$key\" , module=\"site\"");
				}
				
				$this->Session->setFlash(__('Setting has been Saved Successfully'));
				//$this->Session->setFlash('Setting has been Saved Successfully');
				
				//$this->Session->setFlash(__('Setting has been Saved Successfully'), 'default', array(), 'error');
			}
			Cache::delete('site');
			 $this->redirect(array('action'=>'site'));
			//echo '<pre>';print_r($this->request->data);die;
		}
		if(empty($this->request->data)){
			$this->request->data['Setting'] = $this->Setting->find('list',array('fields'=>array('Setting.key','Setting.values')));
		}else{
			$data = $this->Setting->find('list',array('fields'=>array('Setting.key','Setting.values')));
			
			//$this->request->data['Setting']['site_logo'] = $data['site_logo'];
			//$this->request->data['Setting']['site_icon'] = $data['site_icon'];
			//$this->request->data['Setting']['site_noimage'] = $data['site_noimage'];
		}

		//Cache::write('site', $this->request->data);
		
		
		$this->breadcrumbs[] = array(
			'url'=>Router::url('/admin/home'),
			'name'=>'Home'
		);
		$this->breadcrumbs[] = array(
			'url'=>Router::url('/admin/settings/site'),
			'name'=>'Site Setting'
		);
		
		
		
	}
	
	private function _validate($id = null){
		if($id==1){ // validation for admin_site function
			if(trim($this->request->data['Setting']['site_name'])==""){
				$this->Session->setFlash(__('Please Enter Site name'), 'default', array(), 'error');
				return false;
			}
			if(trim($this->request->data['Setting']['site_url'])==""){
				$this->Session->setFlash(__('Please Enter Valid Site url'), 'default', array(), 'error');
				return false;
			}
			if(trim($this->request->data['Setting']['site_contact_email'])==""){
				$this->Session->setFlash(__('Please Enter Valid contact email address'), 'default', array(), 'error');
				return false;
			}
			if (!filter_var($this->request->data['Setting']['site_contact_email'], FILTER_VALIDATE_EMAIL)) {
				$this->Session->setFlash(__('Please Enter Valid contact email address'), 'default', array(), 'error');
				return false;
			}
			//echo "<pre>";print_r($this->request->data);die;
			/*if($this->request->data['Setting']['site_logo']['error']==0){
				if($this->request->data['Setting']['site_logo']['type']!="image/png" && $this->request->data['Setting']['site_logo']['type']!="image/jpeg" && $this->request->data['Setting']['site_logo']['type']!="image/jpg"  && $this->request->data['Setting']['site_logo']['type']!="image/gif"){
					$this->Session->setFlash(__('Please upload png , gif , jpeg format image'), 'default', array(), 'error');
					return false;
					
				}
				if($this->request->data['Setting']['site_logo']['size'] <= 5000 && $this->request->data['Setting']['site_logo']['size'] >=15360 ){
					$this->Session->setFlash(__('Logo image size is not valid'), 'default', array(), 'error');
					return false;
				}
			}*/
			
			/*if($this->request->data['Setting']['site_icon']['error']==0){
				if($this->request->data['Setting']['site_icon']['type']!="image/x-icon"){
					$this->Session->setFlash(__('Please upload only icon format image'), 'default', array(), 'error');
					return false;
					
				}
				if($this->request->data['Setting']['site_icon']['size'] <= 5000 && $this->request->data['Setting']['site_icon']['size'] >=10240 ){
					$this->Session->setFlash(__('Icon image size is not valid'), 'default', array(), 'error');
					return false;
				}
			}
			if($this->request->data['Setting']['site_noimage']['error']==0){
				if($this->request->data['Setting']['site_noimage']['type']!="image/png" && $this->request->data['Setting']['site_noimage']['type']!="image/jpeg" && $this->request->data['Setting']['site_noimage']['type']!="image/jpg"  && $this->request->data['Setting']['site_noimage']['type']!="image/gif"){
					$this->Session->setFlash(__('Please upload only no-image image format image'), 'default', array(), 'error');
					return false;
					
				}
				
			}*/
			if(trim($this->request->data['Setting']['site_title'])==""){
				$this->Session->setFlash(__('Please Enter Site title'), 'default', array(), 'error');
				return false;
			}
			
		}
                else if($id==2){
                    $this->loadModel('User');
                     $user = $this->User->read(null, $this->Auth->user('id'));
                     $encryptedPassword = $this->Auth->password($this->request->data['User']['oldpassword']);
                     if($encryptedPassword != $user['User']['password']){
                         $this->Session->setFlash('Your current password didn\'t match.','default','','error');
                         return false;
                    }
                    if(trim($this->request->data['User']['password'])==''){
						$this->Session->setFlash('Please Enter new password','default','','error');
                         return false;
					}
                    if($this->request->data['User']['password']!=$this->request->data['User']['password2']){
                         $this->Session->setFlash('Your new password and confirm password does not match','default','','error');
                         return false;
                    }
                }
		return true;
	}
	
	function validation(){
		
		  $this->autoRender = false;
			
		  $this->Setting->set($this->request->data);
		  $result = array();
		  if ($this->Setting->validates()) {
			  $result['error'] = 0;
		  }else{
			  $result['error'] = 1;
		  }
		  $result['errors'] = $this->Setting->validationErrors;
		  $errors = array();
		 
		  foreach($result['errors'] as $field => $data){
			  $errors['Setting'.Inflector::camelize($field)] = array_pop($data);
		  }
		 
		 $result['errors'] = $errors;
		 
		 if($this->request->is('ajax')) {
			  echo json_encode($result);
			  //<span class="error-message">Inserisci il nome del proprietario</span>
			  return;
		  } 
		 
		  
	  }
       
       
       private function _validate_social_media($id = null){
		//if($id==1){ // validation for admin_site function
			if(trim($this->request->data['Setting']['facebook'])==""){
				$this->Session->setFlash(__('Please Enter Facebook Url'), 'default', array(), 'error');
				return false;
			}
			
			if(trim($this->request->data['Setting']['twitter'])==""){
				$this->Session->setFlash(__('Please Enter Twitter Url'), 'default', array(), 'error');
				return false;
			}
			
			if(trim($this->request->data['Setting']['linkedin'])==""){
				$this->Session->setFlash(__('Please Enter Linkedin Url'), 'default', array(), 'error');
				return false;
			}
			//echo "<pre>";print_r($this->request->data);die;
			
		
			//if(trim($this->request->data['Setting']['google_plus'])==""){
				//$this->Session->setFlash(__('Please Enter Google Plus Url'), 'default', array(), 'error');
				//return false;
			//}
			
		//}
             
		return true;
	} 
         

        
        function admin_changepassword(){
            if (!empty($this->request->data) && self::_validate(2)){
                $data = $this->User->read(null, $this->Auth->user('id'));
                //$data['User']['id'] = $this->Auth->user('id');
                //$data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
                $data['User']['password'] = $this->request->data['User']['password'];
                //echo '<pre>';print_r($data);
                $this->User->create();
                $this->User->save($data);
                //die;
                $this->Session->setFlash('Your password changed successfully.');
            }
                
                $this->request->data = array();
            
            
            
            $this->breadcrumbs[] = array(
			'url'=>Router::url('/admin/home'),
			'name'=>'Home'
		);
            $this->breadcrumbs[] = array(
                    'url'=>Router::url('/admin/settings/changepassword'),
                    'name'=>'Change Password'
            );
            
        }
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php
Class AccountsController extends AssociationManagerAppController{
	public $uses = array('AssociationManager.Account','AssociationManager.Profile','AssociationManager.Post');
	public $paginate = array();
	public $id = null;
	
	function admin_index($search=null){
		
		/**In this searching and record displaying is performed using model HABTM**/
		
		$this->paginate = array();
		$condition = null;
		$this->paginate['limit']=20;
		if($this->request->is('post')){
			$this->redirect(array('plugin'=>'association_manager','controller'=>'accounts','action'=>'index',$this->request->data['search']));
		}
		$this->paginate['order']=array('Account.id'=>'DESC');		
		if($search!=null){
			$search = urldecode($search);
			$condition['OR']['Account.name like'] = $search.'%';
			$condition['OR']['Profile.company like'] = $search.'%';
		}
		$accounts=$this->paginate("Account", $condition);	
		$this->breadcrumbs[] = array(
			'url'=>Router::url('/admin/home'),
			'name'=>'Home'
		);
		$this->breadcrumbs[] = array(
			'url'=>Router::url('/admin/association_manager/accounts'),
			'name'=>'Manage Account'
		);
		$this->set('accounts',$accounts);
		$this->set('search',$search);
		$this->set('url','/'.$this->params->url);
	}
		 
	function admin_add($id=null){
			
		$this->breadcrumbs[] = array(
		'url'=>Router::url('/admin/home'),
		'name'=>'Home'
		);
		$this->breadcrumbs[] = array(
				'url'=>Router::url('/admin/association_manager/accounts'),
				'name'=>'Manage Account'
		);
		$this->breadcrumbs[] = array(
				'url'=>Router::url('/admin/association_manager/accounts/add'),
				'name'=>($id==null)?'Add Account':'Update Account'
		);
	
		if(!empty($this->request->data) && !$this->validation()){
			$this->Account->create();
			if($this->Account->save($this->request->data)) {
				$this->request->data['Profile']['account_id'] = $this->Account->id;
				$this->Profile->save($this->request->data);
				if ($this->request->data['Account']['id']){
					$this->Session->setFlash(__('Account has been updated successfully'));
				}else{
					$this->Session->setFlash(__('Account has been added successfully'));
				}
				$this->redirect($this->request->data['Account']['redirect']);
			}
		}else{
			if($id!=null){
				$this->request->data = $this->Account->read(null,$id);
			}else{
				$this->request->data = array();
			}
		}
		$redirect_url=(Controller::referer()=="/")? Router::url('/admin/association_manager/accounts') :Controller::referer();
		$this->set('url',$redirect_url);
    }
    
    function admin_view($id = null){
		
		/**In this record displaying using model HABTM**/
		
		$this->layout = '';
		$criteria = array();
        $criteria['conditions'] = array('Account.id'=>$id);
        $record =  $this->Account->find('first', $criteria);
        $this->set('account', $record);
	}

	function validation(){
		$this->Account->set($this->request->data);	
		$this->Profile->set($this->request->data);
		$result = array();
			if($this->Account->validates() && $this->Profile->validates()){
				$result['error'] = 0;
			}else{
				$result['error'] = 1;
			}
			if($this->request->is('ajax')) {
				$this->autoRender = false;
				$result['errors'] = $this->Account->validationErrors;
				$errors = array();
			foreach($result['errors'] as $field => $data){
				$errors['Account'.Inflector::camelize($field)] = array_pop($data);
				
			}
				$result['errors'] = $errors;
				echo json_encode($result);
				return;
			}
			return $result['error']; 
		  
	}

	
}


?>

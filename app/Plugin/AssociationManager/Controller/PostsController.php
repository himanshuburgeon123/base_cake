<?php
Class PostsController extends AssociationManagerAppController{
	public $uses = array('AssociationManager.Account','AssociationManager.Profile','AssociationManager.Post');
	public $paginate = array();
	public $id = null;
	
	function admin_messages($account_id=null,$search=null,$limit=20){
		
		if($account_id==null){
			$this->redirect(array('plugin'=>'association_manager','controller'=>'posts','action'=>'messages'));
		}
		
		if($this->request->is('post')){
				$this->redirect(array('plugin'=>'association_manager','controller'=>'posts','action'=>'messages',$account_id,$this->request->data['search']));
		}		
		
		/* pagination start*/
		$condition=array();
		if($search!=NULL && $search!="_blank"){
			$search = urldecode($search);
			$condition['OR']['Account.name like'] = $search.'%';
			$condition['OR']['Post.message like'] = $search.'%';
		}else{
			$search = '';
		}
		
		if($account_id!=NULL && $account_id!="_blank"){
			$condition['Post.account_id =']=$account_id;
		}else{
			$account_id = '';
		}
		if($limit!='ALL'){
			$this->paginate['limit'] = $limit;
		}
		$this->paginate['order'] = array('Post.id'=>'DESC');
		
		$posts = $this->paginate('Post',$condition);
		/* pagination end*/
		$this->breadcrumbs[] = array(
			'url'=>Router::url('/admin/home'),
			'name'=>'Home'
		    );
            $this->breadcrumbs[] = array(
                    'url'=>Router::url('/admin/association_manager/accounts'),
                    'name'=>'Manage Accounts'
            );
            $this->breadcrumbs[] = array(
                    'url'=>Router::url('/admin/association_manager/posts'),
                    'name'=>'Manage Message'
            );
		$account=$this->Account->read(null,$account_id);
		$redirect_url=(Controller::referer()=="/")? '/admin/association_manager/posts/':Controller::referer();
		$this->set('posts',$posts);
		$this->set('account',$account);
		$this->set('url',$redirect_url);
		$this->set('search', $search);
		$this->set('account_id', $account_id);
	}
		
	function admin_message($account_id=null,$id=null){
			
		$this->breadcrumbs[] = array(
		'url'=>Router::url('/admin/home'),
		'name'=>'Home'
		);
		$this->breadcrumbs[] = array(
				'url'=>Router::url('/admin/association_manager/accounts'),
				'name'=>'Manage Account'
		);
		$this->breadcrumbs[] = array(
				'url'=>Router::url('/admin/association_manager/posts/message'),
				'name'=>($id==null)?'Add Message':'Update Message'
		);
		
		if(!empty($this->request->data) && !$this->message_validation()){
	
			if(!$id){
				$this->request->data['Post']['created_at']=date('Y-m-d H:i:s');
				$this->request->data['Post']['status'] = 1;
			}
			$this->Post->create();
			$this->Post->save($this->request->data);
			if ($this->request->data['Post']['id']) {
				$this->Session->setFlash(__('Message has been updated successfully'));
			} 
			else{
				$this->Session->setFlash(__('Message has been added successfully'));
			}
			$this->redirect($this->request->data['Post']['redirect']);
		}else{
			
			if($id!=null){
				$this->request->data = $this->Post->read(null,$id);
			}else{
				$this->request->data = array();
			}
		}
		$this->set('id',$id);
		$account = $this->Account->find('first',array('conditions'=>array('Account.id'=>$account_id)));
		$redirect_url=(Controller::referer()=="/")? '/admin/association_manager/posts/messages' :Controller::referer();
		$this->set('account_id',$account_id);
		$this->set('url',$redirect_url);
		$this->set('account',$account);
    }	
		 


	function admin_view_message($id = null){
		
		/**In this record displaying using model HABTM**/
		
		$this->layout = '';
		$criteria = array();
        $criteria['conditions'] = array('Post.id'=>$id);
        $record =  $this->Post->find('first', $criteria);
        $this->set('post', $record);
	}
	

	function message_validation(){
		$this->Post->set($this->request->data);	
		$result = array();
			if($this->Post->validates()){
				$result['error'] = 0;
			}else{
				$result['error'] = 1;
			}
			if($this->request->is('ajax')) {
				$this->autoRender = false;
				$result['errors'] = $this->Post->validationErrors;
				$errors = array();
			foreach($result['errors'] as $field => $data){
				$errors['Post'.Inflector::camelize($field)] = array_pop($data);
				
			}
				$result['errors'] = $errors;
				echo json_encode($result);
				return;
			}
			return $result['error']; 
		  
	}
	
}


?>

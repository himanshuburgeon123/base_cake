<?php
Class PagesController extends ContentManagerAppController{
	public $uses = array('ContentManager.Page');
	public $components=array('Email');
	public $paginate = array();
	public $id = null;
	public $name = "Pages";
	
	function admin_index($parent_id = 0 , $search=null){
		
		$this->paginate = array();
		$condition = null;
		$condition['Page.parent_id']= (int)$parent_id;
		$this->paginate['limit']=20;
		if($this->request->is('post')){
			$this->redirect(array('plugin'=>'content_manager','controller'=>'pages','action'=>'index',$parent_id,$this->request->data['search']));
		}
		$this->paginate['order']=array('Page.page_order'=>'ASC','Page.id'=>'DESC');		
		if($search!=null){
			$search = urldecode($search);
			$condition['Page.name like'] = $search.'%';
		}
		
		$pages=$this->paginate("Page", $condition);	

		$this->breadcrumbs[] = array(
			'url'=>Router::url('/admin/home'),
			'name'=>'Home'
		);
		$this->breadcrumbs[] = array(
			'url'=>Router::url('/admin/content_manager/pages'),
			'name'=>'Manage Content'
		);
		$this->set('parent_id',$parent_id);
		$this->set('pages',$pages);
		$this->set('parent_id',$parent_id);
		$this->set('search',$search);
		$this->set('url','/'.$this->params->url);
		if($this->request->is('ajax')){
			$this->layout = '';
			$this -> Render('ajax_admin_index');
		}
	}
        
	function ajax_sort(){
		$this->autoRender = false;
		foreach($_POST['sort'] as $order => $id){
			$page= array();
			$page['Page']['id'] = $id;
			$page['Page']['page_order'] = $order;
			$this->Page->create();
			$this->Page->save($page);
		}
	   
	}
		 
	function admin_add($parent_id=0,$id=null){
			
		$this->breadcrumbs[] = array(
		'url'=>Router::url('/admin/home'),
		'name'=>'Home'
		);
		$this->breadcrumbs[] = array(
				'url'=>Router::url('/admin/content_manager/pages'),
				'name'=>'Manage Content'
		);
		$this->breadcrumbs[] = array(
				'url'=>Router::url('/admin/content_manager/pages/add/'.$parent_id),
				'name'=>($id==null)?'Add Content':'Update Content'
		);
		if(!empty($this->request->data) && !$this->validation()){
			$destination = WWW_ROOT."img/banner/";
			if($this->request->data['Page']['id']){
				$banner_image = $this->Page->find('first',array('fields'=>array('Page.banner_image'),'conditions'=>array('Page.id'=>$this->request->data['Page']['id'])));
			}
			$image_name='';
			if($this->request->data['Page']['banner_image']['error'] < 1){
				$image_name =self::_manage_image($this->request->data['Page']['banner_image']);
			}
			if($this->request->data['Page']['id'] && $image_name!=''){
				unlink(Configure::read('Path.Banner').$banner_image['Page']['banner_image']);
			}else{
				if($this->request->data['Page']['id']){
				$image_name = $banner_image['Page']['banner_image'];
				}
			}
			$this->request->data['Page']['banner_image'] = $image_name;			
			if(!$id){
				$this->request->data['Page']['created_at']=date('Y-m-d H:i:s');
				$this->request->data['Page']['status'] = 1;
			}else{
				$this->request->data['Page']['updated_at']=date('Y-m-d H:i:s');
			}
			$this->Page->create();
			$this->Page->save($this->request->data,array('validate'=>false));
			if ($this->request->data['Page']['id']) {
				$this->Session->setFlash(__('Content has been updated successfully'));
			} 
			else{
				$this->Session->setFlash(__('Content has been added successfully'));
			}
			$this->redirect($this->request->data['Page']['redirect']);
		}else{
			
			if($id!=null){
				$this->request->data = $this->Page->read(null,$id);
			}else{
				$this->request->data = array();
			}
		}
		$redirect_url=(Controller::referer()=="/")? Router::url('/admin/content_manager/pages') :Controller::referer();
		$this->set('parent_id',$parent_id);
		$this->set('url',$redirect_url);
    }
	
	function admin_delete($id=null){
		$this->autoRender = false;
		$data=$this->request->data['Page']['id'];
		$action = $this->request->data['Page']['action'];
		$ans="0";
		foreach($data as $value){
			if($value!='0'){
				if($action=='Publish'){
					$page['Page']['id'] = $value;
					$page['Page']['status']=1;
					$this->Page->create();
					$this->Page->save($page);
					$ans="1";
				}
				if($action=='Unpublish'){
					$page['Page']['id'] = $value;
					$page['Page']['status']=0;
					$this->Page->create();
					$this->Page->save($page);
					$ans="1";
				}
				if($action=='Delete'){
					$page = $this->Page->find('first', array('conditions'=> array('Page.id' => $value),'fields' => array('Page.banner_image')));
					if (!empty($page['Page']['banner_image'])) {
						   @unlink(WWW_ROOT."img/banner/". $page['Page']['banner_image']);
					}
					$this->Page->delete($value);
					$ans="2";
				}
			}
		}
		if($ans=="1"){
			$this->Session->setFlash(__('Page has been '.$this->data['Page']['action'].'ed successfully', true));
		}
		else if($ans=="2"){
			$this->Session->setFlash(__('Page has been '.$this->data['Page']['action'].'d successfully', true));
		}else{
			$this->Session->setFlash(__('Please Select any Page', true),'default','','error');
		}
		$this->redirect($this->request->data['Page']['redirect']);
                 
	}
	
	function home(){
		
		
		$page=$this->Page->find('first',array('conditions'=>array('Page.id'=>17,'Page.status'=>1)));
		if (empty($page)) {
			throw new NotFoundException('404 Error - Page not found');
		}
		
		$this->header_modules[] = $this->requestAction(array('plugin'=>'slide_manager','controller'=>'slides','action'=>'show'),array('return'));
		$this->footer_modules[] = $this->requestAction(array('plugin'=>'content_manager','controller'=>'pages','action'=>'footer_modules',3),array('return'));
		
		
		
		$this->title_for_layout = $page['Page']['page_title'];
		$this->metakeyword = $page['Page']['page_metakeyword'];
		$this->metadescription = $page['Page']['page_metadescription'];
		$this->set('page',$page);
		$this->render('view');
		
	}
	
	function footer_modules($id=""){
		$page=$this->Page->find('first',array('conditions'=>array('Page.id'=>$id,'Page.status'=>1)));
		if (empty($page)) {
			throw new NotFoundException('404 Error - Page not found');
		}
		$this->set('page',$page);
		
	}
	
	public function banner($page = array()){
		App::uses('HtmlHelper', 'View/Helper');
		$page['Page']['banner_image_resized']=self::_load_images('banner',$page['Page']['banner_image'],1600,250);
		$Html = new HtmlHelper(new View());
		$data ='<div class="banner">'.$Html->image($page['Page']['banner_image_resized']).'</div>';
		return $data;
	} 
	
	protected function _load_images($path=null,$photo = null,$width = null ,$height = null) {
		  
        if (!is_null($photo) && $photo!='' && file_exists(WWW_ROOT . "img/".$path."/" . $photo)) {
            $thumb_name = $this->ImageResize->getThumbImage(WWW_ROOT . "img/".$path."/", WWW_ROOT . "img/tmp/".$path."/", $photo, $width, $height);
        } else {
            $img_name = 'no-image.png';
            $thumb_name = $this->ImageResize->getThumbImage(WWW_ROOT."img/",WWW_ROOT."img/tmp/",$img_name,$width,$height);
        }
        
        return $thumb_name;
    }
	
	function view($id=null){
		if(empty($id)){
			$this->redirect('/');
		}
		$pages = $page = array();
		
		$page=$this->Page->find('first',array('conditions'=>array('Page.id'=>$id,'Page.status'=>1)));
		if (empty($page)) {
			throw new NotFoundException('404 Error - Page not found');
		}
		
		//$this->header_modules[] =self::banner($page);
		//$this->header_modules[] =$this->requestAction(array('plugin'=>'content_manager','controller'=>'pages','action'=>'banner',$page));
		
		
		if($id==3 && $page['Page']['parent_id']==0){
			$pages=$this->Page->find('all',array('conditions'=>array('Page.parent_id'=>$id,'Page.status'=>1)));
		}
		
		
		
		$this->set('page', $page);
		$this->set('pages', $pages);
		$this->title_for_layout = $page['Page']['page_title'];
		$this->metakeyword = $page['Page']['page_metakeyword'];
		$this->metadescription = $page['Page']['page_metadescription'];
		
		try{
			$this->viewPath = $this->name.DS.Configure::read('Name.TemplateFolderName');
			$this->render('full_page');
		}catch (Exception $e) {
			$this->render('default');
		}
			
		/*
		if($id==3 && $page['Page']['parent_id']==0){
			$this->render('page_listing');
		}
		
		
		if($page['Page']['page_template'] == 'home') {
			$this->header_modules[] = $this->requestAction(array('plugin'=>'slide_manager','controller'=>'slides','action'=>'show'),array('return'));
			$this->footer_modules[] = $this->requestAction(array('plugin'=>'content_manager','controller'=>'pages','action'=>'footer_modules',3),array('return'));
			
		}  
		
		else if($page['Page']['page_template'] == 'self_banner') {
			$this->header_modules[] =self::banner($page);
		}
		
		else if($page['Page']['page_template'] == 'Pages/pagetemplates/full_page') {
			$this->layout = '';
			$this->render($page['Page']['page_template']);
		}
		* */
	
	}
	
	function contactus(){
	
		$this->loadModel('MailManager.Mail');
		$mail=$this->Mail->read(null,1);
		$body=str_replace('{NAME}',$this->request->data['Page']['name'],$mail['Mail']['mail_body']);
        $body=str_replace('{EMAIL}',$this->request->data['Page']['email'],$body);
		$body=str_replace('{PHONE}',$this->request->data['Page']['phone'],$body);
		$body=str_replace('{CITY}',$this->request->data['Page']['city'],$body);
		$body=str_replace('{MESSAGE}',$this->request->data['Page']['message'],$body);
		
		$email = new CakeEmail();
		$email->to($this->setting['site']['site_contact_email']);
		$email->subject($mail['Mail']['mail_subject']);
		$email->from($this->request->data['Page']['email']);
		$email->emailFormat('html');
		$email->template('default');
		$email->viewVars(array('data'=>$body,'logo'=>Configure::read('Site.admin_logo'),'url'=>$this->setting['site']['site_url']));
		$email->send();
		
		/******Mail to User******/ 
		$mail=$this->Mail->read(null,2);
		$body=str_replace('{NAME}',$this->request->data['Page']['name'],$mail['Mail']['mail_body']);      
		
		$email = new CakeEmail();
		$email->to($this->request->data['Page']['email']);
		$email->subject($mail['Mail']['mail_subject']);
		$email->from($this->setting['site']['site_contact_email'],$mail['Mail']['mail_from']);
		$email->emailFormat('html');
		$email->template('default');
		$email->viewVars(array('data'=>$body,'logo'=>Configure::read('Site.admin_logo'),'url'=>$this->setting['site']['site_url']));
		$email->send();
		
		$this->redirect(array('plugin'=>'content_manager','controller'=>'pages','action'=>'view',27));
		
	} 
	
	function validation(){
		
		$this->Page->set($this->request->data);	
		$result = array();
			if($this->Page->validates()){
				$result['error'] = 0;
			}else{
				$result['error'] = 1;
			}
			if($this->request->is('ajax')) {
				$this->autoRender = false;
				$result['errors'] = $this->Page->validationErrors;
				$errors = array();
			foreach($result['errors'] as $field => $data){
				$errors['Page'.Inflector::camelize($field)] = array_pop($data);
				
			}
				$result['errors'] = $errors;
				echo json_encode($result);
				return;
			}
			return $result['error']; 
		  
	}
	
	function admin_view($id = null){
		$this->layout = '';
		$criteria = array();
        $criteria['conditions'] = array('Page.id'=>$id);
        $parent_page =  $this->Page->find('first', $criteria);
        $this->set('page', $parent_page);
	}
	
	private function _manage_image($image = array()){
        if ($image['error'] > 0) {
            return null;
        }else{
            $existing_image = array();
            if ($image['error'] > 0) {
                return $existing_image['Page']['banner_image'];
            } else {
                $destination = Configure::read('Path.Banner');
                if(!file_exists($destination)) {
					App::uses('Folder', 'Utility');
					mkdir($destination, 0777);
					$dir = new Folder();
					$dir->chmod($destination, 0777, true, array());	
				}
                
                $ext = explode('.', $image['name']);
                $image_name = time() . '_' . time() . '.' . array_pop($ext);
                move_uploaded_file($image['tmp_name'], $destination . $image_name);
                if (!empty($existing_image)) {
                    unlink($destination . $existing_image['Page']['banner_image']);
                }
                //move_uploaded_file($filename, $destination);
                return $image_name;
            }
        }
    }
	
	
}


?>

<?php
class GalleriesController extends ContentManagerAppController{
	var $name = 'Galleries';
	var $helpers = array('Form');
	var $uses = array('ContentManager.Gallery','ContentManager.Page');
	var $paginate = array();

	function admin_index($page_id=null,$search=NULL,$limit = 20) {
		
		if($page_id==null){
			$this->redirect(array('plugin'=>'content_manager','controller'=>'pages','action'=>'index'));
		}
		
		if($this->request->is('post')){
				$this->redirect(array('plugin'=>'content_manager','controller'=>'galleries','action'=>'index',$page_id,$this->request->data['search']));
		}		
		
		/* pagination start*/
		$condition=array();
		if($search!=NULL && $search!="_blank"){
			$this->paginate['conditions']['AND'][] = array('Gallery.name like'=>urldecode($search).'%');
		}else{
			$search = '';
		}
		
		if($page_id!=NULL && $page_id!="_blank"){
			$condition['Gallery.page_id =']=$page_id;
		}else{
			$page_id = '';
		}
		if($limit!='ALL'){
			$this->paginate['limit'] = $limit;
		}
		$this->paginate['order'] = array('Gallery.reorder'=>'ASC');
		
		$gallerys_list = $this->paginate('Gallery',$condition);
		/* pagination end*/
		$this->breadcrumbs[] = array(
			'url'=>Router::url('/admin/home'),
			'name'=>'Home'
		    );
            $this->breadcrumbs[] = array(
                    'url'=>Router::url('/admin/content_manager/pages'),
                    'name'=>'Manage Content'
            );
            $this->breadcrumbs[] = array(
                    'url'=>Router::url('/admin/content_manager/galleries'),
                    'name'=>'Manage Gallery'
            );

		$page=$this->Page->read(null,$page_id);
		$redirect_url=(Controller::referer()=="/")? '/admin/content_manager/galleries/':Controller::referer();
		$this->set('page',$page);
		$this->set('galleries',$gallerys_list);
		$this->set('url',$redirect_url);
		$this->set('search', $search);
		$this->set('page_id', $page_id);
		
		if($this->request->is('ajax')){
			$this->layout = '';
			$this -> Render('ajax_admin_index');
		   
		}
	}
	
	function ajax_sort(){
		$this->autoRender = false;
		foreach($_POST['sort'] as $order => $id){
			$gallery= array();
			$gallery['Gallery']['id'] = $id;
			$gallery['Gallery']['reorder'] = $order;
			$this->Gallery->create();
			$this->Gallery->save($gallery);
		}
           
	}
        
	function admin_add($page_id = null,$id=null){

			$this->breadcrumbs[] = array(
			'url'=>Router::url('/admin/home'),
			'name'=>'Home'
			);
            $this->breadcrumbs[] = array(
                    'url'=>Router::url('/admin/gallery_manager/galleries'),
                    'name'=>'Manage Gallery'
            );
            $this->breadcrumbs[] = array(
                    'url'=>Router::url('/admin/gallery_manager/galleries/add'),
                    'name'=>($id==null)?'Gallery Content':'Update gallery'
            );
            
            if(!empty($this->request->data) && !$this->validation()){
				$destination = WWW_ROOT."img/gallery/";
				if($this->request->data['Gallery']['id']){
					$gallery_image = $this->Gallery->find('first',array('fields'=>array('Gallery.image'),'conditions'=>array('Gallery.id'=>$this->request->data['Gallery']['id'])));
				}else{
					$this->request->data['Gallery']['status'] = 1;
				}
			$image_name='';
			if($this->request->data['Gallery']['image']['error'] < 1){
				$image_name =self::_manage_image($this->request->data['Gallery']['image']);
			}
			
			if($this->request->data['Gallery']['id'] && $image_name!=''){
				unlink(WWW_ROOT."img/gallery/".$gallery_image['Gallery']['image']);
			}else{
				if($this->request->data['Gallery']['id']){
				$image_name = $gallery_image['Gallery']['image'];
				}
			}
			$this->request->data['Gallery']['image'] = $image_name;			
				if(!$id){
				$this->request->data['Gallery']['created_at']=date('Y-m-d H:i:s');
				}else{
				$this->request->data['Gallery']['updated_at']=date('Y-m-d H:i:s');
				}
				//echo"<pre>";print_r($this->request->data);die;
                $this->Gallery->create();
                $this->Gallery->save($this->request->data,array('validate'=>false));
                if ($this->request->data['Gallery']['id']) {
					$this->Session->setFlash(__('Gallery has been updated successfully'));
					} 
					else {
						$this->Session->setFlash(__('Gallery has been added successfully'));
					}
				$this->redirect($this->request->data['Gallery']['redirect']);
            }
            else{
				if($page_id==null){
					$this->redirect(array('plugin'=>'content_manager','controller'=>'pages','action'=>'index'));
				}
                if($id!=null){
                    $this->request->data = $this->Gallery->read(null,$id);
                    $page_id = $this->request->data['Gallery']['page_id'];
                }else{
                    $this->request->data = array();
                }
            } 
            
            $page = $this->Page->find('first',array('conditions'=>array('Page.id'=>$page_id)));
            $redirect_url=(Controller::referer()=="/")? '/admin/content_manager/pages':Controller::referer();
            
            $this->set('id',$id);
            $this->set('url',$redirect_url);
            $this->set('page_id',$page_id);
            $this->set('page',$page);
	}
	
	private function _manage_image($image = array()) {
        if ($image['error'] > 0) {
            return null;
        } else {
            $existing_image = array();
            if ($image['error'] > 0) {
                return $existing_image['Gallery']['image'];
            } else {
                $destination = WWW_ROOT . "img/gallery/";
                $ext = explode('.', $image['name']);
                $image_name = time() . '_' . time() . '.' . array_pop($ext);
                move_uploaded_file($image['tmp_name'], $destination . $image_name);
                if (!empty($existing_image)) {
                    unlink($destination . $existing_image['Gallery']['image']);
                }
                //move_uploaded_file($filename, $destination);
                return $image_name;
            }
        }
    }	
	function validation(){
		  $this->autoRender = false;
			
		  $this->Gallery->set($this->request->data);
		  $result = array();
		  if ($this->Gallery->validates()) {
			  $result['error'] = 0;
		  }else{
			  $result['error'] = 1;
		  }
		  $result['errors'] = $this->Gallery->validationErrors;
		  $errors = array();
		 
		  foreach($result['errors'] as $field => $data){
			  $errors['Gallery'.Inflector::camelize($field)] = array_pop($data);
		  }
		 
		 $result['errors'] = $errors;
		 
		 if($this->request->is('ajax')) {
			  echo json_encode($result);
			  //<span class="error-message">Inserisci il nome del proprietario</span>
			  return;
		  } 
		 
		  
	  }
	

	
	function admin_view($id=null){
		$this->layout = '';
		$gallery = $this->Gallery->read(null,$id);
		$this->set('gallery',$gallery);
	}
	
	 function admin_delete($id=null){
            $data=$this->request->data['Gallery']['id'];
            $action = $this->request->data['Gallery']['action'];
            $ans="0";
            foreach($data as $value){
                if($value!='0'){
                    if($action=='Publish'){
                        $gallery['Gallery']['id'] = $value;
                        $gallery['Gallery']['status']=1;
                        $this->Gallery->create();
                        $this->Gallery->save($gallery);
                        $ans="1";
                    }
                    if($action=='Unpublish'){
                        $gallery['Gallery']['id'] = $value;
                        $gallery['Gallery']['status']=0;
                        $this->Gallery->create();
                        $this->Gallery->save($gallery);
                        $ans="1";
                    }
                    if($action=='Delete'){
						$data = $this->Gallery->find('first',array('conditions'=>array('Gallery.id'=>$value)));
						$destination = WWW_ROOT . "img/gallery/".$data['Gallery']['image'];
						if(file_exists($destination)) {
							unlink($destination);
							$this->Gallery->delete($value);
							$ans="2";
						}
						
                    }
                }
            }
		if($ans=="1"){
			$this->Session->setFlash(__('Gallery image has been '.$this->data['Gallery']['action'].'ed successfully', true));
		}
		else if($ans=="2"){
			$this->Session->setFlash(__('Gallery image has been '.$this->data['Gallery']['action'].'d successfully', true));
		}else{
			$this->Session->setFlash(__('Please Select any Gallery', true),'default','','error');
		}
		$redirect_url=(Controller::referer()=="/")? '/admin/content_manager/galleries/':Controller::referer();
		$this->redirect($redirect_url);
	}
	
	function gallery_banner(){
		App::uses('HtmlHelper', 'View/Helper');
		$Html = new HtmlHelper(new View());
		$data ='<div class="inner-banner">';
		$data .='<div class="inn_img">'.$Html->image('inner-banner-2.jpg').'</div>';
		$data .='<div class="shadows"></div>';
		$data .='<div class="wrapper">';
		$data .='<div class="nav_hd">';
		$data .='<h3>Infrastructure</h3>';
		$data .='</div>';
		$data .='<div class="clear"></div>';
		$data .='</div>';
		$data .='</div>';
		return $data;
	}
	
	function index($id=null){
		
		$this->header_modules[]=self::gallery_banner();
		array_push(self::$css_for_layout,'mainstyle.css');
		array_push(self::$script_for_layout,'spinners.js');
		array_push(self::$script_for_layout,'lightview.js');
		
		$this->paginate = array();
        $conditions = array();
        $this->paginate['limit']=8;
        $conditions['Gallery.status']=1;  
        $this->paginate['order']=array('Gallery.reorder'=>'ASC','Gallery.id'=>'DESC');		        
        $gallery_list=$this->paginate("Gallery", $conditions);	 
		
		
		$this->set('galleries',$gallery_list);
		if ($this->request->is('ajax')) {
			$this->layout = "";
			$this->render('ajax_index');
		}
		$this->title_for_layout = 'Our Infrastructure';
		$this->metakeyword = 'Infrastructure-gallery';
		$this->metadescription = 'Infrastructure-gallery';
		
	}
	

}

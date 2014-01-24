<?php
Class SlidesController extends SlideManagerAppController{
		public $uses = array('SlideManager.Slide');
		public $helpers = array('Form','ImageResize');
		public $paginate = array();
        public $id = null;
	
	function admin_index($search=null){
            $this->paginate = array();
            $condition = null;
            //$condition['Slide.parent_id']= (int)$parent_id;
            $this->paginate['limit']=20;
            if($this->request->is('post')){
				$this->redirect(array('plugin'=>'slide_manager','controller'=>'slides','action'=>'index' ,$this->request->data['search']));
            }
            $this->paginate['order']=array('Slide.reorder'=>'ASC','Slide.id'=>'DESC');		
            
            if($search!=null){
                $search = urldecode($search);
                $condition['Slide.name like'] = $search.'%';
            }
            
            $slides=$this->paginate("Slide", $condition);	
             
            
            $this->breadcrumbs[] = array(
                'url'=>Router::url('/admin/home'),
                'name'=>'Home'
            );
            $this->breadcrumbs[] = array(
                'url'=>Router::url('/admin/slide_manager/slides'),
                'name'=>'Manage Slide'
            );
            
			$this->set('slides', $slides);
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
                $slide= array();
                $slide['Slide']['id'] = $id;
                $slide['Slide']['reorder'] = $order;
				$this->Slide->create();
                $this->Slide->save($slide);
            }
           
        }
        
	function show(){
		array_push(self::$script_for_layout,'jquery.placeholder.min.js','plugins.min.js','scripts.min.js');
		self::$scriptBlocks[] = "var revapi7;
								$(document).ready(function() {
								if ($.fn.cssOriginal != undefined)
								$.fn.css = $.fn.cssOriginal;
									if($('#rev_slider_7_1').revolution == undefined)
										revslider_showDoubleJqueryError('#rev_slider_7_1');
									else
										revapi7 = $('#rev_slider_7_1').show().revolution(	{
										delay:10000, 
										startwidth:1000,
										startheight:400,
										hideThumbs:200,
										thumbWidth:100,
										thumbHeight:50,
										thumbAmount:4,
										navigationType:'bullet',
										navigationArrows:'verticalcentered',
										navigationStyle:'round',
										touchenabled:'on',
										onHoverStop:'off',
										navOffsetHorizontal:0,
										navOffsetVertical:10,
										shadow:2,
										fullWidth:'on',
										stopLoop:'off',
										stopAfterLoops:-1,
										stopAtSlide:-1,
										shuffle:'off',
										hideSliderAtLimit:0,
										hideCaptionAtLimit:0,
										hideAllCaptionAtLilmit:0
									});
								$.restyleRevo(revapi7, $('#rev_slider_7_1').parent().parent());
						});";
		
		
		$slider=$this->Slide->find('all',array('conditions'=>array('Slide.status'=>'1'),'order'=>array('Slide.reorder'=>'ASC')));
		$this->set('slider',$slider);
		//return $slide;
	}
       
		 
        function admin_add($id=null){
			
			$this->breadcrumbs[] = array(
			'url'=>Router::url('/admin/home'),
			'name'=>'Home'
			);
            $this->breadcrumbs[] = array(
                    'url'=>Router::url('/admin/slide_manager/slides'),
                    'name'=>'Manage Slide'
            );
            $this->breadcrumbs[] = array(
                    'url'=>Router::url('/admin/slide_manager/slides/add'),
                    'name'=>($id==null)?'Slide Content':'Update Slide'
            );
            
            if(!empty($this->request->data)){
				
				$destination = Configure::read('Path.Slide');
					
				if($this->request->data['Slide']['id']){
					$slide_image = $this->Slide->find('first',array('fields'=>array('Slide.image','Slide.logo'),'conditions'=>array('Slide.id'=>$this->request->data['Slide']['id'])));
					
				}
				$image_name='';
				
				if($this->request->data['Slide']['id']){
					$image_name = $slide_image['Slide']['image'];
					
				}
				
				if($this->request->data['Slide']['image']['error'] < 1){
					$this->request->data['Slide']['image'] = self::_manage_image($this->request->data['Slide']['image']);
					if($image_name!=''){
						unlink($destination.$image_name);
					}
				}else{
					$this->request->data['Slide']['image'] = $image_name;
				}
				
				if(!$id){
					$this->request->data['Slide']['created_at']=date('Y-m-d H:i:s');
					$this->request->data['Slide']['status']=1;
				}else{
					
					$this->request->data['Slide']['updated_at']=date('Y-m-d H:i:s');
				}
				$this->Slide->create();
                $this->Slide->save($this->request->data,array('validate'=>false));
                if ($this->request->data['Slide']['id']) {
					$this->Session->setFlash(__('Slide has been updated successfully'));
					} 
					else {
						$this->Session->setFlash(__('Slide has been added successfully'));
					}
               // $this->redirect($this->request->data['Slide']['redirect']);
                $this->redirect(array('action'=>'admin_index')); 
            }
            else{
                if($id!=null){
                    $this->request->data = $this->Slide->read(null,$id);
                }else{
                    $this->request->data = array();
                   
                }
            } 
            
            
            
            //$this->set('parent_id',$parent_id);
            $this->set('url',Controller::referer());
        }
        
        function admin_delete($id=null){
            $this->autoRender = false;
            $destination = Configure::read('Path.Slide');
           // print_r($this->request->data);
            $data=$this->request->data['Slide']['id'];
            $action = $this->request->data['Slide']['action'];
            $ans="0";
            foreach($data as $value){
                if($value!='0'){
                    if($action=='Publish'){
                        $slide['Slide']['id'] = $value;
                        $slide['Slide']['status']=1;
                        $this->Slide->create();
                        $this->Slide->save($slide);
                        $ans="1";
                    }
                    if($action=='Unpublish'){
                        $slide['Slide']['id'] = $value;
                        $slide['Slide']['status']=0;
                        $this->Slide->create();
                        $this->Slide->save($slide);
                        $ans="1";
                    }
                    if($action=='Delete'){
						$slide = $this->Slide->find('first', array('conditions'=> array('Slide.id' => $value),'fields' => array('Slide.image','Slide.logo')));
						if (!empty($slide['Slide']['image'])){
						   @unlink($destination. $slide['Slide']['image']);
						}
						if (!empty($slide['Slide']['logo'])){
						   @unlink($destination. $slide['Slide']['logo']);
						}	
                        $this->Slide->delete($value);
                        $ans="2";
                    }
                }
            }
		if($ans=="1"){
			$this->Session->setFlash(__('Slide has been '.$this->data['Slide']['action'].'ed successfully', true));
		}
		else if($ans=="2"){
			$this->Session->setFlash(__('Slide has been '.$this->data['Slide']['action'].'d successfully', true));
		}else{
			$this->Session->setFlash(__('Please Select any Slide', true),'default','','error');
		}
		$this->redirect($this->request->data['Slide']['redirect']);
                 
	}
	
	
	function validation(){
		  $this->autoRender = false;
			
		  $this->Slide->set($this->request->data);
		  $result = array();
		  if ($this->Slide->validates()) {
			  $result['error'] = 0;
		  }else{
			  $result['error'] = 1;
		  }
		  $result['errors'] = $this->Slide->validationErrors;
		  $errors = array();
		 
		  foreach($result['errors'] as $field => $data){
			  $errors['Slide'.Inflector::camelize($field)] = array_pop($data);
		  }
		 
		 $result['errors'] = $errors;
		 
		 if($this->request->is('ajax')) {
			  echo json_encode($result);
			  //<span class="error-message">Inserisci il nome del proprietario</span>
			  return;
		  } 
		 
		  
	  }
	
	function admin_view($id = null) {
    $this->layout = '';
    $criteria = array();
        $criteria['conditions'] = array('Slide.id'=>$id);
        $parent_slide =  $this->Slide->find('first', $criteria);
       // $parent_slide['Slide']['image'] = self::_load_images('slide',$parent_slide['Slide']['image'],80,60);
        $this->set('slide', $parent_slide);
         
      
	}
   	private function _manage_image($image = array()) {
        if ($image['error'] > 0) {
            return null;
        } else {
            $existing_image = array();
            if ($image['error'] > 0) {
                return $existing_image['Slide']['image'];
            } else {
				
                $destination =Configure::read('Path.Slide');
                if(!file_exists($destination)) {
					App::uses('Folder', 'Utility');
					mkdir($destination, 0777);
					$dir = new Folder();
					$dir->chmod($destination, 0777, true, array());	
				}
                $ext = explode('.', $image['name']);
                $get_ext = array_pop($ext);
				$name = basename($image['name'],'.'.$get_ext);
		
                $image_name = $name . '_' . time() . '.' . $get_ext;
                move_uploaded_file($image['tmp_name'], $destination . $image_name);
                if (!empty($existing_image)) {
                    unlink($destination . $existing_image['Slide']['image']);
                }
                return $image_name;
            }
        }
    }
    
	private function _manage_logo($image = array()) {
        if ($image['error'] > 0) {
            return null;
        } else {
            $existing_logo = array();
            if ($image['error'] > 0) {
                return $existing_logo['Slide']['logo'];
            } else {
                $destination =Configure::read('Path.Slide');
                $ext = explode('.', $image['name']);
                $get_ext = array_pop($ext);
				$name = basename($image['name'],'.'.$get_ext);
		
                $image_logo = $name . '_' . time() . '.' . $get_ext;
                move_uploaded_file($image['tmp_name'], $destination . $image_logo);
                if (!empty($existing_logo)) {
                    unlink($destination . $existing_logo['Slide']['logo']);
                }
                return $image_logo;
            }
        }
    }
    
       
 
     
        
      
    
}


?>

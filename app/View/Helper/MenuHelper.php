<?php

class MenuHelper extends AppHelper {

    var $helpers = Array('Html','Form');
    
    function show_pages($pages = array()){
		$data = "";
		if(!empty($pages)){
			$data.="<ul>";
			foreach($pages as $page){
				$data.="<li>";
				$data.=$this->Form->checkbox('pages.', array('hiddenField' => false,'value'=>$page['Page']['id'])).'<label for="label1">'.$page['Page']['name'].'</label>';
				$data.= $this->show_pages($page['children']);
				$data.="</li>";
			}
			$data.="</ul>";
		}
		return $data;
	}
	function show_links($links = array()){
		$data = "";
		if(!empty($links)){
			$data.='<ol class="dd-list">';
			foreach($links as $link){
				$this->request->data['Link'][$link['Link']['id']]['new_window'] = $link['Link']['new_window'];
				$data.='<li class="dd-item" data-id="'.$link['Link']['id'].'">';
				$data .= '<div class="dd-handle">'.$link['Link']['name'].'</div>';
				$data .= '<span class="item-type">'.$link['Link']['module'].'</span>';
				$url = ($link['Link']['url']!='')?'<div class="boxx">
						<label>URL</label>
						'.
						$this->Form->text($link['Link']['id'].'.url',array('value'=>$link['Link']['url']))
						.'
					</div>':'';
				$data .= '<button type="button" class="action caret-down"></button>';
				$data .= '<div class="caret-div" >
					<div class="boxx">
						<label>Navigation Label</label>'.
						$this->Form->text($link['Link']['id'].'.name',array('value'=>$link['Link']['name'])).'
					</div>
					<div class="boxx">
						<label>Title Attribute</label>
						'.
						$this->Form->text($link['Link']['id'].'.tag_title',array('value'=>$link['Link']['tag_title']))
						.'
					</div>
					'.$url.'
					<br clear="all" />
					<div>'.
					$this->Form->checkbox($link['Link']['id'].'.new_window',array('value'=>$link['Link']['new_window']))
					.'Open link in a new window/tab </div>
				<div class="re-link"><a href="#" class="remove-link">Remove</a></div>
				<div><a href="#" class="cancel-link">Cancel</a></div>
				</div>';
				if(!empty($link['children'])){
					$data.= $this->show_links($link['children']);
				}
				$data.="</li>";
			}
			$data.="</ol>";
		}
		return $data;
	}
	function menus($menu_id=0){
		$data = "";
		
		$Link =& ClassRegistry::init("Link");  
		$links = $Link->find('threaded',array('recursive'=>2,'conditions'=>array('Link.menu_id'=>$menu_id,'Link.status'=>1),'order'=>array('Link.reorder'=>'ASC')));
		return ($menu_id==1)?self::__menus($links):self::__menus2($links);
	}
	
	private function __menus($links = array(),$parent = 1){
		$data ='';
		$class="";
		if($parent==1){
			$class="slimmenu";
		}
		
		if(!empty($links)){
			$data .= '<ul class="'.$class.'">';
			foreach($links as $link){
				$url = "";
				$attr = "";
				if($link['Link']['module']=="" || $link['Link']['module']==Null || strtolower($link['Link']['module'])=='custom'){
					$url = $link['Link']['url']; 
				}else if($link['Link']['module']=="Page"|| $link['Link']['module']=="page"){
					$url = Router::url(array('plugin'=>'content_manager','controller'=>'pages','action'=>'view',$link['Link']['ref_id']));
				}
				if($link['Link']['new_window']==1){
					$attr = 'target="_blank"';
				}
				$data .='<li><a href="'.$url.'" '.$attr.' >'.$link['Link']['name'].'</a>';
				$data .= self::__menus($link['children'],0);
				$data .= '</li>';
			}
			$data .= '</ul>';
		}
		return $data;
	}
	private function __menus2($links = array()){
		$data ='';
		if(!empty($links)){
			$data .= '<ul>';
			foreach($links as $link){
				$url = "";
				$attr = "";
				if($link['Link']['module']=="" || $link['Link']['module']==Null || strtolower($link['Link']['module'])=='custom'){
					$url = $link['Link']['url']; 
				}else if($link['Link']['module']=="Page"|| $link['Link']['module']=="page"){
					$url = Router::url(array('plugin'=>'content_manager','controller'=>'pages','action'=>'view',$link['Link']['ref_id']));
				}
				if($link['Link']['new_window']==1){
					$attr = 'target="_blank"';
				}
				if(($link['Link']['module']=="Page"|| $link['Link']['module']=="page") && ($link['Link']['ref_id']==21)){
					$url = Router::url(array('plugin'=>'content_manager','controller'=>'galleries','action'=>'index'));
				}
				$data .='<li><a href="'.$url.'" '.$attr.' >'.$link['Link']['name'].'</a>';
				$data .= self::__menus2($link['children']);
				$data .= '</li>';
				
			}
			$data .= '</ul>';
			
		}
		return $data;
	}
	
}
?>


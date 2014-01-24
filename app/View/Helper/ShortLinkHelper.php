<?php
class ShortLinkHelper extends AppHelper {
	var $helpers = Array('Html','Form');
	
	function show($data = ""){
		$ShortLink =& ClassRegistry::init("ShortLink");  
		$short_links = $ShortLink->find('all');
		//print_r($short_links);die;
		foreach($short_links as $short_link){
			$url = "";
			if($short_link['ShortLink']['module']=="Page"|| $link['Link']['module']=="page"){
					$url = Router::url(array('plugin'=>'content_manager','controller'=>'pages','action'=>'view',$short_link['ShortLink']['object_id']));
			}
			$data =str_replace($short_link['ShortLink']['short_code'],$url,$data);
		}
		return $data;
		
	}
}
?>

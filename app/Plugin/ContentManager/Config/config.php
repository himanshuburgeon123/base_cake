<?php
$config = array();
/**Plugin Define Name **/
$config['Name']['PluginName'] = "ContentManager";
$config['Name']['TemplateFolderName'] =  'page_templates';

$config['Path']['Banner'] =  WWW_ROOT.'img'.DS.'banner'.DS;
$config['Path']['View'] =  array_pop(App::path('View',$config['Name']['PluginName']));
$config['Path']['Gallery'] =  WWW_ROOT.'img'.DS.'gallery'.DS;
$config['Path']['NoImage'] =  WWW_ROOT.'img'.DS.'site'.DS.'noimage.jpg';
$config['Admin']['Limit'] = 20;


/***These below code is used  for admin purpose*/
$config['image_list_width'] = "80";
$config['image_list_height'] = "80";
$config['image_edit_width'] = "120";
$config['image_edit_height'] = "120";
$config['image_front_width'] = "220";
$config['image_front_height'] = "200";

/**Belowe code is used for front banner image on front**/
$config['banner_image_width']="1400";
$config['banner_image_height']="350";

/**Below code for template page***/

$config['PageTemplates']=array(
	'default'=>'Default Template',
	'full_page'=>'Full Section',
	'home'=>'Home',
	'self_banner'=>'Self Banner',
);


?>

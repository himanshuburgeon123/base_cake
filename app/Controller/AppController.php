<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array('Form','Html','Menu','ShortLink');
	public $title_for_layout = "";     /*use as a html title tag content for admin and front side*/
	public $metakeyword = array();     /* use as a metakeyword in front side */
	public $metadescription = array(); /* use as a metadescription in front side */
	public $breadcrumbs = array();    /*use as a breadcrumbs for admin and front side*/
	public $setting = array();
	public static $script_for_layout = array('jquery.slimmenu.js');
	public static $css_for_layout = array('style.css');
	public static $scriptBlocks = array();
	public static $cssBlocks = array();
	public $header_modules = array();
	public $footer_modules = array();
	public $components = array(
		'Session','ImageResize', 'DebugKit.Toolbar',
		'MyMail'=>array(
			'template'=>'default',
			'emailFormat'=>'html',
			'model_name'=>'MailManager.Mail'
			),
		'Auth' => array(
			'loginRedirect' => '/admin/home',
			'logoutRedirect' => '/admin/index',
			'authError' => 'Did you really think you are allowed to see that?'
		),
		
	);
	
	
	public function beforeFilter() {
		Configure::load('config');
		$this->loadModel('User');
		$this->setPermissionAuth(Configure::read('Routing.auth_access'));
		$this->loadSettings();
		self::__setTheme();
		self::load_permission();
	}
	private function load_permission() {
		$id = $this->Auth->user('id');
		if($id) {
			$this->loadModel('SubadminManager.User');
			$user = $this->User->read(null,$id);
			$module =  ucfirst($this->params['controller'].'Controller');
			$user_modules = json_decode($user['User']['permission'],true);
			if((!isset($user_modules[$module]) || $user_modules[$module] == '' || $user_modules[$module] == 0) || $user['User']['role']=='admin'  ){
				if(($this->params['action']!='home' && $this->params['action']!='admin_changepassword' && $this->params['controller']!='users' && $this->params['controller']!='menus' && $this->params['controller']!='links' &&  $this->params['action']!='adminprofile' ) && $this->params['action']!='logout' && $user['User']['role']!='admin'){
					$this->Session->setFlash('You have not permission to access this location','default','msg','error');
					$this->redirect('/admin/home');
				}
			}else{
		       $this->__setPermission($user_modules[$module]);  
			}
			$this->set('ADMIN_PERMISSIONS',$user_modules);
			$this->set('ADMIN_USERS',$user);
	    }
    }
    private function __setPermission($permission) {
		if($permission==2 && $this->params['action']=='admin_delete') {
			$this->Session->setFlash('You are not authorized to access that location','default','','error');
			$this->redirect(array('action'=>'admin_index'));
			return;
		}
		if($permission==1 && ($this->params['action']=='admin_add' || $this->params['action']=='admin_edit' || $this->params['action']=='admin_delete')) {
			$this->Session->setFlash('You are not authorized to access that location','default','','error');
			$this->redirect(array('action'=>'admin_index'));
		}
    }
    public function beforeRender() {
		$this->set('title_for_layout',$this->title_for_layout);
		$this->set('breadcrumbs',$this->breadcrumbs);
		$this->set('setting',$this->setting);
		$this->set('heading',$this->heading);
		$this->set('script_for_layout',self::$script_for_layout);
		$this->set('css_for_layout',self::$css_for_layout);
		$this->set('scriptBlocks',self::$scriptBlocks);
		$this->set('cssBlocks',self::$cssBlocks);
		$this->set('metakeyword',$this->metakeyword);
		$this->set('metadescription',$this->metadescription);
		$this->set('footer_modules',$this->footer_modules);
		$this->set('header_modules',$this->header_modules);
	}
	protected function loadFrontModule() { }
	protected function setPermissionAuth($prefixs) {
		$this->Auth->deny('*');
		$path = explode('_',$this->params['action']);
		if(!in_array($path[0],$prefixs)){
			$this->Auth->allow($this->params['action']);
		}
	}
	protected function loadAdminSettings() {
		Configure::load('Custom/admin_config');
	}
	protected function loadSettings() {
		$settings = Cache::read('site');
		$settings = array();
		if(empty($settings)){
			$this->loadModel('Setting');
			$results = $this->Setting->find('all',array('fields'=>array('Setting.key','Setting.values','Setting.module'),'conditions'=>array('Setting.module'=>array('site','social','image'))));
			$settings = array();
			foreach($results as $result){
				$settings[$result['Setting']['module']][$result['Setting']['key']] = $result['Setting']['values'];
			}
			Configure::write('Site.logo',Configure::read('Site.url').$this->webroot.'img'.DS.'site'.DS.$settings['site']['site_logo']);
			Configure::write('Site.admin_logo',Configure::read('Site.logo'));
			Configure::write('Site.site_name',$settings['site']['site_name']);
			$settings['social']['facebook'] = $settings['social']['facebook'];
			$settings['social']['twitter'] = $settings['social']['twitter'];
			$settings['social']['linkedin'] = $settings['social']['linkedin'];
			$this->title_for_layout = $settings['site']['site_title'];
		
			//$settings['site']['logo'] = $settings['site']['site_url'].$this->webroot.'img/site/'.$settings['site']['site_logo'];
			//$settings['site']['no_image_path'] = WWW_ROOT.'img/site/'.$settings['site']['site_noimage'];
			
			 Cache::write('site', $settings);
			
		}
		$this->setting = $settings;
	}
	private function __setTheme() {
		if($this->params['admin'] || $this->params['controller']=="admin"){
			$this->layout="admin";
			$this->title_for_layout = $this->setting['site']['site_name'];
		}
	}
	protected function _randomString(){
		$characters = '$&@!0123456789abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randstring = '';
		for ($i = 0; $i < 15; $i++) {
			$arr1 = str_split($characters);
			$randstring .= $arr1[rand(0, $i)];
		}
		return $randstring;
	}
}

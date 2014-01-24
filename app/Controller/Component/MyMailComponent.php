<?php
App::import('Component', 'Email');
class MyMailComponent extends EmailComponent {
	public $email;
	public $model_name='';
	public $template = '';
	public $emailFormat = '';
	public $to = null;
	public $mail;
	
	public function __construct($collection, $settings = array()) {
		foreach($settings as $attr => $value){
			$this->$attr = $value;
		}
	}
	public function startup(Controller $controller) {
		$this->email = new CakeEmail();
		$this->template($this->template);
		$this->emailFormat($this->format);
		$this->mail = ClassRegistry::init($this->model_name);
	}
	public function to($email=null) {
		if($email!=null){
			$this->email->to($email);
		}
	}
	public function from($email=null,$name=null) {
		if(!empty($email)){
			$this->email->from($email,$name);
		}
	}
	public function emailFormat($format=null){
		if(!empty($format)){
			$this->email->emailFormat($format);
		}
	}
	public function template($template=null){
		if(!empty($template)){
			$this->email->template($template);
		}
	}
	public function attachments($attachments = null){
		$this->email->attachments($attachments);
	}
	public function send($mail_id = null){
		$mail_data = array();
		$mail_data = $this->mail->read(null,$mail_id);
		
		print_r($mail_data);die;
	}
}
?>

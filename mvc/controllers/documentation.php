<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Documentation extends Admin_Controller {

	public function admin() {
			$this->load->view('documentation/admin', $this->data);
	}
	
	public function teacher() {
			$this->load->view('documentation/teacher', $this->data);
	}

	public function student() {
			$this->load->view('documentation/student', $this->data);
	}
}

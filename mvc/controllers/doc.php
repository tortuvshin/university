<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -----------------------------------------------------
| PRODUCT NAME: 	INISYS SCHOOL MANAGEMENT SYSTEM
| -----------------------------------------------------
| AUTHOR:			TAGTAA DEVELOPMENT TEAM
| -----------------------------------------------------
| EMAIL:			info@tagtaasolution.mn
| -----------------------------------------------------
| WEBSITE:			http://tagtaasolution.mn
| -----------------------------------------------------
*/
class Doc extends Admin_Controller {

	public function admin() {
			$this->load->view('doc/admin', $this->data);
	}
	
	public function teacher() {
			$this->load->view('doc/teacher', $this->data);
	}

	public function student() {
			$this->load->view('doc/student', $this->data);
	}
}

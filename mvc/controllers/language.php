<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends Admin_Controller {
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
	function __construct() {
		parent::__construct();
		$this->load->helper('language');
	}

	public function index($lang) {
		$data = array('lang' => $lang);
		$this->session->set_userdata($data);
		redirect($_SERVER['HTTP_REFERER']);
	}

}

/* End of file language.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/language.php */
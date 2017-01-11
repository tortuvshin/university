<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends Admin_Controller {
/*
| -----------------------------------------------------
| PRODUCT NAME: 	INILABS SCHOOL MANAGEMENT SYSTEM
| -----------------------------------------------------
| AUTHOR:			INILABS TEAM
| -----------------------------------------------------
| EMAIL:			info@inilabs.net
| -----------------------------------------------------
| COPYRIGHT:		RESERVED BY INILABS IT
| -----------------------------------------------------
| WEBSITE:			http://inilabs.net
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
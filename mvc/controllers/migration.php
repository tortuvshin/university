<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration extends Admin_Controller {
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
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->load->library('migration');

		if ( ! $this->migration->current())
		{
			show_error($this->migration->error_string());
		} else {
			echo "success";
		}
	}

}

/* End of file migration.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/migration.php */
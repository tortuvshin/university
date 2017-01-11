<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends Admin_Controller {
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
		$language = $this->session->userdata('lang');
        $this->load->model("teacher_m");
        $this->load->model("parentes_m");
        $this->load->model("student_m");
        $this->load->model("user_m");
        $this->load->model("book_m");
				$this->lang->load('backup', $language);
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			if ($_POST) {
				// Load the DB utility class
				$this->load->dbutil();

				// Backup your entire database and assign it to a variable
				$prefs = array(
                	'filename'    => 'mybackup.sql',    // File name - NEEDED ONLY WITH ZIP FILES
              	);
				$backup =& $this->dbutil->backup($prefs);

				// Load the download helper and send the file to your desktop
				$this->load->helper('download');
				force_download('new.gz', $backup);
			}
			$this->data["subview"] = "backup/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}
}

/* End of file backup.php */
/* Location: .//var/www/html/schoolv2/mvc/controllers/backup.php */

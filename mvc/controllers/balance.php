<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Balance extends Admin_Controller {
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
		$this->load->model("classes_m");
		$this->load->model("student_m");
		$this->load->model("section_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('balance', $language);	
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Accountant") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
  				$this->data['set'] = $id;
				$this->data['classes'] = $this->student_m->get_classes();
				$this->data['students'] = $this->student_m->get_order_by_student(array('classesID' => $id));

				if($this->data['students']) {
					$sections = $this->section_m->get_order_by_section(array("classesID" => $id));
					$this->data['sections'] = $sections;
					foreach ($sections as $key => $section) {
						$this->data['allsection'][$section->section] = $this->student_m->get_order_by_student(array('classesID' => $id, "sectionID" => $section->sectionID));
					}
				} else {
					$this->data['students'] = NULL;
				}

				$this->data["subview"] = "balance/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data['classes'] = $this->classes_m->get_classes();
				$this->data["subview"] = "balance/search";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function balance_list() {
		$classID = $this->input->post('id');
		if((int)$classID) {
			$string = base_url("balance/index/$classID");
			echo $string;
		} else {
			redirect(base_url("balance/index"));
		}
	}
}

/* End of file balance.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/balance.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends Admin_Controller {
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
		$this->load->model("student_m");
		$this->load->model("parentes_m");
		$this->load->model("teacher_m");
		$this->load->model("user_m");
		$this->load->model("systemadmin_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('profile', $language);
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		$username = $this->session->userdata('username');
		if($usertype == "Admin") {
			$this->data['admin'] = $this->systemadmin_m->get_systemadmin(array('username' => $username));
			$this->data["subview"] = "profile/index";
			$this->load->view('_layout_main', $this->data);
		} elseif($usertype == "Librarian" || $usertype == "Accountant") {
			$user = $this->user_m->get_single_user(array("username" => $username));
			if($user) {
				$this->data['user'] = $user;
				$this->data["subview"] = "profile/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} elseif($usertype == "Teacher") {
			$teacher = $this->teacher_m->get_single_teacher(array('username' => $username));
			if($teacher) {
				$this->data['teacher'] = $teacher;
				$this->data["subview"] = "profile/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} elseif($usertype == "Student") {
			$student = $this->student_m->get_single_student(array('username' => $username));
			$this->data["student"] = $this->student_m->get_student($student->studentID);
			$this->data["class"] = $this->student_m->get_class($student->classesID);
			if($this->data["student"] && $this->data["class"]) {
				$this->data["parent"] = $this->parentes_m->get_parentes($student->parentID);
				$this->data["subview"] = "profile/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} elseif($usertype == "Parent") {
			$parentes = $this->parentes_m->get_single_parentes(array("username" => $username));
			if($parentes) {
				$this->data['parentes'] = $parentes;
				$this->data["subview"] = "profile/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}
}

/* End of file book.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/book.php */

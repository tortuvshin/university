<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Section extends Admin_Controller {
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
		$this->load->model("section_m");
		$this->load->model('classes_m');
		$language = $this->session->userdata('lang');
		$this->lang->load('section', $language);
		$this->lang->load('setting', $language);
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
 		if($usertype == "Admin") {
 			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['set'] = $id;
				$this->data['classes'] = $this->classes_m->get_classes();
				$this->data['sections'] = $this->section_m->get_join_section($id);
				$this->data["subview"] = "section/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data['classes'] = $this->classes_m->get_classes();
				$this->data["subview"] = "section/search";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'section',
				'label' => $this->lang->line("section_name"),
				'rules' => 'trim|required|xss_clean|max_length[60]|callback_unique_section'
			),
			array(
				'field' => 'category',
				'label' => $this->lang->line("section_category"),
				'rules' => 'trim|required|max_length[128]|xss_clean'
			),
			array(
				'field' => 'classesID',
				'label' => $this->lang->line("section_classes"),
				'rules' => 'trim|required|numeric|max_length[11]|xss_clean|callback_allclasses'
			),
			array(
				'field' => 'teacherID',
				'label' => $this->lang->line("section_teacher_name"),
				'rules' => 'trim|required|numeric|max_length[11]|xss_clean|callback_allteacher'
			),
			array(
				'field' => 'note',
				'label' => $this->lang->line("classes_note"),
				'rules' => 'trim|max_length[200]|xss_clean'
			)
		);
		return $rules;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$this->data['classes'] = $this->classes_m->get_classes();
			$this->data['teachers'] = $this->classes_m->get_teacher();
			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data["subview"] = "section/add";
					$this->load->view('_layout_main', $this->data);
				} else {
					$array = array(
						"section" => $this->input->post("section"),
						"category" => $this->input->post("category"),
						"classesID" => $this->input->post("classesID"),
						"teacherID" => $this->input->post("teacherID"),
						"note" => $this->input->post("note"),
						"create_date" => date("Y-m-d h:i:s"),
						"modify_date" => date("Y-m-d h:i:s"),
						"create_userID" => $this->session->userdata('loginuserID'),
						"create_username" => $this->session->userdata('username'),
						"create_usertype" => $this->session->userdata('usertype')
					);
					$this->section_m->insert_section($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("section/index"));
				}
			} else {
				$this->data["subview"] = "section/add";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function edit() {

		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			if((int)$id && (int)$url) {
				$this->data['teachers'] = $this->classes_m->get_teacher();
				$this->data['classes'] = $this->classes_m->get_classes();
				$this->data['section'] = $this->section_m->get_section($id);
				if($this->data['section']) {
					$this->data['set'] = $url;
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "section/edit";
							$this->load->view('_layout_main', $this->data);
						} else {
							$array = array(
								"section" => $this->input->post("section"),
								"category" => $this->input->post("category"),
								"classesID" => $this->input->post("classesID"),
								"teacherID" => $this->input->post("teacherID"),
								"note" => $this->input->post("note"),
								"modify_date" => date("Y-m-d h:i:s")
							);

							$this->section_m->update_section($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("section/index/$url"));
						}
					} else {
						$this->data["subview"] = "section/edit";
						$this->load->view('_layout_main', $this->data);
					}
				} else {
					$this->data["subview"] = "error";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function delete() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			if((int)$id && (int)$url) {
				$this->section_m->delete_section($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("section/index/$url"));
			} else {
				redirect(base_url("section/index"));
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}


	function allclasses() {
		if($this->input->post('classesID') == 0) {
			$this->form_validation->set_message("allclasses", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function allteacher() {
		if($this->input->post('teacherID') == 0) {
			$this->form_validation->set_message("allteacher", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	public function section_list() {
		$classID = $this->input->post('id');
		if((int)$classID) {
			$string = base_url("section/index/$classID");
			echo $string;
		} else {
			redirect(base_url("section/index"));
		}
	}

	public function unique_section() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$section = $this->section_m->get_order_by_section(array("classesID" => $this->input->post("classesID"), "section" => $this->input->post('section'), "sectionID !=" => $id));
			if(count($section)) {
				$this->form_validation->set_message("unique_section", "%s already exists");
				return FALSE;
			}
			return TRUE;
		} else {
			$section = $this->section_m->get_order_by_section(array("classesID" => $this->input->post("classesID"), "section" => $this->input->post('section')));

			if(count($section)) {
				$this->form_validation->set_message("unique_section", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}
	}
}

/* End of file class.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/class.php */

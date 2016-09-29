<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends Admin_Controller {
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
		$this->load->model("category_m");
		$this->load->model("hostel_m");
		$this->load->model("hmember_m");
		$this->load->model("student_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('category', $language);	
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype) {
			$this->data['categorys'] = $this->category_m->get_join_category();
			$this->data["subview"] = "category/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'hname', 
				'label' => $this->lang->line("category_hname"), 
				'rules' => 'trim|required|xss_clean|max_length[11]|callback_allhostel'
			), 
			array(
				'field' => 'class_type', 
				'label' => $this->lang->line("category_class_type"),
				'rules' => 'trim|required|max_length[60]|xss_clean|callback_unique_class_type'
			), 
			array(
				'field' => 'hbalance', 
				'label' => $this->lang->line("category_hbalance"),
				'rules' => 'trim|required|max_length[20]|xss_clean|numeric|callback_valid_number'
			),
			array(
				'field' => 'note', 
				'label' => $this->lang->line("category_note"), 
				'rules' => 'trim|max_length[200]|xss_clean'
			)
		);
		return $rules;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$this->data["hostels"] = $this->hostel_m->get_hostel();
			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data["subview"] = "category/add";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$array = array(
						"hostelID" => $this->input->post("hname"),
						"class_type" => $this->input->post("class_type"),
						"hbalance" => $this->input->post("hbalance"),
						"note" => $this->input->post("note")
					);

					$this->category_m->insert_category($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("category/index"));
				}
			} else {
				$this->data["subview"] = "category/add";
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
			if((int)$id) {
				$this->data['category'] = $this->category_m->get_category($id);
				if($this->data["category"]) {
					$this->data["hostels"] = $this->hostel_m->get_hostel();
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "category/edit";
							$this->load->view('_layout_main', $this->data);			
						} else {
							$array = array(
								"hostelID" => $this->input->post("hname"),
								"class_type" => $this->input->post("class_type"),
								"hbalance" => $this->input->post("hbalance"),
								"note" => $this->input->post("note")
							);

							$this->category_m->update_category($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("category/index"));
						}
					} else {
						$this->data["subview"] = "category/edit";
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
			if((int)$id) {
				$hmembers = $this->hmember_m->get_order_by_hmember(array("categoryID" => $id));
				foreach ($hmembers as $hmember) {
					$this->student_m->update_student_classes(array("hostel" => 0), array("studentID" => $hmember->studentID));
				}
				$this->hmember_m->delete_hmember_hID_fc($id);
				$this->category_m->delete_category($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("category/index"));
			} else {
				redirect(base_url("category/index"));
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}	
	}

	function unique_class_type(){
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$student = $this->category_m->get_order_by_category(array("class_type" => $this->input->post("class_type"), "hostelID" => $this->input->post("hname"), "categoryID !=" => $id));
			if(count($student)) {
				$this->form_validation->set_message("unique_class_type", "%s already exists");
				return FALSE;
			}
			return TRUE;
		} else {
			$student = $this->category_m->get_order_by_category(array("class_type" => $this->input->post("class_type"), "hostelID" => $this->input->post("hname")));

			if(count($student)) {
				$this->form_validation->set_message("unique_class_type", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}	
	}

	function allhostel() {
		if($this->input->post('hname') == 0) {
			$this->form_validation->set_message("allhostel", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function valid_number() {
		if($this->input->post('hbalance') && $this->input->post('hbalance') < 0) {
			$this->form_validation->set_message("valid_number", "%s is invalid number");
			return FALSE;
		}
		return TRUE;
	}
}

/* End of file category.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/category.php */
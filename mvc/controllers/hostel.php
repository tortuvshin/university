<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
class Hostel extends Admin_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("hostel_m");
		$this->load->model("hmember_m");
		$this->load->model("student_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('hostel', $language);	
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype) {
			$this->data['hostels'] = $this->hostel_m->get_order_by_hostel();
			$this->data["subview"] = "hostel/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'name', 
				'label' => $this->lang->line("hostel_name"), 
				'rules' => 'trim|required|xss_clean|max_length[128]|callback_unique_name'
			), 
			array(
				'field' => 'htype', 
				'label' => $this->lang->line("hostel_htype"),
				'rules' => 'trim|required|max_length[11]|xss_clean|callback_unique_htype'
			), 
			array(
				'field' => 'address', 
				'label' => $this->lang->line("hostel_address"),
				'rules' => 'trim|required|max_length[200]|xss_clean'
			),
			array(
				'field' => 'note', 
				'label' => $this->lang->line("hostel_note"), 
				'rules' => 'trim|max_length[200]|xss_clean'
			)
		);
		return $rules;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data["subview"] = "hostel/add";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$array = array(
						"name" => $this->input->post("name"),
						"htype" => $this->input->post("htype"),
						"address" => $this->input->post("address"),
						"note" => $this->input->post("note")
					);

					$this->hostel_m->insert_hostel($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("hostel/index"));
				}
			} else {
				$this->data["subview"] = "hostel/add";
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
				$this->data['hostel'] = $this->hostel_m->get_hostel($id);
				if($this->data['hostel']) {
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "hostel/edit";
							$this->load->view('_layout_main', $this->data);			
						} else {
							$array = array(
								"name" => $this->input->post("name"),
								"htype" => $this->input->post("htype"),
								"address" => $this->input->post("address"),
								"note" => $this->input->post("note")
							);

							$this->hostel_m->update_hostel($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("hostel/index"));
						}
					} else {
						$this->data["subview"] = "hostel/edit";
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
				$hmembers = $this->hmember_m->get_order_by_hmember(array("hostelID" => $id));
				foreach ($hmembers as $hmember) {
					$this->student_m->update_student_classes(array("hostel" => 0), array("studentID" => $hmember->studentID));
				}
				$this->hmember_m->delete_hmember_hID($id);
				$this->hostel_m->delete_hostel($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("hostel/index"));
			} else {
				redirect(base_url("hostel/index"));
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}	
	}

	function unique_name() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$student = $this->hostel_m->get_order_by_hostel(array("name" => $this->input->post("name"), "hostelID !=" => $id));
			if(count($student)) {
				$this->form_validation->set_message("unique_name", "%s already exists");
				return FALSE;
			}
			return TRUE;
		} else {
			$student = $this->hostel_m->get_order_by_hostel(array("name" => $this->input->post("name")));
			if(count($student)) {
				$this->form_validation->set_message("unique_name", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}
	}

	function unique_htype() {
		$htype = $this->input->post('htype');
		if($htype === '0') {
			$this->form_validation->set_message("unique_htype", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}
}

/* End of file hostel.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/hostel.php */
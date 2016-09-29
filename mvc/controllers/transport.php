<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transport extends Admin_Controller {
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
		$this->load->model("transport_m");
		$this->load->model("student_m");
		$this->load->model("tmember_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('transport', $language);	
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype) {
			$this->data['transports'] = $this->transport_m->get_order_by_transport();
			$this->data["subview"] = "transport/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
		
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'route', 
				'label' => $this->lang->line("transport_route"), 
				'rules' => 'trim|required|xss_clean|max_length[128]|callback_unique_route'
			), 
			array(
				'field' => 'vehicle', 
				'label' => $this->lang->line("transport_vehicle"),
				'rules' => 'trim|required|max_length[11]|xss_clean|numeric|callback_valid_number'
			), 
			array(
				'field' => 'fare', 
				'label' => $this->lang->line("transport_fare"),
				'rules' => 'trim|required|max_length[11]|xss_clean|numeric|callback_valid_number_for_fare'
			),
			array(
				'field' => 'note', 
				'label' => $this->lang->line("transport_note"), 
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
					$this->data['form_validation'] = validation_errors(); 
					$this->data["subview"] = "transport/add";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$array = array(
						"route" => $this->input->post("route"),
						"vehicle" => $this->input->post("vehicle"),
						"fare" => $this->input->post("fare"),
						"note" => $this->input->post("note")
					);

					$this->transport_m->insert_transport($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("transport/index"));
				}
			} else {
				$this->data["subview"] = "transport/add";
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
				$this->data['transport'] = $this->transport_m->get_transport($id);
				if($this->data['transport']) {
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "transport/edit";
							$this->load->view('_layout_main', $this->data);			
						} else {
							$array = array(
								"route" => $this->input->post("route"),
								"vehicle" => $this->input->post("vehicle"),
								"fare" => $this->input->post("fare"),
								"note" => $this->input->post("note")
							);

							$this->transport_m->update_transport($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("transport/index"));
						}
					} else {
						$this->data["subview"] = "transport/edit";
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
				$lmembers = $this->tmember_m->get_order_by_tmember(array("transportID" => $id));
				foreach ($lmembers as $lmember) {
					$this->student_m->update_student_classes(array("transport" => 0), array("studentID" => $lmember->studentID));
				}
				$this->tmember_m->delete_tmember_tID($id);
				$this->transport_m->delete_transport($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("transport/index"));
			} else {
				redirect(base_url("transport/index"));
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}	
	}

	function unique_route() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$transport = $this->transport_m->get_order_by_transport(array("route" => $this->input->post("route"), "transportID !=" => $id));
			if(count($transport)) {
				$this->form_validation->set_message("unique_route", "%s already exists");
				return FALSE;
			}
			return TRUE;
		} else {
			$transport = $this->transport_m->get_order_by_transport(array("route" => $this->input->post("route")));

			if(count($transport)) {
				$this->form_validation->set_message("unique_route", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}	
	}

	function valid_number() {
		if($this->input->post('vehicle') && $this->input->post('vehicle') < 0) {
			$this->form_validation->set_message("valid_number", "%s is invalid number");
			return FALSE;
		}
		return TRUE;
	}

	function valid_number_for_fare() {
		if($this->input->post('fare') && $this->input->post('fare') < 0) {
			$this->form_validation->set_message("valid_number_for_fare", "%s is invalid number");
			return FALSE;
		}
		return TRUE;
	}
}

/* End of file transport.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/transport.php */
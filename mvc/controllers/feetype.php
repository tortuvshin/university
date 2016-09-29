<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feetype extends Admin_Controller {
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
		$this->load->model("feetype_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('feetype', $language);	
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
 		if($usertype == "Admin" || $usertype == "Accountant") {
			$this->data['feetypes'] = $this->feetype_m->get_feetype();
			$this->data["subview"] = "feetype/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	protected function rules() {
		$rules = array(
				array(
					'field' => 'feetype', 
					'label' => $this->lang->line("feetype_name"), 
					'rules' => 'trim|required|xss_clean|max_length[60]|callback_unique_feetype'
				),
				array(
					'field' => 'note', 
					'label' => $this->lang->line("feetype_note"), 
					'rules' => 'trim|xss_clean|max_length[200]'
				),
			);
		return $rules;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Accountant") {
			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data["subview"] = "feetype/add";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$array = array(
						"feetype" => $this->input->post("feetype"),
						"note" => $this->input->post("note")
					);

					$this->feetype_m->insert_feetype($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("feetype/index"));
				}
			} else {
				$this->data["subview"] = "feetype/add";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function edit() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Accountant") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['feetype'] = $this->feetype_m->get_feetype($id);
				if($this->data['feetype']) {
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "feetype/edit";
							$this->load->view('_layout_main', $this->data);			
						} else {
							$array = array(
								"feetype" => $this->input->post("feetype"),
								"note" => $this->input->post("note")
							);

							$this->feetype_m->update_feetype($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("feetype/index"));
						}
					} else {
						$this->data["subview"] = "feetype/edit";
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
		if($usertype == "Admin" || $usertype == "Accountant") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->feetype_m->delete_feetype($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("feetype/index"));
			} else {
				redirect(base_url("feetype/index"));
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}	
	}

	public function unique_feetype() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$feetype = $this->feetype_m->get_order_by_feetype(array("feetype" => $this->input->post("feetype"), "feetypeID !=" => $id));
			if(count($feetype)) {
				$this->form_validation->set_message("unique_feetype", "%s already exists");
				return FALSE;
			}
			return TRUE;
		} else {
			$feetype = $this->feetype_m->get_order_by_feetype(array("feetype" => $this->input->post("feetype")));

			if(count($feetype)) {
				$this->form_validation->set_message("unique_feetype", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}	
	}
}

/* End of file feetype.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/feetype.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exam extends Admin_Controller {
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
		$this->load->model("exam_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('exam', $language);	
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$this->data['exams'] = $this->exam_m->get_order_by_exam();
			$this->data["subview"] = "exam/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'exam', 
				'label' => $this->lang->line("exam_name"), 
				'rules' => 'trim|required|xss_clean|max_length[60]|callback_unique_exam'
			), 
			array(
				'field' => 'date', 
				'label' => $this->lang->line("exam_date"),
				'rules' => 'trim|required|max_length[10]|xss_clean|callback_date_valid'
			), 
			array(
				'field' => 'note', 
				'label' => $this->lang->line("exam_note"), 
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
					$this->data["subview"] = "exam/add";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$array = array(
						"exam" => $this->input->post("exam"),
						"date" => date("Y-m-d", strtotime($this->input->post("date"))),
						"note" => $this->input->post("note")
					);

					$this->exam_m->insert_exam($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("exam/index"));
				}
			} else {
				$this->data["subview"] = "exam/add";
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
				$this->data['exam'] = $this->exam_m->get_exam($id);
				if($this->data['exam']) {
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "exam/edit";
							$this->load->view('_layout_main', $this->data);			
						} else {
							$array = array(
								"exam" => $this->input->post("exam"),
								"date" => date("Y-m-d", strtotime($this->input->post("date"))),
								"note" => $this->input->post("note")
							);

							$this->exam_m->update_exam($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("exam/index"));
						}
					} else {
						$this->data["subview"] = "exam/edit";
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
				$this->exam_m->delete_exam($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("exam/index"));
			} else {
				redirect(base_url("exam/index"));
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}	
	}

	public function unique_exam() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$exam = $this->exam_m->get_order_by_exam(array("exam" => $this->input->post("exam"), "examID !=" => $id));
			if(count($exam)) {
				$this->form_validation->set_message("unique_exam", "%s already exists");
				return FALSE;
			}
			return TRUE;
		} else {
			$exam = $this->exam_m->get_order_by_exam(array("exam" => $this->input->post("exam")));

			if(count($exam)) {
				$this->form_validation->set_message("unique_exam", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}	
	}

	function date_valid($date) {
	  	if(strlen($date) <10) {
			$this->form_validation->set_message("date_valid", "%s is not valid dd-mm-yyyy");
	     	return FALSE;
		} else {
	   		$arr = explode("-", $date);   
	        $dd = $arr[0];            
	        $mm = $arr[1];              
	        $yyyy = $arr[2];
	      	if(checkdate($mm, $dd, $yyyy)) {
	      		return TRUE;
	      	} else {
	      		$this->form_validation->set_message("date_valid", "%s is not valid dd-mm-yyyy");
	     		return FALSE;
	      	}
	    } 

	} 
}

/* End of file exam.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/exam.php */
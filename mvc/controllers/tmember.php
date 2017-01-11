<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tmember extends Admin_Controller {
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
		$this->load->model("tmember_m");
		$this->load->model("transport_m");
		$this->load->model("student_m");
		$this->load->model("section_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('tmember', $language);	
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'transportID', 
				'label' => $this->lang->line("tmember_route_name"), 
				'rules' => 'trim|required|max_length[11]|xss_clean|callback_alltransport'
			),
			array(
				'field' => 'tbalance', 
				'label' => $this->lang->line("tmember_tfee"), 
				'rules' => 'trim|required|max_length[20]|xss_clean|numeric|callback_valid_number'
			)
		);
		return $rules;
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Accountant") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['set'] = $id;
				$this->data['classes'] = $this->student_m->get_classes();
				$this->data['students'] = array();
				$students = $this->student_m->get_order_by_roll(array('classesID' => $id));
				foreach ($students as $key => $student) {
					$section = $this->section_m->get_section($student->sectionID);
					if($section) {
						$this->data['students'][$key] = (object) array_merge( (array)$student, array('ssection' => $section->section));
					} else {
						$this->data['students'][$key] = (object) array_merge( (array)$student, array('ssection' => $student->section));
					}
				}

				$this->data["subview"] = "tmember/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data['classes'] = $this->student_m->get_classes();
				$this->data["subview"] = "tmember/search";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Accountant") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			$this->data['transports'] = $this->transport_m->get_transport();
			$student = $this->student_m->get_student($id);

			if((int)$id && (int)$url) {
				if($student){
					$this->data['set'] = $url;
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "tmember/add";
							$this->load->view('_layout_main', $this->data);			
						} else {

							$array = array(
								"studentID" => $student->studentID,
								"transportID" => $this->input->post("transportID"),
								"name" => $student->name,
								"email" => $student->email,
								"phone" => $student->phone,
								"tbalance" => $this->input->post("tbalance"),
								"tjoindate" => date("Y-m-d")
							);

							$this->tmember_m->insert_tmember($array);
							$this->student_m->update_student(array("transport" => 1), $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("tmember/index/$url"));
						}
					} else {
						$this->data["subview"] = "tmember/add";
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

	public function edit() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Accountant") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			if((int)$id && (int)$url) {
				$this->data['tmember'] = $this->tmember_m->get_single_tmember(array("studentID" =>$id));
				if($this->data['tmember']) {
					$this->data['transports'] = $this->transport_m->get_transport();
					$this->data['set'] = $url;
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) { 
							$this->data["subview"] = "tmember/edit";
							$this->load->view('_layout_main', $this->data);
						} else {
							$array = array(
								"transportID" => $this->input->post("transportID"),
								"tbalance" => $this->input->post("tbalance")
							);
							$this->tmember_m->update_tmember($array, $this->data['tmember']->tmemberID);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("tmember/index/$url"));	
						}
					} else {
						$this->data["subview"] = "tmember/edit";
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
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			if((int)$id && (int)$url) {
				$this->tmember_m->delete_tmember_sID($id);
				$this->student_m->update_student(array("transport" => 0), $id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("tmember/index/$url"));
			} else {
				redirect(base_url("tmember/index"));
			}	
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function view() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Accountant") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			if((int)$id && (int)$url) {
				$this->data['set'] = $url;
				$this->data['student'] = $this->student_m->get_student($id);
				if($this->data['student']) {
					$this->data["class"] = $this->student_m->get_class($this->data['student']->classesID);
					$this->data['tmember'] = $this->tmember_m->get_tmember_sID($id);
					if($this->data['tmember']) {
						$this->data['transport'] = $this->transport_m->get_transport($this->data['tmember']->transportID);
						$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
						$this->data["subview"] = "tmember/view";
						$this->load->view('_layout_main', $this->data);
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
		} elseif($usertype == "Student") {
			$username = $this->session->userdata("username");
			$student = $this->student_m->get_single_student(array("username" => $username));
			$this->data['student'] = $this->student_m->get_student($student->studentID);
			if($this->data['student']) {
				$this->data["class"] = $this->student_m->get_class($this->data['student']->classesID);
				$this->data['tmember'] = $this->tmember_m->get_tmember_sID($student->studentID);
				if($this->data['tmember']) {
					$this->data['transport'] = $this->transport_m->get_transport($this->data['tmember']->transportID);
					$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
					$this->data["subview"] = "tmember/view";
					$this->load->view('_layout_main', $this->data);
				} else {
					$this->data["subview"] = "tmember/view";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "tmember/view";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function student_list() {
		$classID = $this->input->post('id');
		if((int)$classID) {
			$string = base_url("tmember/index/$classID");
			echo $string;
		} else {
			redirect(base_url("tmember/index"));
		}
	}

	public function transport_fare() {
		$transportID = $this->input->post('id');
		if((int)$transportID) {
			$string = $this->transport_m->get_transport($transportID);
			echo $string->fare;
		} else {
			redirect(base_url("tmember/index"));
		}
	}

	public function print_preview() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Accountant") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));

			if ((int)$id && (int)$url) {
				$this->data['set'] = $url;
				$this->data['student'] = $this->student_m->get_student($id);	

				if($this->data['student']) {
					$this->data["class"] = $this->student_m->get_class($this->data['student']->classesID);
					$this->data['tmember'] = $this->tmember_m->get_tmember_sID($id);
					if($this->data['tmember']) {
						$this->data['transport'] = $this->transport_m->get_transport($this->data['tmember']->transportID);
						$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
						$this->load->library('html2pdf');
					    $this->html2pdf->folder('./assets/pdfs/');
					    $this->html2pdf->filename('Report.pdf');
					    $this->html2pdf->paper('a4', 'portrait');
					    $this->data['panel_title'] = $this->lang->line('panel_title');

						$html = $this->load->view('tmember/print_preview', $this->data, true);
						$this->html2pdf->html($html);
						$this->html2pdf->create();
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
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}
	public function send_mail() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$id = $this->input->post('id');
			$url = $this->input->post('set');
			if ((int)$id && (int)$url) {
				$this->data["student"] = $this->student_m->get_student($id);
				if($this->data["student"]) {

					$this->data["class"] = $this->student_m->get_class($this->data['student']->classesID);
					$this->data['tmember'] = $this->tmember_m->get_tmember_sID($id);
					if($this->data['tmember']) {
						$this->data['transport'] = $this->transport_m->get_transport($this->data['tmember']->transportID);
						$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
						$this->load->library('html2pdf');
					    $this->html2pdf->folder('uploads/report');
					    $this->html2pdf->filename('Report.pdf');
					    $this->html2pdf->paper('a4', 'portrait');
					    $this->data['panel_title'] = $this->lang->line('panel_title');

						$html = $this->load->view('tmember/print_preview', $this->data, true);
						$this->html2pdf->html($html);
						$this->html2pdf->create('save');
						
						if($path = $this->html2pdf->create('save')) {
						$this->load->library('email');
						$this->email->set_mailtype("html");
						$this->email->from($this->data["siteinfos"]->email, $this->data['siteinfos']->sname);
						$this->email->to($this->input->post('to'));
						$this->email->subject($this->input->post('subject'));
						$this->email->message($this->input->post('message'));	
						$this->email->attach($path);
							if($this->email->send()) {
								$this->session->set_flashdata('success', $this->lang->line('mail_success'));
							} else {
								$this->session->set_flashdata('error', $this->lang->line('mail_error'));
							}
						}
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

	function alltransport() {
		if($this->input->post('transportID') == 0) {
			$this->form_validation->set_message("alltransport", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function valid_number() {
		if($this->input->post('tbalance') && $this->input->post('tbalance') < 0) {
			$this->form_validation->set_message("valid_number", "%s is invalid number");
			return FALSE;
		}
		return TRUE;
	}

}

/* End of file tmember.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/tmember.php */
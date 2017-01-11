<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lmember extends Admin_Controller {
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
		$this->load->model("lmember_m");
		$this->load->model("student_m");
		$this->load->model("issue_m");
		$this->load->model('section_m');
		$language = $this->session->userdata('lang');
		$this->lang->load('lmember', $language);	
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'lID', 
				'label' => $this->lang->line("lmember_lID"),
				'rules' => 'trim|required|max_length[40]|callback_unique_lID|xss_clean'
			),
			array(
				'field' => 'lbalance', 
				'label' => $this->lang->line("lmember_lfee"), 
				'rules' => 'trim|required|max_length[20]|xss_clean|numeric|callback_valid_number'
			)
		);
		return $rules;
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Librarian") {
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
				$this->data["subview"] = "lmember/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data['classes'] = $this->student_m->get_classes();
				$this->data["subview"] = "lmember/search";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Librarian") {
			$lID = '';
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			$lmember = $this->lmember_m->get_lmember();
			$lastid = $this->lmember_m->get_lmember_lastID();
			$student = $this->student_m->get_student($id);

			if((int)$id && (int)$url) {

				if($student) {
					if(count($lmember)) {
					$lID = $lastid->lID+1;
					} else {
						$data = date('Y');
						$lID = $data.'01';
					}

					$this->data['libraryID'] = $lID;
					$this->data['student'] = $student;
					$this->data['set'] = $url;
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data['form_validation'] = validation_errors(); 
							$this->data["subview"] = "lmember/add";
							$this->load->view('_layout_main', $this->data);			
						} else {

							$array = array(
								"lID" => $this->input->post("lID"),
								"studentID" => $student->studentID,
								"name" => $student->name,
								"email" => $student->email,
								"phone" => $student->phone,
								"lbalance" => $this->input->post("lbalance"),
								"ljoindate" => date("Y-m-d")
							);

							$this->lmember_m->insert_lmember($array);
							$this->student_m->update_student(array("library" => 1), $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("lmember/index/$url"));
						}
					} else {
						$this->data["subview"] = "lmember/add";
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

	public function view() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Librarian") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));

			if ((int)$id && (int)$url) {
				$this->data['set'] = $url;
				$this->data['student'] = $this->student_m->get_student($id);	

				if($this->data['student']) {
					$this->data["class"] = $this->student_m->get_class($this->data['student']->classesID);
					$this->data['lmember'] = $this->lmember_m->get_lmember_sID($id);
					if($this->data['lmember']) {
						$this->data['issues'] = $this->issue_m->get_order_by_issue(array('lID' => $this->data['lmember']->lID));
						$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
						$this->data["subview"] = "lmember/view";
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
				$this->data['lmember'] = $this->lmember_m->get_lmember_sID($student->studentID);
				if($this->data['lmember']) {
					$lmember = $this->lmember_m->get_single_lmember(array("studentID" => $student->studentID));
					$lID = $lmember->lID;
					$this->data['issues'] = $this->issue_m->get_order_by_issue(array("lID" => $lID));
					$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
					$this->data["subview"] = "lmember/view";
					$this->load->view('_layout_main', $this->data);
				} else {
					$this->data["subview"] = "lmember/view";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "lmember/view";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function print_preview() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Librarian") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));

			if ((int)$id && (int)$url) {
				$this->data['set'] = $url;
				$this->data['student'] = $this->student_m->get_student($id);	

				if($this->data['student']) {
					$this->data["class"] = $this->student_m->get_class($this->data['student']->classesID);
					$this->data['lmember'] = $this->lmember_m->get_lmember_sID($id);
					if($this->data['lmember']) {
						$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
						$this->load->library('html2pdf');
					    $this->html2pdf->folder('./assets/pdfs/');
					    $this->html2pdf->filename('Report.pdf');
					    $this->html2pdf->paper('a4', 'portrait');
					    $this->data['panel_title'] = $this->lang->line('panel_title');
						$this->data['issues'] = $this->issue_m->get_order_by_issue(array('lID' => $this->data['lmember']->lID));

						$html = $this->load->view('lmember/print_preview', $this->data, true);
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
					$this->data['lmember'] = $this->lmember_m->get_lmember_sID($id);
					$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
					$this->load->library('html2pdf');
				    $this->html2pdf->folder('uploads/report');
				    $this->html2pdf->filename('Report.pdf');
				    $this->html2pdf->paper('a4', 'portrait');
				    $this->data['panel_title'] = $this->lang->line('panel_title');
					$this->data['issues'] = $this->issue_m->get_order_by_issue(array('lID' => $this->data['lmember']->lID));

					$html = $this->load->view('lmember/print_preview', $this->data, true);
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
		if($usertype == "Admin" || $usertype == "Librarian") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			if((int)$id && (int)$url) {
				$this->data['student'] = $this->student_m->get_student($id);
				if($this->data['student']) {
					$this->data['lmember'] = $this->lmember_m->get_single_lmember(array("studentID" => $id));
					if($this->data['lmember']) {
						$this->data['set'] = $url;
						if($_POST) {
							$rules = $this->rules();
							$this->form_validation->set_rules($rules);
							if ($this->form_validation->run() == FALSE) { 
								$this->data["subview"] = "lmember/edit";
								$this->load->view('_layout_main', $this->data);
							} else {
							
								$array = array(
									"lID" => $this->input->post("lID"),
									"lbalance" => $this->input->post("lbalance")
								);

								$this->lmember_m->update_lmember($array, $this->data['lmember']->lmemberID);
								$this->session->set_flashdata('success', $this->lang->line('menu_success'));
								redirect(base_url("lmember/index/$url"));	
							}
						} else {
							$this->data["subview"] = "lmember/edit";
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
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function delete() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Librarian") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			if((int)$id && (int)$url) {
				$this->lmember_m->delete_lmember_sID($id);

				$this->student_m->update_student(array("library" => 0), $id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("lmember/index/$url"));
			} else {
				redirect(base_url("lmember/index"));
			}	
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function student_list() {
		$classID = $this->input->post('id');
		if((int)$classID) {
			$string = base_url("lmember/index/$classID");
			echo $string;
		} else {
			redirect(base_url("lmember/index"));
		}
	}

	public function unique_lID() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		$method = $this->uri->segment(2);

		if($method == "edit") {
			$library = $this->lmember_m->get_single_lmember(array("studentID" => $id));
			$lmember = $this->lmember_m->get_order_by_lmember(array("lID" => $this->input->post("lID"), "lmemberID !=" => $library->lmemberID));
			if(count($lmember)) {
				$this->form_validation->set_message("unique_lID", "%s already exists");
				return FALSE;
			}
			return TRUE;
		} else {
			$lmember = $this->lmember_m->get_order_by_lmember(array("lID" => $this->input->post("lID")));
			if(count($lmember)) {
				$this->form_validation->set_message("unique_lID", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}
	}

	function valid_number() {
		if($this->input->post('lbalance') && $this->input->post('lbalance') < 0) {
			$this->form_validation->set_message("valid_number", "%s is invalid number");
			return FALSE;
		}
		return TRUE;
	}
}

/* End of file lmember.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/lmember.php */
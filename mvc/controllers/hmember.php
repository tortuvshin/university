<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hmember extends Admin_Controller {
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
		$this->load->model("hmember_m");
		$this->load->model("category_m");
		$this->load->model("hostel_m");
		$this->load->model("student_m");
		$this->load->model("section_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('hmember', $language);	
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'hostelID', 
				'label' => $this->lang->line("hmember_hname"), 
				'rules' => 'trim|max_length[11]|required|xss_clean|numeric|callback_unique_gender'
			),
			array(
				'field' => 'categoryID', 
				'label' => $this->lang->line("hmember_class_type"), 
				'rules' => 'trim|max_length[11]|required|xss_clean|numeric|callback_unique_select'
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
				$this->data["subview"] = "hmember/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data['classes'] = $this->student_m->get_classes();
				$this->data["subview"] = "hmember/search";
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
			$this->data["hostels"] = $this->hostel_m->get_hostel();
			if((int)$id && (int)$url) {
				$student = $this->student_m->get_student($id);
				if($student) {
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data['form_validation'] = validation_errors(); 
							$this->data["subview"] = "hmember/add";
							$this->load->view('_layout_main', $this->data);			
						} else {
							$hostel_main_id = $this->hostel_m->get_hostel($this->input->post("hostelID"));
							$category_main_id = $this->category_m->get_single_category(array("hostelID" => $hostel_main_id->hostelID, "categoryID" =>  $this->input->post("categoryID")));
							if($hostel_main_id) {
								if($category_main_id) {
									$array = array(
										"hostelID" => $this->input->post("hostelID"),
										"categoryID" => $this->input->post("categoryID"),
										"studentID" => $id,
										"hbalance" => $category_main_id->hbalance,
										"hjoindate" => date("Y-m-d")
									);
									$this->hmember_m->insert_hmember($array);
									$this->student_m->update_student(array("hostel" => 1), $id);
									$this->session->set_flashdata('success', $this->lang->line('menu_success'));
									redirect(base_url("hmember/index/$url"));
								} else {
									$this->data["subview"] = "error";
									$this->load->view('_layout_main', $this->data);
								}
							} else {
								$this->data["subview"] = "error";
								$this->load->view('_layout_main', $this->data);
							}
						}
					} else {
						$this->data["subview"] = "hmember/add";
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
				$this->data["hmember"] = $this->hmember_m->get_single_hmember(array("studentID" => $id));
				if($this->data["hmember"]) {
					$this->data["categorys"] = $this->category_m->get_order_by_category(array("hostelID" => $this->data["hmember"]->hostelID));
					if($this->data["categorys"]) {
						$this->data["hostels"] = $this->hostel_m->get_hostel();
						$this->data['set'] = $url;
						if($_POST) {
							$rules = $this->rules();
							$this->form_validation->set_rules($rules);
							if ($this->form_validation->run() == FALSE) { 
								$this->data["subview"] = "hmember/edit";
								$this->load->view('_layout_main', $this->data);
							} else {
								$hostel_main_id = $this->hostel_m->get_hostel($this->input->post("hostelID"));
								$category_main_id = $this->category_m->get_single_category(array("hostelID" => $hostel_main_id->hostelID, "categoryID" =>  $this->input->post("categoryID")));

								$hostel_main_id = $this->hostel_m->get_hostel($this->input->post("hostelID"));
								$category_main_id = $this->category_m->get_single_category(array("hostelID" => $hostel_main_id->hostelID, "categoryID" =>  $this->input->post("categoryID")));
								if($hostel_main_id) {
									if($category_main_id) {
										$array = array(
											"hostelID" => $this->input->post("hostelID"),
											"categoryID" => $this->input->post("categoryID"),
											"studentID" => $id,
											"hbalance" => $category_main_id->hbalance
										);

										$this->hmember_m->update_hmember($array, $this->data['hmember']->hmemberID);
										$this->session->set_flashdata('success', $this->lang->line('menu_success'));
										redirect(base_url("hmember/index/$url"));
									} else {
										$this->data["subview"] = "error";
										$this->load->view('_layout_main', $this->data);
									}
								} else {
									$this->data["subview"] = "error";
									$this->load->view('_layout_main', $this->data);
								}				
							}
						} else {
							$this->data["subview"] = "hmember/edit";
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
		if($usertype == "Admin" || $usertype == "Accountant") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			if((int)$id && (int)$url) {
				$this->data["hmember"] = $this->hmember_m->get_single_hmember(array("studentID" => $id));
				if($this->data["hmember"]) {
					$this->hmember_m->delete_hmember($this->data['hmember']->hmemberID);
					$this->student_m->update_student(array("hostel" => 0), $id);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("hmember/index/$url"));
				} else {
					redirect(base_url("hmember/index"));
				}
				
			} else {
				redirect(base_url("hmember/index"));
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
					$this->data['hmember'] = $this->hmember_m->get_single_hmember(array("studentID" => $id));
					if($this->data['hmember']) {
						$this->data['hostel'] = $this->hostel_m->get_hostel($this->data['hmember']->hostelID);
						$this->data['category'] = $this->category_m->get_category($this->data['hmember']->categoryID);
						$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
						$this->data["subview"] = "hmember/view";
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
				$this->data['hmember'] = $this->hmember_m->get_single_hmember(array("studentID" => $this->data['student']->studentID));
				if($this->data['hmember']) {
					$this->data['hostel'] = $this->hostel_m->get_hostel($this->data['hmember']->hostelID);
					$this->data['category'] = $this->category_m->get_category($this->data['hmember']->categoryID);
					$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
					$this->data["subview"] = "hmember/view";
					$this->load->view('_layout_main', $this->data);
				} else {
					$this->data["subview"] = "hmember/view";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "hmember/view";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
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
					$this->data['hmember'] = $this->hmember_m->get_single_hmember(array("studentID" => $id));
					if($this->data['hmember']) {
						$this->data['hostel'] = $this->hostel_m->get_hostel($this->data['hmember']->hostelID);
						$this->data['category'] = $this->category_m->get_category($this->data['hmember']->categoryID);
						$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);

						$this->load->library('html2pdf');
					    $this->html2pdf->folder('./assets/pdfs/');
					    $this->html2pdf->filename('Report.pdf');
					    $this->html2pdf->paper('a4', 'portrait');
					    $this->data['panel_title'] = $this->lang->line('panel_title');

						$html = $this->load->view('hmember/print_preview', $this->data, true);
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
					$this->data['hmember'] = $this->hmember_m->get_single_hmember(array("studentID" => $id));
					if($this->data['hmember']) {
					$this->data['hostel'] = $this->hostel_m->get_hostel($this->data['hmember']->hostelID);
					$this->data['category'] = $this->category_m->get_category($this->data['hmember']->categoryID);
					}
					$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
					$this->load->library('html2pdf');
				    $this->html2pdf->folder('uploads/report');
				    $this->html2pdf->filename('Report.pdf');
				    $this->html2pdf->paper('a4', 'portrait');
				    $this->data['panel_title'] = $this->lang->line('panel_title');

					$html = $this->load->view('hmember/print_preview', $this->data, true);
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

	public function student_list() {
		$classID = $this->input->post('id');
		if((int)$classID) {
			$string = base_url("hmember/index/$classID");
			echo $string;
		} else {
			redirect(base_url("hmember/index"));
		}
	}

	function categorycall() {
		$classtype = $this->input->post('id');

		if((int)$classtype) {
			$allclasstype = $this->category_m->get_order_by_category(array("hostelID" => $classtype));
			echo "<option value='0'>", $this->lang->line("hmember_select_class_type"),"</option>";
			foreach ($allclasstype as $value) {
				echo "<option value=\"$value->categoryID\">",$value->class_type,"</option>";
			}
		} 
	}

	function unique_select() {
		if($this->input->post("categoryID") == 0) {
			$this->form_validation->set_message("unique_select", "The %s field is required");
			return FALSE;
		}
		return TRUE;
	}

	function unique_gender() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			if($this->input->post("hostelID") == 0) {
				$this->form_validation->set_message("unique_gender", "The %s field is required");
				return FALSE;
			} else {
				$student = $this->student_m->get_student($id);
				$hostel = $this->hostel_m->get_single_hostel(array("hostelID" => $this->input->post("hostelID")));
				if($hostel) {
					$gender = "";
					if($student->sex == "Male") {
						$gender = "Boys";
					} else {
						$gender = "Girls";
					}

					if($hostel->htype == $gender) {
						return TRUE;
					} elseif($hostel->htype == "Combine") {
						return TRUE;
					} else {
						$this->form_validation->set_message("unique_gender", "This hostel only for $hostel->htype.");
						return FALSE;
					}
				} else {
					$this->form_validation->set_message("unique_gender", "The %s field is required");
					return FALSE;
				}
			}
		}
		return FALSE;	
	}

}

/* End of file hmember.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/hmember.php */
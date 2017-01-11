<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examschedule extends Admin_Controller {
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
		$this->load->model("examschedule_m");
		$this->load->model("student_info_m");
		$this->load->model("parentes_info_m");
		$this->load->model("parentes_m");
		$this->load->model("student_m");
		$this->load->model("section_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('examschedule', $language);	
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Teacher") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['set'] = $id;
				$this->data['classes'] = $this->examschedule_m->get_classes();
				$this->data['examschedules'] = $this->examschedule_m->get_join_all($id);

				if($this->data['examschedules']) {
					$sections = $this->section_m->get_order_by_section(array("classesID" => $id));
					$this->data['sections'] = $sections;
					foreach ($sections as $key => $section) {
						$this->data['allsection'][$section->section] = $this->examschedule_m->get_join_all_wsection($id, $section->sectionID);
					}
				} else {
					$this->data['examschedules'] = NULL;
				}

				$this->data["subview"] = "examschedule/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data['classes'] = $this->examschedule_m->get_classes();
				$this->data["subview"] = "examschedule/search";
				$this->load->view('_layout_main', $this->data);
			}
		} elseif($usertype == "Student") {
			$student = $this->student_info_m->get_student_info();
			$this->data['examschedules'] = $this->student_info_m->get_join_all_examschedule_wsection($student->classesID, $student->sectionID);
			$this->data["subview"] = "examschedule/index";
			$this->load->view('_layout_main', $this->data);
		} elseif($usertype == "Parent") {
			$username = $this->session->userdata("username");
			$parent = $this->parentes_m->get_single_parentes(array('username' => $username));
			$this->data['students'] = $this->student_m->get_order_by_student(array('parentID' => $parent->parentID));
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$checkstudent = $this->student_m->get_single_student(array('studentID' => $id));
				if(count($checkstudent)) {
					$classesID = $checkstudent->classesID;
					$this->data['set'] = $id;
					$this->data['examschedules'] = $this->student_info_m->get_join_all_examschedule_wsection($checkstudent->classesID, $checkstudent->sectionID);
					$this->data["subview"] = "examschedule/index_parent";
					$this->load->view('_layout_main', $this->data);
				} else {
					$this->data["subview"] = "error";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "examschedule/search_parent";
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
					'field' => 'examID', 
					'label' => $this->lang->line("examschedule_name"), 
					'rules' => 'trim|required|numeric|xss_clean|max_length[11]|callback_allexam'
				),
				array(
					'field' => 'classesID', 
					'label' => $this->lang->line("examschedule_classes"), 
					'rules' => 'trim|required|numeric|xss_clean|max_length[11]|callback_allclasses'
				),
				array(
					'field' => 'sectionID', 
					'label' => $this->lang->line("examschedule_section"), 
					'rules' => 'trim|required|numeric|xss_clean|max_length[11]|callback_allsection'
				),
				array(
					'field' => 'subjectID', 
					'label' => $this->lang->line("examschedule_subject"), 
					'rules' => 'trim|required|numeric|xss_clean|max_length[11]|callback_allsubject'
				),
				array(
					'field' => 'date',
					'label' => $this->lang->line("examschedule_date"), 
					'rules' => 'trim|required|xss_clean|max_length[10]|callback_date_valid|callback_pastdate_check'
				),
				array(
					'field' => 'examfrom', 
					'label' => $this->lang->line("examschedule_examfrom"), 
					'rules' => 'trim|required|xss_clean|max_length[10]'
				),
				array(
					'field' => 'examto', 
					'label' => $this->lang->line("examschedule_examto"), 
					'rules' => 'trim|required|xss_clean|max_length[10]'
				),
				array(
					'field' => 'room', 
					'label' => $this->lang->line("examschedule_room"), 
					'rules' => 'trim|xss_clean|max_length[10]'
				)
			);
		return $rules;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {

			$this->data['classes'] = $this->examschedule_m->get_classes();
			$this->data['exams'] = $this->examschedule_m->get_exam();
			$classesID = $this->input->post("classesID");
			
			if($classesID != 0) {
				$this->data['subjects'] = $this->examschedule_m->get_subject($classesID);
				$this->data['sections'] = $this->section_m->get_order_by_section(array("classesID" => $classesID));
			} else {
				$this->data['subjects'] = "empty";
				$this->data['sections'] = "empty";
			}
			$this->data['subjectID'] = 0;
			$this->data['sectionID'] = 0;

			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data["subview"] = "examschedule/add";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$array = array(
						"examID" => $this->input->post("examID"),
						"classesID" => $this->input->post("classesID"),
						"sectionID" => $this->input->post("sectionID"),
						"subjectID" => $this->input->post("subjectID"),
						"edate" => date("Y-m-d", strtotime($this->input->post("date"))),
						"examfrom" => $this->input->post("examfrom"),
						"examto" => $this->input->post("examto"),
						"room" => $this->input->post("room"),
						"year" => date("Y")
					);

					$this->examschedule_m->insert_examschedule($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("examschedule/index"));
				}
			} else {
				$this->data["subview"] = "examschedule/add";
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
				$this->data['examschedule'] = $this->examschedule_m->get_examschedule($id);
				if($this->data['examschedule']) {
					$classID = $this->data['examschedule']->classesID;
					$this->data['subjects'] = $this->examschedule_m->get_subject($classID);
					$this->data['classes'] = $this->examschedule_m->get_classes();
					$this->data['exams'] = $this->examschedule_m->get_exam();
					$this->data['sections'] = $this->section_m->get_order_by_section(array("classesID" => $classID));
					$this->data['set'] = $url;
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "examschedule/edit";
							$this->load->view('_layout_main', $this->data);			
						} else {
							$array = array(
								"examID" => $this->input->post("examID"),
								"classesID" => $this->input->post("classesID"),
								"sectionID" => $this->input->post("sectionID"),
								"subjectID" => $this->input->post("subjectID"),
								"edate" => date("Y-m-d", strtotime($this->input->post("date"))),
								"examfrom" => $this->input->post("examfrom"),
								"examto" => $this->input->post("examto"),
								"room" => $this->input->post("room")
							);

							$this->examschedule_m->update_examschedule($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("examschedule/index/$url"));
						}
					} else {
						$this->data["subview"] = "examschedule/edit";
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
			$classes = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			if((int)$id && (int)$classes) {
				$this->examschedule_m->delete_examschedule($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("examschedule/index/$classes"));
			} else {
				redirect(base_url("examschedule/index"));
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function examschedule_list() {
		$classID = $this->input->post('id');
		if((int)$classID) {
			$string = base_url("examschedule/index/$classID");
			echo $string;
		} else {
			redirect(base_url("examschedule/index"));
		}
	}

	public function student_list() {
		$studentID = $this->input->post('id');
		if((int)$studentID) {
			$string = base_url("examschedule/index/$studentID");
			echo $string;
		} else {
			redirect(base_url("examschedule/index"));
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

	function allsubject() {
		if($this->input->post('subjectID') == 0) {
			$this->form_validation->set_message("allsubject", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function subjectcall() {
		$classID = $this->input->post('id');

		if((int)$classID) {
			$allclasses = $this->examschedule_m->get_subject($classID);
			echo "<option value='0'>", $this->lang->line("examschedule_select_subject"),"</option>";
			foreach ($allclasses as $value) {
				echo "<option value=\"$value->subjectID\">",$value->subject,"</option>";
			}
		} 
	}

	function sectioncall() {
		$classID = $this->input->post('id');
		if((int)$classID) {
			$allsection = $this->section_m->get_order_by_section(array("classesID" => $classID));
			echo "<option value='0'>", $this->lang->line("examschedule_select_section"),"</option>";
			foreach ($allsection as $value) {
				echo "<option value=\"$value->sectionID\">",$value->section,"</option>";
			}
		} 
	}

	function allexam() {
		$examID = $this->input->post('examID');
		if($examID === '0') {
			$this->form_validation->set_message("allexam", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function allclasses() {
		$examID = $this->input->post('classesID');
		if($examID === '0') {
			$this->form_validation->set_message("allclasses", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function allsection() {
		$sectionID = $this->input->post('sectionID');
		if($sectionID === '0') {
			$this->form_validation->set_message("allsection", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function pastdate_check() {
		$date = strtotime($this->input->post("date"));
		$now_date = strtotime(date("Y-m-d"));
		if($date < $now_date) {
			$this->form_validation->set_message("pastdate_check", "The %s field is past");
	     	return FALSE;
		}
		return TRUE;
	}
}

/* End of file examschedule.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/examschedule.php */
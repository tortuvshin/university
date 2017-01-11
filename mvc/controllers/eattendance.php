<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eattendance extends Admin_Controller {
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
		$this->load->model("student_m");
		$this->load->model("exam_m");
		$this->load->model('subject_m');
		$this->load->model("eattendance_m");
		$this->load->model("classes_m");
		$this->load->model("section_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('eattendance', $language);	
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'examID', 
				'label' => $this->lang->line("eattendance_exam"), 
				'rules' => 'trim|required|xss_clean|numeric|max_length[11]|callback_check_exam'
			), 
			array(
				'field' => 'classesID', 
				'label' => $this->lang->line("eattendance_classes"), 
				'rules' => 'trim|required|xss_clean|numeric|max_length[11]|callback_check_classes'
			), 
			array(
				'field' => 'subjectID', 
				'label' => $this->lang->line("eattendance_subject"), 
				'rules' => 'trim|required|xss_clean|numeric|max_length[11]|callback_check_subject'
			)
		);
		return $rules;
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Teacher") {
			$this->data['exams'] = $this->exam_m->get_exam();
			$this->data['classes'] = $this->classes_m->get_classes();
			$classesID = $this->input->post("classesID");
			if($classesID != 0) {
				$this->data['subjects'] = $this->subject_m->get_order_by_subject(array("classesID" => $classesID));
			} else {
				$this->data['subjects'] = "empty";
			}
			$this->data['subjectID'] = 0;
			$this->data['students'] = array();
			$year = date("Y");

			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) { 
					$this->data["subview"] = "eattendance/index";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$examID = $this->input->post("examID");
					$classesID = $this->input->post("classesID");
					$subjectID = $this->input->post("subjectID");
					$date = date("Y-m-d");
					$year = date("Y");
		

					$this->data['eattendances'] = $this->eattendance_m->get_order_by_eattendance(array("examID" => $examID, "classesID" => $classesID, "subjectID" => $subjectID, 'year' => $year));
					if(count($this->data['eattendances'])) {
						$this->data['students'] = $this->student_m->get_order_by_student(array("classesID" => $classesID));
						if(count($this->data['students'])) {

							if($this->data['students']) {
								$sections = $this->section_m->get_order_by_section(array("classesID" => $classesID));
								$this->data['sections'] = $sections;
								foreach ($sections as $key => $section) {
									$this->data['allsection'][$section->section] = $this->student_m->get_order_by_student(array('classesID' => $classesID, "sectionID" => $section->sectionID));
								}
							} else {
								$this->data['students'] = NULL;
							}

							// foreach ($students as $key => $student) {
							// 	$section = $this->section_m->get_section($student->sectionID);
							// 	if($section) {
							// 		$this->data['students'][$key] = (object) array_merge( (array)$student, array('ssection' => $section->section));
							// 	} else {
							// 		$this->data['students'][$key] = (object) array_merge( (array)$student, array('ssection' => $student->section));
							// 	}
							// }
							$this->data['examID'] = $examID;
							$this->data['classesID'] = $classesID;
							$this->data['subjectID'] = $subjectID;
						}
					}

					$this->data["subview"] = "eattendance/index";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "eattendance/index";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Teacher") {
			$this->data['exams'] = $this->exam_m->get_exam();
			$this->data['classes'] = $this->classes_m->get_classes();
			$classesID = $this->input->post("classesID");
			if($classesID != 0) {
				$this->data['subjects'] = $this->subject_m->get_order_by_subject(array("classesID" => $classesID));
			} else {
				$this->data['subjects'] = "empty";
			}
			$this->data['subjectID'] = 0;
			$this->data['students'] = array();

			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) { 
					$this->data["subview"] = "eattendance/add";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$examID = $this->input->post("examID");
					$classesID = $this->input->post("classesID");
					$subjectID = $this->input->post("subjectID");
					$date = date("Y-m-d");
					$year = date("Y");
	
						$students = $this->student_m->get_order_by_student(array("classesID" => $classesID));
						if(count($students)) {
							foreach ($students as $key => $student) {
								$section = $this->section_m->get_section($student->sectionID);
								if($section) {
									$this->data['students'][$key] = (object) array_merge( (array)$student, array('ssection' => $section->section));
								} else {
									$this->data['students'][$key] = (object) array_merge( (array)$student, array('ssection' => $student->section));
								}

								$studentID = $student->studentID;
								$eattendance = $this->eattendance_m->get_order_by_eattendance(array("studentID" => $studentID, "examID" => $examID, "classesID" => $classesID, "subjectID" => $subjectID));
								if(!count($eattendance)) {
									$array = array(
										"examID" => $examID,
										"classesID" => $classesID,
										"subjectID" => $subjectID,
										"studentID" => $studentID,
										"s_name" => $student->name,
										"date" => $date,
										"year" => $year
									);
									$this->eattendance_m->insert_eattendance($array);
								}
							}
							$this->data['eattendances'] = $this->eattendance_m->get_eattendance();
							$this->data['examID'] = $examID;
							$this->data['classesID'] = $classesID;
							$this->data['subjectID'] = $subjectID;
						}
						$this->data["subview"] = "eattendance/add";
						$this->load->view('_layout_main', $this->data);

				}
			} else {
				$this->data["subview"] = "eattendance/add";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	function check_exam() {
		$examID = $this->input->post('examID');
		if($examID === '0') {
			$this->form_validation->set_message("check_exam", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function check_classes() {
		$classesID = $this->input->post('classesID');
		if($classesID === '0') {
			$this->form_validation->set_message("check_classes", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function check_subject() {
		$subjectID = $this->input->post('subjectID');
		if($subjectID === '0') {
			$this->form_validation->set_message("check_subject", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function subjectcall() {
		$classID = $this->input->post('id');

		if((int)$classID) {
			$allclasses = $this->subject_m->get_order_by_subject(array("classesID" => $classID));
			echo "<option value='0'>", $this->lang->line("eattendance_select_subject"),"</option>";
			foreach ($allclasses as $value) {
				echo "<option value=\"$value->subjectID\">",$value->subject,"</option>";
			}
		} 
	}


	function single_add() {
		$examID = $this->input->post('examID');
		$classesID = $this->input->post('classesID');
		$subjectID = $this->input->post('subjectID');
		$studentID = $this->input->post('studentID');
		$status = 0;
		$status = $this->input->post('status');
		$year = date("Y");
		
		if($status == "checked") {
			$status = "Present";
		} elseif($status == "unchecked") {
			$status = "Absent";
		}
		if((int)$examID && (int)$classesID && (int)$subjectID) {
			$array = array("eattendance" => $status);
			$this->eattendance_m->update_eattendance_classes($array, array("examID" => $examID, "classesID" => $classesID, "subjectID" => $subjectID, "year" => $year, "studentID" => $studentID));
			echo $this->lang->line('menu_success');
		}
	}

	function all_add() {
		$examID = $this->input->post('examID');
		$classesID = $this->input->post('classesID');
		$subjectID = $this->input->post('subjectID');
		$status = 0;
		$status = $this->input->post('status');
		$year = date("Y");
		
		if($status == "checked") {
			$status = "Present";
		} elseif($status == "unchecked") {
			$status = "Absent";
		}
		if((int)$examID && (int)$classesID && (int)$subjectID) {
			$array = array("eattendance" => $status);
			$this->eattendance_m->update_eattendance_classes($array, array("examID" => $examID, "classesID" => $classesID, "subjectID" => $subjectID, "year" => $year));
			echo $this->lang->line('menu_success');
		}
	}
}

/* End of file class.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/class.php */
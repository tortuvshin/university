<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends Admin_Controller {
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
		$this->load->model("subject_m");
		$this->load->model("student_info_m");
		$this->load->model("parentes_info_m");
		$this->load->model('section_m');
		$this->load->model("classes_m");
		$this->load->model("teacher_m");
		$this->load->model("student_m");
		$this->load->model("mark_m");
		$this->load->model("grade_m");
		$this->load->model("exam_m");
		$this->load->model("routine_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('report', $language);	
	}

	protected function rules_student() {
		$rules = array(
			array(
				'field' => 'classesID', 
				'label' => $this->lang->line("report_classes"), 
				'rules' => 'trim|required|xss_clean|numeric|callback_check_classes_student'
			), 
			array(
				'field' => 'sectionID', 
				'label' => $this->lang->line("report_section"),
				'rules' => 'trim|xss_clean|numeric|callback_check_student_section'
			),
			array(
				'field' => 'studentID', 
				'label' => $this->lang->line("report_student_id"),
				'rules' => 'trim|xss_clean|numeric'
			)
			
		);
		return $rules;
	}
	protected function rules_mark() {
		$rules = array(
			array(
				'field' => 'examID', 
				'label' => $this->lang->line("mark_exam"), 
				'rules' => 'trim|required|xss_clean|max_length[11]'
			), 
			array(
				'field' => 'classesID_mark', 
				'label' => $this->lang->line("mark_classes"), 
				'rules' => 'trim|required|xss_clean|max_length[11]'
			), 
			array(
				'field' => 'subjectID', 
				'label' => $this->lang->line("mark_subject"),
				'rules' => 'trim|xss_clean|max_length[11]'
			)
		);
		return $rules;
	}

	protected function rules_routine() {
		$rules = array(
			array(
				'field' => 'classesID_routine', 
				'label' => $this->lang->line("report_classes"), 
				'rules' => 'trim|required|xss_clean|max_length[11]|callback_check_classes'
			), 
			array(
				'field' => 'sectionID_routine', 
				'label' => $this->lang->line("report_section"),
				'rules' => 'trim|required|xss_clean|max_length[11]|callback_check_section'
			)
		);
		return $rules;
	}

	protected function rules_balance() {
		$rules = array(
			array(
				'field' => 'classesID_balance', 
				'label' => $this->lang->line("report_classes"), 
				'rules' => 'trim|required|xss_clean|max_length[11]|callback_check_classes_balance'
			), 
			array(
				'field' => 'sectionID_balance', 
				'label' => $this->lang->line("report_section"),
				'rules' => 'trim|xss_clean|max_length[11]'
			)
		);
		return $rules;
	}

	public function index() {	
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			if($_POST) {
				$this->data['classes'] = $this->student_m->get_classes();
				$this->data['teachers'] = $this->teacher_m->get_teacher();
				$this->data['exams'] = $this->exam_m->get_exam();
				$this->data['set_exam'] = 0;

				$rules = $this->rules_student();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) { 
					$this->data["subview"] = "report/index";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$studentID = $this->input->post('studentID');
					$classID = $this->input->post('classesID');
					$sectionID = $this->input->post('sectionID');
					if((int) !empty($classID) && (int) !empty($sectionID)) { 
						$this->data["students"] = $this->student_m->get_order_by_studen_with_section($classID, $sectionID);
						$this->data["status"] = "single";
			
						$this->data['set'] = $classID;
						$this->data["exams"] = $this->exam_m->get_exam();
						$this->data["grades"] = $this->grade_m->get_grade();
						$this->data["marks"] = $this->mark_m->get_order_by_mark(array("studentID" =>$studentID, "classesID" => $classID));

						$this->load->library('html2pdf');
					    $this->html2pdf->folder('./assets/pdfs/');
					    $this->html2pdf->filename('Report.pdf');
					    $this->html2pdf->paper('a4', 'portrait');
					    $this->data['panel_title'] = $this->lang->line('panel_title');
						$html = $this->load->view('report/student_list_pdf', $this->data, true);
						$this->html2pdf->html($html);
						$this->html2pdf->create();


					} elseif((int) !empty($classID) && $sectionID === '0') {
						$this->data["students"] = $this->student_m->get_order_by_studen_with_section_and_classes($classID);
						$this->data["status"] = "alldata";
						$this->load->library('html2pdf');
					    $this->html2pdf->folder('./assets/pdfs/');
					    $this->html2pdf->filename('Report.pdf');
					    $this->html2pdf->paper('a4', 'portrait');
					    $this->data['panel_title'] = $this->lang->line('panel_title');
						$html = $this->load->view('report/student_list_pdf', $this->data, true);
						$this->html2pdf->html($html);
						$this->html2pdf->create();
					} else {
						$this->data["subview"] = "error";
						$this->load->view('_layout_main', $this->data);
					}
				}

			} else {
				// $this->data['sections'] = $this->section_m->get_join_section_with_classes();
				$this->data['classes'] = $this->student_m->get_classes();
				$this->data['teachers'] = $this->teacher_m->get_teacher();
				$this->data['exams'] = $this->exam_m->get_exam();
				$this->data['set_exam'] = 0;
				$this->data["subview"] = "report/index";
				$this->load->view('_layout_main', $this->data);	
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function teacher_report() {
		$usertype = $this->session->userdata("usertype");
		$language = $this->session->userdata('lang');
		$this->lang->load('teacher', $language);	
		$this->data['classes'] = $this->student_m->get_classes();
		$this->data['teachers'] = $this->teacher_m->get_teacher();
		$this->data['exams'] = $this->exam_m->get_exam();
		$this->data['set_exam'] = 0;
		if($usertype == "Admin") {
			if ($_POST) {
				$teacherID = $this->input->post('teacherID');
				if((int)!empty($teacherID)) { 
					$this->data["teacher"] = $this->teacher_m->get_teacher($teacherID);
					if($this->data["teacher"]) {
						$this->data['panel_title'] = $this->lang->line('panel_title');
						$html = $this->load->view('teacher/print_preview', $this->data, true);
						$this->load->library('html2pdf');
					    $this->html2pdf->folder('./assets/pdfs/');
					    $this->html2pdf->filename('Report.pdf');
					    $this->html2pdf->paper('a4', 'portrait');
						$this->html2pdf->html($html);
						$this->html2pdf->create();
					} else {
						$this->data["subview"] = "error";
						$this->load->view('_layout_main', $this->data);
					}
				} else {
					$this->data["teachers"] = $this->teacher_m->get_teacher();
					if(count($this->data["teachers"])) {
						$this->data['panel_title'] = $this->lang->line('panel_title');
						$html = $this->load->view('report/teacher_list_pdf', $this->data, true);
						$this->load->library('html2pdf');
					    $this->html2pdf->folder('./assets/pdfs/');
					    $this->html2pdf->filename('Report.pdf');
					    $this->html2pdf->paper('a4', 'portrait');
						$this->html2pdf->html($html);
						$this->html2pdf->create();
					} else {
						$this->session->set_flashdata('error', $this->lang->line('report_emteacher'));
						redirect(base_url('report/index'));
					}
				}
			} else {
				
				$this->data["subview"] = "report/index";
				$this->load->view('_layout_main', $this->data);	
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function mark_report() {
		$usertype = $this->session->userdata("usertype");
		$language = $this->session->userdata('lang');
		$this->lang->load('mark', $language);	
		$this->data['classes'] = $this->student_m->get_classes();
		$this->data['teachers'] = $this->teacher_m->get_teacher();
		$this->data['exams'] = $this->exam_m->get_exam();
		$this->data['set_exam'] = 0;
		if($usertype == "Admin") {
			if ($_POST) {
				$rules = $this->rules_mark();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) { 
					$this->data["subview"] = "report/index";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$examID = $this->input->post('examID');
					$classID = $this->input->post('classesID_mark');
					$subjectID = $this->input->post('subjectID');
					$this->data['exam'] = $this->exam_m->get_exam($examID);
					$this->data["class"] = $this->student_m->get_class($classID);
					$this->data['subject'] = $this->subject_m->get_subject($subjectID);
					if ($this->data['exam'] && $this->data["class"] && empty($subjectID)) {
						$this->data['subjects'] = $this->subject_m->get_order_by_subject(array("classesID" => $classID));
						
						$this->db->select('*');
						$this->db->from('student');
						$this->db->join('mark', 'student.studentID = mark.studentID', 'left');
						$this->db->where(array('student.classesID' => $classID, 'mark.examID' => $examID));
						$query = $this->db->get();
						$this->data['full_result'] = $query->result();

						$this->load->library('html2pdf');
					    $this->html2pdf->folder('./assets/pdfs/');
					    $this->html2pdf->filename('Report.pdf');
					    $this->html2pdf->paper('a4', 'portrait');
					    $this->data['panel_title'] = $this->lang->line('panel_title');
						$html = $this->load->view('report/students_all_mark_report', $this->data, true);
						$this->html2pdf->html($html);
						$this->html2pdf->create();
					} else {
						$this->data['subjects'] = $this->subject_m->get_order_by_subject(array("classesID" => $classID, "subjectID" => $subjectID ));
						
						$this->db->select('*');
						$this->db->from('student');
						$this->db->join('mark', 'student.studentID = mark.studentID', 'left');
						$this->db->where(array('student.classesID' => $classID, 'mark.examID' => $examID, 'mark.subjectID' => $subjectID));
						$query = $this->db->get();
						$this->data['full_result'] = $query->result();

						$this->load->library('html2pdf');
					    $this->html2pdf->folder('./assets/pdfs/');
					    $this->html2pdf->filename('Report.pdf');
					    $this->html2pdf->paper('a4', 'portrait');
					    $this->data['panel_title'] = $this->lang->line('panel_title');
						$html = $this->load->view('report/students_all_mark_report', $this->data, true);
						$this->html2pdf->html($html);
						$this->html2pdf->create();
					}

				}
			} else {				
				$this->data["subview"] = "report/index";
				$this->load->view('_layout_main', $this->data);	
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function balance_report() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$this->data['classes'] = $this->student_m->get_classes();
			$this->data['teachers'] = $this->teacher_m->get_teacher();
			$this->data['exams'] = $this->exam_m->get_exam();
			$this->data['set_exam'] = 0;
			if($_POST) {
				$rules = $this->rules_balance();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) { 
					$this->data["subview"] = "report/index";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$classID = $this->input->post('classesID_balance');
					$sectionID = $this->input->post('sectionID_balance');
					if((int) !empty($classID) && (int) !empty($sectionID)) { 
						$this->data["students"] = $this->student_m->get_order_by_studen_with_section($classID, $sectionID);
						$this->data["status"] = "single";
						$this->data['set'] = $classID;

						$this->load->library('html2pdf');
					    $this->html2pdf->folder('./assets/pdfs/');
					    $this->html2pdf->filename('Report.pdf');
					    $this->html2pdf->paper('a4', 'portrait');
					    $this->data['panel_title'] = $this->lang->line('panel_title');
						$html = $this->load->view('report/balance_report', $this->data, true);
						$this->html2pdf->html($html);
						$this->html2pdf->create();

					} elseif((int) !empty($classID) && $sectionID === '0') {
						$this->data["students"] = $this->student_m->get_order_by_studen_with_section_and_classes($classID);
						$this->data['set'] = $classID;
						$this->data["status"] = "alldata";
						$this->load->library('html2pdf');
					    $this->html2pdf->folder('./assets/pdfs/');
					    $this->html2pdf->filename('Report.pdf');
					    $this->html2pdf->paper('a4', 'portrait');
					    $this->data['panel_title'] = $this->lang->line('panel_title');
						$html = $this->load->view('report/balance_report', $this->data, true);
						$this->html2pdf->html($html);
						$this->html2pdf->create();
					} else {
						$this->data["subview"] = "error";
						$this->load->view('_layout_main', $this->data);
					}

				}
			} else {
				$this->data["subview"] = "report/index";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}


	public function name() {
		$classID = $this->input->post('id');
		if((int)$classID) {
			$allstudent = $this->student_m->get_order_by_student(array('classesID' => $classID));
			if($allstudent) {
				echo "<option value='0'>", $this->lang->line("report_select_name"),"</option>";
				foreach ($allstudent as $value) {
					echo "<option value=\"$value->studentID\">", $value->roll, "&nbsp;&nbsp;  (", $value->name, ")", "</option>";
				}
			} else {
				echo "<option value='0'>", $this->lang->line("report_select_name"),"</option>";	
			}
		} else {
			echo "<option value='0'>", $this->lang->line("report_select_name"),"</option>";	
		}
	}

	public function subjectcall() {
		$usertype = $this->session->userdata("usertype");
		$id = $this->input->post('id');
		if((int)$id) {
			if($usertype == "Admin") {
				$allsubject = $this->subject_m->get_order_by_subject(array("classesID" => $id));
				echo "<option value='0'>", $this->lang->line("mark_select_subject"),"</option>";
				foreach ($allsubject as $value) {
					echo "<option value=\"$value->subjectID\">",$value->subject,"</option>";
				}
			} elseif($usertype == "Teacher") {
				$username = $this->session->userdata("username");
				$teacher = $this->user_m->get_username_row("teacher", array("username" => $username));
				$allsubject = $this->subject_m->get_order_by_subject(array("classesID" => $id, "teacherID" => $teacher->teacherID));
				echo "<option value='0'>", $this->lang->line("mark_select_subject"),"</option>";
				foreach ($allsubject as $value) {
					echo "<option value=\"$value->subjectID\">",$value->subject,"</option>";
				}
			}
		} 
	}


	public function check_exam() {
		if($this->input->post('examID') == 0) {
			$this->form_validation->set_message("check_exam", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	public function check_classes() {
		if($this->input->post('classesID_routine') == 0) {
			$this->form_validation->set_message("check_classes", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	public function check_classes_student() {
		if($this->input->post('classesID') == 0) {
			$this->form_validation->set_message("check_classes_student", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	public function check_classes_balance() {
		if($this->input->post('classesID_balance') == 0) {
			$this->form_validation->set_message("check_classes_balance", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	public function check_classes_student_section() {
		if($this->input->post('sectionID') == 0) {
			$this->form_validation->set_message("check_classes_student_section", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}


	public function check_section() {
		if($this->input->post('sectionID_routine') == 0) {
			$this->form_validation->set_message("check_section", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	// public function check_section_balance() {
	// 	if($this->input->post('sectionID_routine') == 0) {
	// 		$this->form_validation->set_message("check_section", "The %s field is required");
	//      	return FALSE;
	// 	}
	// 	return TRUE;
	// }

	function call_section() {
		$classesID = $this->input->post('classesID');
		if($classesID) {
			$allsection = $this->section_m->get_order_by_section(array("classesID" => $classesID));
			echo "<option value='0'>", $this->lang->line("report_select_section"),"</option>";
			if(count($allsection)) {
				foreach ($allsection as $value) {
					echo "<option value=\"$value->sectionID\">",$value->section,"</option>";
				}
			} else {
				echo "<option value='0'>". $this->lang->line("report_select_section") ."</option>";
			}
		} else {
			echo "<option value='0'>". $this->lang->line("report_select_section") ."</option>";
		}
	}

	function routine() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$this->data['classes'] = $this->student_m->get_classes();
			$this->data['teachers'] = $this->teacher_m->get_teacher();
			$this->data['exams'] = $this->exam_m->get_exam();
			$this->data['set_exam'] = 0;
 			$this->data['set_routine'] = 0;
			if($_POST) {
				$rules = $this->rules_routine();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) { 
					$this->data["subview"] = "report/index";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$classID = $this->input->post('classesID_routine');
					$sectionID = $this->input->post('sectionID_routine');
					if((int)!empty($classID) && (int)!empty($sectionID)) {
						$this->data['routines'] = $this->routine_m->get_join_all_wsection($classID,$sectionID);

						$this->load->library('html2pdf');
					    $this->html2pdf->folder('./assets/pdfs/');
					    $this->html2pdf->filename('Report.pdf');
					    $this->html2pdf->paper('a4', 'portrait');
					    $this->data['panel_title'] = $this->lang->line('panel_title');
						$html = $this->load->view('report/routine_pdf', $this->data, true);
						$this->html2pdf->html($html);
						$this->html2pdf->create();

						// $this->data['panel_title'] = $this->lang->line('panel_title');
						// $html = $this->load->view('report/routine_pdf', $this->data);
					} else {
						$this->data["subview"] = "report/index";
						$this->load->view('_layout_main', $this->data);
					}
				}
			} else {
				$this->data["subview"] = "report/index";
				$this->load->view('_layout_main', $this->data);	
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}
}
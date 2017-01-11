<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mark extends Admin_Controller {
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
		$this->load->model("mark_m");
		$this->load->model("grade_m");
		$this->load->model("classes_m");
		$this->load->model("exam_m");
		$this->load->model("subject_m");
		$this->load->model("user_m");
		$this->load->model("section_m");
		$this->load->model("parentes_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('mark', $language);
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'examID',
				'label' => $this->lang->line("mark_exam"),
				'rules' => 'trim|required|xss_clean|max_length[11]|callback_check_exam'
			),
			array(
				'field' => 'classesID',
				'label' => $this->lang->line("mark_classes"),
				'rules' => 'trim|required|xss_clean|max_length[11]|callback_check_classes'
			),
			array(
				'field' => 'subjectID',
				'label' => $this->lang->line("mark_subject"),
				'rules' => 'trim|required|xss_clean|max_length[11]|callback_check_subject'
			)
		);
		return $rules;
	}


	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Teacher") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['set'] = $id;
				$this->data['classes'] = $this->student_m->get_classes();
				$this->data['student'] = $this->student_m->get_order_by_student(array('classesID' => $id));
				$this->data["subview"] = "mark/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data['classes'] = $this->student_m->get_classes();
				$this->data["subview"] = "mark/search";
				$this->load->view('_layout_main', $this->data);
			}
		} elseif($usertype == 'Parent') {
			$username = $this->session->userdata("username");
			$parent = $this->parentes_m->get_single_parentes(array('username' => $username));
			$this->data['allstudents'] = $this->student_m->get_order_by_student(array('parentID' => $parent->parentID));
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));

			if((int)$id) {
				$checkstudent = $this->student_m->get_single_student(array('studentID' => $id));
				if(count($checkstudent)) {
					$classesID = $checkstudent->classesID;
					$studentID = $checkstudent->studentID;
					$student = $checkstudent;
					$this->data['set'] = $id;
					$this->data["student"] = $this->student_m->get_student($studentID);
					$this->data["classes"] = $this->student_m->get_class($classesID);

					if($this->data["student"] && $this->data["classes"]) {
						$this->data["exams"] = $this->exam_m->get_exam();
						$this->data["grades"] = $this->grade_m->get_grade();
						$this->data["marks"] = $this->mark_m->get_order_by_mark(array("studentID" => $student->studentID, "classesID" => $student->classesID));
						$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);

						$this->data["subview"] = "mark/index_parent";
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
				$this->data["subview"] = "mark/search_parent";
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
			$this->data['students'] = array();
			$this->data['set_exam'] = 0;
			$this->data['set_classes'] = 0;
			$this->data['set_subject'] = 0;
			$classesID = $this->input->post("classesID");
			if($classesID != 0) {
				if($usertype == "Admin") {
					$this->data['subjects'] = $this->subject_m->get_subject_call($classesID);
				} elseif($usertype == "Teacher") {
					$username = $this->session->userdata("username");
					$teacher = $this->user_m->get_username_row("teacher", array("username" => $username));
					$this->data['subjects'] = $this->subject_m->get_order_by_subject(array("classesID" => $classesID, "teacherID" => $teacher->teacherID));
				}
			} else {
				$this->data['subjects'] = 0;
			}
			$this->data['exams'] = $this->exam_m->get_exam();
			$this->data['classes'] = $this->classes_m->get_classes();
			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data["subview"] = "mark/add";
					$this->load->view('_layout_main', $this->data);
				} else {
					$examID = $this->input->post('examID');
					$classesID = $this->input->post('classesID');
					$subjectID = $this->input->post('subjectID');
					$this->data['set_exam'] = $examID;
					$this->data['set_classes'] = $classesID;
					$this->data['set_subject'] = $subjectID;

					$exam = $this->exam_m->get_exam($examID);
					$subject = $this->subject_m->get_subject($subjectID);
					$year = date("Y");
					$students = $this->student_m->get_order_by_student(array("classesID" => $classesID));

						if(count($students)) {
							foreach ($students as $student) {
								$studentID = $student->studentID;
								$in_student = $this->mark_m->get_order_by_mark(array("examID" => $examID, "classesID" => $classesID, "subjectID" => $subjectID, "studentID" => $studentID));
								if(!count($in_student)) {
									$array = array(
										"examID" => $examID,
										"exam" => $exam->exam,
										"studentID" => $studentID,
										"classesID" => $classesID,
										"subjectID" => $subjectID,
										"subject" => $subject->subject,
										"year" => $year
									);
									$this->mark_m->insert_mark($array);
								}
							}
							$this->data['students'] = $students;
							$all_student = $this->mark_m->get_order_by_mark(array("examID" => $examID, "classesID" => $classesID, "subjectID" => $subjectID));
							$this->data['marks'] = $all_student;
						}

					$this->data["subview"] = "mark/add";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "mark/add";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	function mark_send() {
		$examID = $this->input->post("examID");
		$classesID = $this->input->post("classesID");
		$subjectID = $this->input->post("subjectID");
		$inputs = $this->input->post("inputs");
		$exploade = explode("$" , $inputs);
		$ex_array = array();
		foreach ($exploade as $key => $value) {
			if($value == "") {
				break;
			} else {
				$ar_exp = explode(":", $value);
				$ex_array[$ar_exp[0]] = $ar_exp[1];
			}
		}

		$students = $this->student_m->get_order_by_student(array("classesID" => $classesID));
		foreach ($students as $student) {
			foreach ($ex_array as $key => $mark) {
				if($key == $student->studentID) {
					$array = array("mark" => $mark);
					$this->mark_m->update_mark_classes($array, array("examID" => $examID, "classesID" => $classesID, "subjectID" => $subjectID, "studentID" => $student->studentID));
					break;
				}
			}
		}
		echo $this->lang->line('mark_success');
	}

	public function view() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Teacher") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));

			if ((int)$id && (int)$url) {
				$this->data["student"] = $this->student_m->get_student($id);
				$this->data["classes"] = $this->student_m->get_class($url);
				if($this->data["student"] && $this->data["classes"]) {
					$this->data['set'] = $url;
					$this->data["exams"] = $this->exam_m->get_exam();
					$this->data["grades"] = $this->grade_m->get_grade();
					$this->data["marks"] = $this->mark_m->get_order_by_mark_with_highest_mark($url,$id);
					$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);

					// dump($this->data["marks"]);
					// die;


					$this->data["subview"] = "mark/view";
					$this->load->view('_layout_main', $this->data);
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
			$student = "";
			if($usertype == "Student") {
				$student = $this->user_m->get_username_row("student", array("username" => $username));
			} elseif($usertype == "Parent") {
				$user = $this->user_m->get_username_row("parent", array("username" => $username));
				$student = $this->student_m->get_student($user->studentID);
			}
			$this->data["student"] = $this->student_m->get_student($student->studentID);
			$this->data["classes"] = $this->student_m->get_class($student->classesID);
			if($this->data["student"] && $this->data["classes"]) {
				$this->data["exams"] = $this->exam_m->get_exam();
				$this->data["grades"] = $this->grade_m->get_grade();
				$this->data["marks"] = $this->mark_m->get_order_by_mark(array("studentID" => $student->studentID, "classesID" => $student->classesID));

				$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
				$this->data["subview"] = "mark/view";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	function print_preview() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Teacher") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));

			if ((int)$id && (int)$url) {
				$this->data["student"] = $this->student_m->get_student($id);
				$this->data["classes"] = $this->student_m->get_class($url);
				if($this->data["student"] && $this->data["classes"]) {
					$this->data['set'] = $url;
					$this->data["exams"] = $this->exam_m->get_exam();
					$this->data["grades"] = $this->grade_m->get_grade();
					$this->data["marks"] = $this->mark_m->get_order_by_mark(array("studentID" =>$id, "classesID" => $url));
					$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);

					$this->load->library('html2pdf');
				    $this->html2pdf->folder('./assets/pdfs/');
				    $this->html2pdf->filename('Report.pdf');
				    $this->html2pdf->paper('a4', 'portrait');
				    $this->data['panel_title'] = $this->lang->line('panel_title');
					$html = $this->load->view('mark/print_preview', $this->data, true);
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
	}
	public function send_mail() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Teacher") {
			$id = $this->input->post('id');
			$url = $this->input->post('set');
			if ((int)$id && (int)$url) {
				$this->data["student"] = $this->student_m->get_student($id);
				$this->data["classes"] = $this->student_m->get_class($url);
				if($this->data["student"] && $this->data["classes"]) {

					$this->data['set'] = $url;
					$this->data["exams"] = $this->exam_m->get_exam();
					$this->data["grades"] = $this->grade_m->get_grade();
					$this->data["marks"] = $this->mark_m->get_order_by_mark(array("studentID" =>$id, "classesID" => $url));
					$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);

				    $this->load->library('html2pdf');
				    $this->html2pdf->folder('uploads/report');
				    $this->html2pdf->filename('Report.pdf');
				    $this->html2pdf->paper('a4', 'portrait');
				    $this->data['panel_title'] = $this->lang->line('panel_title');
					$html = $this->load->view('mark/print_preview', $this->data, true);
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

	function mark_list() {
		$classID = $this->input->post('id');
		if((int)$classID) {
			$string = base_url("mark/index/$classID");
			echo $string;
		} else {
			redirect(base_url("mark/index"));
		}
	}

	function student_list() {
		$studentID = $this->input->post('id');
		if((int)$studentID) {
			$string = base_url("mark/index/$studentID");
			echo $string;
		} else {
			redirect(base_url("mark/index"));
		}
	}

	function subjectcall() {
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

	function check_exam() {
		if($this->input->post('examID') == 0) {
			$this->form_validation->set_message("check_exam", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function check_classes() {
		if($this->input->post('classesID') == 0) {
			$this->form_validation->set_message("check_classes", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function check_subject() {
		if($this->input->post('subjectID') == 0) {
			$this->form_validation->set_message("check_subject", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}
}

/* End of file class.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/class.php */

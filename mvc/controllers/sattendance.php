<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sattendance extends Admin_Controller {
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
		$this->load->model("parentes_m");
		$this->load->model("sattendance_m");
		$this->load->model("teacher_m");
		$this->load->model("classes_m");
		$this->load->model("user_m");
		$this->load->model("section_m");
		$this->load->model("setting_m");
		$this->data['setting'] = $this->setting_m->get_setting(1);
		if($this->data['setting']->attendance == "subject") {
			$this->load->model("subject_m");
			$this->load->model("subjectattendance_m");
		}
		$language = $this->session->userdata('lang');
		$this->lang->load('sattendance', $language);
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'classesID',
				'label' => $this->lang->line("classes_name"),
				'rules' => 'trim|required|xss_clean|max_length[11]|callback_check_classes'
			),
			array(
				'field' => 'date',
				'label' => $this->lang->line("classes_numeric"),
				'rules' => 'trim|required|max_length[10]|xss_clean|callback_date_valid|callback_valid_future_date'
			)
		);
		return $rules;
	}

	protected function subject_rules() {
		$rules = array(
			array(
				'field' => 'classesID',
				'label' => $this->lang->line("classes_name"),
				'rules' => 'trim|required|xss_clean|max_length[11]|callback_check_classes'
			),
			array(
				'field' => 'subjectID',
				'label' => $this->lang->line("attendance_subject"),
				'rules' => 'trim|required|xss_clean|callback_check_subject'
			),
			array(
				'field' => 'date',
				'label' => $this->lang->line("classes_numeric"),
				'rules' => 'trim|required|max_length[10]|xss_clean|callback_date_valid|callback_valid_future_date'
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
				$this->data['students'] = $this->student_m->get_order_by_student(array('classesID' => $id));

				if($this->data['students']) {
					$sections = $this->section_m->get_order_by_section(array("classesID" => $id));
					$this->data['sections'] = $sections;
					foreach ($sections as $key => $section) {
						$this->data['allsection'][$section->section] = $this->student_m->get_order_by_student(array('classesID' => $id, "sectionID" => $section->sectionID));
					}
				} else {
					$this->data['students'] = NULL;
				}
				$this->data["subview"] = "sattendance/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data['classes'] = $this->student_m->get_classes();
				$this->data["subview"] = "sattendance/search";
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

			$this->data['set'] = 0;
			$this->data['date'] = date("d-m-Y");
			$this->data['day'] = 0;
			$this->data['monthyear'] = 0;
			$username = $this->session->userdata("username");
			$this->data['classes'] = $this->classes_m->get_classes();
			$this->data['students'] = array();
			$classesID = $this->input->post("classesID");

			if($classesID != 0 && $this->data['setting']->attendance == "subject") {
				$this->data['subjects'] = $this->subject_m->get_order_by_subject(array("classesID" => $classesID));
			} else {
				$this->data['subjects'] = "empty";
			}

			$this->data['subjectID'] = 0;

			if($_POST) {

				if($this->data['setting']->attendance == "subject") {
					$rules = $this->subject_rules();
				} else {
					$rules = $this->rules();
				}

				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data["subview"] = "sattendance/add";
					$this->load->view('_layout_main', $this->data);
				} else {
					$classesID = $this->input->post("classesID");

					if($this->data['setting']->attendance == "subject") {
						$subjectID = $this->input->post("subjectID");
						$this->data['subjectID'] = $subjectID;

					}

					$date = $this->input->post("date");
					$this->data['set'] = $classesID;
					$this->data['date'] = $date;
					$explode_date = explode("-", $date);
					$monthyear = $explode_date[1]."-".$explode_date[2];
					$userID = "";

					$last_day = cal_days_in_month(CAL_GREGORIAN, $explode_date[1], $explode_date[2]);
					if($last_day >= $explode_date[1]) {

						if($usertype == "Admin") {
							$user = $this->user_m->get_username_row("systemadmin", array("username" => $username));
							$userID = $user->systemadminID;
						} elseif($usertype == "Teacher") {
							$user = $this->user_m->get_username_row("teacher", array("username" => $username));
							$userID = $user->teacherID;
						}
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
								if($this->data['setting']->attendance == "subject") {
									$attendance_monthyear = $this->subjectattendance_m->get_order_by_sub_attendance(array("studentID" => $studentID, "classesID" => $classesID, "subjectID" => $subjectID, "monthyear" => $monthyear));
								} else {
									$attendance_monthyear = $this->sattendance_m->get_order_by_attendance(array("studentID" => $studentID, "classesID" => $classesID, "monthyear" => $monthyear));
								}

								if(!count($attendance_monthyear)) {
									if($this->data['setting']->attendance == "subject") {
										$array = array(
											"studentID" => $studentID,
											"classesID" => $classesID,
											"subjectID" => $subjectID,
											"userID" => $userID,
											"usertype" => $usertype,
											"monthyear" => $monthyear
										);
										$this->subjectattendance_m->insert_sub_attendance($array);
									} else {
										$array = array(
											"studentID" => $studentID,
											"classesID" => $classesID,
											"userID" => $userID,
											"usertype" => $usertype,
											"monthyear" => $monthyear
										);
										$this->sattendance_m->insert_attendance($array);
									}
								}
							}
							if($this->data['setting']->attendance == "subject") {
								$this->data['attendances'] = $this->subjectattendance_m->get_sub_attendance();
							} else {
								$this->data['attendances'] = $this->sattendance_m->get_attendance();
							}
							$this->data['monthyear'] = $monthyear;
							$this->data['day'] = $explode_date[0];
						}
						$this->data["subview"] = "sattendance/add";
						$this->load->view('_layout_main', $this->data);
					} else {
						$this->data["subview"] = "error";
						$this->load->view('_layout_main', $this->data);
					}
				}
			} else {
				$this->data["subview"] = "sattendance/add";
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
			$string = base_url("sattendance/index/$classID");
			echo $string;
		} else {
			redirect(base_url("sattendance/index"));
		}
	}

	function singl_add() {
		$id = $this->input->post('id');
		$day = $this->input->post('day');
		if((int)$id && (int)$day) {
			$aday = "a".abs($day);

			if($this->data['setting']->attendance == "subject") {
				$attendance_row = $this->subjectattendance_m->get_sub_attendance($id);
				if($attendance_row) {
					if($attendance_row->$aday == "") {
						$this->subjectattendance_m->update_sub_attendance(array($aday => "P"), $id);
						echo $this->lang->line('menu_success');
					} elseif($attendance_row->$aday == "P") {
						$this->subjectattendance_m->update_sub_attendance(array($aday => "A"), $id);
						echo $this->lang->line('menu_success');
					} elseif($attendance_row->$aday == "A") {
						$this->subjectattendance_m->update_sub_attendance(array($aday => "P"), $id);
						echo $this->lang->line('menu_success');
					}
				}
			} else {
				$attendance_row = $this->sattendance_m->get_attendance($id);
				if($attendance_row) {
					if($attendance_row->$aday == "") {
						$this->sattendance_m->update_attendance(array($aday => "P"), $id);
						echo $this->lang->line('menu_success');
					} elseif($attendance_row->$aday == "P") {
						$this->sattendance_m->update_attendance(array($aday => "A"), $id);
						echo $this->lang->line('menu_success');
					} elseif($attendance_row->$aday == "A") {
						$this->sattendance_m->update_attendance(array($aday => "P"), $id);
						echo $this->lang->line('menu_success');
					}
				}
			}

		}
	}

	function all_add() {
		$classes = $this->input->post('classes');
		$day = $this->input->post('day');
		$monthyear = $this->input->post('monthyear');
		$status = 0;
		$status = $this->input->post('status');

		if($status == "checked") {
			$status = "P";
		} elseif($status == "unchecked") {
			$status = "A";
		}
		if((int)$classes) {
			$array = array("a".abs($day) => $status);
			if($this->data['setting']->attendance == "subject") {
				$subjectID = $this->input->post('subject');
				$this->subjectattendance_m->update_sub_attendance_classes($array, array("classesID" => $classes, "subjectID" => $subjectID, "monthyear" => $monthyear));
			} else {
				$this->sattendance_m->update_attendance_classes($array, array("classesID" => $classes, "monthyear" => $monthyear));
			}
			echo $this->lang->line('menu_success');
		}
	}

	public function view() {
		$usertype = $this->session->userdata("usertype");
		$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));

		if($this->data['setting']->attendance == "subject") {
			$this->data["subjects"] = $this->subject_m->get_order_by_subject(array("classesID" => $url));
		}

		if($usertype == "Admin" || $usertype == "Teacher") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));

			if ((int)$id && (int)$url) {
				$this->data["student"] = $this->student_m->get_student($id);
				$this->data["classes"] = $this->student_m->get_class($url);
				if($this->data["student"] && $this->data["classes"]) {
					$this->data['set'] = $url;

					if($this->data['setting']->attendance == "subject") {
						$this->data['attendances'] = $this->subjectattendance_m->get_order_by_sub_attendance(array("studentID" => $id, "classesID" => $url));
					} else {
						$this->data['attendances'] = $this->sattendance_m->get_order_by_attendance(array("studentID" => $id, "classesID" => $url));
					}

					$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
					$this->data["subview"] = "sattendance/view";
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
			$student = $this->student_m->get_single_student(array("username" => $username));
			if($student) {
				$this->data["student"] = $student;
				$this->data['classes'] = $this->classes_m->get_classes($student->classesID);

				if($this->data['setting']->attendance == "subject") {
					$this->data['attendances'] = $this->subjectattendance_m->get_order_by_sub_attendance(array("studentID" => $student->studentID, "classesID" => $student->classesID));
				} else {
					$this->data['attendances'] = $this->sattendance_m->get_order_by_attendance(array("studentID" => $student->studentID, "classesID" => $student->classesID));
				}

				$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
				$this->data["subview"] = "sattendance/view";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} elseif($usertype == "Parent") {
			$username = $this->session->userdata("username");
			$parent = $this->parentes_m->get_single_parentes(array('username' => $username));
			$this->data['allstudents'] = $this->student_m->get_order_by_student(array('parentID' => $parent->parentID));
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$checkstudent = $this->student_m->get_single_student(array('studentID' => $id));
				if(count($checkstudent)) {
					$classesID = $checkstudent->classesID;
					$this->data['set'] = $id;
					$this->data["student"] = $checkstudent;
					$this->data['classes'] = $this->classes_m->get_classes($classesID);

					if($this->data['setting']->attendance == "subject") {
						$this->data['attendances'] = $this->subjectattendance_m->get_order_by_sub_attendance(array("studentID" => $id, "classesID" => $classesID));
					} else {
						$this->data['attendances'] = $this->sattendance_m->get_order_by_attendance(array("studentID" => $id, "classesID" => $classesID));
					}

					$this->data["section"] = $this->section_m->get_section($checkstudent->sectionID);

					$this->data["subview"] = "sattendance/index_parent";
					$this->load->view('_layout_main', $this->data);
				} else {
					$this->data["subview"] = "error";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "sattendance/search_parent";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function pstudent_list() {
		$studentID = $this->input->post('id');
		if((int)$studentID) {
			$string = base_url("sattendance/view/$studentID");
			echo $string;
		} else {
			redirect(base_url("sattendance/view"));
		}
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

	public function print_preview() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Teacher") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));

			if ((int)$id && (int)$url) {
				$this->data["student"] = $this->student_m->get_student($id);
				$this->data["class"] = $this->student_m->get_class($url);
				if($this->data["student"] && $this->data["class"]) {
					$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
				    $this->load->library('html2pdf');
				    $this->html2pdf->folder('./assets/pdfs/');
				    $this->html2pdf->filename('Report.pdf');
				    $this->html2pdf->paper('a4', 'landscape');
				    $this->data['panel_title'] = $this->lang->line('panel_title');
					$this->data['attendances'] = $this->sattendance_m->get_order_by_attendance(array("studentID" => $id, "classesID" => $url));
					$html = $this->load->view('sattendance/print_preview', $this->data, true);
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
				$this->data["class"] = $this->student_m->get_class($url);
				if($this->data["student"] && $this->data["class"]) {

					$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
					$this->load->library('html2pdf');
				    $this->html2pdf->folder('uploads/report');
				    $this->html2pdf->filename('Report.pdf');
				    $this->html2pdf->paper('a4', 'landscape');
				    $this->data['panel_title'] = $this->lang->line('panel_title');
					$this->data['attendances'] = $this->sattendance_m->get_order_by_attendance(array("studentID" => $id, "classesID" => $url));
					$html = $this->load->view('sattendance/print_preview', $this->data, true);
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

	function valid_future_date($date) {
		$presentdate = date('Y-m-d');
		$date = date("Y-m-d", strtotime($date));
		if($date > $presentdate) {
			// $this->session->set_flashdata('error', 'Date must be less or equel then from present date');
			return FALSE;
		}
		return TRUE;
	}

	public function subjectall() {
		$usertype = $this->session->userdata("usertype");
		$id = $this->input->post('id');
		if((int)$id) {
			if($usertype == "Admin") {
				$allsubject = $this->subject_m->get_order_by_subject(array("classesID" => $id));
				echo "<option value='0'>", $this->lang->line("attendance_select_subject"),"</option>";
				foreach ($allsubject as $value) {
					echo "<option value=\"$value->subjectID\">",$value->subject,"</option>";
				}
			} elseif($usertype == "Teacher") {
				$username = $this->session->userdata("username");
				$teacher = $this->user_m->get_username_row("teacher", array("username" => $username));
				$allsubject = $this->subject_m->get_order_by_subject(array("classesID" => $id, "teacherID" => $teacher->teacherID));
				echo "<option value='0'>", $this->lang->line("attendance_select_subject"),"</option>";
				foreach ($allsubject as $value) {
					echo "<option value=\"$value->subjectID\">",$value->subject,"</option>";
				}
			}
		}
	}
}

/* End of file class.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/sattendance.php */

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leave extends Admin_Controller {
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
    $this->load->model("teacher_m");
    $this->load->model("student_m");
    $this->load->model("parentes_m");
    $this->load->model("user_m");
		$this->load->model("tattendance_m");
		$this->load->model("sattendance_m");
		$this->load->model("classes_m");
		$this->load->model("section_m");
    $this->load->model("site_m");
    $this->load->model("siteusers_m");
    $this->load->model("leaveapp_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('leave', $language);
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		$username = $this->session->userdata("username");
		if($usertype == "Admin") {
			$this->data['leaves'] = $this->leaveapp_m->join_submit_leave($username);
			$this->data["subview"] = "leave/submitapp";
			$this->load->view('_layout_main', $this->data);
		} else {
			if($usertype == "Parent") {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}	elseif($usertype == "Student") {
				$this->data['leaves'] = $this->leaveapp_m->join_my_leave($username,'teacher');
				$this->data["subview"] = "leave/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data['leaves'] = $this->leaveapp_m->join_my_leave($username,'systemadmin');
				$this->data["subview"] = "leave/index";
				$this->load->view('_layout_main', $this->data);
			}
		}
	}

	public function submitleaveapp() {
		$usertype = $this->session->userdata("usertype");
		$username = $this->session->userdata("username");
		if($usertype == "Admin" || $usertype == "Teacher") {

			$this->data['leaves'] = $this->leaveapp_m->join_submit_leave($username);
			$this->data["subview"] = "leave/submitapp";
			$this->load->view('_layout_main', $this->data);

		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	protected function rules() {
		$rules = array(
				 array(
					'field' => 'to',
					'label' => $this->lang->line("to"),
					'rules' => 'trim|required|xss_clean|callback_check_to'
				),
				array(
					'field' => 'title',
					'label' => $this->lang->line("leave_title"),
					'rules' => 'trim|required|max_length[50]|xss_clean'
				),
				array(
					'field' => 'fdate',
					'label' => $this->lang->line("leave_fdate"),
					'rules' => 'trim|required|max_length[10]|xss_clean|callback_date_valid'
				),
				array(
					'field' => 'tdate',
					'label' => $this->lang->line("leave_tdate"),
					'rules' => 'trim|required|max_length[10]|xss_clean|callback_todate_valid'
				),
				array(
					'field' => 'details',
					'label' => $this->lang->line("leave_details"),
					'rules' => 'trim|required|xss_clean'
				)
			);
		return $rules;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
    $this->data['usertype'] = $usertype;
    if($usertype == "Student") {
      $this->data['users'] = $this->teacher_m->get_order_by_teacher();
    } else {
      $this->data['users'] = $this->siteusers_m->get_site();
    }

		if($usertype != "Admin" && $usertype !="Parent") {
			if($_POST) {
				$rules = $this->rules();
				$this->data['set'] = $this->input->post("to");
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data['form_validation'] = validation_errors();
					$this->data["subview"] = "leave/add";
					$this->load->view('_layout_main', $this->data);
				} else {
					$array = array(
						"title" => $this->input->post("title"),
						"details" => $this->input->post("details"),
						"fdate" => date("Y-m-d", strtotime($this->input->post("fdate"))),
						"tdate" => date("Y-m-d", strtotime($this->input->post("tdate"))),
						"tousername" => $this->input->post("to"),
            "fromusername" => $this->session->userdata('username')
					);
					$this->leaveapp_m->insert_leave($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("leave/index"));
				}
			} else {
				$this->data["subview"] = "leave/add";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function view() {
		$this->data['option'] = 0;
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$this->data['have'] = $this->leaveapp_m->get_leave($id);
			if($this->data['have']) {
					$usertype = $this->session->userdata("usertype");
					$username = $this->session->userdata("username");
					if($usertype == "Student") {
						$this->data['leave'] = $this->leaveapp_m->join_my_leave($username,'teacher',$id);
					} else {
						$this->data['admin_view'] = 1;
						$this->data['leave'] = $this->leaveapp_m->join_my_leave($username,'systemadmin',$id);
					}

					if($this->data['leave'])
						$this->data["subview"] = "leave/view";
					else
						$this->data["subview"] = "error";
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

	public function submitview() {
		$this->data['option'] = 1;
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$this->data['have'] = $this->leaveapp_m->get_leave($id);
			if($this->data['have']) {
					$usertype = $this->session->userdata("usertype");
					$username = $this->session->userdata("username");
					if($usertype == "Admin" || $usertype == "Teacher") {
						$this->data['leave'] = $this->leaveapp_m->join_submit_leave($username,$id);
					}

					if($this->data['leave'])
						$this->data["subview"] = "leave/view";
					else
						$this->data["subview"] = "error";

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

	public function edit() {
		$usertype = $this->session->userdata("usertype");
		$username = $this->session->userdata("username");
		$this->data['usertype'] = $usertype;
		if($usertype == "Student") {
      $this->data['users'] = $this->teacher_m->get_order_by_teacher();
    } else {
      $this->data['users'] = $this->siteusers_m->get_site();
    }

		if($usertype != "Admin" && $usertype != "Parent") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['leave'] = $this->leaveapp_m->get_leave($id);
				if($this->data['leave'] && $this->data['leave']->status != "1" && $this->data['leave']->fromusername == $username) {
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "leave/edit";
							$this->load->view('_layout_main', $this->data);
						} else {
							$array = array(
								"title" => $this->input->post("title"),
								"details" => $this->input->post("details"),
								"fdate" => date("Y-m-d", strtotime($this->input->post("fdate"))),
								"tdate" => date("Y-m-d", strtotime($this->input->post("tdate"))),
								"status" => 0,
								"tousername" => $this->input->post("to"),
		            "fromusername" => $this->session->userdata('username')
							);

							$this->leaveapp_m->update_leave($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("leave/index"));
						}
					} else {
						$this->data["subview"] = "leave/edit";
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
		$username = $this->session->userdata("username");
		if($usertype != "Admin" && $usertype != "Parent") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['leave'] = $this->leaveapp_m->get_leave($id);
				if($this->data['leave'] && $this->data['leave']->fromusername == $username) {
					$this->leaveapp_m->delete_leave($id);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("leave/index"));
				} else {
					$this->data["subview"] = "error";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				redirect(base_url("leave/index"));
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function print_preview() {
		$this->data['option'] = 1;
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		$usertype = $this->session->userdata("usertype");
		$username = $this->session->userdata("username");
		if((int)$id) {
			if($usertype == "Admin" || $usertype == "Teacher") {
				$this->data['leave'] = $this->leaveapp_m->join_submit_leave($username,$id);
			}
			if($this->data['leave']) {
				$this->load->library('html2pdf');
		    $this->html2pdf->folder('./assets/pdfs/');
		    $this->html2pdf->filename('Report.pdf');
		    $this->html2pdf->paper('a4', 'portrait');
		    $this->data['panel_title'] = $this->lang->line('panel_title');
				$html = $this->load->view('leave/print_preview', $this->data, true);
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
	}

	public function send_mail() {
		$this->data['option'] = 1;
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		$usertype = $this->session->userdata("usertype");
		$username = $this->session->userdata("username");
		if($usertype != "Parent") {
			$id = $this->input->post('id');
			if ((int)$id) {
				if($usertype == "Admin" || $usertype == "Teacher") {
					$this->data['leave'] = $this->leaveapp_m->join_submit_leave($username,$id);
				}
				if($this->data['leave']) {
					$this->load->library('html2pdf');
			    $this->html2pdf->folder('uploads/report');
			    $this->html2pdf->filename('Report.pdf');
			    $this->html2pdf->paper('a4', 'portrait');
			    $this->data['panel_title'] = $this->lang->line('panel_title');
					$html = $this->load->view('leave/print_preview', $this->data, true);
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

  function check_to() {
		if($this->input->post('to') == "0") {
			$this->form_validation->set_message("check_to", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	private function create_attendance_table($date,$value,$tbl) {
		$usertype = $this->session->userdata("usertype");
		$username = $this->session->userdata("username");

		$explode_date = explode("-", $date);
		$monthyear = $explode_date[1]."-".$explode_date[2];

		$last_day = cal_days_in_month(CAL_GREGORIAN, $explode_date[1], $explode_date[2]);
			if($last_day >= $explode_date[1]) {
				if($tbl=='teacher') {

					if(isset($value)) {
							$teacherID = $value->teacherID;
							$attendance_monthyear = $this->tattendance_m->get_order_by_tattendance(array("teacherID" => $teacherID, "monthyear" => $monthyear));
							if(!count($attendance_monthyear)) {
								$array = array(
									"teacherID" => $teacherID,
									"usertype" => $value->usertype,
									"monthyear" => $monthyear
								);
								$this->tattendance_m->insert_tattendance($array);
							}
					}
				} elseif($tbl=='student') {
					$classesID = $value->classesID;
					$userID = "";

						if($usertype == "Admin") {
							$user = $this->user_m->get_username_row("systemadmin", array("username" => $username));
							$userID = $user->systemadminID;
						} elseif($usertype == "Teacher") {
							$user = $this->user_m->get_username_row("teacher", array("username" => $username));
							$userID = $user->teacherID;
						}

						if(isset($value)) {
								$studentID = $value->studentID;
								$attendance_monthyear = $this->sattendance_m->get_order_by_attendance(array("studentID" => $studentID, "classesID" => $classesID, "monthyear" => $monthyear));
								if(!count($attendance_monthyear)) {
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
			}
	}

	private function single_add_attendance($day,$value,$tbl,$set) {

		$explode_date = explode("-", $day);
		$monthyear = $explode_date[1]."-".$explode_date[2];

		if((int)$day) {
			$aday = "a".abs($day);
			if($tbl=='teacher') {
				$attendance_row = $this->tattendance_m->get_order_by_tattendance(array("monthyear" => $monthyear , "teacherID" => $value->teacherID));
				if($attendance_row) {
					$attendance_row = $attendance_row[0];
					if($attendance_row->$aday == "" || $attendance_row->$aday == "A" || $attendance_row->$aday == "L") {
						$this->tattendance_m->update_tattendance(array($aday => $set), $attendance_row->tattendanceID);
					}
				}
			} elseif($tbl=='student') {
				$attendance_row = $this->sattendance_m->get_order_by_attendance(array("monthyear" => $monthyear , "studentID" => $value->studentID , "classesID" => $value->classesID));
				if($attendance_row) {
					$attendance_row = $attendance_row[0];
					if($attendance_row->$aday == "" || $attendance_row->$aday == "A" || $attendance_row->$aday == "L") {
						$this->sattendance_m->update_attendance(array($aday => $set), $attendance_row->attendanceID);
					}
				}
			}
		}
	}

	private function update_attendance($fdate,$tdate,$tbl,$value,$set)
	{
		while (strtotime($fdate) <= strtotime($tdate)) {
			$this->single_add_attendance($fdate,$value,$tbl,$set);
			$fdate = date("d-m-Y", strtotime("+1 day", strtotime($fdate)));
		}
	}

	private function route_data($data,$set)
	{
		$fdate = date("d-m-Y",strtotime($data->fdate));
		$tdate = date("d-m-Y",strtotime($data->tdate));
		$fromusername = $data->fromusername;

		$teacher = $this->teacher_m->get_single_teacher(array("username" => $fromusername));
		$student = $this->student_m->get_single_student(array("username" => $fromusername));

		if($student!=null) {
			$this->create_attendance_table($fdate,$student,'student');
			$this->create_attendance_table($tdate,$student,'student');

			$this->update_attendance($fdate,$tdate,'student',$student,$set);

		} elseif($teacher!=null) {
			$this->create_attendance_table($fdate,$teacher,'teacher');
			$this->create_attendance_table($tdate,$teacher,'teacher');

			$this->update_attendance($fdate,$tdate,'teacher',$teacher,$set);
		}
	}

	function accept() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$usertype = $this->session->userdata("usertype");
			$username = $this->session->userdata("username");
			if($usertype=='Admin' || $usertype=='Teacher') {
				$this->data['leave'] = $this->leaveapp_m->get_leave($id);
				if($this->data['leave']) {
					$array = array(
            "status" => 1
					);
					$this->leaveapp_m->update_leave($array, $id);

					$this->route_data($this->data['leave'],"L");

					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("leave/submitleaveapp/"));
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

	function denied() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$usertype = $this->session->userdata("usertype");
			$username = $this->session->userdata("username");
			if($usertype=='Admin' || $usertype=='Teacher') {
				$this->data['leave'] = $this->leaveapp_m->get_leave($id);
				if($this->data['leave']) {
					$array = array(
            "status" => 2
					);
					$this->leaveapp_m->update_leave($array, $id);

					$this->route_data($this->data['leave'],NULL);


					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("leave/submitleaveapp/"));
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

	function all_accept() {
		$usertype = $this->session->userdata("usertype");
		$username = $this->session->userdata("username");
		if($usertype == 'Admin' || $usertype== 'Teacher') {
			$result = $this->leaveapp_m->all_accept_or_denied($username,1);
			if($result > 0) {
				$alldata = $this->leaveapp_m->get_order_by_leave(array("tousername" => $username));
				foreach ($alldata as $data) {
					$this->route_data($data,"L");
				}
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('leave_all_error'));
			}
			redirect(base_url("leave/submitleaveapp/"));
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	function all_denied() {
		$usertype = $this->session->userdata("usertype");
		$username = $this->session->userdata("username");
		if($usertype == 'Admin' || $usertype== 'Teacher') {
			$result = $this->leaveapp_m->all_accept_or_denied($username,2);
			if($result > 0) {
				$alldata = $this->leaveapp_m->get_order_by_leave(array("tousername" => $username));
				foreach ($alldata as $data) {
					$this->route_data($data,NULL);
				}
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
			} else {
				$this->session->set_flashdata('error', $this->lang->line('leave_all_error'));
			}
			redirect(base_url("leave/submitleaveapp/"));

		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
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

	function todate_valid($date) {
		$fdate = $this->input->post('fdate');
		if(strlen($date) <10) {
			$this->form_validation->set_message("todate_valid", "%s is not valid dd-mm-yyyy");
	     	return FALSE;
		} else {
	   		$arr = explode("-", $date);
	        $dd = $arr[0];
	        $mm = $arr[1];
	        $yyyy = $arr[2];
	      	if(checkdate($mm, $dd, $yyyy)) {
						if($fdate>$date) {
							$this->form_validation->set_message("todate_valid", "%s must be greater than From Leave Date");
		     			return FALSE;
						} else {
							return TRUE;
						}
	      	} else {
	      		$this->form_validation->set_message("todate_valid", "%s is not valid dd-mm-yyyy");
	     			return FALSE;
	      	}
	    }
	}
}


/* End of file leave.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/leave.php */

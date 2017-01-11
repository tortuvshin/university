<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tattendance extends Admin_Controller {
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
		$this->load->model("tattendance_m");
		$this->load->model("teacher_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('tattendance', $language);	
	}

	protected function rules() {
		$rules = array(
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
		if($usertype == "Admin") {
			$this->data['teachers'] = $this->teacher_m->get_teacher();
			$this->data["subview"] = "tattendance/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {

			$this->data['date'] = date("d-m-Y");

			$this->data['teachers'] = array();
			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) { 
					$this->data["subview"] = "tattendance/add";
					$this->load->view('_layout_main', $this->data);			
				} else {

					$date = $this->input->post("date");
					$this->data['date'] = $date;
					$explode_date = explode("-", $date);
					$monthyear = $explode_date[1]."-".$explode_date[2];

					$last_day = cal_days_in_month(CAL_GREGORIAN, $explode_date[1], $explode_date[2]);
					if($last_day >= $explode_date[1]) {

						$teachers = $this->teacher_m->get_teacher();
						if(count($teachers)) {
							foreach ($teachers as $teacher) {
								$teacherID = $teacher->teacherID;
								$attendance_monthyear = $this->tattendance_m->get_order_by_tattendance(array("teacherID" => $teacherID, "monthyear" => $monthyear));
								if(!count($attendance_monthyear)) {
									$array = array(
										"teacherID" => $teacherID,
										"usertype" => $teacher->usertype,
										"monthyear" => $monthyear
									);
									$this->tattendance_m->insert_tattendance($array);
								}
							}
							$this->data['teachers'] = $teachers;
							$this->data['tattendances'] = $this->tattendance_m->get_tattendance();
							$this->data['monthyear'] = $monthyear;
							$this->data['day'] = $explode_date[0];
						}
						$this->data["subview"] = "tattendance/add";
						$this->load->view('_layout_main', $this->data);
					} else {
						$this->data["subview"] = "error";
						$this->load->view('_layout_main', $this->data);
					}
				}
			} else {
				$this->data["subview"] = "tattendance/add";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	function singl_add() {
		$id = $this->input->post('id');
		$day = $this->input->post('day');
		if((int)$id && (int)$day) {
			$tattendance_row = $this->tattendance_m->get_tattendance($id);
			$aday = "a".abs($day);
			if($tattendance_row) {
				if($tattendance_row->$aday == "") {
					$this->tattendance_m->update_tattendance(array($aday => "P"), $id);
					echo $this->lang->line('menu_success');
				} elseif($tattendance_row->$aday == "P") {
					$this->tattendance_m->update_tattendance(array($aday => "A"), $id);
					echo $this->lang->line('menu_success');
				} elseif($tattendance_row->$aday == "A") {
					$this->tattendance_m->update_tattendance(array($aday => "P"), $id);
					echo $this->lang->line('menu_success');
				}
			}
		}
	}

	function all_add() {
		$day = $this->input->post('day');
		$monthyear = $this->input->post('monthyear');
		$status = 0;
		$status = $this->input->post('status');
		
		if($status == "checked") {
			$status = "P";
		} elseif($status == "unchecked") {
			$status = "A";
		}
		if((int)$day) {
			$array = array("a".abs($day) => $status);
			$this->tattendance_m->update_tattendance_all($array, array("monthyear" => $monthyear));
			echo $this->lang->line('menu_success');
		}
	}

	public function view() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if ((int)$id) {
				$this->data["teacher"] = $this->teacher_m->get_teacher($id);
				if($this->data["teacher"]) {
					$this->data['attendances'] = $this->tattendance_m->get_order_by_tattendance(array("teacherID" => $id));
					$this->data["subview"] = "tattendance/view";
					$this->load->view('_layout_main', $this->data);
				} else {
					$this->data["subview"] = "error";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} elseif($usertype == "Teacher") {
			$username = $this->session->userdata("username");
			$teacher = $this->teacher_m->get_single_teacher(array("username" => $username));
			if($teacher) {
				$this->data["teacher"] = $teacher;
				$this->data['attendances'] = $this->tattendance_m->get_order_by_tattendance(array("teacherID" => $teacher->teacherID));
				$this->data["subview"] = "tattendance/view";
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
		if($usertype == "Admin") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));			
			if ((int)$id) {
				$this->data["teacher"] = $this->teacher_m->get_teacher($id);
				if($this->data["teacher"]) {
				    $this->load->library('html2pdf');
				    $this->html2pdf->folder('./assets/pdfs/');
				    $this->html2pdf->filename('Report.pdf');
				    $this->html2pdf->paper('a4', 'landscape');
				    $this->data['panel_title'] = $this->lang->line('panel_title');
					$this->data['attendances'] = $this->tattendance_m->get_order_by_tattendance(array("teacherID" => $id));
					$html = $this->load->view('tattendance/print_preview', $this->data, true);
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
		if($usertype == "Admin") {
			$id = $this->input->post('id');
			if ((int)$id) {
				$this->data["teacher"] = $this->teacher_m->get_teacher($id);
				if($this->data["teacher"]) {
					$this->load->library('html2pdf');
				    $this->html2pdf->folder('uploads/report');
				    $this->html2pdf->filename('Report.pdf');
				    $this->html2pdf->paper('a4', 'landscape');
				    $this->data['panel_title'] = $this->lang->line('panel_title');
					$this->data['attendances'] = $this->tattendance_m->get_order_by_tattendance(array("teacherID" => $id));
					$html = $this->load->view('tattendance/print_preview', $this->data, true);
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
			return FALSE;
		}
		return TRUE;
	}
}

/* End of file class.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/class.php */
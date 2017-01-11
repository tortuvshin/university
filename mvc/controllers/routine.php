<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Routine extends Admin_Controller {
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
		$this->load->model("routine_m");
		$this->load->model("classes_m");
		$this->load->model("student_info_m");
		$this->load->model("parentes_info_m");
		$this->load->model("section_m");
		$this->load->model("subject_m");
		$this->load->model('parentes_m');
		$this->load->model('student_m');
		$language = $this->session->userdata('lang');
		$this->lang->load('routine', $language);
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Teacher") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['set'] = $id;
				$this->data['classes'] = $this->routine_m->get_classes();
				$this->data['routines'] = $this->routine_m->get_join_all($id);

				if($this->data['routines']) {
					$sections = $this->section_m->get_order_by_section(array("classesID" => $id));
					$this->data['sections'] = $sections;
					foreach ($sections as $key => $section) {
						$this->data['allsection'][$section->section] = $this->routine_m->get_join_all_wsection($id, $section->sectionID);
					}
				} else {
					$this->data['routines'] = NULL;
				}

				$this->data["subview"] = "routine/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data['classes'] = $this->routine_m->get_classes();
				$this->data["subview"] = "routine/search";
				$this->load->view('_layout_main', $this->data);
			}
		} elseif($usertype == "Student") {
			$student = 	$this->student_info_m->get_student_info();
			$this->data['routines'] = $this->routine_m->get_join_all_wsection($student->classesID, $student->sectionID);
			$this->data["subview"] = "routine/index";
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
					$sectionID = $checkstudent->sectionID;
					$this->data['set'] = $id;
					$this->data['routines'] = $this->routine_m->get_join_all_wsection($classesID, $sectionID);
					$this->data["subview"] = "routine/index_parent";
					$this->load->view('_layout_main', $this->data);
				} else {
					$this->data["subview"] = "error";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "routine/search_parent";
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
					'field' => 'classesID', 
					'label' => $this->lang->line("routine_classes"), 
					'rules' => 'trim|required|xss_clean|numeric|max_length[11]|callback_allclasses'
				),
				array(
					'field' => 'sectionID', 
					'label' => $this->lang->line("routine_section"), 
					'rules' => 'trim|required|xss_clean|numeric|max_length[11]|callback_allsection'
				),
				array(
					'field' => 'subjectID', 
					'label' => $this->lang->line("routine_subject"), 
					'rules' => 'trim|required|xss_clean|numeric|max_length[11]|callback_allsubject'
				),
				array(
					'field' => 'day',
					'label' => $this->lang->line("routine_day"), 
					'rules' => 'trim|required|xss_clean|max_length[60]'
				),
				array(
					'field' => 'start_time', 
					'label' => $this->lang->line("routine_start_time"), 
					'rules' => 'trim|required|xss_clean|max_length[10]'
				),
				array(
					'field' => 'end_time', 
					'label' => $this->lang->line("routine_end_time"), 
					'rules' => 'trim|required|xss_clean|max_length[10]'
				),
				array(
					'field' => 'room', 
					'label' => $this->lang->line("routine_room"), 
					'rules' => 'trim|required|xss_clean|max_length[11]|callback_unique_room'
				)
			);
		return $rules;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$this->data['classes'] = $this->classes_m->get_classes();
			$classesID = $this->input->post("classesID");
			
			if($classesID != 0) {
				$this->data['subjects'] = $this->subject_m->get_order_by_subject(array('classesID' =>$classesID));
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
					$this->data['form_validation'] = validation_errors(); 
					$this->data["subview"] = "routine/add";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$array = array(
						"classesID" => $this->input->post("classesID"),
						"sectionID" => $this->input->post("sectionID"),
						"subjectID" => $this->input->post("subjectID"),
						"day" => $this->input->post("day"),
						"start_time" => $this->input->post("start_time"),
						"end_time" => $this->input->post("end_time"),
						"room" => $this->input->post("room")
					);
					$this->routine_m->insert_routine($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("routine/index"));
				}
			} else {
				$this->data["subview"] = "routine/add";
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
				$this->data['routine'] = $this->routine_m->get_routine($id);
				if($this->data['routine']) {
					$classID = $this->data['routine']->classesID;
					$this->data['sections'] = $this->section_m->get_order_by_section(array("classesID" => $classID));
					$this->data['subjects'] = $this->routine_m->get_subject($classID);
					$this->data['classes'] = $this->routine_m->get_classes();
					$this->data['set'] = $url;
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "routine/edit";
							$this->load->view('_layout_main', $this->data);			
						} else {
							$array = array(
								"classesID" => $this->input->post("classesID"),
								"sectionID" => $this->input->post("sectionID"),
								"subjectID" => $this->input->post("subjectID"),
								"day" => $this->input->post("day"),
								"start_time" => $this->input->post("start_time"),
								"end_time" => $this->input->post("end_time"),
								"room" => $this->input->post("room")
							);

							$this->routine_m->update_routine($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("routine/index/$url"));
						}
					} else {
						$this->data["subview"] = "routine/edit";
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
				$this->routine_m->delete_routine($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("routine/index/$classes"));
			} else {
				redirect(base_url("routine/index"));
			}	
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function routine_list() {
		$classID = $this->input->post('id');
		if((int)$classID) {
			$string = base_url("routine/index/$classID");
			echo $string;
		} else {
			redirect(base_url("routine/index"));
		}
	}

	public function student_list() {
		$studentID = $this->input->post('id');
		if((int)$studentID) {
			$string = base_url("routine/index/$studentID");
			echo $string;
		} else {
			redirect(base_url("routine/index"));
		}
	}

	function allsubject() {
		if($this->input->post('subjectID') == 0) {
			$this->form_validation->set_message("allsubject", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function allsection() {
		if($this->input->post('sectionID') == 0) {
			$this->form_validation->set_message("allsection", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	function subjectcall() {
		$classID = $this->input->post('id');

		if((int)$classID) {
			$allclasses = $this->routine_m->get_subject($classID);
			echo "<option value='0'>", $this->lang->line("routine_subject_select"),"</option>";
			foreach ($allclasses as $value) {
				echo "<option value=\"$value->subjectID\">",$value->subject,"</option>";
			}
		} 
	}

	function sectioncall() {
		$classID = $this->input->post('id');

		if((int)$classID) {
			$allsection = $this->section_m->get_order_by_section(array('classesID' => $classID));
			echo "<option value='0'>", $this->lang->line("routine_select_section"),"</option>";
			foreach ($allsection as $value) {
				echo "<option value=\"$value->sectionID\">",$value->section,"</option>";
			}
		} 
	}

	function unique_room() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$routine = $this->routine_m->get_order_by_routine(array('classesID' => $this->input->post('classesID'), 'day' => $this->input->post('day'), 'start_time' => $this->input->post('start_time'), 'end_time' => $this->input->post('end_time'), 'room' => $this->input->post('room'), 'routineID !=' => $id ));
			if(count($routine)) {
				$this->form_validation->set_message("unique_room", "%s already exists");
				return FALSE;
			}
			return TRUE;

		} else {
			$routine = $this->routine_m->get_order_by_routine(array('classesID' => $this->input->post('classesID'), 'day' => $this->input->post('day'), 'start_time' => $this->input->post('start_time'), 'end_time' => $this->input->post('end_time'), 'room' => $this->input->post('room'), ));
			if(count($routine)) {
				$this->form_validation->set_message("unique_room", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}
	}

	function allclasses() {
		if($this->input->post('classesID') == 0) {
			$this->form_validation->set_message("allclasses", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}
}

/* End of file routine.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/routine.php */
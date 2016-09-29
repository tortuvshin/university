<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion extends Admin_Controller {
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
		$this->load->model("subject_m");
		$this->load->model("promotionsubject_m");
		$this->load->model("classes_m");
		$this->load->model("mark_m");
		$this->load->model('section_m');
		$language = $this->session->userdata('lang');
		$this->lang->load('promotion', $language);	
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Teacher") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->data['set'] = $id;
				$this->data['classes'] = $this->student_m->get_classes();
				$this->data['students'] = $this->student_m->get_order_by_student(array('classesID' => $id));
				$this->data['subjects'] = $this->subject_m->get_order_by_subject(array('classesID' => $id));
				$this->data['promotionsubjects'] = $this->promotionsubject_m->get_order_by_promotionsubject(array("classesID" => $id));
				foreach ($this->data['subjects'] as $key => $subject) {
					$subjectinfo = $this->promotionsubject_m->get_order_by_promotionsubject(array('classesID' => $id, 'subjectID' => $subject->subjectID));
					if(!count($subjectinfo)){
						$this->promotionsubject_m->insert_promotionsubject(array('classesID' => $id, 'subjectID' => $subject->subjectID, 'subjectCode' => $subject->subject_code));
					}
				}

				$rules = array();
				$array = array();
				if ($_POST) {
					foreach ($_POST as $key => $subjectMark) {
						$rules[] = array(
							'field' => "".$key, 
							'label' => " ", 
							'rules' => 'trim|required|xss_clean|max_length[6]|numeric'
						);
					}

					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run() == FALSE) { 
						$this->data["subview"] = "promotion/index";
						$this->load->view('_layout_main', $this->data);
					} else {
						foreach ($_POST as $key => $value) {
							$array = array("subjectMark" => $value);
							$this->promotionsubject_m->update_promotionsubject($array, $key);
						}
						redirect("promotion/add/$id");
					}
				} else {
					$this->data["subview"] = "promotion/index";
					$this->load->view('_layout_main', $this->data);
				}

			} else {
				$this->data['classes'] = $this->student_m->get_classes();
				$this->data["subview"] = "promotion/search";
				$this->load->view('_layout_main', $this->data);
			}
		} 

	}

	public function promotion_list() {
		$classID = $this->input->post('id');
		if((int)$classID) {
			$string = base_url("promotion/index/$classID");
			echo $string;
		} else {
			redirect(base_url("promotion/index"));
		}
	}


	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Teacher") {

			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$classes = $this->classes_m->get_classes($id);
				if(count($classes)) {
					$this->data['set'] = $id;
					$this->data['classes'] = $this->student_m->get_classes();
					$this->data['students'] = $this->student_m->get_order_by_student_year($id);
					if(count($this->data['students'])) {

						$min_year = $this->student_m->get_order_by_student_single_year($id);
						$subjectMarks = $this->promotionsubject_m->get_order_by_promotionsubject_with_subject($id);
						$markClasses = $this->mark_m->get_order_by_mark_with_subject($id,$min_year->year);
						
						/* Start Maximum Semester for each class */
						
						$AllSemester = array();
						foreach ($markClasses as $key => $markClass) {
							if($markClass->mark != null){
								array_push($AllSemester,$markClass->examID);
							}
						}

						$AllSemester = array_unique($AllSemester);
						$maxSemester = count($AllSemester);

						/* Close Maximum Semester for each class */

						/* Start Promotion Mark Settings */
						$check = array();
						foreach ($subjectMarks as $key => $subjectMark) {
							$check[$subjectMark->subjectID] = intval($subjectMark->subjectMark*$maxSemester);
						}

						/* Close Promotion Mark Settings */

						$student_result = array();
						$total_mark = array();
						$sum = 0;
						foreach ($this->data['students'] as $key => $student) {
							$f=0;
							foreach ($subjectMarks as $key =>  $subjectMark) {

								$total_semester = $this->mark_m->count_subject_mark($student->studentID, $student->classesID, $subjectMark->subjectID);
								if($maxSemester==0) {
									$f=2;
									break;
								} elseif(intval($total_semester->total_semester) == $maxSemester) {
									$sum = $this->mark_m->sum_student_subject_mark($student->studentID, $student->classesID, $subjectMark->subjectID);
									$sum = intval($sum->mark);

									// dump($sum);
									// dump($check[$subjectMark->subjectID]);
									if($check[$subjectMark->subjectID] <= $sum) {
										$f=1;
									} else {
										$f=0;
										break;
									}
								} else {
									$f=0;
									break;
								}
							}
							$student_result[$student->studentID] = $f;
						}

						$this->data['student_result'] = $student_result;

						
						$this->data["subview"] = "promotion/add";
						$this->load->view('_layout_main', $this->data);
					} else {
						$this->session->set_flashdata('error', $this->lang->line('promotion_emstudent'));
						redirect(base_url('promotion/index'));
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

	function promotion_to_next_class() {

		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Teacher") {

			$studentIDs = $this->input->post("studentIDs");
			$js_classeID = $this->input->post("classesID");
			$explode = explode(",",  $studentIDs);

			$students = $this->student_m->get_order_by_student(array("classesID" => $js_classeID));

			if(count($students) && count($studentIDs) && count($js_classeID)) {
				$allclasses = $this->classes_m->get_order_by_numeric_classes();
				$f=0;
				foreach ($students as $key => $student) {

					if($student->studentID === $explode[$key]) {
						$classes = $this->classes_m->get_classes($js_classeID);
						$get_numeric_classID = ($classes->classes_numeric);

						foreach ($allclasses as $key => $allclass) {
							if($allclass->classes_numeric == $get_numeric_classID) {

								if(isset($allclasses[$key+1]->classesID)) {
									$next_classesID = $allclasses[$key+1]->classesID;
									$section = $this->section_m->get_single_section(array("classesID" => $next_classesID));								
									$year = $student->year;
									$year++;
									$array = array(
										'classesID' => $next_classesID,
										'year' => $year
									);
									if(count($section)) {
										$array['sectionID'] = $section->sectionID;
										$array['section'] = $section->section;
									}
									$this->student_m->update_student($array, $student->studentID);
								} else {
									$f = 1;
									break;
								}
							}
						}
						if($f==1) {
							break;
						}

					} else {
						$year = $student->year;
						$year++;
						$array = array(
							'year' => $year
						);
						$this->student_m->update_student($array, $student->studentID);
					}
				}

				if($f==1){
					$this->session->set_flashdata('error', $this->lang->line('promotion_create_class'));
					echo 'error';
				} else {
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					echo 'success'; 
				}
				
			}


		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

}

/* End of file promotion.php */
/* Location: .//var/www/html/school/mvc/controllers/promotion.php */
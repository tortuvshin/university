<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends Admin_Controller {
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
	function __construct () {
		parent::__construct();
		$this->load->model("student_m");
		$this->load->model("parentes_m");
		$this->load->model("section_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('student', $language);
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
						$this->data['allsection'][$section->sectionID] = $this->student_m->get_order_by_student(array('classesID' => $id, "sectionID" => $section->sectionID));
					}
				} else {
					$this->data['students'] = NULL;
				}

				$this->data["subview"] = "student/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data['classes'] = $this->student_m->get_classes();
				$this->data["subview"] = "student/search";
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
				'field' => 'name',
				'label' => $this->lang->line("student_name"),
				'rules' => 'trim|required|xss_clean|max_length[60]'
			),
			array(
				'field' => 'dob',
				'label' => $this->lang->line("student_dob"),
				'rules' => 'trim|required|max_length[10]|callback_date_valid|xss_clean'
			),
			array(
				'field' => 'sex',
				'label' => $this->lang->line("student_sex"),
				'rules' => 'trim|required|max_length[10]|xss_clean'
			),
			array(
				'field' => 'religion',
				'label' => $this->lang->line("student_religion"),
				'rules' => 'trim|max_length[25]|xss_clean'
			),
			array(
				'field' => 'email',
				'label' => $this->lang->line("student_email"),
				'rules' => 'trim|required|max_length[40]|valid_email|xss_clean|callback_unique_email'
			),
			array(
				'field' => 'phone',
				'label' => $this->lang->line("student_phone"),
				'rules' => 'trim|max_length[25]|min_length[5]|xss_clean'
			),
			array(
				'field' => 'address',
				'label' => $this->lang->line("student_address"),
				'rules' => 'trim|max_length[200]|xss_clean'
			),
			array(
				'field' => 'classesID',
				'label' => $this->lang->line("student_classes"),
				'rules' => 'trim|required|numeric|max_length[11]|xss_clean|callback_unique_classesID'
			),
			array(
				'field' => 'sectionID',
				'label' => $this->lang->line("student_section"),
				'rules' => 'trim|required|numeric|max_length[11]|xss_clean|callback_unique_sectionID'
			),
			array(
				'field' => 'roll',
				'label' => $this->lang->line("student_roll"),
				'rules' => 'trim|required|max_length[40]|callback_unique_roll|xss_clean'
			),
			array(
				'field' => 'guargianID',
				'label' => $this->lang->line("student_guargian"),
				'rules' => 'trim|required|max_length[11]|xss_clean|numeric'
			),
			array(
				'field' => 'photo',
				'label' => $this->lang->line("student_photo"),
				'rules' => 'trim|max_length[200]|xss_clean'
			),

			array(
				'field' => 'username',
				'label' => $this->lang->line("student_username"),
				'rules' => 'trim|required|min_length[4]|max_length[40]|xss_clean|callback_lol_username'
			),
			array(
				'field' => 'password',
				'label' => $this->lang->line("student_password"),
				'rules' => 'trim|required|min_length[4]|max_length[40]|xss_clean'
			)
		);
		return $rules;
	}

	function insert_with_image($username) {
	    $random = rand(1, 10000000000000000);
	    $makeRandom = hash('sha512', $random. $username . config_item("encryption_key"));
	    return $makeRandom;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$this->data['classes'] = $this->student_m->get_classes();
			$this->data['sections'] = $this->section_m->get_section();
			$this->data['parents'] = $this->parentes_m->get_parentes();

			$classesID = $this->input->post("classesID");

			if($classesID != 0) {
				$this->data['sections'] = $this->section_m->get_order_by_section(array("classesID" =>$classesID));
			} else {
				$this->data['sections'] = "empty";
			}
			$this->data['sectionID'] = $this->input->post("sectionID");

			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data["subview"] = "student/add";
					$this->load->view('_layout_main', $this->data);
				} else {

					$sectionID = $this->input->post("sectionID");
					if($sectionID == 0) {
						$this->data['sectionID'] = 0;
					} else {
						$this->data['sections'] = $this->section_m->get_allsection($classesID);
						$this->data['sectionID'] = $this->input->post("sectionID");
					}

					$dbmaxyear = $this->student_m->get_order_by_student_single_max_year($classesID);
					$maxyear = "";
					if(count($dbmaxyear)) {
						$maxyear = $dbmaxyear->year;
					} else {
						$maxyear = date("Y");
					}

					$section = $this->section_m->get_section($sectionID);
					$array = array();
					$array["name"] = $this->input->post("name");
					$array["dob"] = date("Y-m-d", strtotime($this->input->post("dob")));
					$array["sex"] = $this->input->post("sex");
					$array["religion"] = $this->input->post("religion");
					$array["email"] = $this->input->post("email");
					$array["phone"] = $this->input->post("phone");
					$array["address"] = $this->input->post("address");
					$array["classesID"] = $this->input->post("classesID");
					$array["sectionID"] = $this->input->post("sectionID");
					$array["section"] = $section->section;
					$array["roll"] = $this->input->post("roll");
					$array["username"] = $this->input->post("username");
					$array['password'] = $this->student_m->hash($this->input->post("password"));
					$array['usertype'] = "Student";
					$array['parentID'] = $this->input->post('guargianID');
					$array['library'] = 0;
					$array['hostel'] = 0;
					$array['transport'] = 0;
					$array['create_date'] = date("Y-m-d");
					$array['year'] = $maxyear;
					$array['totalamount'] = 0;
					$array['paidamount'] = 0;
					$array["create_date"] = date("Y-m-d h:i:s");
					$array["modify_date"] = date("Y-m-d h:i:s");
					$array["create_userID"] = $this->session->userdata('loginuserID');
					$array["create_username"] = $this->session->userdata('username');
					$array["create_usertype"] = $this->session->userdata('usertype');
					$array["studentactive"] = 1;

					$new_file = "defualt.png";
					if($_FILES["image"]['name'] !="") {
						$file_name = $_FILES["image"]['name'];
						$file_name_rename = $this->insert_with_image($this->input->post("username"));
			            $explode = explode('.', $file_name);
			            if(count($explode) >= 2) {

				            $new_file = $file_name_rename.'.'.$explode[1];
							$config['upload_path'] = "./uploads/images";
							$config['allowed_types'] = "gif|jpg|png";
							$config['file_name'] = $new_file;
							$config['max_size'] = '1024';
							$config['max_width'] = '3000';
							$config['max_height'] = '3000';
							$array['photo'] = $new_file;
							$this->load->library('upload', $config);
							if(!$this->upload->do_upload("image")) {
								$this->data["image"] = $this->upload->display_errors();
								$this->data["subview"] = "student/add";
								$this->load->view('_layout_main', $this->data);
							} else {
								$data = array("upload_data" => $this->upload->data());
								$this->student_m->insert_student($array);
								$this->session->set_flashdata('success', $this->lang->line('menu_success'));
								redirect(base_url("student/index"));
							}
						} else {
							$this->data["image"] = "Invalid file";
							$this->data["subview"] = "student/add";
							$this->load->view('_layout_main', $this->data);
						}
					} else {
						$array["photo"] = $new_file;
						$this->student_m->insert_student($array);
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
						redirect(base_url("student/index"));
					}
				}
			} else {
				$this->data["subview"] = "student/add";
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
				$this->data['classes'] = $this->student_m->get_classes();
				$this->data['student'] = $this->student_m->get_student($id);
				$this->data['parents'] = $this->parentes_m->get_parentes();
				$classesID = $this->data['student']->classesID;

				$this->data['sections'] = $this->section_m->get_order_by_section(array('classesID' => $classesID));
				$this->data['set'] = $url;
				if($this->data['student']) {
					if($_POST) {
						$rules = $this->rules();
						unset($rules[11],$rules[12], $rules[13]);
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "student/edit";
							$this->load->view('_layout_main', $this->data);
						} else {

							$array = array();
							$array["name"] = $this->input->post("name");
							$array["dob"] = date("Y-m-d", strtotime($this->input->post("dob")));
							$array["sex"] = $this->input->post("sex");
							$array["religion"] = $this->input->post("religion");
							$array["email"] = $this->input->post("email");
							$array["phone"] = $this->input->post("phone");
							$array["address"] = $this->input->post("address");
							$array["classesID"] = $this->input->post("classesID");
							$array["sectionID"] = $this->input->post("sectionID");
							$section = $this->section_m->get_section($this->input->post("sectionID"));
							$array["section"] = $section->section;
							$array["roll"] = $this->input->post("roll");
							$array["parentID"] = $this->input->post("guargianID");
							$array["modify_date"] = date("Y-m-d h:i:s");

							if($_FILES["image"]['name'] !="") {
								if($this->data['student']->photo != 'defualt.png') {
									unlink(FCPATH.'uploads/images/'.$this->data['student']->photo);
								}
								$file_name = $_FILES["image"]['name'];
								$file_name_rename = $this->insert_with_image($this->data['student']->username);
					            $explode = explode('.', $file_name);
					            if(count($explode) >= 2) {
						            $new_file = $file_name_rename.'.'.$explode[1];
									$config['upload_path'] = "./uploads/images";
									$config['allowed_types'] = "gif|jpg|png";
									$config['file_name'] = $new_file;
									$config['max_size'] = '1024';
									$config['max_width'] = '3000';
									$config['max_height'] = '3000';

									$array['photo'] = $new_file;
									$this->load->library('upload', $config);
									if(!$this->upload->do_upload("image")) {
										$this->data["image"] = $this->upload->display_errors();
										$this->data["subview"] = "student/edit";
										$this->load->view('_layout_main', $this->data);
									} else {
										$data = array("upload_data" => $this->upload->data());
										$this->student_m->update_student($array, $id);
										$this->session->set_flashdata('success', $this->lang->line('menu_success'));
										redirect(base_url("student/index/$url"));
									}
								} else {
									$this->data["image"] = "Invalid file";
									$this->data["subview"] = "student/edit";
									$this->load->view('_layout_main', $this->data);
								}
							} else {
								$this->student_m->update_student($array, $id);
								$this->session->set_flashdata('success', $this->lang->line('menu_success'));
								redirect(base_url("student/index/$url"));
							}
						}
					} else {
						$this->data["subview"] = "student/edit";
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

	public function view() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype == "Teacher") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			if ((int)$id && (int)$url) {
				$this->data["student"] = $this->student_m->get_student($id);
				$this->data["class"] = $this->student_m->get_class($url);
				if($this->data["student"] && $this->data["class"]) {
					$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
					$this->data['set'] = $url;
					if ($this->data["student"]->parentID) {
						$this->data["parent"] = $this->parentes_m->get_parentes($this->data["student"]->parentID);
					}
					$this->data["subview"] = "student/view";
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
	}

	public function print_preview() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
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
				    $this->html2pdf->paper('a4', 'portrait');
				    $this->data['panel_title'] = $this->lang->line('panel_title');
					$this->data["parent"] = $this->parentes_m->get_parentes($this->data["student"]->parentID);
					$html = $this->load->view('student/print_preview', $this->data, true);
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
			$url = $this->input->post('set');
			if ((int)$id && (int)$url) {
				$this->data["student"] = $this->student_m->get_student($id);
				$this->data["class"] = $this->student_m->get_class($url);
				if($this->data["student"] && $this->data["class"]) {
					$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);
				    $this->load->library('html2pdf');
				    $this->html2pdf->folder('uploads/report');
				    $this->html2pdf->filename('Report.pdf');
				    $this->html2pdf->paper('a4', 'portrait');
				    $this->data['panel_title'] = $this->lang->line('panel_title');
					$this->data["parent"] = $this->parentes_m->get_parentes($this->data["student"]->parentID);
					$html = $this->load->view('student/print_preview', $this->data, true);
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



	public function delete() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));
			if ((int)$id && (int)$url) {
				$this->data['student'] = $this->student_m->get_student($id);
				if($this->data['student']) {
					if($this->data['student']->photo != 'defualt.png') {
						unlink(FCPATH.'uploads/images/'.$this->data['student']->photo);
					}
					$this->student_m->delete_student($id);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("student/index/$url"));
				} else {
					redirect(base_url("student/index"));
				}
			} else {
				redirect(base_url("student/index/$url"));
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function unique_roll() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$student = $this->student_m->get_order_by_roll(array("roll" => $this->input->post("roll"), "studentID !=" => $id, "classesID" => $this->input->post('classesID')));
			if(count($student)) {
				$this->form_validation->set_message("unique_roll", "%s already exists");
				return FALSE;
			}
			return TRUE;
		} else {
			$student = $this->student_m->get_order_by_roll(array("roll" => $this->input->post("roll"), "classesID" => $this->input->post('classesID')));

			if(count($student)) {
				$this->form_validation->set_message("unique_roll", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}
	}

	public function lol_username() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$student_info = $this->student_m->get_single_student(array('studentID' => $id));
			$tables = array('student' => 'student', 'parent' => 'parent', 'teacher' => 'teacher', 'user' => 'user', 'systemadmin' => 'systemadmin');
			$array = array();
			$i = 0;
			foreach ($tables as $table) {
				$user = $this->student_m->get_username($table, array("username" => $this->input->post('username'), "email !=" => $student_info->email));
				if(count($user)) {
					$this->form_validation->set_message("lol_username", "%s already exists");
					$array['permition'][$i] = 'no';
				} else {
					$array['permition'][$i] = 'yes';
				}
				$i++;
			}
			if(in_array('no', $array['permition'])) {
				return FALSE;
			} else {
				return TRUE;
			}
		} else {
			$tables = array('student' => 'student', 'parent' => 'parent', 'teacher' => 'teacher', 'user' => 'user', 'systemadmin' => 'systemadmin');
			$array = array();
			$i = 0;
			foreach ($tables as $table) {
				$user = $this->student_m->get_username($table, array("username" => $this->input->post('username')));
				if(count($user)) {
					$this->form_validation->set_message("lol_username", "%s already exists");
					$array['permition'][$i] = 'no';
				} else {
					$array['permition'][$i] = 'yes';
				}
				$i++;
			}

			if(in_array('no', $array['permition'])) {
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	public function date_valid($date) {
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

	public function unique_classesID() {
		if($this->input->post('classesID') == 0) {
			$this->form_validation->set_message("unique_classesID", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	public function unique_sectionID() {
		if($this->input->post('sectionID') == 0) {
			$this->form_validation->set_message("unique_sectionID", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}

	public function student_list() {
		$classID = $this->input->post('id');
		if((int)$classID) {
			$string = base_url("student/index/$classID");
			echo $string;
		} else {
			redirect(base_url("student/index"));
		}
	}

	public function unique_email() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$student_info = $this->student_m->get_single_student(array('studentID' => $id));
			$tables = array('student' => 'student', 'parent' => 'parent', 'teacher' => 'teacher', 'user' => 'user', 'systemadmin' => 'systemadmin');
			$array = array();
			$i = 0;
			foreach ($tables as $table) {
				$user = $this->student_m->get_username($table, array("email" => $this->input->post('email'), 'username !=' => $student_info->username ));
				if(count($user)) {
					$this->form_validation->set_message("unique_email", "%s already exists");
					$array['permition'][$i] = 'no';
				} else {
					$array['permition'][$i] = 'yes';
				}
				$i++;
			}
			if(in_array('no', $array['permition'])) {
				return FALSE;
			} else {
				return TRUE;
			}
		} else {
			$tables = array('student' => 'student', 'parent' => 'parent', 'teacher' => 'teacher', 'user' => 'user', 'systemadmin' => 'systemadmin');
			$array = array();
			$i = 0;
			foreach ($tables as $table) {
				$user = $this->student_m->get_username($table, array("email" => $this->input->post('email')));
				if(count($user)) {
					$this->form_validation->set_message("unique_email", "%s already exists");
					$array['permition'][$i] = 'no';
				} else {
					$array['permition'][$i] = 'yes';
				}
				$i++;
			}

			if(in_array('no', $array['permition'])) {
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	function sectioncall() {
		$classesID = $this->input->post('id');
		if((int)$classesID) {
			$allsection = $this->section_m->get_order_by_section(array('classesID' => $classesID));
			echo "<option value='0'>", $this->lang->line("student_select_section"),"</option>";
			foreach ($allsection as $value) {
				echo "<option value=\"$value->sectionID\">",$value->section,"</option>";
			}
		}
	}

	function active() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$id = $this->input->post('id');
			$status = $this->input->post('status');
			if($id != '' && $status != '') {
				if((int)$id) {
					if($status == 'chacked') {
						$this->student_m->update_student(array('studentactive' => 1), $id);
						echo 'Success';
					} elseif($status == 'unchacked') {
						$this->student_m->update_student(array('studentactive' => 0), $id);
						echo 'Success';
					} else {
						echo "Error";
					}
				} else {
					echo "Error";
				}
			} else {
				echo "Error";
			}
		} else {
			echo "Error";
		}
	}
}

/* End of file student.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/student.php */

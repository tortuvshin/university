<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parentes extends Admin_Controller {
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
	public function __construct () {
		parent::__construct();
		$this->load->model("parentes_m");
		$this->load->model("student_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('parentes', $language);
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$this->data['parentes'] = $this->parentes_m->get_parentes();
			$this->data["subview"] = "parentes/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'name', 
				'label' => $this->lang->line("parentes_guargian_name"), 
				'rules' => 'trim|required|xss_clean|max_length[60]'
			),
			array(
				'field' => 'father_name',
				'label' => $this->lang->line("parentes_father_name"), 
				'rules' => 'trim|required|xss_clean|max_length[60]'
			),
			array(
				'field' => 'mother_name', 
				'label' => $this->lang->line("parentes_mother_name"), 
				'rules' => 'trim|required|xss_clean|max_length[60]'
			),
			array(
				'field' => 'father_profession', 
				'label' => $this->lang->line("parentes_father_name"), 
				'rules' => 'trim|required|xss_clean|max_length[40]'
			),
			array(
				'field' => 'mother_profession', 
				'label' => $this->lang->line("parentes_mother_name"), 
				'rules' => 'trim|required|xss_clean|max_length[40]'
			),
			array(
				'field' => 'email', 
				'label' => $this->lang->line("parentes_email"), 
				'rules' => 'trim|required|max_length[40]|valid_email|xss_clean|callback_unique_email'
			),
			array(
				'field' => 'phone', 
				'label' => $this->lang->line("parentes_phone"), 
				'rules' => 'trim|min_length[5]|max_length[25]|xss_clean'
			),
			array(
				'field' => 'address', 
				'label' => $this->lang->line("parentes_address"), 
				'rules' => 'trim|max_length[200]|xss_clean'
			),
			array(
				'field' => 'photo', 
				'label' => $this->lang->line("parentes_photo"), 
				'rules' => 'trim|max_length[200]|xss_clean'
			),
			array(
				'field' => 'username', 
				'label' => $this->lang->line("parentes_username"), 
				'rules' => 'trim|required|min_length[4]|max_length[40]|xss_clean|callback_lol_username'
			),
			array(
				'field' => 'password',
				'label' => $this->lang->line("parentes_password"), 
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
			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data['form_validation'] = validation_errors(); 
					$this->data["subview"] = "parentes/add";
					$this->load->view('_layout_main', $this->data);		
				} else {
					$array = array();
					for($i=0; $i<count($rules); $i++) {
						$array[$rules[$i]['field']] = $this->input->post($rules[$i]['field']);
					}

					$array['password'] = $this->student_m->hash($this->input->post("password"));
					$array['usertype'] = "Parent";
					$array["create_date"] = date("Y-m-d h:i:s");
					$array["modify_date"] = date("Y-m-d h:i:s");
					$array["create_userID"] = $this->session->userdata('loginuserID');
					$array["create_username"] = $this->session->userdata('username');
					$array["create_usertype"] = $this->session->userdata('usertype');
					$array["parentactive"] = 1;

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
								$this->data["subview"] = "parentes/add";
								$this->load->view('_layout_main', $this->data);
							} else {
								$data = array("upload_data" => $this->upload->data());
								$this->parentes_m->insert_parentes($array);
								$this->session->set_flashdata('success', $this->lang->line('menu_success'));
								redirect(base_url("parentes/index"));
							}
						} else {
							$this->data["image"] = "Invalid file";
							$this->data["subview"] = "parentes/add";
							$this->load->view('_layout_main', $this->data);
						}
					} else {
						$array["photo"] = $new_file;
						$this->parentes_m->insert_parentes($array);
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
						redirect(base_url("parentes/index"));
					}
				}
			} else {
				$this->data["subview"] = "parentes/add";
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
			
			if ((int)$id) {
				$this->data['parentes'] = $this->parentes_m->get_parentes($id);
				if($this->data['parentes']) {
					if($_POST) {
						$rules = $this->rules();
						unset($rules[8],$rules[9], $rules[10]);
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) { 
							$this->data["subview"] = "parentes/edit";
							$this->load->view('_layout_main', $this->data);
						} else {

							$array = array();
							for($i=0; $i<count($rules); $i++) {
								$array[$rules[$i]['field']] = $this->input->post($rules[$i]['field']);
							}
							$array["modify_date"] = date("Y-m-d h:i:s");
						
							if($_FILES["image"]['name'] !="") {
								if($this->data['parentes']->photo != 'defualt.png') {
									unlink(FCPATH.'uploads/images/'.$this->data['parentes']->photo);
								}
								$file_name = $_FILES["image"]['name'];
								$file_name_rename = $this->insert_with_image($this->data['parentes']->username);
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
										$this->data["subview"] = "parentes/edit";
										$this->load->view('_layout_main', $this->data);
									} else {
										$data = array("upload_data" => $this->upload->data());
										$this->parentes_m->update_parentes($array, $id);
										$this->session->set_flashdata('success', $this->lang->line('menu_success'));
										redirect(base_url("parentes/index"));
									}
								} else {
									$this->data["image"] = "invalid file";
									$this->data["subview"] = "parentes/edit";
									$this->load->view('_layout_main', $this->data);
								}
							} else {
								$this->parentes_m->update_parentes($array, $id);
								$this->session->set_flashdata('success', $this->lang->line('menu_success'));
								redirect(base_url("parentes/index"));
							}
						}
					} else {
						$this->data["subview"] = "parentes/edit";
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
		if($usertype == "Admin") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if ((int)$id) {
				$this->data['parentes'] = $this->parentes_m->get_parentes($id);

				if($this->data['parentes']) {
					$this->data["subview"] = "parentes/view";
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
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));

		if ((int)$id) {
			$usertype = $this->session->userdata('usertype');
			if ($usertype == "Admin") {
				$this->load->library('html2pdf');
			    $this->html2pdf->folder('./assets/pdfs/');
			    $this->html2pdf->filename('Report.pdf');
			    $this->html2pdf->paper('a4', 'portrait');

				$this->data['parentes'] = $this->parentes_m->get_parentes($id);
				if($this->data['parentes']) {
					$this->data['panel_title'] = $this->lang->line('panel_title');
					$html = $this->load->view('parentes/print_preview', $this->data, true);
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
				$this->data['parentes'] = $this->parentes_m->get_parentes($id);
				if($this->data['parentes']) {
					$html = $this->load->view('parentes/print_preview', $this->data, true);
					$this->load->library('html2pdf');
				    $this->html2pdf->folder('uploads/report');
				    $this->html2pdf->filename('Report.pdf');
				    $this->html2pdf->paper('a4', 'portrait');
				    $this->data['panel_title'] = $this->lang->line('panel_title');
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
			if ((int)$id) {
				$this->data['parentes'] = $this->parentes_m->get_parentes($id);
				if($this->data['parentes']) {
					if($this->data['parentes']->photo != 'defualt.png') {
						unlink(FCPATH.'uploads/images/'.$this->data['parentes']->photo);
					}
					$this->parentes_m->delete_parentes($id);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("parentes/index"));
				} else {
					redirect(base_url("parentes/index"));
				}
			} else {
				redirect(base_url("parentes/index"));
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function unique_email() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$parents = $this->parentes_m->get_single_parentes(array('parentID' => $id));
			$tables = array('student' => 'student', 'parent' => 'parent', 'teacher' => 'teacher', 'user' => 'user', 'systemadmin' => 'systemadmin');
			$array = array();
			$i = 0;
			foreach ($tables as $table) {
				$user = $this->parentes_m->get_username($table, array("email" => $this->input->post('email'), 'username !=' => $parents->username ));
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

	public function lol_username() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$parents_info = $this->user_m->get_single_user(array('teacherID' => $id));
			$tables = array('student' => 'student', 'parent' => 'parent', 'teacher' => 'teacher', 'user' => 'user', 'systemadmin' => 'systemadmin');
			$array = array();
			$i = 0;
			foreach ($tables as $table) {
				$user = $this->student_m->get_username($table, array("username" => $this->input->post('username'), "email !=" => $parents_info->email ));
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

	function active() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$id = $this->input->post('id');
			$status = $this->input->post('status');
			if($id != '' && $status != '') {
				if((int)$id) {
					if($status == 'chacked') {
						$this->parentes_m->update_parentes(array('parentactive' => 1), $id);
						echo 'Success';
					} elseif($status == 'unchacked') {
						$this->parentes_m->update_parentes(array('parentactive' => 0), $id);
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

/* End of file parentes.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/parentes.php */
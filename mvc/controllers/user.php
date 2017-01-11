<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Admin_Controller {
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
		$this->load->model("user_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('user', $language);
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$this->data['users'] = $this->user_m->get_user();
			$this->data["subview"] = "user/index";
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
				'label' => $this->lang->line("user_name"),
				'rules' => 'trim|required|xss_clean|max_length[60]'
			),
			array(
				'field' => 'dob',
				'label' => $this->lang->line("user_dob"),
				'rules' => 'trim|required|max_length[10]|callback_date_valid|xss_clean'
			),
			array(
				'field' => 'sex',
				'label' => $this->lang->line("user_sex"),
				'rules' => 'trim|max_length[10]|xss_clean'
			),
			array(
				'field' => 'religion',
				'label' => $this->lang->line("user_religion"),
				'rules' => 'trim|max_length[25]|xss_clean'
			),
			array(
				'field' => 'email',
				'label' => $this->lang->line("user_email"),
				'rules' => 'trim|required|max_length[40]|valid_email|xss_clean|callback_unique_email'
			),
			array(
				'field' => 'phone',
				'label' => $this->lang->line("user_phone"),
				'rules' => 'trim|min_length[5]|max_length[25]|xss_clean'
			),
			array(
				'field' => 'address',
				'label' => $this->lang->line("user_address"),
				'rules' => 'trim|max_length[200]|xss_clean'
			),
			array(
				'field' => 'jod',
				'label' => $this->lang->line("user_jod"),
				'rules' => 'trim|required|max_length[10]|callback_date_valid|xss_clean'
			),
			array(
				'field' => 'usertype',
				'label' => $this->lang->line("user_type"),
				'rules' => 'trim|required|max_length[20]|xss_clean'
			),
			array(
				'field' => 'photo',
				'label' => $this->lang->line("user_photo"),
				'rules' => 'trim|max_length[200]|xss_clean'
			),
			array(
				'field' => 'username',
				'label' => $this->lang->line("user_username"),
				'rules' => 'trim|required|min_length[4]|max_length[40]|xss_clean|callback_lol_username'
			),
			array(
				'field' => 'password',
				'label' => $this->lang->line("user_password"),
				'rules' => 'trim|required|min_length[4]|max_length[40]|xss_clean'
			),
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
					$this->data["subview"] = "user/add";
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
					$array["jod"] = date("Y-m-d", strtotime($this->input->post("jod")));
					$array["username"] = $this->input->post("username");
					$array["password"] = $this->user_m->hash($this->input->post("password"));
					$array["usertype"] = $this->input->post("usertype");
					$array["create_date"] = date("Y-m-d h:i:s");
					$array["modify_date"] = date("Y-m-d h:i:s");
					$array["create_userID"] = $this->session->userdata('loginuserID');
					$array["create_username"] = $this->session->userdata('username');
					$array["create_usertype"] = $this->session->userdata('usertype');
					$array["useractive"] = 1;

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
								$this->data["subview"] = "user/add";
								$this->load->view('_layout_main', $this->data);
							} else {
								$data = array("upload_data" => $this->upload->data());
								$this->user_m->insert_user($array);
								$this->session->set_flashdata('success', $this->lang->line('menu_success'));
								redirect(base_url("user/index"));
							}
						} else {
							$this->data["image"] = "Invalid file";
							$this->data["subview"] = "user/add";
							$this->load->view('_layout_main', $this->data);
						}
					} else {
						$array["photo"] = $new_file;
						$this->user_m->insert_user($array);
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
						redirect(base_url("user/index"));
					}
				}
			} else {
				$this->data["subview"] = "user/add";
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
				$this->data['user'] = $this->user_m->get_user($id);
				if($this->data['user']) {
					$rules = $this->rules();
					unset($rules[9], $rules[10], $rules[11]);
					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run() == FALSE) {
						$this->data["subview"] = "user/edit";
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
						$array["jod"] = date("Y-m-d", strtotime($this->input->post("jod")));
						$array["usertype"] = $this->input->post("usertype");
						$array["modify_date"] = date("Y-m-d h:i:s");

						if($_FILES["image"]['name'] !="") {
							if($this->data['user']->photo != 'defualt.png') {
									unlink(FCPATH.'uploads/images/'.$this->data['user']->photo);
								}
							$file_name = $_FILES["image"]['name'];
							$file_name_rename = $this->insert_with_image($this->data['user']->username);
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
									$this->data["subview"] = "user/edit";
									$this->load->view('_layout_main', $this->data);
								} else {
									$data = array("upload_data" => $this->upload->data());
									$this->user_m->update_user($array, $id);
									$this->session->set_flashdata('success', $this->lang->line('menu_success'));
									redirect(base_url("user/index"));
								}
							} else {
								$this->data["image"] = "Invalid file";
								$this->data["subview"] = "user/edit";
								$this->load->view('_layout_main', $this->data);
							}
						} else {
							$this->user_m->update_user($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("user/index"));
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
			if((int)$id) {
				$this->data['user'] = $this->user_m->get_user($id);
				if($this->data['user']) {
					if($this->data['user']->photo != 'defualt.png') {
						unlink(FCPATH.'uploads/images/'.$this->data['user']->photo);
					}
					$this->user_m->delete_user($id);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("user/index"));
				} else {
					redirect(base_url("user/index"));
				}
			} else {
				redirect(base_url("user/index"));
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
				$this->data["user"] = $this->user_m->get_user($id);
				if($this->data["user"]) {
					$this->data["subview"] = "user/view";
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

		if ((int)$id) {
			$usertype = $this->session->userdata('usertype');
			if ($usertype == "Admin") {
				$this->load->library('html2pdf');
			    $this->html2pdf->folder('./assets/pdfs/');
			    $this->html2pdf->filename('Report.pdf');
			    $this->html2pdf->paper('a4', 'portrait');

				$this->data['user'] = $this->user_m->get_user($id);
				if($this->data['user']) {
					$this->data['panel_title'] = $this->lang->line('panel_title');
					$html = $this->load->view('user/print_preview', $this->data, true);
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
				$this->load->library('html2pdf');
			    $this->html2pdf->folder('uploads/report');
			    $this->html2pdf->filename('Report.pdf');
			    $this->html2pdf->paper('a4', 'portrait');

				$this->data['user'] = $this->user_m->get_user($id);
				if($this->data["user"]) {
					$this->data['panel_title'] = $this->lang->line('panel_title');
					$html = $this->load->view('user/print_preview', $this->data, true);
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

	public function lol_username() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$user_info = $this->user_m->get_single_user(array('userID' => $id));
			$tables = array('student' => 'student', 'parent' => 'parent', 'teacher' => 'teacher', 'user' => 'user', 'systemadmin' => 'systemadmin');
			$array = array();
			$i = 0;
			foreach ($tables as $table) {
				$user = $this->user_m->get_username($table, array("username" => $this->input->post('username'), "email !=" => $user_info->email ));
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
				$user = $this->user_m->get_username($table, array("username" => $this->input->post('username')));
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

	public function unique_email() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		if((int)$id) {
			$user_info = $this->user_m->get_single_user(array('userID' => $id));
			$tables = array('student' => 'student', 'parent' => 'parent', 'teacher' => 'teacher', 'user' => 'user', 'systemadmin' => 'systemadmin');
			$array = array();
			$i = 0;
			foreach ($tables as $table) {
				$user = $this->user_m->get_username($table, array("email" => $this->input->post('email'), 'username !=' => $user_info->username ));
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
				$user = $this->user_m->get_username($table, array("email" => $this->input->post('email')));
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

	function active() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$id = $this->input->post('id');
			$status = $this->input->post('status');
			if($id != '' && $status != '') {
				if((int)$id) {
					if($status == 'chacked') {
						$this->user_m->update_user(array('useractive' => 1), $id);
						echo 'Success';
					} elseif($status == 'unchacked') {
						$this->user_m->update_user(array('useractive' => 0), $id);
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

/* End of file user.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/user.php */

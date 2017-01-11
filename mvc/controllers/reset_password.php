<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reset_password extends Admin_Controller {
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
		$this->load->model("reset_password_m");
		$this->load->model("student_m");
		$this->load->model("teacher_m");
		$this->load->model("parentes_m");
		$this->load->model("user_m");
		$this->load->model("systemadmin_m");

		$language = $this->session->userdata('lang');
		$this->lang->load('reset_password', $language);	
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
 		if($usertype == "Admin") {

 			$users = $this->input->post("users");
 			$table = '';
			$tableID = '';
 			if($users != '0') {
				if($users == "Admin") {
					$table = 'systemadmin';
					$tableID = 'systemadminID';
				} elseif($users == "Accountant") {
					$table = 'user';
					$tableID = 'userID';
				} elseif($users == "Librarian") {
					$table = 'user';
					$tableID = 'userID';
				} elseif($users == 'Parent') { 
					$table = 'parent';
					$tableID = 'parentID';
				} else {
					$table = strtolower($users);
					$tableID = strtolower($users)."ID";
				}

				$this->data['usernames'] = $this->reset_password_m->get_username($table, array('usertype' => $users));
			} else {
				$this->data['usernames'] = "empty";
			}

			$this->data['username'] = 0;

 			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) { 
					$this->data["subview"] = "reset_password/index";
					$this->load->view('_layout_main', $this->data);			
				} else {
					$array = array(
						'password' => $this->reset_password_m->hash($this->input->post("new_password"))
					);
					$userID = $this->input->post('username');
					$this->reset_password_m->update_reset_password($table, $array, $tableID, $userID);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("reset_password/index"));
				}
			} else {
				$this->data["subview"] = "reset_password/index";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function userscall() {
		$usertype = $this->session->userdata("usertype");
 		if($usertype == "Admin") {

			$users = $this->input->post('users');
			$table = '';
			$tableID = '';
			if($users == "Admin") {
				$table = 'systemadmin';
				$tableID = 'systemadminID';
			} elseif($users == "Accountant") {
				$table = 'user';
				$tableID = 'userID';
			} elseif($users == "Librarian") {
				$table = 'user';
				$tableID = 'userID';
			} elseif($users == 'Parent') { 
				$table = 'parent';
				$tableID = 'parentID';
			} else {
				$table = strtolower($users);
				$tableID = strtolower($users)."ID";
			}

			$get_users = $this->reset_password_m->get_username($table, array('usertype' => $users));
			
			if(count($get_users)) {
				foreach ($get_users as $key => $user) {
					echo "<option value='".$user->$tableID."'>".$user->username .' ('.$user->email.')'."</option>";
				}
			} else {
				echo "<option value=''>".' '."</option>";
			}
		} 
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'users', 
				'label' => $this->lang->line("reset_password_users"), 
				'rules' => 'trim|required|xss_clean'
			), 
			array(
				'field' => 'username', 
				'label' => $this->lang->line("reset_password_username"),
				'rules' => 'trim|required|xss_clean|numeric|'
			), 
			array(
				'field' => 'new_password', 
				'label' => $this->lang->line("reset_password_new_password"),
				'rules' => 'trim|required|xss_clean'
			), 
			array(
				'field' => 're_password', 
				'label' => $this->lang->line("reset_password_re_password"), 
				'rules' => 'trim|required|xss_clean|matches[new_password]'
			)
		);
		return $rules;
	}

}

/* End of file class.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/class.php */
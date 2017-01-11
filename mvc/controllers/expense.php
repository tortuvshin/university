<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expense extends Admin_Controller {
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
		$this->load->model("expense_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('expense', $language);
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
 		if($usertype == "Admin" || $usertype == "Accountant") {
			$this->data['expenses'] = $this->expense_m->get_expense();
			$this->data["subview"] = "expense/index";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	protected function rules() {
		$rules = array(
				 array(
					'field' => 'expense',
					'label' => $this->lang->line("expense_expense"),
					'rules' => 'trim|required|xss_clean|max_length[128]'
				),
				array(
					'field' => 'date',
					'label' => $this->lang->line("expense_date"),
					'rules' => 'trim|required|max_length[10]|xss_clean|callback_date_valid'
				),
				array(
					'field' => 'amount',
					'label' => $this->lang->line("expense_amount"),
					'rules' => 'trim|required|numeric|max_length[11]|xss_clean|callback_valid_number'
				),
				array(
					'field' => 'note',
					'label' => $this->lang->line("expense_note"),
					'rules' => 'trim|max_length[200]|xss_clean'
				)
			);
		return $rules;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
 		if($usertype == "Admin" || $usertype == "Accountant") {
			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data["subview"] = "expense/add";
					$this->load->view('_layout_main', $this->data);
				} else {
					$uname= $this->session->userdata("name");
					$username = $this->session->userdata("username");
					$email = $this->session->userdata("email");
					$table = "";
					$userid = "";
					$array = array();
					$array = array(
						"create_date" => date("Y-m-d"),
						"date" => date("Y-m-d", strtotime($this->input->post("date"))),
						"expense" => $this->input->post("expense"),
						"amount" => $this->input->post("amount"),
						"note" => $this->input->post("note"),
						"expenseyear" => date("Y")
					);

					if($usertype == "Admin") {
						$table = "systemadmin";
						$userid = "systemadminID";
					} elseif($usertype == "Accountant") {
						$table = "user";
						$userid = "userID";
					}

					$user = $this->expense_m->user_expense($table, $username, $email);
					$array['userID'] = $user->$userid;
					$array['uname'] = $user->name;
					$array['usertype'] = $user->usertype;
					$this->expense_m->insert_expense($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("expense/index"));
				}
			} else {
				$this->data["subview"] = "expense/add";
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
			if((int)$id) {
				$this->data['expense'] = $this->expense_m->get_expense($id);
				if($this->data['expense']) {
					if($_POST) {
						$rules = $this->rules();
						$this->form_validation->set_rules($rules);
						if ($this->form_validation->run() == FALSE) {
							$this->data["subview"] = "expense/edit";
							$this->load->view('_layout_main', $this->data);
						} else {

							$uname= $this->session->userdata("name");
							$username = $this->session->userdata("username");
							$email = $this->session->userdata("email");
							$table = "";
							$userid = "";
							$array = array();
							$array = array(
								"date" => date("Y-m-d", strtotime($this->input->post("date"))),
								"expense" => $this->input->post("expense"),
								"amount" => $this->input->post("amount"),
								"note" => $this->input->post("note"),
							);

							if($usertype == "Admin") {
								$table = "systemadmin";
								$userid = "systemadminID";
							} elseif($usertype == "Accountant") {
								$table = "user";
								$userid = "userID";
							}

							$user = $this->expense_m->user_expense($table, $username, $email);
							$array['userID'] = $user->$userid;
							$array['uname'] = $user->name;
							$array['usertype'] = $user->usertype;

							$this->expense_m->update_expense($array, $id);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("expense/index"));
						}
					} else {
						$this->data["subview"] = "expense/edit";
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
			if((int)$id) {
				$this->expense_m->delete_expense($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("expense/index"));
			} else {
				redirect(base_url("expense/index"));
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

	function valid_number() {
		if($this->input->post('amount') && $this->input->post('amount') < 0) {
			$this->form_validation->set_message("valid_number", "%s is invalid number");
			return FALSE;
		}
		return TRUE;
	}
}

/* End of file expense.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/expense.php */

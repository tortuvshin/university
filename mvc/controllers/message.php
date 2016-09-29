<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends Admin_Controller {
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
		$this->load->model("message_m");
		$this->load->model("reply_msg_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('message', $language);
	}

	public function index() {
		$email = $this->session->userdata('email');
		$usertype = $this->session->userdata('usertype');
		$userID = $this->userID();
		$table = "";

		$this->data['messages'] = $this->message_m->get_order_by_message(array('email' => $email,'receiverID' => $userID, 'receiverType' => $usertype, 'to_status' => 0));
		if (count($this->data['messages'])) {
			foreach ($this->data['messages'] as $key => $item) {
				if ($item->usertype=="Admin") {
					$table = "systemadmin";
				} elseif($item->usertype=="Accountant" || $item->usertype=="Librarian") {
					$table = "user";
				} else {
					$table = strtolower($item->usertype);
				}
				$query = $this->db->get_where($table, array($table.'ID' => $item->userID));
				if (count($query->row())) {
					$this->data['messages'][$key] = (object) array_merge( (array)$item, array( 'sender' => $query->row()->name));
				}
			}
		}
		$this->data["subview"] = "message/index";
		$this->load->view('_layout_main', $this->data);
	}

	public function fav_message() {
		$email = $this->session->userdata('email');
		$usertype = $this->session->userdata('usertype');
		$userID = $this->userID();
		$table = "";

		$this->data['messages'] = $this->message_m->get_order_by_message(array('email' => $email,'receiverID' => $userID, 'receiverType' => $usertype, 'to_status' => 0, 'fav_status' => 1));
		$this->data['messages_sent'] = $this->message_m->get_order_by_message(array('userID' => $userID, 'usertype' => $usertype, 'from_status' => 0, 'fav_status_sent' => 1));
		if (count($this->data['messages'])) {
			foreach ($this->data['messages'] as $key => $item) {
				if ($item->usertype=="Admin") {
					$table = "systemadmin";
				} elseif($item->usertype=="Accountant" || $item->usertype=="Librarian") {
					$table = "user";
				} else {
					$table = strtolower($item->usertype);
				}
				$query = $this->db->get_where($table, array($table.'ID' => $item->userID));
				if (count($query->row())) {
					$this->data['messages'][$key] = (object) array_merge( (array)$item, array( 'sender' => $query->row()->name));
				}
			}
		}
		if (count($this->data['messages_sent'])) {
			foreach ($this->data['messages_sent'] as $key => $item) {
				if ($item->receiverType=="Admin") {
					$table = "systemadmin";
				} elseif($item->receiverType=="Accountant" || $item->receiverType=="Librarian") {
					$table = "user";
				} else {
					$table = strtolower($item->receiverType);
				}
				$query = $this->db->get_where($table, array($table.'ID' => $item->receiverID));
				if (count($query->row())) {
					$this->data['messages_sent'][$key] = (object) array_merge( (array)$item, array( 'sender' => $query->row()->name));
				}

			}
		}
		$this->data["subview"] = "message/favorite";
		$this->load->view('_layout_main', $this->data);
	}

	public function sent() {
		$usertype = $this->session->userdata('usertype');
		$username = $this->session->userdata("username");
		$table = "";
		if ($usertype=="Admin") {
			$table = "systemadmin";
			$tableID = "systemadminID";
		} elseif($usertype=="Accountant" || $usertype=="Librarian") {
			$table = "user";
			$tableID = "userID";
		} else {
			$table = strtolower($usertype);
			$tableID = $table."ID";
		}
		$query = $this->db->get_where($table, array('username' => $username));
		$userID = $query->row()->$tableID;
		$table = "";
		$this->data['messages'] = $this->message_m->get_order_by_message(array('userID' => $userID, 'usertype' => $usertype, 'from_status' => 0));
		if (count($this->data['messages'])) {
			foreach ($this->data['messages'] as $key => $item) {
				if ($item->receiverType=="Admin") {
					$table = "systemadmin";
				} elseif($item->receiverType=="Accountant" || $item->receiverType=="Librarian") {
					$table = "user";
				} else {
					$table = strtolower($item->receiverType);
				}
				$query = $this->db->get_where($table, array($table.'ID' => $item->receiverID));
				if (count($query->row())) {
					$this->data['messages'][$key] = (object) array_merge( (array)$item, array( 'sender' => $query->row()->name));
				}

			}
		}
		$this->data["subview"] = "message/sent";
		$this->load->view('_layout_main', $this->data);
	}

	public function trash() {
		$email = $this->session->userdata('email');
		$usertype = $this->session->userdata('usertype');
		$username = $this->session->userdata("username");
		$table = "";
		if ($usertype=="Admin") {
			$table = "systemadmin";
			$tableID = "systemadminID";
		} elseif($usertype=="Accountant" || $usertype=="Librarian") {
			$table = "user";
			$tableID = "userID";
		} else {
			$table = strtolower($usertype);
			$tableID = $table."ID";
		}
		$query = $this->db->get_where($table, array('username' => $username));
		$userID = $query->row()->$tableID;
		$this->data['messages'] = $this->message_m->get_trash_message($email,$userID,$usertype);
		/* sender */
		if (count($this->data['messages'])) {
			foreach ($this->data['messages'] as $key => $item) {
				if ($item->usertype=="Admin") {
					$table = "systemadmin";
				} elseif($item->usertype=="Accountant" || $item->usertype=="Librarian") {
					$table = "user";
				} else {
					$table = strtolower($item->usertype);
				}
				$query = $this->db->get_where($table, array($table.'ID' => $item->userID));
				if (count($query->row())) {
					$this->data['messages'][$key] = (object) array_merge( (array)$item, array( 'sender' => $query->row()->name));
				}

			}
		}
		$this->data["subview"] = "message/trash";
		$this->load->view('_layout_main', $this->data);
	}

	public function fav_status() {
		$messageID = $this->input->post('id');
		$array = array();
		if((int)$messageID) {
			$this->data['message'] = $this->message_m->get_message($messageID);
			if ($this->data['message']->fav_status==0) {
				$array["fav_status"] = 1;
			} else {
				$array["fav_status"] = 0;
			}
			$this->message_m->update_message($array, $messageID);
			$string = base_url("message/index");
			echo $string;
		} else {
			redirect(base_url("message/index"));
		}

	}

	public function fav_status_sent() {
		$messageID = $this->input->post('id');
		$array = array();
		if((int)$messageID) {
			$this->data['message'] = $this->message_m->get_message($messageID);
			if ($this->data['message']->fav_status_sent==0) {
				$array["fav_status_sent"] = 1;
			} else {
				$array["fav_status_sent"] = 0;
			}
			$this->message_m->update_message($array, $messageID);
			$string = base_url("message/sent");
			echo $string;
		} else {
			redirect(base_url("message/sent"));
		}

	}

	protected function rules() {
		$rules = array(
				 array(
					'field' => 'to',
					'label' => $this->lang->line("name"),
					'rules' => 'trim|required|xss_clean|max_length[128]'
				),
				array(
					'field' => 'message',
					'label' => $this->lang->line("message"),
					'rules' => 'trim|required|xss_clean'
				),
				array(
					'field' => 'subject',
					'label' => $this->lang->line("subject"),
					'rules' => 'trim|required|xss_clean'
				),
				array(
					'field' => 'attachment',
					'label' => $this->lang->line("attachment"),
					'rules' => 'trim|xss_clean'
				)
			);
		return $rules;
	}

	public function add() {
		$usertype = $this->session->userdata("usertype");
		$username = $this->session->userdata("username");
		$year = date("Y");
		$table = "";
		$tableID = "";
		$this->data['admin'] = $this->message_m->get_recivers('systemadmin');
		$this->data['student'] = $this->message_m->get_recivers('student');
		$this->data['parent'] = $this->message_m->get_recivers('parent');
		$this->data['teacher'] = $this->message_m->get_recivers('teacher');
		$this->data['accountant'] = $this->message_m->get_recivers('user', array('usertype' => 'Accountant'));
		$this->data['librarian'] = $this->message_m->get_recivers('user', array('usertype' => 'Librarian'));
		if($_POST) {
			$rules = $this->rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data['form_validation'] = validation_errors();
				$this->data["subview"] = "message/add";
				$this->load->view('_layout_main', $this->data);
			} else {
				if ($usertype=="Admin") {
					$table = "systemadmin";
					$tableID = "systemadminID";
				} elseif($usertype=="Accountant" || $usertype=="Librarian") {
					$table = "user";
					$tableID = "userID";
				} else {
					$table = strtolower($usertype);
					$tableID = $table."ID";
				}
				$query = $this->db->get_where($table, array('username' => $username));
				$userID = $query->row()->$tableID;

				$receverInfo = explode(',', $_POST['to']);
				$array = array(
					"email" => $receverInfo[2],
					"receiverID" => $receverInfo[1],
					"receiverType" => $receverInfo[0],
					"subject" => $this->input->post("subject"),
					"message" => $this->input->post("message"),
					"userID" => $userID,
					"usertype" => $this->session->userdata('usertype'),
					"useremail" => $this->session->userdata('email'),
					"year" => $year,
					"date" => date("Y-m-d"),
					"create_date" => date("Y-m-d h:i:s"),
					"read_status" => 0,
					"from_status" => 0,
					"to_status" => 0,
					"fav_status" => 0,
					'fav_status_sent' => 0,
					'reply_status' => 0
				);
				if($_FILES["attachment"]['name'] !="") {
					$file_name = $_FILES["attachment"]['name'];
					$file_name_rename = rand(1, 100000000000);
		            $explode = explode('.', $file_name);
		            if(count($explode) >= 2) {
		            	$new_file = $file_name_rename.'.'.$explode[1];
		            	if (preg_match('/\s/',$file_name)) {
							$file_name = str_replace(' ', '_', $file_name);
						}
						$config['upload_path'] = "./uploads/attach";
						$config['allowed_types'] = "gif|jpg|png|pdf|docx|csv";
						$config['file_name'] = $new_file;
						$config['max_size'] = '1024';
						$config['max_width'] = '3000';
						$config['max_height'] = '3000';
						$array['attach'] = $file_name;
						$array['attach_file_name'] = $new_file;
						$this->load->library('upload', $config);
						if(!$this->upload->do_upload("attachment")) {
							$this->data["attachment_error"] = $this->upload->display_errors();
							$this->data["subview"] = "message/add";
							$this->load->view('_layout_main', $this->data);
						} else {
							$data = array("upload_data" => $this->upload->data());
							$this->message_m->insert_message($array);
							$this->session->set_flashdata('success', $this->lang->line("menu_success"));
							redirect(base_url("message/index"));
						}
					} else {
						$this->data["attachment_error"] = "Invalid file";
						$this->data["subview"] = "message/add";
						$this->load->view('_layout_main', $this->data);
					}
				} else {
					$this->message_m->insert_message($array);
					$this->session->set_flashdata('success', $this->lang->line("menu_success"));
					redirect(base_url("message/index"));
				}
			}
		} else {
			$this->data["subview"] = "message/add";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function view() {
		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
		$this->data['userID'] = $this->userID();
		$usertype = $this->session->userdata('usertype');
		$this->data['sender'] = new stdClass();
		if((int)$id) {
			$this->data['message'] = $this->message_m->get_message($id);
			$this->data['reply_msg'] = $this->reply_msg_m->get_order_by_reply_msg(array('messageID'=>$id));
			if ($this->data['message']) {

				/*reciver info*/
				$table1 = "";
				if ($this->data['message']->receiverType=="Admin") {
						$table1 = "systemadmin";
				} elseif($this->data['message']->receiverType=="Accountant" || $this->data['message']->receiverType=="Librarian") {
					$table1 = "user";
				} else {
					$table1 = strtolower($this->data['message']->receiverType);
				}
				$query = $this->db->get_where($table1, array($table1.'ID' => $this->data['message']->receiverID));
				$this->data['reciver'] = $query->row();
				/*reciver info end*/
				/*sender info*/
				$table = "";
				if ($this->data['message']->usertype=="Admin") {
						$table = "systemadmin";
				} elseif($this->data['message']->usertype=="Accountant" || $this->data['message']->usertype=="Librarian") {
					$table = "user";
				} else {
					$table = strtolower($this->data['message']->usertype);
				}
				$query = $this->db->get_where($table, array($table.'ID' => $this->data['message']->userID));
				if($query->row()){
					$this->data['sender'] = $query->row();
				} else {
					$this->data['sender']->email = $this->data['message']->useremail;
					$this->data['sender']->photo = "defualt.png";
				}
				/* Change read status*/
				$read_status = array();
				if($this->data['userID']==$this->data['message']->receiverID && $usertype==$this->data['message']->receiverType) {
					$read_status['read_status'] = 1;
				} else {
					$read_status['reply_status'] = 0;
				}
				$this->message_m->update_message($read_status, $id);
				/*sender info end*/
				$this->data["subview"] = "message/view";
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

	public function delete_inbox() {
		$id = htmlentities(mysql_real_escape_string($this->input->post('id')));
		if($id) {
			$array = array();
			$array = explode(',', $id);
			$update_array = array();
			foreach ($array as $value) {
				$update_array['to_status']  = 1;
				$this->message_m->update_message($update_array, $value);
			}
			$this->session->set_flashdata('success', $this->lang->line("menu_success"));
			echo base_url("message/index");
		} else {
			echo base_url("message/index");
		}
	}

	public function delete_sent() {
		$id = htmlentities(mysql_real_escape_string($this->input->post('id')));
		if($id) {
			$array = array();
			$array = explode(',', $id);
			$update_array = array();
			foreach ($array as $value) {
				$update_array['from_status']  = 1;
				$this->message_m->update_message($update_array, $value);
			}
			$this->session->set_flashdata('success', $this->lang->line("menu_success"));
			echo base_url("message/sent");
		} else {
			echo base_url("message/sent");
		}
	}

	public function delete_trash() {
		$usertype = $this->session->userdata('usertype');
		$username = $this->session->userdata('username');
		if ($usertype=="Admin") {
			$table = "systemadmin";
			$tableID = "systemadminID";
		} elseif($usertype=="Accountant" || $usertype=="Librarian") {
			$table = "user";
			$tableID = "userID";
		} else {
			$table = strtolower($usertype);
			$tableID = $table."ID";
		}
		$query = $this->db->get_where($table, array('username' => $username));
		$userID = $query->row()->$tableID;
		$id = htmlentities(mysql_real_escape_string($this->input->post('id')));
		if($id) {
			$array = array();
			$array = explode(',', $id);
			$update_array = array();
			foreach ($array as $value) {
				if($value != '') {
					$this->data['message'] = $this->message_m->get_message($value);
					if($this->data['message']->receiverID==$userID && $this->data['message']->receiverType==$usertype) {
						$update_array['to_status']  = 2;
					} else {
						$update_array['from_status']  = 2;
					}
					$this->message_m->update_message($update_array, $value);
				}
			}
			$this->session->set_flashdata('success', $this->lang->line("menu_success"));
			echo base_url("message/trash");
		} else {
			echo base_url("message/trash");
		}
	}

	public function restore_message() {
		$usertype = $this->session->userdata('usertype');
		$username = $this->session->userdata('username');
		if ($usertype=="Admin") {
			$table = "systemadmin";
			$tableID = "systemadminID";
		} elseif($usertype=="Accountant" || $usertype=="Librarian") {
			$table = "user";
			$tableID = "userID";
		} else {
			$table = strtolower($usertype);
			$tableID = $table."ID";
		}
		$query = $this->db->get_where($table, array('username' => $username));
		$userID = $query->row()->$tableID;
		$id = htmlentities(mysql_real_escape_string($this->input->post('id')));
		if($id) {
			$array = array();
			$array = explode(',', $id);
			$update_array = array();
			foreach ($array as $value) {
				if($value != '') {
					$this->data['message'] = $this->message_m->get_message($value);
					if($this->data['message']->receiverID==$userID && $this->data['message']->receiverType==$usertype) {
						$update_array['to_status']  = 0;
					} else {
						$update_array['from_status']  = 0;
					}
					$this->message_m->update_message($update_array, $value);
				}
			}
			$this->session->set_flashdata('success', $this->lang->line("menu_success"));
			echo base_url("message/trash");
		} else {
			echo base_url("message/trash");
		}
	}

	public function reply_msg() {
		$userID = $this->userID();
		$usertype = $this->session->userdata('usertype');
		if ($_POST) {
			$id = $this->input->post('id');
			$message = $this->input->post('message');
			$this->data['message'] = $this->message_m->get_message($id);
			$array = array();
			$active = array();
			$array = array(
				"messageID" => $id,
				"reply_msg" => $message,
				"create_time" => date("Y-m-d h:i:s")
			);
			if ($this->data['message']->receiverID == $userID && $this->data['message']->receiverType == $usertype) {
				$array['status'] = 0;
				$active['reply_status'] = 1;
			} else {
				$array['status'] = 1;
				$active['read_status'] = 0;
			}
			if($this->reply_msg_m->insert_reply_msg($array) && $this->message_m->update_message($active, $id)) {
				// $this->message_m->update_message($active, $id);
				$this->session->set_flashdata('success', $this->lang->line("menu_success"));
				echo base_url("message/view/$id");
			} else {
				echo base_url("message/view/$id");
				$this->session->set_flashdata('error', 'Reply not sent!');
			}
		}

	}

	public function userID() {

		$usertype = $this->session->userdata('usertype');
		$username = $this->session->userdata('username');
		if ($usertype=="Admin") {
			$table = "systemadmin";
			$tableID = "systemadminID";
		} elseif($usertype=="Accountant" || $usertype=="Librarian") {
			$table = "user";
			$tableID = "userID";
		} else {
			$table = strtolower($usertype);
			$tableID = $table."ID";
		}
		$query = $this->db->get_where($table, array('username' => $username));
		$userID = $query->row()->$tableID;
		return $userID;
	}

	public function unreadCounter()
	{
		$id = $this->userID();
		$usertype = $this->session->userdata('usertype');
		$array = array();
		$array['inbox'] = $this->message_m->counter(array("read_status" => 0, "receiverID" => $id, "receiverType"=> $usertype));
		$array['send'] = $this->message_m->counter(array("reply_status" => 1, "userID" => $id, "usertype"=> $usertype));
		echo json_encode($array);
	}

}

/* End of file message.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/message.php */

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitorinfo extends Admin_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("visitorinfo_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('visitorinfo', $language);
	}
	protected function rules() {
		$rules = array(
			array(
				'field' => 'name',
				'label' => $this->lang->line("name"),
				'rules' => 'trim|required|xss_clean|max_length[60]'
			),
			array(
				'field' => 'email_id',
				'label' => $this->lang->line("email"),
				'rules' => 'trim|max_length[40]|valid_email|xss_clean'
			),
			array(
				'field' => 'phone',
				'label' => $this->lang->line("phone"),
				'rules' => 'trim|max_length[25]|min_length[5]|xss_clean'
			),
			array(
				'field' => 'company_name',
				'label' => $this->lang->line("company_name"),
				'rules' => 'trim|max_length[200]|xss_clean'
			),
			array(
				'field' => 'coming_from',
				'label' => $this->lang->line("coming_from"),
				'rules' => 'trim|xss_clean'
			),
			array(
				'field' => 'to_meet',
				'label' => $this->lang->line("to_meet"),
				'rules' => 'trim|xss_clean'
			),
			array(
				'field' => 'representing',
				'label' => $this->lang->line("representing"),
				'rules' => 'trim|required|max_length[40]|callback_unique_roll|xss_clean'
			)
		);
		return $rules;
	}
	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype=="Admin" || $usertype=="Receptionist") {
			$this->data['passes'] = $this->visitorinfo_m->get_order_by_visitorinfo();
			$this->data['admin'] = $this->message_m->get_recivers('systemadmin');
			$this->data['student'] = $this->message_m->get_recivers('student');
			$this->data['parent'] = $this->message_m->get_recivers('parent');
			$this->data['teacher'] = $this->message_m->get_recivers('teacher');
			$this->data['accountant'] = $this->message_m->get_recivers('user', array('usertype' => 'Accountant'));
			$this->data['librarian'] = $this->message_m->get_recivers('user', array('usertype' => 'Librarian'));
			if ($_POST) {
				$rules = $this->rules();
				$array = array();
				for($i=0; $i<count($rules); $i++) {
					$array[$rules[$i]['field']] = $this->input->post($rules[$i]['field']);
				}
				$receverInfo = explode(',', $_POST['to_meet']);
				$array["to_meet"] = $receverInfo[2];
				$array["to_meet_personID"] = $receverInfo[1];
				$array["to_meet_person_usertype"] = $receverInfo[0];
				$array["check_in"] = date("Y-m-d h:i:s");
				$array["status"] = 0;
			    $encoded_data = $_POST['image'];
    			$binary_data = base64_decode( $encoded_data );
			    // // save to server (beware of permissions)
			    $file_name_rename = rand(1, 100000000000);
			    $new_file = "visitor".$file_name_rename.'.jpeg';
			    $result = file_put_contents( 'uploads/visitor/'.$new_file, $binary_data );
			    $array["photo"] = $new_file;
			    if ($result) {
			    	if($id = $this->visitorinfo_m->insert_visitorinfo($array)) {
			    		$this->session->set_flashdata('success', $this->lang->line("upload_success"));
			    		$arr = array(
							  'id'=>$id,
							  'to_meet'=>$array["to_meet"],
							  'to_meet_type'=>$array["to_meet_person_usertype"],
							);
						echo json_encode($arr);
			    	} else {
			    		$this->session->set_flashdata('error', $this->lang->line("upload_error_data"));
			    		$this->data["subview"] = "visitorinfo/index";
						$this->load->view('_layout_main', $this->data);
			    	}
			    } else {
			    	$this->session->set_flashdata('error', $this->lang->line("upload_error"));
			    	$this->data["subview"] = "visitorinfo/index";
					$this->load->view('_layout_main', $this->data);
			    }
		    } else {
				$this->data["subview"] = "visitorinfo/index";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function logout() {
		$usertype = $this->session->userdata('usertype');
		if ($usertype=="Admin" || $usertype=="Receptionist") {
			$id = $this->input->post('visitorID');
			if ((int)$id) {
				$array = [];
				$array['check_out'] = date("Y-m-d h:i:s");
				$array['status'] = 1;
				if($this->visitorinfo_m->update_visitorinfo($array, $id)) {
		    		$this->session->set_flashdata('success', $this->lang->line("checkout_success"));
		    		echo base_url("visitorinfo/index");
		    	} else {
		    		$this->session->set_flashdata('error', $this->lang->line("checkout_error"));
					echo base_url("visitorinfo/index");
		    	}
			} else {
				$this->session->set_flashdata('error', $this->lang->line("invalid_id"));
				echo base_url("visitorinfo/index");
			}
		} else {

		}

	}
	public function delete() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype=="Receptionist") {
			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			if((int)$id) {
				$this->visitorinfo_m->delete_visitorinfo($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("visitorinfo/index"));
			} else {
				redirect(base_url("visitorinfo/index"));
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}
	public function view() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin" || $usertype=="Receptionist") {
			$id = $this->input->post('visitorinfoID');
			if((int)$id) {
				$data = $this->visitorinfo_m->get_visitorinfo($id);
				$arr = array(
						  'id'=>$data->visitorID,
						  'photo'=>$data->photo,
						  'phone'=>$data->phone,
						  'email_id'=>$data->email_id,
						  'name'=>$data->name,
						  'to_meet'=>$data->to_meet,
						  'to_meet_type'=>$data->to_meet_person_usertype,
						  'company_name'=>$data->company_name,
						  'coming_from'=>$data->coming_from,
						  'representing'=>$data->representing,
						);
				echo json_encode($arr);
			} else {
				redirect(base_url("visitorinfo/index"));
			}
		} else {
			redirect(base_url("visitorinfo/index"));
		}
	}


}

/* End of file visitorinfo.php */
/* Location: .//var/www/html/schoolv2/mvc/controllers/visitorinfo.php */

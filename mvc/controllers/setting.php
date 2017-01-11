<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class setting extends Admin_Controller {
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
		$this->load->model("setting_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('setting', $language);
	}

	protected function rules() {
		$rules = array(
				array(
					'field' => 'sname',
					'label' => $this->lang->line("setting_school_name"),
					'rules' => 'trim|required|xss_clean|max_length[128]'
				),
				array(
					'field' => 'phone',
					'label' => $this->lang->line("setting_school_phone"),
					'rules' => 'trim|required|xss_clean|max_length[25]'
				),
				array(
					'field' => 'email',
					'label' => $this->lang->line("setting_school_email"),
					'rules' => 'trim|required|valid_email|max_length[40]|xss_clean'
				),
				array(
					'field' => 'automation',
					'label' => $this->lang->line("setting_school_automation"),
					'rules' => 'trim|required|max_length[2]|xss_clean|numeric|callback_unique_day'
				),
				array(
					'field' => 'currency_code',
					'label' => $this->lang->line("setting_school_currency_code"),
					'rules' => 'trim|required|max_length[11]|xss_clean'
				),
				array(
					'field' => 'currency_symbol',
					'label' => $this->lang->line("setting_school_currency_symbol"),
					'rules' => 'trim|required|max_length[3]|xss_clean'
				),
				array(
					'field' => 'footer',
					'label' => $this->lang->line("setting_school_footer"),
					'rules' => 'trim|required|max_length[200]|xss_clean'
				),
				array(
					'field' => 'address',
					'label' => $this->lang->line("setting_school_address"),
					'rules' => 'trim|required|max_length[200]|xss_clean'
				),
				array(
					'field' => 'language',
					'label' => $this->lang->line("setting_school_lang"),
					'rules' => 'trim|required|xss_clean'
				),
				array(
					'field' => 'attendance',
					'label' => $this->lang->line("setting_school_attendance"),
					'rules' => 'trim|required|xss_clean|callback_attendance'
 				)
			);
		return $rules;
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$this->data['setting'] = $this->setting_m->get_setting(1);
			if($this->data['setting']) {

				if($_POST) {
					$rules = $this->rules();
					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run() == FALSE) {
						$this->data['form_validation'] = validation_errors();
						$this->data["subview"] = "setting/index";
						$this->load->view('_layout_main', $this->data);
					} else {
						if($this->pcode_validation($this->data['setting']->purchase_code) == FALSE) {
							$this->session->set_flashdata('error', $this->lang->line('settings_pde'));
							redirect(base_url('setting/index'));
						}
						$array = array();
						for($i=0; $i<count($rules); $i++) {
							$array[$rules[$i]['field']] = $this->input->post($rules[$i]['field']);
						}

						if(isset($array['language'])) {
							$this->session->set_userdata('lang',$array['language']);
						}

						if($_FILES["image"]['name'] !="") {
							$file_name = $_FILES["image"]['name'];
							$file_name_rename = rand(1, 100000000000);
				            $explode = explode('.', $file_name);
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
								$this->data["subview"] = "setting/index";
								$this->load->view('_layout_main', $this->data);
							} else {
								$data = array("upload_data" => $this->upload->data());
								$this->setting_m->update_setting($array, 1);
								$this->session->set_flashdata('success', $this->lang->line('menu_success'));
								redirect(base_url("setting/index"));
							}
						} else {
							$this->setting_m->update_setting($array, 1);
							$this->session->set_flashdata('success', $this->lang->line('menu_success'));
							redirect(base_url("setting/index"));
						}
					}
				} else {
					$this->data["subview"] = "setting/index";
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

	public function unique_day() {
		$day = $this->input->post('automation');
		if((int)$day) {
			if($day < 0 || $day > 28) {
				$this->form_validation->set_message("unique_day", "%s already exists");
				return FALSE;
			}
			return TRUE;
		} else {
			$this->form_validation->set_message("unique_day", "%s already exists");
			return FALSE;
		}
	}

	public function pcode_validation($pcode) {
		$purchase_code = $pcode;
		// $purchase_code_username = "sangwh";
		// $purchase_code = "f541d688-9d40-40db-99fb-65e6f80692ab";
	    $username = 'inilabs';
	    $api_key = 'a7hfhirfq8dw64old1bafe2dpimk5zdb';
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_USERAGENT, 'API');
	    curl_setopt($ch, CURLOPT_URL, "http://marketplace.envato.com/api/edge/". $username ."/". $api_key ."/verify-purchase:". $purchase_code .".json");
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    $purchase_data = json_decode(curl_exec($ch), true);
	    if(!count($purchase_data['verify-purchase'])) {
	    	$this->form_validation->set_message("pcode_validation", "Your Purchase Code Is Not Valid.");
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function attendance() {
		
		if($this->input->post('attendance') === "0") {
			$this->form_validation->set_message("attendance", "The %s field is required");
			 	return FALSE;
		}
		return TRUE;
	}


}

/* End of file setting.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/setting.php */

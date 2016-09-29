<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Omnipay\Omnipay;
class Payment_settings extends Admin_Controller {
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
		$this->load->model("payment_settings_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('payment_settings', $language);
	}

	protected function rules_paypal() {
		$rules = array(
			array(
				'field' => 'paypal_email', 
				'label' => $this->lang->line("paypal_email"), 
				'rules' => 'trim|xss_clean|max_length[255]|valid_email'
			), 
			array(
				'field' => 'paypal_api_username', 
				'label' => $this->lang->line("paypal_api_username"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'paypal_api_password', 
				'label' => $this->lang->line("paypal_api_password"), 
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'paypal_api_signature', 
				'label' => $this->lang->line("paypal_api_signature"), 
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'paypal_demo', 
				'label' => $this->lang->line("paypal_demo"), 
				'rules' => 'trim|xss_clean|max_length[255]'
			),
		);
		return $rules;
	}

	public function index() {
		$usertype = $this->session->userdata("usertype");
		if($usertype == "Admin") {
			$bind = array();
			$get_configs = $this->payment_settings_m->get_order_by_config();
			foreach ($get_configs as $key => $get_key) {
				$bind[$get_key->config_key] = $get_key->value;
			}
			$this->data['set_key'] = $bind;
			if($_POST) {
				$type = $this->input->post('type');
				if($type == 'paypal') {
					$this->data['paypal'] = 1;
					$rules = $this->rules_paypal();
					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run() == FALSE) {
						$this->data["subview"] = "paymentsettings/index";
						$this->load->view('_layout_main', $this->data);			
					} else {
						$paypal_email = $this->input->post('paypal_email');
						$paypal_api_username = $this->input->post('paypal_api_username');
						$paypal_api_password = $this->input->post('paypal_api_password');
						$paypal_api_signature = $this->input->post('paypal_api_signature');
						if($this->input->post('paypal_demo')){
							$paypal_demo = "TRUE";
						} else{
							$paypal_demo = "FALSE";
						}

						$array = array(
						   array(
						      'config_key' => 'paypal_api_username',
						      'value' => $paypal_api_username,
						   ),
						   array(
						      'config_key' => 'paypal_api_password',
						      'value' => $paypal_api_password
						   ),
						   array(
						      'config_key' => 'paypal_api_signature',
						      'value' => $paypal_api_signature
						   ),
						   array(
						      'config_key' => 'paypal_email',
						      'value' => $paypal_email
						   ),
						   array(
						      'config_key' => 'paypal_demo',
						      'value' => $paypal_demo
						   )
						);
						$this->payment_settings_m->update_key($array);
						$bind = array();
						$get_configs = $this->payment_settings_m->get_order_by_config();
						foreach ($get_configs as $key => $get_key) {
							$bind[$get_key->config_key] = $get_key->value;
						}
						$this->data['set_key'] = $bind;
						$this->data["subview"] = "paymentsettings/index";
						$this->load->view('_layout_main', $this->data);
					}
				}
			} else {
				$this->data['paypal'] = 1;
				$this->data["subview"] = "paymentsettings/index";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}
}

/* End of file student.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/student.php */
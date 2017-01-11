<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Install extends CI_Controller {
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
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->helper('file');
		if ($this->config->item('installed') != 'no') {
			show_404();

		}

	}

	protected function rules_purchase_code() {
		$rules = array(
			array(
				'field' => 'purchase_code',
				'label' => 'Purchase Code',
				'rules' => 'trim|required|max_length[255]|xss_clean|callback_pcode_validation'
			)
		);
		return $rules;
	}

	protected function rules_database() {
		$rules = array(
				array(
					'field' => 'host',
					'label' => 'host',
					'rules' => 'trim|required|max_length[255]|xss_clean'
				),
				array(
					'field' => 'database',
					'label' => 'database',
					'rules' => 'trim|required|max_length[255]|xss_clean|callback_database_unique'
				),
				array(
					'field' => 'user',
					'label' => 'user',
					'rules' => 'trim|required|max_length[255]|xss_clean'
				),
				array(
					'field' => 'password',
					'label' => 'password',
					'rules' => 'trim|required|max_length[255]|xss_clean'
				)
			);
		return $rules;
	}

	protected function rules_timezone() {
		$rules = array(
				array(
					'field' => 'timezone',
					'label' => 'timezone',
					'rules' => 'trim|required|max_length[255]|xss_clean|callback_index_validation'
				)
			);
		return $rules;
	}

	protected function rules_site() {
		$rules = array(
				array(
					'field' => 'sname',
					'label' => 'Site Name',
					'rules' => 'trim|required|max_length[40]|xss_clean'
				),
				array(
					'field' => 'phone',
					'label' => 'Phone',
					'rules' => 'trim|required|max_length[25]|xss_clean'
				),
				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'trim|required|max_length[40]|xss_clean|valid_email'
				),
				array(
					'field' => 'adminname',
					'label' => 'Admin Name',
					'rules' => 'trim|required|max_length[40]|xss_clean'
				),
				array(
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'trim|required|max_length[40]|xss_clean'
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required|max_length[40]|xss_clean'
				),
			);
		return $rules;
	}

	function index() {

		$this->data['errors'] = array();
		$this->data['success'] = array();

		// Check PHP version
		if (phpversion() < "5.3") {
			$this->data['errors'][] = 'You are running PHP old version!';
		} else {
			$phpversion = phpversion();
			$this->data['success'][] = ' You are running PHP '.$phpversion;
		}
		// Check Mcrypt PHP exention
		if(!extension_loaded('mcrypt')) {
			$this->data['errors'][] = 'Mcriypt PHP exention unloaded!';
		} else {
			$this->data['success'][] = 'Mcriypt PHP exention loaded!';
		}
		// Check Mysql PHP exention
		if(!extension_loaded('mysql')) {
			$this->data['errors'][] = 'Mysql PHP exention unloaded!';
		} else {
			$this->data['success'][] = 'Mysql PHP exention loaded!';
		}
		// Check Mysql PHP exention
		if(!extension_loaded('mysqli')) {
			$this->data['errors'][] = 'Mysqli PHP exention unloaded!';
		} else {
			$this->data['success'][] = 'Mysqli PHP exention loaded!';
		}
		// Check MBString PHP exention
		if(!extension_loaded('mbstring')) {
			$this->data['errors'][] = 'MBString PHP exention unloaded!';
		} else {
			$this->data['success'][] = 'MBString PHP exention loaded!';
		}
		// Check GD PHP exention
		if(!extension_loaded('gd')) {
			$this->data['errors'][] = 'GD PHP exention unloaded!';
		} else {
			$this->data['success'][] = 'GD PHP exention loaded!';
		}
		// Check CURL PHP exention
		if(!extension_loaded('curl')) {
			$this->data['errors'][] = 'CURL PHP exention unloaded!';
		} else {
			$this->data['success'][] = 'CURL PHP exention loaded!';
		}
		// Check Config Path
		if (@include($this->config->config_path)) {
			$this->data['success'][] = 'Database file is loaded';
			@chmod($this->config->config_path, FILE_WRITE_MODE);
			if(is_really_writable($this->config->config_path) == TRUE) {
				$this->data['success'][] = 'Config PHP exention loaded!';
			} else {
				$this->data['errors'][] = 'Config PHP exention unloaded!';
			}
		} else {
			$this->data['errors'][] = 'Config file is unloaded';
		}
		// Check Database Path
		if (@include($this->config->database_path)) {
			$this->data['success'][] = 'Database file is loaded';
			@chmod($this->config->database_path, FILE_WRITE_MODE);
			if (is_really_writable($this->config->database_path) === FALSE) {
				$this->data['errors'][] = 'database file is unwritable';
			} else {
				$this->data['success'][] = 'Database file is writable';
			}

		} else {
			$this->data['errors'][] = 'Database file is unloaded';
		}

		if (count($this->data['errors']) == 0) {
			$this->data["subview"] = "install/index";
			$this->load->view('_layout_install', $this->data);
		} else {
			$this->data["subview"] = "install/index";
			$this->load->view('_layout_install', $this->data);
		}
	}

	function purchase_code() {
		if($_POST) {
			$rules = $this->rules_purchase_code();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "install/purchase_code";
				$this->load->view('_layout_install', $this->data);
			} else {
				redirect(base_url("install/database"));
			}
		} else {
			$this->data["subview"] = "install/purchase_code";
			$this->load->view('_layout_install', $this->data);
		}
	}

	function database() {
		if($this->check_pcode() == TRUE) {
			if($_POST) {
				$rules = $this->rules_database();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data["subview"] = "install/database";
					$this->load->view('_layout_install', $this->data);
				} else {
					redirect(base_url("install/timezone"));
				}
			} else {
				$this->data["subview"] = "install/database";
				$this->load->view('_layout_install', $this->data);
			}
		} else {
			redirect(base_url("install/purchase_code"));
		}
	}

	function timezone() {
		if($this->check_pcode() == TRUE) {
			if($_POST) {
				$rules = $this->rules_timezone();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data["subview"] = "install/timezone";
					$this->load->view('_layout_install', $this->data);
				} else {
					redirect(base_url("install/site"));
				}
			} else {
				$this->data["subview"] = "install/timezone";
				$this->load->view('_layout_install', $this->data);
			}
		} else {
			redirect(base_url("install/purchase_code"));
		}
	}

	function site() {
		if($this->check_pcode() == TRUE) {
			if($_POST) {
				$this->load->library('session');
				unset($this->db);
				$rules = $this->rules_site();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data["subview"] = "install/site";
					$this->load->view('_layout_install', $this->data);
				} else {
					$this->load->helper('form');
					$this->load->helper('url');
					$this->load->model('install_m');
					$this->load->model('systemadmin_m');
					$file = APPPATH.'config/purchase'.EXT;
					@chmod($file, FILE_WRITE_MODE);
					$purchase_file = read_file($file);
					$array = array(
						'sname' => $this->input->post("sname"),
						'phone' => $this->input->post("phone"),
						'address' => $this->input->post("address"),
						'email' => $this->input->post("email"),
						'automation' => 5,
						'currency_code' => $this->input->post("currency_code"),
						'currency_symbol' => $this->input->post("currency_symbol"),
						'language' => 'english',
						'theme' => 'Basic',
						'fontorbackend' => 0,
						'photo' => 'site.png',
						'purchase_code' => $purchase_file,
						'updateversion' => '2.00',
						'attendance' => 'day'
					);

					$array_admin = array(
						'name' => $this->input->post("adminname"),
						'dob' => '2011-01-01',
						'sex' => 'Male',
						'religion' => 'Unknown',
						'email' => $this->input->post("email"),
						'phone' => $this->input->post("phone"),
						'address' => $this->input->post("address"),
						'jod' => date('Y-m-d'),
						'photo' => 'defualt.png',
						'username' => $this->input->post("username"),
						'password' => $this->install_m->hash($this->input->post("password")),
						'usertype' => 'Admin',
						'create_date' => date("Y-m-d h:i:s"),
						'modify_date' => date("Y-m-d h:i:s"),
						'create_userID' => 0,
						'create_username' => $this->input->post("username"),
						'create_usertype' => 'Admin',
						'systemadminactive' => 1,
						'systemadminextra1' => '',
						'systemadminextra2' => ''
					);




					$select = $this->install_m->select_setting();
					if(count($select)) {
						$update = $this->install_m->update_setting($array, 1);
						$update_admin = $this->systemadmin_m->update_systemadmin($array_admin, 1);
						if($update == TRUE && $update_admin) {
							$this->load->library('session');
							$sesdata= array(
			                   	'username'  => $this->input->post('username'),
			                   	'password'  => $this->input->post('password'),
			               	);

							$this->session->set_userdata($sesdata);
							redirect(base_url("install/done"));
						}
					} else {
						$insert = $this->install_m->insert_setting($array);
						$insert_admin = $this->systemadmin_m->insert_systemadmin($array_admin);
						if($insert == TRUE && $insert_admin == TRUE) {
							$this->load->library('session');
							$sesdata= array(
			                   	'username'  => $this->input->post('username'),
			                   	'password'  => $this->input->post('password'),
			               	);

							$this->session->set_userdata($sesdata);
							redirect(base_url("install/done"));
						}
					}
				}
			} else {
				$this->data["subview"] = "install/site";
				$this->load->view('_layout_install', $this->data);
			}
		} else {
			redirect(base_url("install/purchase_code"));
		}
	}

	function done() {
		if($this->check_pcode() == TRUE) {
			$this->load->library('session');
			if($_POST) {
				$this->config->config_update(array("installed" => 'Yes'));
				@chmod($this->config->database_path, FILE_READ_MODE);
				@chmod($this->config->config_path, FILE_READ_MODE);
				$this->session->sess_destroy();
				redirect(base_url('signin/index'));
			} else {
				$this->data["subview"] = "install/done";
				$this->load->view('_layout_install', $this->data);
			}
		} else {
			redirect(base_url("install/purchase_code"));
		}
	}

	function database_unique() {
		$config_db = array();
		$config_db['hostname'] = $this->input->post('host');
		$config_db['username'] = $this->input->post('user');
		$config_db['password'] = $this->input->post('password');
		$config_db['database'] = $this->input->post('database');
		$config_db['dbdriver'] = 'mysql';

		$this->config->db_config_update($config_db);
		unset($this->db);
		$config_db['db_debug'] = FALSE;
		$this->load->database($config_db);
		$this->load->dbutil();

		if ($this->dbutil->database_exists($this->db->database)) {
			if ($this->db->table_exists('setting') == FALSE) {
			    $id = uniqid();
				$encryption_key = md5("School".$id);
				$this->config->config_update(array('encryption_key'=> $encryption_key));
				$this->load->model('install_m');
				$this->install_m->use_sql_string();
				return TRUE;
			}
			return TRUE;
		} else {
			$this->load->dbforge();
			if ($this->dbforge->create_database($this->db->database)) {
				$id = uniqid();
				$encryption_key = md5("School".$id);
				$this->config->config_update(array('encryption_key'=> $encryption_key));
				$this->load->model('install_m');
				$this->install_m->use_sql_string();
				return TRUE;
			}
			else {
				$this->form_validation->set_message("database_unique", "%s can not create");
				return FALSE;
			}
		}
	}

	function index_validation() {
		$timezone = $this->input->post('timezone');
		@chmod($this->config->index_path, 0777);
		if (is_really_writable($this->config->index_path) === FALSE) {
			$this->form_validation->set_message("index_validation", "Index file is unwritable");
			return FALSE;
		} else {
			$file = $this->config->index_path;
			$current = file_get_contents($file);
			$current = "<?php \ndate_default_timezone_set('". $timezone ."');\n?>\n".$current;
			if(file_put_contents($file, $current)) {
				@chmod($this->config->index_path, 0644);
				return TRUE;
			}
		}
	}

	public function pcode_validation() {
		$purchase_code = trim($this->input->post('purchase_code'));
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
			$file = APPPATH.'config/purchase'.EXT;
			@chmod($file, FILE_WRITE_MODE);
			$purchase_file = read_file($file);
			write_file($file, $purchase_code);
			return TRUE;
		}
	}

	function check_pcode() {
		$file = APPPATH.'config/purchase'.EXT;
		@chmod($file, FILE_WRITE_MODE);
		$purchase_code = read_file($file);

		$username = 'inilabs';
	    $api_key = 'a7hfhirfq8dw64old1bafe2dpimk5zdb';
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_USERAGENT, 'API');
	    curl_setopt($ch, CURLOPT_URL, "http://marketplace.envato.com/api/edge/". $username ."/". $api_key ."/verify-purchase:". $purchase_code .".json");
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    $purchase_data = json_decode(curl_exec($ch), true);
	    if(!count($purchase_data['verify-purchase'])) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
}

/* End of file install.php */
/* Location: ./application/controllers/install.php */

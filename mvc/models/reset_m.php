<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class reset_m extends CI_Model {

	protected $_table_name = 'reset';
	protected $_primary_key = 'resetID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "resetID desc";


	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
	}
	
	public function get_reset($id = NULL, $single = FALSE){
		
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else {
			$method = 'result';
		}
		
		if (!count($this->db->ar_orderby)) {
			$this->db->order_by($this->_order_by);
		}
		return $this->db->get($this->_table_name)->$method();
	}

	function get_order_by_reset($array=NULL) {
		if($array != NULL) {
			$this->db->select()->from($this->_table_name)->where($array)->order_by($this->_order_by);
			$query = $this->db->get();
			return $query->result();
		} else {
			$this->db->select()->from($this->_table_name)->order_by($this->_order_by);
			$query = $this->db->get();
			return $query->result();
		}
	}

	function get_single_reset($array=NULL) {
		if($array != NULL) {
			$this->db->select()->from($this->_table_name)->where($array);
			$query = $this->db->get();
			return $query->row();
		} else {
			$this->db->select()->from($this->_table_name)->order_by($this->_order_by);
			$query = $this->db->get();
			return $query->result();
		}
	}

	function insert_reset($array) {
		$this->db->insert($this->_table_name, $array);
		$id = $this->db->insert_id();
		return $id;	
	}

	function update($data, $id = NULL) {
		$filter = $this->_primary_filter;
		$id = $filter($id);
		$this->db->set($data);
		$this->db->where($this->_primary_key, $id);
		$this->db->update($this->_table_name);
	}

	public function delete($id){
		$filter = $this->_primary_filter;
		$id = $filter($id);
		
		if (!$id) {
			return FALSE;
		}
		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
	}

	public function hash($string) {
		return hash("sha512", $string . config_item("encryption_key"));
	}


	function get_table_users($table, $email) {
		$user = $this->db->get_where($table, array("email" => $email));
		return $user->row();
	}

	function get_admin() {
		$query = $this->db->get_where('setting', array('SettingID' => 1));
		return $query->row();
	}



	/* infinite code starts here */
}

/* End of file student_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/student_m.php */
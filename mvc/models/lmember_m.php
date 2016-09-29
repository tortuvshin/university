<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lmember_m extends MY_Model {

	protected $_table_name = 'lmember';
	protected $_primary_key = 'lmemberID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "lmemberID asc";

	function __construct() {
		parent::__construct();
	}

	function get_lmember_sID($id) {
		$this->db->select('*')->from('lmember')->where(array('studentID' => $id));
		$query = $this->db->get();
		return $query->row();
	}

	function get_lmember($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_single_lmember($array=NULL) {
		$query = parent::get_single($array);
		return $query;
	}

	function get_lmember_lastID() {
		$this->db->select('*')->from('lmember')->order_by('lmemberID desc')->limit(1, 0);
		$query = $this->db->get();
		return $query->row();
	}

	function get_order_by_lmember($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_lmember($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_lmember($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_lmember($id){
		parent::delete($id);
	}

	public function delete_lmember_sID($id){
		$this->db->where('studentID', $id);
		$this->db->delete("lmember");
		return TRUE;
	}
}

/* End of file lmember_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/lmember_m.php */
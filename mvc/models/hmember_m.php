<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hmember_m extends MY_Model {

	protected $_table_name = 'hmember';
	protected $_primary_key = 'hmemberID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "hmemberID asc";

	function __construct() {
		parent::__construct();
	}

	function get_hmember($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_single_hmember($array=NULL) {
		$query = parent::get_single($array);
		return $query;
	}

	function get_hmember_lastID() {
		$this->db->select('*')->from('hmember')->order_by('hmemberID desc')->limit(1, 0);
		$query = $this->db->get();
		return $query->row();
	}

	function get_order_by_hmember($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_hmember($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_hmember($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_hmember($id){
		parent::delete($id);
	}

	public function delete_hmember_sID($id){
		$this->db->where('studentID', $id);
		$this->db->delete("hmember");
		return TRUE;
	}

	public function delete_hmember_hID($id){
		$this->db->where('hostelID', $id);
		$this->db->delete("hmember");
		return TRUE;
	}

	public function delete_hmember_hID_fc($id){
		$this->db->where('categoryID', $id);
		$this->db->delete("hmember");
		return TRUE;
	}
}

/* End of file hmember_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/hmember_m.php */
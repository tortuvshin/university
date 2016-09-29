<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class category_m extends MY_Model {

	protected $_table_name = 'category';
	protected $_primary_key = 'categoryID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "class_type asc";

	function __construct() {
		parent::__construct();
	}

	function get_join_category() {
		$this->db->select('*');
		$this->db->from('category');
		$this->db->join('hostel', 'category.hostelID = hostel.hostelID', 'LEFT');
		$query = $this->db->get();
		return $query->result();
	}

	function get_category($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_category($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_single_category($array=NULL) {
		$query = parent::get_single($array);
		return $query;
	}

	function insert_category($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_category($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_category($id){
		parent::delete($id);
	}
}

/* End of file category_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/category_m.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class teacher_m extends MY_Model {

	protected $_table_name = 'teacher';
	protected $_primary_key = 'teacherID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "name asc";

	function __construct() {
		parent::__construct();
	}

	function get_username($table, $data=NULL) {
		$query = $this->db->get_where($table, $data);
		return $query->result();
	}


	function get_teacher($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_teacher($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_single_teacher($array) {
		$query = parent::get_single($array);
		return $query;
	}

	function insert_teacher($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_teacher($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	function delete_teacher($id){
		parent::delete($id);
	}

	function hash($string) {
		return parent::hash($string);
	}
}

/* End of file teacher_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/teacher_m.php */

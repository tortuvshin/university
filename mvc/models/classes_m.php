<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classes_m extends MY_Model {

	protected $_table_name = 'classes';
	protected $_primary_key = 'classesID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "classes_numeric asc";

	function __construct() {
		parent::__construct();
	}

	function get_join_classes() {
		$this->db->select('*');
		$this->db->from('classes');
		$this->db->join('teacher', 'classes.teacherID = teacher.teacherID', 'LEFT');
		$query = $this->db->get();
		return $query->result();
	}

	function get_teacher() {
		$this->db->select('*')->from('teacher');
		$query = $this->db->get();
		return $query->result();
	}

	function get_classes($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_classes($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_classes($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_classes($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_classes($id){
		parent::delete($id);
	}

	function get_order_by_numeric_classes() {
		$this->db->select('*')->from('classes')->order_by('classes_numeric asc');
		$query = $this->db->get();
		return $query->result();
	}
}

/* End of file classes_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/classes_m.php */
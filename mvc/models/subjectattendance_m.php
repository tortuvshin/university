<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subjectattendance_m extends MY_Model {

	protected $_table_name = 'sub_attendance';
	protected $_primary_key = 'attendanceID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "monthyear asc";

	function __construct() {
		parent::__construct();
	}

	function get_sub_attendance($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_sub_attendance($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_sub_attendance($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_sub_attendance($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	function update_sub_attendance_classes($array, $id) {
		$this->db->update($this->_table_name, $array, $id);
		return $id;
	}

	public function delete_sub_attendance($id){
		parent::delete($id);
	}

}
/* End of file sub_attendance_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/sub_attendance_m.php */

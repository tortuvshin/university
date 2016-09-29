<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eattendance_m extends MY_Model {

	protected $_table_name = 'eattendance';
	protected $_primary_key = 'eattendanceID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "eattendance desc";

	function __construct() {
		parent::__construct();
	}

	function get_eattendance($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_eattendance($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_eattendance($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_eattendance($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	function update_eattendance_classes($array, $id) {
		$this->db->update($this->_table_name, $array, $id);
		return $id;
	}

	public function delete_eattendance($id){
		parent::delete($id);
	}


	

}

/* End of file attendance_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/attendance_m.php */